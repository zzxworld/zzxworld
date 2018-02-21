<div class="panel panel-default">
    <div class="panel-heading"><h3 class="panel-title">讨论</h3></div>
    <div class="panel-body">
        <form class="form" method="post" action="{{ $action }}">
            {{ csrf_field() }}
            <div class="form-group">
                <textarea class="form-control" rows="10" name="content"></textarea>
            </div>
            <button class="btn btn-primary" type="submit">发表</button>
        </form>
    </div>
</div>
