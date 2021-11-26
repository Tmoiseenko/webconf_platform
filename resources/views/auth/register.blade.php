@extends('layouts.register_app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if(Request::get('promo_page') && Request::get('promo_page') === 'promo')
                <div class="col-sm-7 text-center text-primary mb-5">
                    <h1>ИНФОDAY 2021</h1>

                    <p class="mt-3 display-5">Ссылку на подключение к трансляции вы получите после регистрации на
                        мероприятие</p>
                </div>
            @endif
            <div class="col-md-12">
                <div class="card">
                    <div class="row">
                        <div class="col-md-6 register-card programs-card">
                            <div class="card-header color-white">Программа</div>
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
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row justify-content-center">
                                <div class="col-md-4">
                                    <div class="d-flex justify-content-center align-items-center text-center h-100">
                                        <img width="150px" height="90px" src="/images/logos/InfocellLogo-HighRes.png">
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="card-header">Регистрация</div>
                                </div>
                            </div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="last_name"
                                               class="col-md-4 col-form-label text-md-right">Фамилия</label>

                                        <div class="col-md-6">
                                            <input id="last_name" type="text"
                                                   class="form-control @error('last_name') is-invalid @enderror"
                                                   name="last_name" value="{{ old('last_name') }}" required
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
                                               class="col-md-4 col-form-label text-md-right">Имя</label>

                                        <div class="col-md-6">
                                            <input id="first_name" type="text"
                                                   class="form-control @error('first_name') is-invalid @enderror"
                                                   name="first_name" value="{{ old('first_name') }}" required
                                                   autocomplete="family-name" autofocus>

                                            @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   name="email" value="{{ old('email') }}" required
                                                   autocomplete="email">

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">Телефон</label>

                                        <div class="col-md-6">
                                            <input id="phone" type="tel"
                                                   class="form-control @error('phone') is-invalid @enderror"
                                                   name="phone" value="{{ old('phone') }}" required>

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="company"
                                               class="col-md-4 col-form-label text-md-right">Компания</label>

                                        <div class="col-md-6">
                                            <input id="company" type="company"
                                                   class="form-control @error('company') is-invalid @enderror"
                                                   name="company" value="{{ old('company') }}" required
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
                                               class="col-md-4 col-form-label text-md-right">Должность</label>

                                        <div class="col-md-6">
                                            <input id="position" type="position"
                                                   class="form-control @error('position') is-invalid @enderror"
                                                   name="position" value="{{ old('position') }}" required
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
                                               class="col-md-4 col-form-label text-md-right">Пароль</label>

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
                                            <label class="custom-control-label super-small" for="customCheck1">Даю
                                                согласие на обработку персональных данных, в частности: ФИО; дата
                                                рождения; пол; телефон, а также иные данные, указанные в онлайн форме, а
                                                равно предоставленные дополнительные данные по иным каналам связи с
                                                целью участия в маркетинговом мероприятии</label>

                                            @error('agree')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group text-center mt-5">
                                        <button type="submit" class="btn btn-primary">
                                            Зарегистрироваться и войти
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(!Request::get('promo_page') || Request::get('promo_page') !== 'promo')
                <div class="col-md-5 mt-5">
                    <a href="{{ route('login') }}" class="btn btn-light w-100 mt-3">Я уже регистрировался</a>
                </div>
            @endif
        </div>
    </div>
@endsection
