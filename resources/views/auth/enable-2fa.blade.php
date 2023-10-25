@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Enable Two-Factor Authentication</div>

                <div class="card-body">
                    <p>Scan the QR code with the Google Authenticator app or enter the code manually to enable two-factor authentication.</p>
                    <div class="text-center">
                        {!! $qrCode !!}
                    </div>
                    <form method="POST" action="{{ route('enable-2fa.verify') }}">
                        @csrf
                        <div class="form-group">
                            <label for="2fa_code" class="col-md-4 col-form-label text-md-right">Enter 2FA Code:</label>
                            <div class="col-md-6">
                                <input id="2fa_code" type="text" class="form-control" name="2fa_code" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Verify and Enable 2FA
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
