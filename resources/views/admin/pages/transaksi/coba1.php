@extends('staff.layouts.app')

@section('title', 'Scan QR Code')

@push('style')
@endpush

@section('staff.content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Scan QR Code</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('staff.layouts.alert')
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h4>Scan QR Code</h4>
                            </div>
                            <div class="card-body">
                                <div id="qr-reader" style="width: 500px; display:none;"></div>
                                <button id="start-scan-btn" class="btn btn-primary mb-3">Start Scan</button>
                                <form id="scanForm" action="{{ route('transaksi.scan') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="qrcode" id="qrcodeInput">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
<script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js" type="text/javascript"></script>
<script>
    function onScanSuccess(decodedText, decodedResult) {
        console.log(`Code matched = ${decodedText}`, decodedResult);
        document.getElementById('qrcodeInput').value = decodedText;
        document.getElementById('scanForm').submit();
    }

    function onScanFailure(error) {
        console.warn(`Code scan error = ${error}`);
    }

    document.getElementById('start-scan-btn').addEventListener('click', function() {
        document.getElementById('qr-reader').style.display = 'block';
        const html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    });
</script>
@endpush
