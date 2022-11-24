@extends('layouts.app')

@section('content')
@inject('answer_service', 'App\Services\AnswerService')
<div class="container">
    @include('layouts.flash-message')
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{ $threads->links() }}
        </div>
    </div>
    <div class="row justify-content-center">
        @foreach ($threads as $thread)
            <div class="col-md-8 mb-5">
                <div class="card text-center">
                    <div class="card-header">
                        <h5 class="small">{{ $loop->iteration }} 投稿者：{{ $thread->name }}：{{ $thread->created_at->format('Y/m/d H:i:s') }}</h5>
                        <h3 class="m-0">{!! $answer_service->convertUrl($thread->body) !!}</h3>
                    </div>
                    @foreach ($thread->answers as $answer)
                        <div class="card-body">
                            <h5 class="small">{{ $loop->iteration }} 名前：{{ $answer->name }}：{{ $answer->created_at->format('Y/m/d H:i:s') }}</h5>
                            <p class="card-text">{!! $answer_service->convertUrl($answer->body) !!}</p>
                        </div>
                        <div id="app">
                            <test-component></test-component>
                        </div>
                        @include('components.answer-delete', compact(['thread', 'answer']))
                    @endforeach
                    @include('components.show-links', compact('thread'))
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card w-75 m-auto">
                                <h5 class="card-header">新規アンサー投稿</h5>
                                <div class="card-body">
                                    @include('components.answer-create', compact('thread'))
                                </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h5 class="card-header">新規お題作成</h5>
                <div class="card-body">
                    <form method="POST" action="{{ route('threads.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="thread-body">お題</label>
                            <input type="text" name="body" class="form-control" id="thread-body">
                        </div>
                        <button type="submit" class="btn btn-primary">お題を投稿</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
