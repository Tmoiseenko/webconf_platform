@extends('layouts.login_app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-body text-center">
                    <div>Время сессии истекло. Пожалуйста, попробуйте еще раз</div>

                    <div class="mt-5 text-center">
                        <a href="/register" class="btn btn-primary-gradient">Зарегистрироваться</a>
                        <a href="/login" class="ml-5 link">Войти</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
