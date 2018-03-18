<form action="{{ url($url) }}" method="post" accept-charset="utf-8">
    {{ csrf_field() }}
    @if ($feed->id)
        <input type="hidden" value="PUT" name="_method">
    @endif
    <div class="form-group">
        <label>名称</label>
        <input class="form-control" type="text" name="name" value="{{ $feed->name }}">
    </div>
    <div class="form-group">
        <label>地址</label>
        <input class="form-control" type="text" name="url" value="{{ $feed->url }}">
    </div>
    <button class="btn btn-primary" type="submit">保存</button>
    <a class="btn btn-default" href="{{ url('news/feeds') }}">取消</a>
</form>
