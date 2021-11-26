@extends('layouts.login_app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Изменить пароль</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <!-- Password Reset Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <!-- Email Address -->
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="email">Email</label>
                            <div class="col-md-6">
                                <input id="email" class="form-control" type="email" name="email" value="{{ Request::get('email') }}" required autofocus />
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="password">Новый пароль</label>
                            <div class="col-md-6">
                                <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" required />

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="password_confirmation">Еще раз новый пароль</label>
                            <div class="col-md-6">
                                <input id="password_confirmation" class="form-control"
                                                    type="password"
                                                    name="password_confirmation" required />
                            </div>
                        </div>

                        <div class="text-center mt-5">
                            <button type="submit" class="btn btn-primary">
                                Изменить пароль
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection