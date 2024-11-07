<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Paket;
use App\Models\Histories;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\VarDumper\Caster\RedisCaster;

class ScanController extends Controller
{
    public function index()
    {
        return view('staff.pages.scan.index');
    }

    public function indexscan()
    {
        return view('admin.pages.scan.index');
    }

    public function scan_one()
    {
        return view('scan1.pages.scan.index');
    }

    public function scan_two()
    {
        return view('scan2.pages.scan.index');
    }

    public function scan_three()
    {
        return view('scan3.pages.scan.index');
    }

    public function scan(Request $request)
    {
        $validatedData = $request->validate([
            'qrcode' => 'required|string',
            'action' => 'required|string', // Pastikan 'action' ada dalam request
        ]);

        Log::info('Validated Data:', $validatedData);

        // Ambil data yang dipindai dan aksi yang dipilih
        $scannedData = $validatedData['qrcode'];
        $action = $validatedData['action'];

        // Temukan transaksi berdasarkan QR code
        $transaction = Transaksi::where('qrcode', $scannedData)->first();

        if (!$transaction) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan untuk QR code yang dipindai.');
        }

        // Ambil paket terkait untuk memeriksa jumlah yang tersedia
        $paket = Paket::find($transaction->paket_id); // Mengasumsikan Anda memiliki paket_id di model transaksi

        if (!$paket) {
            return redirect()->back()->with('error', 'Paket tidak ditemukan.');
        }

        // Hitung total sejarah yang ada untuk transaksi ini
        $totalHistories = Histories::where('transaksi_id', $transaction->id)
            ->where('jenis_transaksi', $action === 'wahana' ? 'Pengurangan Wahana' : 'Pengurangan Porsi')
            ->sum('qty');

        // Tentukan batas untuk pemindaian
        $availableQuantity = $paket->quantity; // Mengasumsikan jumlah tersedia disimpan di model paket
        if ($totalHistories >= $availableQuantity) {
            return redirect()->back()->with('error', 'Tidak dapat memindai: batas terlampaui untuk paket ini.');
        }

        // Lanjutkan dengan pemindaian
        $transaksiId = $transaction->id;
        $user = auth()->user();
        $jenisTransaksi = $action === 'wahana' ? 'Pengurangan Wahana' : 'Pengurangan Porsi';

        // Siapkan data untuk tabel histories
        $historyData = [
            'transaksi_id' => $transaksiId,
            'jenis_transaksi' => $jenisTransaksi,
            'tanggal' => now()->toDateString(),
            'jam' => now()->toTimeString(),
            'qty' => 1, // Ubah sesuai kebutuhan, ini bisa dinamis berdasarkan kasus penggunaan Anda
            'user_id' => $user->id, // Sertakan ID pengguna untuk pelacakan
            'namawahana' => $user->namawahana, // Pastikan properti ini ada di model pengguna Anda
        ];
        Log::info('History Data to Save:', $historyData);
        // Insert rekaman sejarah
        try {
            Histories::create($historyData);
            Log::info('History created successfully:', $historyData);
        } catch (\Exception $e) {
            Log::error('Error saving history:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }

        return redirect()->back()->with('success', 'Data berhasil dipindai dan disimpan di histories!');
    }


    // public function showScanForm()
    // {
    //     // Logic to get transaksi_id based on conditions, e.g., fetching from the database
    //     $transaksiId = 'your_transaction_id_here'; // Example value or fetched from DB

    //     return view('staff.pages.histories.index', compact('transaksiId'));
    // }



    public function scan_satu(Request $request)
    {

        $validatedData = $request->validate([
            'qrcode' => 'required|string',
            'action' => 'required|string', // Pastikan 'action' ada dalam request
        ]);

        Log::info('Validated Data:', $validatedData);

        // Ambil data yang dipindai dan aksi yang dipilih
        $scannedData = $validatedData['qrcode'];
        $action = $validatedData['action'];

        // Temukan transaksi berdasarkan QR code
        $transaction = Transaksi::where('qrcode', $scannedData)->first();

        if (!$transaction) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan untuk QR code yang dipindai.');
        }

        // Ambil paket terkait untuk memeriksa jumlah yang tersedia
        $paket = Paket::find($transaction->paket_id); // Mengasumsikan Anda memiliki paket_id di model transaksi

        if (!$paket) {
            return redirect()->back()->with('error', 'Paket tidak ditemukan.');
        }

        // Hitung total sejarah yang ada untuk transaksi ini
        $totalHistories = Histories::where('transaksi_id', $transaction->id)
            ->where('jenis_transaksi', $action === 'wahana' ? 'Pengurangan Wahana' : 'Pengurangan Porsi')
            ->sum('qty');

        // Tentukan batas untuk pemindaian
        $availableQuantity = $paket->quantity; // Mengasumsikan jumlah tersedia disimpan di model paket
        if ($totalHistories >= $availableQuantity) {
            return redirect()->back()->with('error', 'Tidak dapat memindai: batas terlampaui untuk paket ini.');
        }

        // Lanjutkan dengan pemindaian
        $transaksiId = $transaction->id;
        $user = auth()->user();
        $jenisTransaksi = $action === 'wahana' ? 'Pengurangan Wahana' : 'Pengurangan Porsi';

        // Siapkan data untuk tabel histories
        $historyData = [
            'transaksi_id' => $transaksiId,
            'jenis_transaksi' => $jenisTransaksi,
            'tanggal' => now()->toDateString(),
            'jam' => now()->toTimeString(),
            'qty' => 1, // Ubah sesuai kebutuhan, ini bisa dinamis berdasarkan kasus penggunaan Anda
            'user_id' => $user->id, // Sertakan ID pengguna untuk pelacakan
            'namawahana' => $user->namawahana, // Pastikan properti ini ada di model pengguna Anda
        ];
        Log::info('History Data to Save:', $historyData);
        // Insert rekaman sejarah
        try {
            Histories::create($historyData);
            Log::info('History created successfully:', $historyData);
        } catch (\Exception $e) {
            Log::error('Error saving history:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }

        return redirect()->back()->with('success', 'Data berhasil dipindai dan disimpan di histories!');
    }


    public function scan_dua(Request $request)
    {
        $validatedData = $request->validate([
            'qrcode' => 'required|string',
            'action' => 'required|string', // Pastikan 'action' ada dalam request
        ]);

        Log::info('Validated Data:', $validatedData);

        // Ambil data yang dipindai dan aksi yang dipilih
        $scannedData = $validatedData['qrcode'];
        $action = $validatedData['action'];

        // Temukan transaksi berdasarkan QR code
        $transaction = Transaksi::where('qrcode', $scannedData)->first();

        if (!$transaction) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan untuk QR code yang dipindai.');
        }

        // Ambil paket terkait untuk memeriksa jumlah yang tersedia
        $paket = Paket::find($transaction->paket_id); // Mengasumsikan Anda memiliki paket_id di model transaksi

        if (!$paket) {
            return redirect()->back()->with('error', 'Paket tidak ditemukan.');
        }

        // Hitung total sejarah yang ada untuk transaksi ini
        $totalHistories = Histories::where('transaksi_id', $transaction->id)
            ->where('jenis_transaksi', $action === 'wahana' ? 'Pengurangan Wahana' : 'Pengurangan Porsi')
            ->sum('qty');

        // Tentukan batas untuk pemindaian
        $availableQuantity = $paket->quantity; // Mengasumsikan jumlah tersedia disimpan di model paket
        if ($totalHistories >= $availableQuantity) {
            return redirect()->back()->with('error', 'Tidak dapat memindai: batas terlampaui untuk paket ini.');
        }

        // Lanjutkan dengan pemindaian
        $transaksiId = $transaction->id;
        $user = auth()->user();
        $jenisTransaksi = $action === 'wahana' ? 'Pengurangan Wahana' : 'Pengurangan Porsi';

        // Siapkan data untuk tabel histories
        $historyData = [
            'transaksi_id' => $transaksiId,
            'jenis_transaksi' => $jenisTransaksi,
            'tanggal' => now()->toDateString(),
            'jam' => now()->toTimeString(),
            'qty' => 1, // Ubah sesuai kebutuhan, ini bisa dinamis berdasarkan kasus penggunaan Anda
            'user_id' => $user->id, // Sertakan ID pengguna untuk pelacakan
            'namawahana' => $user->namawahana, // Pastikan properti ini ada di model pengguna Anda
        ];
        Log::info('History Data to Save:', $historyData);
        // Insert rekaman sejarah
        try {
            Histories::create($historyData);
            Log::info('History created successfully:', $historyData);
        } catch (\Exception $e) {
            Log::error('Error saving history:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }

        return redirect()->back()->with('success', 'Data berhasil dipindai dan disimpan di histories!');
    }

    public function scannn(Request $request)
    {
        $qrcode = $request->input('qrcode');

        // Validasi QR Code
        if (!$qrcode) {
            return back()->withErrors('QR Code tidak terbaca!');
        }

        // Proses lebih lanjut (contoh: cek QR code, simpan transaksi, dsb.)
        // Implement your QR code processing logic here

        return redirect()->route('scan1.scan.index')->with('success', 'QR Code berhasil diproses: ' . $qrcode);
    }

    public function scannnn(Request $request)
    {
        $qrcode = $request->input('qrcode');

        // Validasi QR Code
        if (!$qrcode) {
            return back()->withErrors('QR Code tidak terbaca!');
        }

        // Proses lebih lanjut (contoh: cek QR code, simpan transaksi, dsb.)
        // Implement your QR code processing logic here

        return redirect()->route('scan1.scan.index')->with('success', 'QR Code berhasil diproses: ' . $qrcode);
    }
}
