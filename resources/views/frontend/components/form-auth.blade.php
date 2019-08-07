<form action="{{$action}}" class="commenting-form" method="post">
    @csrf()
    <div class="row">
        <input type="text" name="name" id="name" value="{{Auth::user()->name}}" hidden>
        <input type="email" name="email" id="email" value="{{Auth::user()->email}}" hidden>
        <input type="text" name="parent_id" id="parent_id" value="{{$comment->id}}" hidden>

        <div class="form-group col-md-12">
            <textarea name="comment" id="comment" placeholder="Ваше сообщение" class="form-control"></textarea>
        </div>

        <div class="form-group col-md-12">
            <button type="submit" class="btn btn-success btn-reply">{{$submit}}</button>
        </div>
    </div>
</form>
