@if (Auth::guard('admin')->check())
    <form action="{{ route('admin.threads.destroy', $thread->id) }}" method="post" class="mb-4">
        @csrf
        @method('DELETE')
        <input type="submit" class="btn btn-danger" value="削除" onclick="return confirm('スレッドを削除します。本当に実行してよろしいでしょうか?')">
    </form>
@else
    <form method="POST" action="{{ route('answers.store', $thread->id) }}" class="mb-4" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="thread-first-content">内容</label>
            <textarea name="body" class="form-control" id="thread-first-content" rows="3"
                required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">書き込む</button>
    </form>
@endif
