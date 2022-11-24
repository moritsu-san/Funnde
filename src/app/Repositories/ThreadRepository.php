<?php

namespace App\Repositories;

use App\Models\Thread;
use Carbon\Carbon;

class ThreadRepository
{

    protected $thread;

    public function __construct(Thread $thread)
    {
        $this->thread = $thread;
    }

    public function findById(int $id)
    {
        return $this->thread->find($id);
    }

    public function create(array $data)
    {
        return $this->thread->create($data);
    }

    public function getPaginatedThreads(int $per_page)
    {
        return $this->thread->orderBy('latest_answer_time', 'desc')->paginate($per_page);
    }

    public function updateTime(int $id)
    {
        $thread = $this->findById($id);
        $thread->latest_answer_time = Carbon::now();
        return $thread->save();
    }

    public function deleteThread(int $id)
    {
        $thread = $this->findById($id);
        return $thread->delete();
    }

}
