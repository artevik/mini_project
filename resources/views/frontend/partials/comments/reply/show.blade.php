@foreach($comments as $key=>$comment)

    @if($parent_id)

        <div class="card ml-3 mb-3 {{$class}}">
            <div class="comment" id="comment_{{$comment->id}}">
                <div class="comment-header d-flex justify-content-between">
                    <div class="user d-flex align-items-center">
                        <div class="image"><img src="{{asset('frontend/img/user.svg')}}" alt="..." class="img-fluid rounded-circle"></div>
                        <div class="title">
                            <strong>{{$comment->name}} <small>({{$comment->email}})</small></strong>
                            <span class="date">{{$comment->published_at}}</span>
                        </div>
                    </div>
                </div>
                <div class="comment-body">
                    <p>{{$comment->comment}}</p>
                </div>
            </div>

            <div class="comment-reply text-right">
                <p class="btn-collapse"><a data-toggle="collapse" href="#replyComment_{{$comment->id}}" role="button" aria-expanded="false" aria-controls="replyComment"> <i class="fa fa-edit"></i> Прокомментировать</a></p>
            </div>

            <div class="collapse" id="replyComment_{{$comment->id}}">
                <div class="card comment-reply pt-3 pl-3 pr-3 mb-5">

                    @if(Auth::check())

                        @if(Route::has('login'))
                            @component('frontend.components.form-auth', ['post' => $post, 'comment' => $comment])
                                @else
                                    @component('frontend.components.form')
                                        @slot('title')
                                            Комментируем сообщение пользователя <small>{{$comment->name}}</small>
                                        @endslot
                                        @endif
                                        @slot('action')
                                            {{route('comments.store', $post->id)}}
                                        @endslot

                                        @slot('submit')
                                            Комментировать
                                        @endslot

                                    @endcomponent
                                    @else
                                        Для того чтобы оставить сообщение <a href="{{route('login')}}">авторизируйтесь</a> или пройдите <a href="{{route('register')}}">регистрацию</a>
                                    @endif

                </div>
            </div>
            @component('frontend.partials.comments.reply.show', [
                                                   'comments' => $post->comments()->where('id_parent_comment', '=', $comment->id)->get(),
                                                   'post' => $post,
                                                   'parent_id' => true,
                                                   'owner_id' => $comment->id
                                                   ])
                @slot('class')
                    reply
                @endslot
            @endcomponent
        </div>
    @endif

@endforeach
