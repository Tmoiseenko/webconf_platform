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
        @if($rooms->isNotEmpty())
        <section class="mt-5" id="rooms">
            <h2 class="text-primary mb-3 mt-5">{{ __('front.title.rooms') }}</h2>
            <hr>
            <div class="row mt-4">
                @foreach($rooms as $room)
                    <div class="col-6 col-xs-6 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <a class="link" target="_blank" href="{{ $room->link }}">
                            <div class="card-low">
                                <div class="card-body text-center">
                                    @if($room->partner->image->getRelativeUrlAttribute())
                                        <div class="partner-logo">
                                            <div style="background-image: url({{ $room->image->getRelativeUrlAttribute() }})"></div>
                                        </div>
                                    @endif
                                    <h3 class="mt-3">{{ $room->title }}</h3>
                                    <div class="mt-3 text-left font-normal room-about">{{ $room->about }}</div>


                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>

        @endif

        @if($materials->isNotEmpty())
        <section class="mt-5" id="materials">
            <h2 class="text-primary mb-3 mt-5">{{ __('front.title.materials') }}</h2>
            <hr>
            <div class="row mt-4">
                @foreach($materials as $material)
                    <div class="col-6 col-xs-6 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <a class="link" target="_blank" href="{{ $material->link }}">
                            <div class="card-low">
                                <div class="card-body text-center">
                                    @if($material->image)
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

        @endif

        @if($programs->isNotEmpty())
        <section class="mt-5" id="program">
            <h2 class="text-primary mb-3 mt-5">{{ __('front.title.programs') }}</h2>
            <hr>
            @foreach($programs as $program)
                @if($program->vip == 0)
                    <div class="row mt-4 mb-5">
                        <div class="col-sm-3">
                            <h3 class="font-program">
                                {{ Illuminate\Support\Carbon::parse($program->started_at)->format('H:i') }} -
                                {{ Illuminate\Support\Carbon::parse($program->finished_at)->format('H:i') }}
                            </h3>
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
                            <h3 class="font-program">
                                {{ Illuminate\Support\Carbon::parse($program->started_at)->format('H:i') }} -
                                {{ Illuminate\Support\Carbon::parse($program->finished_at)->format('H:i') }}</h3>
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
        @endif
        @if($partners->isNotEmpty())
        <section class="mt-5" id="partners">
            <h2 class="text-primary mb-3 mt-5">{{ __('front.title.partners') }}</h2>
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
        @endif


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
