<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Paket;
use Illuminate\Support\Facades\Session;
use Picqer\Barcode\BarcodeGeneratorPNG;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Twilio\Rest\Client;

class TransaksiController extends Controller
{
    protected $paginationLimit = 10; // Define pagination limit for easier adjustment

    public function index(Request $request)
    {
        $query = Transaksi::with('paket');

        if ($request->has('name')) {
            $query->where('nm_konsumen', 'LIKE', '%' . $request->name . '%');
        }

        $transaksis = $query->paginate($this->paginationLimit);

        return view('staff.pages.transaksi.index', compact('transaksis'));
    }

    public function index_admin(Request $request)
    {
        $query = Transaksi::with('paket');

        if ($request->has('name')) {
            $query->where('nm_konsumen', 'LIKE', '%' . $request->name . '%');
        }

        $transaksis = $query->paginate($this->paginationLimit);

        return view('admin.pages.transaksi.index', compact('transaksis'));
    }

    private function generateBarcodeSession()
    {
        if (!Session::has('barcode')) {
            $barcode = 'barcode-' . uniqid();
            Session::put('barcode', $barcode);
        }
        return Session::get('barcode');
    }

    public function create()
    {
        $pakets = Paket::all();
        $barcode = $this->generateBarcodeSession();

        return view('staff.pages.transaksi.create', compact('pakets', 'barcode'));
    }

    public function createadmin()
    {
        $pakets = Paket::all();
        $barcode = $this->generateBarcodeSession();

        return view('admin.pages.transaksi.create', compact('pakets', 'barcode'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nm_konsumen' => 'required|string|max:255',
            'nohp' => 'required|string|max:20',
            'paket_id' => 'required|exists:pakets,id',
        ]);

        Transaksi::create([
            'nm_konsumen' => $request->nm_konsumen,
            'nohp' => $request->nohp,
            'paket_id' => $request->paket_id,
            'barcode' => rand()
        ]);

        return redirect()->route('staff.transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function storeadmin(Request $request)
    {
        $request->validate([
            'nm_konsumen' => 'required|string|max:255',
            'nohp' => 'required|string|max:20',
            'paket_id' => 'required',
        ]);

        Transaksi::create([
            'nm_konsumen' => $request->nm_konsumen,
            'nohp' => $request->nohp,
            'paket_id' => $request->paket_id,
            'barcode' => rand(),
        ]);

        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil ditambahkan oleh Admin.');
    }

    public function getLatestTransactionId()
    {
        return Transaksi::latest('created_at')->value('id');
    }

    public function sendWhatsAppMessageWithBarcode($nohp, $message, $barcodeData)
    {
        $generator = new BarcodeGeneratorPNG();
        $barcodeImage = $generator->getBarcode($barcodeData, $generator::TYPE_CODE_128);

        $barcodePath = 'barcodes/' . $barcodeData . '.png';
        Storage::disk('public')->put($barcodePath, $barcodeImage);

        $barcodeUrl = asset('storage/' . $barcodePath);
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $twilioNumber = env('TWILIO_PHONE_NUMBER');

        $client = new Client($sid, $token);

        $client->messages->create(
            "whatsapp:" . $nohp,
            [
                'from' => "whatsapp:" . $twilioNumber,
                'body' => $message,
                'mediaUrl' => $barcodeUrl
            ]
        );

        Storage::disk('public')->delete($barcodePath);
    }

    public function getPaket($id)
    {
        $paket = Paket::findOrFail($id);

        return response()->json([
            'wahana' => $paket->wahana,
            'porsi' => $paket->porsi,
            'nm_paket' => $paket->nm_paket
        ]);
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        unlink(public_path('storage/qrcodes/' . $transaksi->barcode));

        $transaksi->delete();

        return redirect()->route('staff.transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }

    public function checkTransaksi($barcode)
    {
        $transaksi = Transaksi::with(['paket'])->where('barcode', $barcode)->first();

        if (!$transaksi) {
            return response()->json(['code' => 404, 'message' => 'Data Not Found !']);
        }

        return response()->json(['code' => 200, 'message' => 'Data Found', 'data' => $transaksi]);
    }
}
