@extends('admin.layouts.app')

@section('title', 'Scan QR Code')

@push('style')
    <style>
        #qr-reader {
            width: 100%;
            height: auto;
            display: none;
        }
    </style>
@endpush

@section('admin.content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Scan QR Code</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('admin.layouts.alert')
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h4>Scan QR Code</h4>
                            </div>
                            <div class="card-body">
                                <div id="qr-reader"></div>
                                <div class="row mt-3">
                                    <div class="col-lg-4">
                                        <button id="start-scan-btn" class="btn btn-primary w-100 mt-1">Start Scan</button>
                                    </div>
                                    <div class="col-lg-4">
                                        <select id="cameraSelection" class="form-control">
                                            <option value="">Pilih Kamera</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <input type="file" id="qr-upload" accept="image/*" class="form-control">
                                    </div>
                                </div>
                                <audio id="scanSuccessSound" src="{{ asset('sounds/scan-success.mp3') }}"></audio>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal for displaying scan result and dropdown -->
    <div class="modal fade" id="scanResultModal" tabindex="-1" role="dialog" aria-labelledby="scanResultModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scanResultModalLabel">Scan Result</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="scanResultText">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Kode Unik</th>
                                    <th>Nama Konsumen</th>
                                    <th>Nama Paket</th>
                                    <th>Wahana</th>
                                    <th>Porsi</th>
                                </tr>
                            </thead>
                            <tbody id="append-result">

                            </tbody>
                        </table>
                    </div>
                    <!-- Dropdown for selecting action -->
                    <input type="hidden" name="transaksi_id" id="transaksi_id">
                    <input type="hidden" name="namawahana" id="namawahana">
                    <div class="form-group">
                        <label for="actionSelect">Choose Action:</label>
                        <select class="form-control" id="jenis_transaksi" name="jenis_transaksi">
                            <option value="wahana">Pengurangan Wahana</option>
                            <option value="porsi">Pengurangan Porsi</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="confirmActionBtn">Confirm</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });

            function playScanSuccessSound() {
                const audio = document.getElementById('scanSuccessSound');
                audio.currentTime = 0;
                audio.play();
            }

            function showScanResult(decodedText) {
                $('#scanResultModal').modal('show');
                $.ajax({
                    url: `{{ url('staff/checkTransaksi/${decodedText}') }}`,
                    method: "GET",
                    dataType: "json",
                    success: function(response) {
                        if (response.code == 200) {
                            $("#transaksi_id").val(response.data.id);
                            $("#namawahana").val(response.data.paket.nm_paket);
                            let html = `<tr>
                                            <td>${response.data.barcode}</td>
                                            <td>${response.data.nm_konsumen}</td>
                                            <td>${response.data.paket.nm_paket}</td>
                                            <td>${response.data.paket.wahana}</td>
                                            <td>${response.data.paket.porsi}</td>
                                        </tr>`;
                            $("#append-result").html(html);
                        } else {
                            alert('Data Tidak Ditemukan');
                        }
                    },
                    error: function(err) {
                        console.log(err);
                    }
                })
            }

            function onScanSuccess(decodedText) {
                playScanSuccessSound();
                showScanResult(decodedText + '.png');
                document.getElementById('qrcodeInput').value = decodedText;
            }

            function onScanFailure(error) {
                console.warn(`Code scan error = ${error}`);
            }

            Html5Qrcode.getCameras().then(devices => {
                if (devices && devices.length) {
                    const cameraSelection = $('#cameraSelection');
                    devices.forEach(device => {
                        cameraSelection.append(new Option(device.label, device.id));
                    });
                }
            }).catch(err => console.error("Error mendapatkan kamera:", err));

            $('#start-scan-btn').click(function() {
                const cameraId = $('#cameraSelection').val();
                if (cameraId) {
                    document.getElementById('qr-reader').style.display = 'block';
                    const html5QrcodeScanner = new Html5Qrcode("qr-reader");
                    html5QrcodeScanner.start(
                        cameraId,
                        { fps: 10, qrbox: 250 },
                        onScanSuccess,
                        onScanFailure
                    ).catch(err => console.error("Error memulai scan:", err));
                } else {
                    Toast.fire({
                        icon: "warning",
                        title: "Silahkan Pilih Kamera Terlebih Dahulu"
                    });
                }
            });

            document.getElementById('qr-upload').addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const html5QrCode = new Html5Qrcode("qr-reader");
                    html5QrCode.scanFile(file, true)
                        .then(onScanSuccess)
                        .catch(onScanFailure);
                }
            });

            $("#confirmActionBtn").click(function(e) {
                $.ajax({
                    url: "{{ route('staff.histories.store') }}",
                    method: "POST",
                    data: {
                        transaksi_id: $("#transaksi_id").val(),
                        namawahana: $("#namawahana").val(),
                        jenis_transaksi: $("#jenis_transaksi").val(),
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.code == 200) {
                            Toast.fire({
                                icon: "success",
                                title: response.message
                            });
                            $('#scanResultModal').modal('hide');
                            window.location.reload();
                        } else {
                            Toast.fire({
                                icon: "error",
                                title: response.message
                            });
                        }
                    },
                    error: function(err) {
                        console.log(err);
                    }
                })
            });
        });
    </script>
@endpush
