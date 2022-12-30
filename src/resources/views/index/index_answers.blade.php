@extends('layouts.app')

@section('title', '踏んで - お題一覧')

@section('content')
@inject('answer_service', 'App\Services\AnswerService')
<div class="container mx-auto">
    <div id="header-news">
        @include('components.flash-message')
    </div>
    <div id="main-board" class="flex">
        <div id="main-container" class="w-2/3 mr-10 row justify-content-center">
            <div class="content-menu">
                <ul class="flex">
                    <li class="mr-6">
                        <a href="{{ route('answer.recent') }}" target="_self">新着</a>
                    </li>
                    <li>
                        <a href="{{ route('answer.popular') }}" target="_self">人気</a>
                    </li>
                </ul>
            </div>
            <div id="content">
                @foreach ($threads as $thread)
                    @include('components.thread-card')
                @endforeach
            </div>
            {{-- <div class="col-md-8">
                {{ $threads->links() }}
            </div> --}}
        </div>
        <div id="right-container" class="w-1/3">
            <div class="side-widget">
                <div class="side-widget-title">

                </div>
                <div class="side-widget-content">
                    最近のコメント
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

