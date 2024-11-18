@extends('admin.layouts.app')

@section('title', 'Setting Wa Sender')

@push('style')
@endpush

@section('admin.content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>LIMERR RESORT ADMIN</h1>
            </div>
        </section>

        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <b>Qr Code Whatsaap</b>
                    </div>
                    <div class="card-body">
                        <div id="show-qr">
                    
                        </div>

                        <div class="mt-3">
                            <a href="javascript:void(0)" onclick="return refreshQrCode()" class="btn btn-primary w-100">Refresh</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <b>Langkah Langkah Mengaktifkan Whatsaap Sender</b>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>
                                Jika Masih Ada Pesan Menunggu Server Silahkan Tekan Tombol <b>Refresh</b> Di Atas Qr Code
                            </li>
                            <li>
                                Silahkan Scan Qr Code Di Samping Menggunakan Aplikasi Whatsaap
                            </li>
                            <li>
                                Jika Di Aplikasi Whatsaap Sudah Berhasil Menscan Qrcode Silahkan Tekan Tombol <b>Refresh</b> Untuk Merefresh Status QrCode
                            </li>
                            <li>
                                Jika Sudah Tampil Pesan Status Berhasil Login Ke Whatsaap Berarti Sudah Berhasil
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        generateQrCode();
        function generateQrCode() {
            $.ajax({
                url: `{{route('admin.wa.generateQrcodeWa')}}`,
                method: "POST",
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    if (response.isScanned == true && response.status == false) {
                        $("#show-qr").html(`<div class="alert alert-primary">
                                                        <strong>Sudah Login Ke Whatsaap</strong>
                                                    </div>`)
                    } else if(response.isScanned == false && response.status == true) {
                        $("#show-qr").html(`<img src="${response.qrcode}" alt="" style="width: 100%">`);
                    } else {
                        $("#show-qr").html(`<div class="alert alert-warning">
                                                        <strong>Menunggu Server Aktif</strong>
                                                    </div>`);
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            })
        }

        function refreshQrCode() {
            generateQrCode();
        }
    </script>
@endpush
