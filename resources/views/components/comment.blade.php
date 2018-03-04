<div class="panel panel-default comment-container" id="p-comment">
    <div class="panel-heading"><h3 class="panel-title">评论</h3></div>
    <ul class="list-group comments">
        @foreach ($comments as $comment)
            <li id="comment-{{ $comment->id }}" class="list-group-item comment">
                <span class="autohor">{{ $comment->name }}</span>
                <span class="date">{{ $comment->created_at->format('Y-m-d')}}</span>
                <div class="content">{{ $comment->text }}</div>
            </li>
        @endforeach
    </ul>
    <div class="panel-body">
        <form class="form" method="post" action="{{ $action }}">
            {{ csrf_field() }}

            @guest
            <p class="alert alert-info">您现在是匿名交流状态，发表内容前需要提供姓名和联系邮箱。</p>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="required">姓名</label>
                        <input class="form-control" type="text" name="name">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="required">联系邮箱</label>
                        <input class="form-control" type="text" name="email">
                    </div>
                </div>
            </div>
            @endguest

            <div class="form-group">
                <textarea class="form-control" rows="5" name="content"></textarea>
            </div>
            <button class="btn btn-primary" type="submit">发表</button>
        </form>
    </div>
</div>
