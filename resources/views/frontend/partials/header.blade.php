<header class="header">
    <!-- Main Navbar-->
    <nav class="navbar navbar-expand-lg">
        <div class="search-area">
            <div class="search-area-inner d-flex align-items-center justify-content-center">
                <div class="close-btn"><i class="icon-close"></i></div>
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8">
                        <form action="#">
                            <div class="form-group">
                                <input type="search" name="search" id="search" placeholder="What are you looking for?">
                                <button type="submit" class="submit"><i class="icon-search-1"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <!-- Navbar Brand -->
            <div class="navbar-header d-flex align-items-center justify-content-between">
                <!-- Navbar Brand --><a href="/" class="navbar-brand">Bootstrap Laravel Blog</a>
                <!-- Toggle Button-->
                <button type="button" data-toggle="collapse" data-target="#navbarcollapse" aria-controls="navbarcollapse" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler"><span></span><span></span><span></span></button>
            </div>
            <!-- Navbar Menu -->
            <div id="navbarcollapse" class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="/" class="nav-link active ">Главная</a>
                    </li>
                    @auth
                    <li class="nav-item"><a href="{{route('addPost')}}" class="nav-link ">Добавить пост</a>
                    </li>
                    @endauth
                </ul>

                <ul class="langs navbar-text">
                    @if (Route::has('login'))
                        <div class="top-right links">
                            @auth
                            <a href="{{ url('/home') }}">Панель администратора</a>
                            @else
                                <a href="{{ route('login') }}">Вход</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}">Регистрация</a>
                                @endif
                                @endauth
                        </div>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>
