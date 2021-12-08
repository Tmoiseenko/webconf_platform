@extends('layouts.register_app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="row">
                        <div class="col-md-6 register-card programs-card">
                            <div class="card-header color-white">{{ __('front.title.programs') }}</div>
                            <div class="row">
                                @if($programs)
                                    @foreach($programs as $program)
                                        <div class="col-md-4 text-center">
                                            <strong>
                                                {{ $program->started_at }} - {{ $program->finished_at }}
                                            </strong>
                                        </div>
                                        <div class="col-md-8">
                                            <p>
                                                <strong>{{ $program->author }}</strong>
                                            </p>
                                            <p>{!! nl2br($program->topic) !!}</p>
                                        </div>
                                    @endforeach
                                    <div class="col-md-12 text-center">
                                        <p>
                                            <strong>
                                                {{ __('front.register.program_not_show') }}
                                            </strong>
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row justify-content-center">
                                <div class="col-md-4">
                                    <div class="d-flex justify-content-center align-items-center text-center h-100">
                                        <img width="150px" height="90px" src="{{ asset('/images/logos/InfocellLogo-HighRes.png') }}">
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="card-header">{{ __('front.title.register') }}</div>
                                </div>
                            </div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="last_name"
                                               class="col-md-4 col-form-label text-md-right">{{ __('front.register.last_name') }}</label>

                                        <div class="col-md-6">
                                            <input id="last_name" type="text"
                                                   class="form-control @error('last_name') is-invalid @enderror"
                                                   name="last_name" value="{{ old('last_name') }}" required
                                                   placeholder="Чехов"
                                                   autocomplete="given-name" autofocus>

                                            @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="first_name"
                                               class="col-md-4 col-form-label text-md-right">{{ __('front.register.first_name') }}</label>

                                        <div class="col-md-6">
                                            <input id="first_name" type="text"
                                                   class="form-control @error('first_name') is-invalid @enderror"
                                                   name="first_name" value="{{ old('first_name') }}" required
                                                   placeholder="Антон"
                                                   autocomplete="family-name" autofocus>

                                            @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('front.register.email') }}</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   name="email" value="{{ old('email') }}" required
                                                   placeholder="email@mail.com"
                                                   autocomplete="email">

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('front.register.phone') }}</label>

                                        <div class="col-md-6">
                                            <input id="phone" type="tel"
                                                   class="form-control @error('phone') is-invalid @enderror"
                                                   placeholder="+7(99) 999-99-99"
                                                   name="phone" value="{{ old('phone') }}" required>

                                            @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="company"
                                               class="col-md-4 col-form-label text-md-right">{{ __('front.register.company') }}</label>

                                        <div class="col-md-6">
                                            <input id="company" type="company"
                                                   class="form-control @error('company') is-invalid @enderror"
                                                   name="company" value="{{ old('company') }}" required
                                                   placeholder="Рога и копыта"
                                                   autocomplete="company">

                                            @error('company')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="position"
                                               class="col-md-4 col-form-label text-md-right">{{ __('front.register.position') }}</label>

                                        <div class="col-md-6">
                                            <input id="position" type="position"
                                                   class="form-control @error('position') is-invalid @enderror"
                                                   name="position" value="{{ old('position') }}" required
                                                   placeholder="Писатель"
                                                   autocomplete="position">

                                            @error('position')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password"
                                               class="col-md-4 col-form-label text-md-right">{{ __('front.register.password') }}</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   name="password" required autocomplete="new-password">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group mt-5">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="agree"
                                                   id="customCheck1" required>
                                            <label class="custom-control-label super-small" for="customCheck1">{{ __('front.register.agree') }}</label>

                                            @error('agree')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group text-center mt-5">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('front.register.registe_button') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <div class="col-md-5 mt-5">
                    <a href="{{ route('login') }}" class="btn btn-light w-100 mt-3">{{ __('front.register.im_registred') }}</a>
                </div>
        </div>
    </div>
@endsection
