<header>
    <h3 class="h6">{{$title}}</h3>
</header>
<form action="{{$action}}" class="commenting-form" method="post">
    @csrf()
    <div class="row">
        <div class="form-group col-md-6">
            <input type="text" name="name" id="name" placeholder="Имя" class="form-control">
        </div>
        <div class="form-group col-md-6">
            <input type="email" name="email" id="email" placeholder="Email" class="form-control">
        </div>
        <div class="form-group col-md-12">
            <textarea name="comment" id="comment" placeholder="Ваше сообщение" class="form-control"></textarea>
        </div>

        <div class="form-group col-md-12">
            <button type="submit" class="btn btn-secondary ">{{$submit}}</button>
        </div>
    </div>
</form>
