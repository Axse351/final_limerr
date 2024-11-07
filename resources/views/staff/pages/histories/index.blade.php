@extends('staff.layouts.app')

@section('title', 'Riwayat Transaksi')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('staff.content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Riwayat Transaksi</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Riwayat</a></div>
                    <div class="breadcrumb-item">Riwayat Transaksi</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('staff.layouts.alert')
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Riwayat Transaksi</h4>
                            </div>
                            <div class="card-body">
                                <div class="float-right">
                                    <form id="scanForm" action="{{ route('staff.histories.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="qrcode" id="qrcodeInput">
                                        <input type="hidden" name="jenis_transaksi" id="jenisTransaksiInput">
                                        <input type="hidden" name="qty" value="1">
                                        <input type="hidden" name="tanggal" id="tanggalInput">
                                        <input type="hidden" name="jam" id="jamInput">
                                    </form>
                                </div>

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>
                                            <th class="text-center">Jenis Transaksi</th>
                                            <th class="text-center">Nama Konsumen</th>
                                            <th class="text-center">Tanggal</th>
                                            <th class="text-center">Jam</th>
                                            <th class="text-center">qty</th>
                                            <th class="text-center">Wahana Dipakai</th>
                                            <th class="text-center">Nama Wahana</th>
                                        </tr>
                                        @foreach ($histories as $history)
                                            <tr>
                                                <td class="text-center">{{ $history->jenis_transaksi }}</td>
                                                <td class="text-center">{{ $history->transaksi->nm_konsumen }}</td>
                                                <td class="text-center">{{ $history->tanggal }}</td>
                                                <td class="text-center">{{ $history->jam }}</td>
                                                <td class="text-center">{{ $history->qty }}</td>
                                                <td class="text-center">{{ $history->namawahana }}</td>
                                                <td class="text-center">{{ $history->user->namawahana }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>

                                <div class="float-right">
                                    {{ $histories->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal for scanning -->
    <div class="modal fade" id="scanResultModal" tabindex="-1" role="dialog" aria-labelledby="scanResultModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scanResultModalLabel">Scan Result</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="scanResultText"></p>
                    <div class="form-group">
                        <label for="actionSelect">Choose Action:</label>
                        <select class="form-control" id="actionSelect">
                            <option value="pengurangan Wahana">Pengurangan Wahana</option>
                            <option value="pengurangan Porsi">Pengurangan Porsi</option>
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
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            // Function to handle successful scans
            function onScanSuccess(decodedText, decodedResult) {
                console.log(`Code matched = ${decodedText}`, decodedResult);

                // Prepare data to send to the server
                const scanData = {
                    qrcode: decodedText,
                    jenis_transaksi: 'Pengurangan Wahana', // Adjust based on your logic
                    qty: 1, // Default quantity, adjust as necessary
                    tanggal: new Date().toISOString().split('T')[0], // Current date in YYYY-MM-DD format
                    jam: new Date().toTimeString().split(' ')[0], // Current time in HH:MM:SS format
                    _token: '{{ csrf_token() }}' // Include CSRF token for Laravel
                };

                // Send data via AJAX
                $.ajax({
                    url: '{{ route('staff.histories.store') }}', // Update with your store route
                    type: 'POST',
                    data: scanData,
                    success: function(response) {
                        console.log('Data successfully saved:', response);
                        // Append the new history record to the table
                        const newRow = `
                            <tr>
                                <td class="text-center">${response.jenis_transaksi}</td>
                                <td class="text-center">${response.qrcode}</td>
                                <td class="text-center">${response.tanggal}</td>
                                <td class="text-center">${response.jam}</td>
                                <td class="text-center">${response.qty}</td>
                                <td class="text-center">${response.wahana_dipakai || 'N/A'}</td> <!-- Adjust as necessary -->
                            </tr>
                        `;
                        // Assuming the table has a class 'table'
                        $('.table').append(newRow); // Update your table class if necessary
                    },
                    error: function(xhr, status, error) {
                        console.error('Error saving data:', error);
                    }
                });
            }

            // Start scanning on button click
            document.getElementById('start-scan-btn').addEventListener('click', function() {
                document.getElementById('qr-reader').style.display = 'block'; // Show the QR reader
                const html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", {
                    fps: 10,
                    qrbox: 250
                });
                html5QrcodeScanner.render(onScanSuccess, onScanFailure);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Function to handle scan results
            function showScanResult(decodedText) {
                $('#scanResultText').text(decodedText);
                $('#scanResultModal').modal('show'); // Show modal
                $('#qrcodeInput').val(decodedText); // Set QR code input value
                $('#tanggalInput').val(new Date().toISOString().split('T')[0]); // Set current date
                $('#jamInput').val(new Date().toTimeString().split(' ')[0]); // Set current time
            }

            function onScanSuccess(decodedText, decodedResult) {
                console.log(`Code matched = ${decodedText}`, decodedResult);
                showScanResult(decodedText); // Show the result
            }

            function onScanFailure(error) {
                console.warn(`Code scan error = ${error}`);
            }

            // Start scanning on button click
            document.getElementById('start-scan-btn').addEventListener('click', function() {
                const html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", {
                    fps: 10,
                    qrbox: 250
                });
                html5QrcodeScanner.render(onScanSuccess, onScanFailure);
            });

            // Handle the Confirm button click
            document.getElementById('confirmActionBtn').addEventListener('click', function() {
                const selectedAction = $('#actionSelect').val();
                $('#jenisTransaksiInput').val(selectedAction); // Set transaction type
                $('#scanForm').submit(); // Submit the form
            });
        });
    </script>
@endpush
