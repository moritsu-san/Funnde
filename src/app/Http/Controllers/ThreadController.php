<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ThreadRequest;
use App\Services\ThreadService;
use App\Repositories\ThreadRepository;
use App\Services\SlackNotificationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Throwable;

class ThreadController extends Controller
{

    protected $thread_service;
    protected $thread_repository;
    protected $slack_notification_service;

    public function __construct(
        ThreadService $thread_service,
        ThreadRepository $thread_repository,
        SlackNotificationService $slack_notification_service
    )
    {
        $this->middleware('auth')->except('index');
        $this->thread_service = $thread_service;
        $this->thread_repository = $thread_repository;
        $this->slack_notification_service = $slack_notification_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $threads = $this->thread_service->getThreads(10);
        return view('threads.index', compact('threads'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ThreadRequest $request)
    {
        try{
            $data = $request->validated();
            $data['name'] = Auth::user()->name;
            $data['user_id'] = Auth::id();

            $this->thread_service->createNewThread(Auth::id(), $data);
            $this->slack_notification_service->send(Auth::user()->name. 'がお題として"' . $request->body . '"を投稿しました。');
        } catch (Throwable $error) {
            return redirect()->route('threads.index')->with('error', 'お題の投稿に失敗しました...');
        }

        return redirect()->route('threads.index')->with('success', 'お題を投稿しました!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $thread = $this->thread_repository->findById($id);
        $thread->load('answers');
        return view('threads.show', compact('thread'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
