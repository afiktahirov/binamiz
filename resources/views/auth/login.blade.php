@extends('layouts.app')

@section('content')
<div class="container-fluid mb-7">
    <section>
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                        <div class="card card-plain mt-8">
                            <div class="card-header pb-0 text-left bg-transparent">
                                <h3 class="font-weight-bolder text-info text-gradient">Xoş Gəldiniz</h3>
                                <p class="mb-0">Daxil olmaq üçün fin kodunuzu və şifrənizi daxil edin</p>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="mb-3">
                                        <label class="form-label">Fin Kod</label>
                                        <input id="finCode" type="text" name="fin_code"
                                            class="form-control @error('fin_code') is-invalid @enderror"
                                            placeholder="Fin Kod" value="{{ old('fin_code') }}" required autofocus>
                                        @error('fin_code')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Şifrə</label>
                                        <input id="password" type="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Şifrə" required>
                                        @error('password')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">Yadda saxla</label>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">
                                            {{ __('Daxil ol') }}
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                @if (Route::has('password.request'))
                                    <p class="mb-2 text-sm">
                                        <a href="{{ route('password.request') }}" class="font-weight-bold">
                                            Şifrəni unutmusunuz?
                                        </a>
                                    </p>
                                @endif

                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                            <div class="oblique-image position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                                style="background-image:url('http://bina.mmmc.az/storage/uploads/complex/d3HGKCnjQjw8G7WFblxzhgbUe1bTNYBpSiktRl8x.png'); background-size: contain; background-repeat: no-repeat;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
