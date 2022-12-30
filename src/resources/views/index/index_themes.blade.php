@extends('layouts.app')

@section('title', '踏んで - お題一覧')

@section('content')
@inject('answer_service', 'App\Services\AnswerService')
<div class="container mx-auto">
    <div id="header-news">
        @include('components.flash-message')
    </div>
    <div id="main-container" class="row justify-content-center">
        <div class="content-menu">
            <ul>
                <li>
                    <a href="" target="_self"></a>
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
</div>
@endsection

