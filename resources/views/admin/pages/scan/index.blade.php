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
                                <button id="start-scan-btn" class="btn btn-primary mb-3">Start Scan</button>
                                <form id="scanForm" action="{{ route('scan.process') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="qrcode" id="qrcodeInput">
                                    <input type="hidden" name="action" id="actionInput">
                                </form>
                                <audio id="scanSuccessSound" src="{{ asset('sounds/scan-success.mp3') }}"></audio>
                            </div>
                        </div>
                    </div>
                </div>

              

            </div>
        </section>
    </div>

      <!-- Modal for displaying scan result and dropdown -->
      <div class="modal fade" id="scanResultModal" tabindex="-1" role="dialog" aria-labelledby="scanResultModalLabel" aria-hidden="true">
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
                    <!-- Dropdown for selecting action -->
                    <div class="form-group">
                        <label for="actionSelect">Choose Action:</label>
                        <select class="form-control" id="actionSelect">
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
<script>
    // Play sound on successful scan
    function playScanSuccessSound() {
        const audio = document.getElementById('scanSuccessSound');
        audio.currentTime = 0; // Reset to the start of the sound
        audio.play(); // Play the sound
    }

    // Show modal popup with scan result and action dropdown
    function showScanResult(decodedText) {
        document.getElementById('scanResultText').textContent = decodedText;
        $('#scanResultModal').modal('show'); // Show the Bootstrap modal
    }

    function onScanSuccess(decodedText, decodedResult) {
        console.log(`Code matched = ${decodedText}`, decodedResult);
        document.getElementById('qrcodeInput').value = decodedText;
        playScanSuccessSound(); // Play sound on successful scan

        // Show the scan result in a modal popup
        showScanResult(decodedText);
    }

    function onScanFailure(error) {
        console.warn(`Code scan error = ${error}`);
    }

    document.getElementById('start-scan-btn').addEventListener('click', function() {
        document.getElementById('qr-reader').style.display = 'block'; // Show the QR reader
        const html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", { 
            fps: 10, 
            qrbox: 250 
        });
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    });

    // Handle the Confirm button click in the modal
  
</script>
<script>
      document.getElementById('confirmActionBtn').addEventListener('click', function() {
        const selectedAction = document.getElementById('actionSelect').value;
        document.getElementById('actionInput').value = selectedAction; // Set the action input value

        // Submit the form
        document.getElementById('scanForm').submit();
    });
</script>
@endpush

