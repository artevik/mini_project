@extends('frontend.welcome')

@section('content')
    <section class="latest-posts">
        <div class="container">
            <header>
                <h2>Последние посты</h2>
                <p class="text-big">Выводится 15 постов <kbd>видимые</kbd> с последующей пагинацией</p>
            </header>
            <div class="row">

                @foreach($posts as $post)

                    <div class="post col-md-4">
                        <div class="post-thumbnail">
                            <a href="{{route('showPost', $post->id)}}">
                                <img src="@if(strpos($post['image'], 'http') === 0) {{$post['image']}} @else {{url('/')}}/uploads/images/{{$post['image']}} @endif" alt="..." class="img-fluid">
                            </a>
                        </div>
                        <div class="post-details">
                            <div class="post-meta d-flex justify-content-between">
                                <div class="date">{{$post['published_at']}}</div>
                                <div class="category"><a href="#"> {{$post->comments->count()}} <i class="icon-comment"></i> </a></div>
                            </div><a href="{{route('showPost', $post->id)}}">
                                <h3 class="h4">{{$post['title']}}</h3></a>
                            <p class="text-muted">{{$post['description']}}</p>
                        </div>
                    </div>

                @endforeach

            </div>

            <div class="posts-listing row text-center">
                <!-- Pagination -->
                {{ $posts->links() }}
            </div>

        </div>
    </section>
@endsection
