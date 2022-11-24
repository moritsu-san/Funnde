<?php

namespace App\Services;

use App\Repositories\ThreadRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Throwable;

class ThreadService
{

    protected $thread_repository;

    public function __construct(ThreadRepository $thread_repository)
    {
        $this->thread_repository = $thread_repository;
    }

    public function createNewThread(string $user_id, array $data)
    {
        DB::beginTransaction();
        try{
            $thread_data = $this->getThreadData($user_id, $data['name'], $data['body']);
            $thread = $this->thread_repository->create($thread_data);
        } catch (Throwable $error){
            DB::rollback();
            info($error->getMessage());
            throw $error;
        }
        DB::commit();

        return $thread;
    }

    public function getThreadData(string $user_id, string $name, string $body)
    {
        return [
            'user_id' => $user_id,
            'name' => $name,
            'body' => $body,
            'latest_answer_time' => Carbon::now()
        ];
    }

    public function getThreads(int $per_page)
    {
        $threads = $this->thread_repository->getPaginatedThreads($per_page);
        $threads->load('answers');
        return $threads;
    }
}
