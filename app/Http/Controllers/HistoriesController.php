<?php

namespace App\Http\Controllers;

use App\Models\Histories; // Model History
use App\Models\History;
use App\Models\Paket;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HistoriesController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data barcode dari request jika ada
        $barcode = $request->input('barcode');

        // Query untuk mengambil data histori
        $histories = Histories::when($barcode, function ($query, $barcode) {
            return $query->where('barcode', $barcode);
        })->paginate(10);

        return view('staff.pages.histories.index', compact('histories', 'barcode'));
    }
    public function showScanForm()
    {
        // Dapatkan transaksi ID (jika tidak ada, berikan nilai default atau null)
        $transaksiId = null; // Contoh nilai atau didapatkan dari DB

        return view('staff.pages.histories.index', compact('transaksiId'));
    }
    public function index_admin(Request $request)
    {
        // Ambil data barcode dari request jika ada
        $barcode = $request->input('barcode');

        // Query untuk mengambil data histori
        $histories = Histories::when($barcode, function ($query, $barcode) {
            return $query->where('barcode', $barcode);
        })->paginate(10); // Pagination data

        return view('admin.pages.histories.index', compact('histories', 'barcode'));
    }
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'jenis_transaksi' => 'required'
        ]);

        if ($validation->fails()) {
            return response()->json(['code' => 400, 'errors' => $validation->errors()]);
        }

        $checkHistory = Histories::with(['transaksi', 'transaksi.paket'])
            ->where('transaksi_id', $request->transaksi_id)
            ->where('jenis_transaksi', $request->jenis_transaksi)
            ->first();

        $batasWahana = $checkHistory?->transaksi->paket->wahana ?? 0;
        $batasPorsi = $checkHistory?->transaksi->paket->porsi ?? 0;

        $totalHistory = Histories::where('transaksi_id', $request->transaksi_id)
            ->where('jenis_transaksi', $request->jenis_transaksi)
            ->count();

        $post = $request->all();
        $post['tanggal'] = Carbon::now();
        $post['jam'] = Carbon::now()->format('H:i:s');
        $post['qty'] = 1;
        $post['user_id'] = Auth::user()->id;

        if (!$checkHistory) {
            Histories::create($post);
            return response()->json(['code' => 200, 'message' => 'Berhasil Menyimpan History Baru']);
        }

        if ($request->input('jenis_transaksi') === 'wahana') {
            if ($totalHistory >= $batasWahana) {
                return response()->json(['code' => 400, 'message' => 'Kuota Wahana Sudah Habis.']);
            }
        } else {
            if ($totalHistory >= $batasPorsi) {
                return response()->json(['code' => 400, 'message' => 'Kuota Porsi Sudah Habis.']);
            }
        }

        Histories::create($post);
        return response()->json(['code' => 200, 'message' => 'Berhasil Menyimpan Data']);
    }




    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'qrcode' => 'required|string',
            'jenis_transaksi' => 'required|string',
            'qty' => 'required|integer',
            'tanggal' => 'required|date',
            'jam' => 'required|string',
        ]);

        // Find the history entry by ID
        $history = Histories::findOrFail($id);

        // Update the entry with new data
        $history->update([
            'jenis_transaksi' => $request->jenis_transaksi,
            'qty' => $request->qty,
            'tanggal' => now(),
            'jam' => now()->format('H:i:s'),
            // If you need to update the user or namawahana, add those fields here
        ]);

        return redirect()->back()->with('success', 'History updated successfully');
    }

    public function updateQty(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'qty' => 'required|integer',
        ]);

        // Find the history entry by ID
        $history = Histories::findOrFail($id);

        // Update the quantity only
        $history->update([
            'qty' => $request->qty,
            'tanggal' => now(),
            'jam' => now()->format('H:i:s'),
        ]);

        return redirect()->back()->with('success', 'Quantity updated successfully');
    }
}
