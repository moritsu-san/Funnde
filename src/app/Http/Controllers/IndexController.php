<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread;
use App\Http\Requests\ThreadRequest;
use App\Services\ThreadService;
use App\Repositories\ThreadRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Throwable;

class IndexController extends Controller
{
    protected $thread_service;
    protected $thread_repository;

    public function __construct(
        ThreadService $thread_service,
        ThreadRepository $thread_repository
    )
    {
        $this->authorizeResource(Thread::class, 'thread');
        $this->thread_service = $thread_service;
        $this->thread_repository = $thread_repository;
    }

    public function index_answers()
    {
        $threads = $this->thread_service->getThreadsWithAnswers(10);
        return view('index.index_answers', compact('threads'));
    }

    public function index_themes()
    {
        $threads = $this->thread_service->getThreadsWithAnswers(10);
        // dd($threads);
        return view('index.index_themes', compact('threads'));
    }
}