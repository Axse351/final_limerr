<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Transaksi;
use Endroid\QrCode\Builder\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class WaSenderController extends Controller
{
    public function index()
    {
        return view("admin.pages.wa.index");
    }

    public function generateQrcodeWa()
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('http://localhost:3000/api/qr-code');

        $qrCode = json_decode($response->body());

        return response()->json($qrCode);
    }

    public function storeTransaksiQrCode(Request $request)
    {
        ini_set('max_execution_time', 180);

        $request->validate([
            'nm_konsumen' => 'required|string|max:255',
            'nohp' => 'required|string|max:20',
            'paket_id' => 'required',
        ]);

        $qrCodeText = rand();

        $fileName = $qrCodeText . '.png';
        $qrCodePath = 'public/qrcodes/' . $fileName;

        $result = Builder::create()
            ->data($qrCodeText)
            ->size(300)
            ->margin(10)
            ->build();

        Storage::put($qrCodePath, $result->getString());

        $urlQrcode = url('storage/qrcodes/' . $fileName);

        $paket = Paket::where('id', $request->paket_id)->first();

        $message = "Halo, $request->nm_konsumen Berikut adalah Tiket Pesanan Anda :
                    \n Nama Konsumen : $request->nm_konsumen,
                    \n Nama Paket    : $paket->nm_paket,
                    \n Kuota Wahana  : $paket->wahana
                    \n Kuota Porsi  : $paket->porsi
                  ";

        $params = [
            "phone" => $request->nohp,
            "message" => $message,
            "file" => $urlQrcode
        ];

        try {
            $post = $request->all();
            $post['barcode'] = $fileName;

            Transaksi::create($post);

            $response = Http::timeout(60)->withHeaders([
                'Content-Type' => 'application/json',
            ])->post('http://localhost:3000/api/send-message-media', $params);

            if ($response->failed()) {
                return back()->withErrors(['error' => $response->body()]);
            }

            return back()->with('success', 'Berhasil Membuat Transaksi. QrCode Telah Di Kirim Ke Whatsaap');
        } catch (\Exception $e) {
            return back()->with('success', 'Berhasil Membuat Transaksi. QrCode Telah Di Kirim Ke Whatsaap');
        }
    }
}
