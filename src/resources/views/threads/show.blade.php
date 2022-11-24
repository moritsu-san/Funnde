@extends('layouts.app')

@section('content')
@inject('answer_service', 'App\Services\AnswerService')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 mb-3">
            @include('components.thread-index-back')
        </div>
        <div class="col-md-10">
            @include('layouts.flash-message')
            <h5 class="small">投稿者：{{ $thread->name }}：{{ $thread->created_at->format('Y/m/d H:i:s') }}</h5>
            <h3>{!! $answer_service->convertUrl($thread->body) !!}</h3>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10 mb-5">
            @foreach ($thread->answers as $answer)
            <div class="card mb-2">
                <div class="card-body">
                    <p>{{ $loop->iteration }} {{ $answer->name }} {{ $answer->created_at }}</p>
                    <p class="mb-0">{!! $answer_service->convertUrl($answer->body) !!}</p>
                </div>
            </div>
            @include('components.answer-delete', compact(['thread', 'answer']))
            @endforeach
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <h5 class="card-header">アンサーを投稿する</h5>
                <div class="card-body">
                    @include('components.answer-create', compact('thread'))
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
