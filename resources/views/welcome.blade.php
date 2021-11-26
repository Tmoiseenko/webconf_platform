@extends('layouts.app')

@section('content')
    <div class="container pl-lg-5 mt-4">
        <div class="row" id="stream">
            <div class="col-sm-12 text-center mt-5 mb-2">
                <div class="iframe-wrapper">
                    @if($event)
                        <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" type="text/html"
                                src="{{ $event->iframe_link }}" allowfullscreen></iframe>
                    @else
                        <img class="img-fluid " src="{{ asset('images/preview.jpg') }}" alt="preview">
                    @endif
                </div>
            </div>
        </div>

        <section class="mt-5" id="rooms">
            <h2 class="text-primary mb-3 mt-5">Материалы для скачивания</h2>
            <hr>
            <div class="row mt-4">
                @foreach($materials as $material)
                    <div class="col-6 col-xs-6 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <a class="link" target="_blank" href="{{ $material->link }}">
                            <div class="card-low">
                                <div class="card-body text-center">
                                    @if($material->partner)
                                        <div class="partner-logo">
                                            <div style="background-image: url({{ $material->image->getRelativeUrlAttribute() }})"></div>
                                        </div>
                                    @endif
                                    <h3 class="mt-3">{{ $material->title }}</h3>
                                    <div class="mt-3 text-left font-normal room-about">{{ $material->about }}</div>


                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="mt-5" id="program">
            <h2 class="text-primary mb-3 mt-5">Программа</h2>
            <hr>
            @foreach($programs as $program)
                @if($program->vip == 0)
                    <div class="row mt-4 mb-5">
                        <div class="col-sm-3">
                            <h3 class="font-program">{{ $program->started_at }} - {{ $program->finished_at }}</h3>
                        </div>
                        <div class="col-sm-9 mt-3 mt-sm-0">
                            <h3 class="font-program">{{ $program->author }}</h3>
                            <div class="d-flex mt-3 align-items-center">
                                @if($program->image->getRelativeUrlAttribute())
                                    <img src="{{ $program->image->getRelativeUrlAttribute() }}" alt="{{ $program->author }}"
                                         class="rounded-circle mr-3 speaker-thumb">
                                @endif
                                <div class="h3 font-normal font-program">{!! nl2br($program->topic) !!}</div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row mt-4">
                        <div class="col-sm-3">
                            <h3 class="font-program">{{ $program->started_at }} - {{ $program->finished_at }}</h3>
                        </div>
                        <div class="col-sm-9 mt-3 mt-sm-0">
                            <img src="{{ $program->image->getRelativeUrlAttribute() }}" alt="{{ $program->author }}" class="vip-speaker mr-3">
                            <h3 class="mt-4 font-program">{{ $program->author }}</h3>
                            <div
                                class="h3 font-normal mt-4 line-correction font-program">{!! nl2br($program->topic) !!}</div>
                        </div>
                    </div>
                @endif
            @endforeach
        </section>

        <section class="mt-5" id="partners">
            <h2 class="text-primary mb-3 mt-5">Партнеры</h2>
            <hr>
            <div class="row mt-4 pt-3">
                @foreach($partners as $partner)
                    <div class="col-6 col-xs-6 col-sm-6 col-md-6 col-lg-3 mb-5">
                        <a target="_blank" href="{{ $partner->link }}" class="partner">
                            <div class="partner-logo">
                                <div style="background-image: url({{ $partner->image->getRelativeUrlAttribute() }})"></div>
                            </div>
                            @if($partner->title && $partner->about)
                                <h3>{{ $partner->title }}</h3>
                                <div class="text-muted font-normal">{{ $partner->about }}</div>
                            @endif
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection

@section('chat')
    <chat
        @auth
        :allow-chat=1
        user="{{ Auth::user() }}"
        @else
            :allow-chat=0
        user=""
        @endauth
    ></chat>
@endsection
