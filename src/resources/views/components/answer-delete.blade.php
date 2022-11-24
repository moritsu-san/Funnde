@if (Auth::guard('admin')->check())
    <form action="{{ route('admin.answers.destroy', [$thread->id, $answer->id])}}" method="post", class="my-2">
        @csrf
        @method('DELETE')
        <input type="submit" class="btn btn-danger" value="削除" onclick="return confirm('アンサーを削除します。本当に削除してよろしいでしょうか?')">
    </form>
@endif
