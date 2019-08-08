@extends('frontend.welcome')

@section('content')

    <div class="container">
        <div class="row">
            <!-- Latest Posts -->
            <main class="post blog-post col-lg-12">
                <div class="container">
                    <div class="post-single">
                        <div class="post-thumbnail"><img src="@if(strpos($post['image'], 'http') === 0) {{$post['image']}} @else {{url('/')}}/uploads/images/{{$post['image']}} @endif" alt="..." class="img-fluid"></div>
                        <div class="post-details">
                            <h1>{{$post->title}}<a href="#"><i class="fa fa-bookmark-o"></i></a></h1>
                            <div class="post-footer d-flex align-items-center flex-column flex-sm-row">
                                <a href="#" class="author d-flex align-items-center flex-wrap">
                                    <div class="avatar"><img src="@if($post->user[0]->image !== null){{$post->user[0]->image}}@else{{asset('frontend/img/avatar-1.jpg')}} @endif" alt="..." class="img-fluid"></div>
                                    <div class="title"><span>{{$post->user[0]->name}}</span></div>
                                </a>
                                <div class="d-flex align-items-center flex-wrap">
                                    <div class="date"><i class="icon-clock"></i> {{$post->published_at}}</div>
                                    <div class="comments meta-last"> {{$post->comments->where('id_parent_comment', 0)->count()}} <i class="icon-comment"></i></div>
                                </div>
                            </div>
                            <div class="post-body">
                                {{$post->description}}
                            </div>

                            @if($posts->total() > 0)

                            <div class="posts-nav d-flex justify-content-between align-items-stretch flex-column flex-md-row">

                                <a href="{{url('/posts/')}}/@if($post->id == 1){{$posts->total()}} @else{{$post->id-1}} @endif" class="prev-post text-left d-flex align-items-center">
                                    <div class="icon prev"><i class="fa fa-angle-left"></i></div>
                                    <div class="text"><strong class="text-primary">Предыдущая страница </strong>
                                    </div>
                                </a>

                                <a href="{{url('/posts/')}}/@if($post->id == 1){{$post->id+1}} @elseif($post->id >= $posts->total()){{1}} @else{{$post->id+1}} @endif" class="next-post text-right d-flex align-items-center justify-content-end">
                                    <div class="text"><strong class="text-primary">Следующая старница </strong>
                                    </div>
                                    <div class="icon next"><i class="fa fa-angle-right">   </i></div>
                                </a>

                            </div>

                            @endif

                            <div class="post-comments">
                                <header>
                                    <h3 class="h6">Комментарии пользователей<span class="no-of-comments">({{$post->comments->where('id_parent_comment', 0)->count()}})</span></h3>
                                </header>

                                @if($post->comments->count() > 0)

                                    <div id="response"></div>

                                    <form class="sorting">
                                        @csrf
                                        <div class="form-group">
                                            <label for="sortByDate">Сортировка: </label>
                                            <select class="form-control col-md-2" id="sortByDate" name="sortByDate">
                                                <option value="asc" data-value="Новые">Сначало новые</option>
                                                <option value="desc" data-value="Старые">Сначало старые</option>
                                            </select>
                                        </div>
                                    </form>

                                    @component('frontend.partials.comments.reply.show', [
                                                    'comments' => $post->comments()->where('id_parent_comment', '=', 0)->get(),
                                                    'post' => $post,
                                                    'parent_id' => true,
                                                    'owner_id' => 0
                                                    ])
                                                    @slot('class')
                                                        main
                                                    @endslot
                                                @endcomponent

                                @else
                                   @if(Auth::check())
                                        <p>Вы можете оставить комментарий первым!</p>
                                   @endif
                                @endif
                            </div>

                            <div class="add-comment">
                                @if(Auth::check())
                                    @component('frontend.components.form')
                                        @slot('title')
                                            Оставить отзыв
                                        @endslot
                                        @slot('action')
                                            {{route('comments.store', $post->id)}}
                                        @endslot
                                        @slot('submit')
                                            Отправить сообщение
                                        @endslot
                                    @endcomponent
                                @else
                                    Для того чтобы оставить сообщение <a href="{{route('login')}}">авторизируйтесь</a> или пройдите <a href="{{route('register')}}">регистрацию</a>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </main>

        </div>
    </div>

@endsection


@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>

<script>
        @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('message') }}","{{ Session::get('title') }}",{timeOut: 5000, "closeButton": true, "progressBar": true, "positionClass": "toast-top-center",});
            break;

        case 'warning':
            toastr.warning("{{ Session::get('message') }}","{{ Session::get('title') }}",{timeOut: 2000, "closeButton": true, "progressBar": true, "positionClass": "toast-top-center",});
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}","{{ Session::get('title') }}",{timeOut: 2000, "closeButton": true, "progressBar": true, "positionClass": "toast-top-center",});
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}","{{ Session::get('title') }}",{timeOut: 2000, "closeButton": true, "progressBar": true, "positionClass": "toast-top-center",});
            break;
    }
    @endif
</script>

<script>

    jQuery(document).ready(function($){
        jQuery( "#sortByDate" ).on( "change", function() {
            let formData = $('.sorting').serializeArray();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type : 'POST',
                url : '{{route('comments.sort', [$post->id])}}',
                data: formData,
                dataType: 'json',
                beforeSend:function(xhr){
                    $('#response').text('Загружаю...'); // изменяем текст кнопки
                },
                success : function( data ) {
                    $('#response').html(data);
                    console.log(data);
                },
                error: function (data, textStatus, errorThrown) {
                    console.log(data);
                },
            });
            return false;
        });
    });

</script>
@endpush
