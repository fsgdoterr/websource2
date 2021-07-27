<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Source</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media.css') }}">
</head>
<body>
    <header>
        <div class="container">
            <div class="header-head">
                <nav>
                    <a href="{{ route('home') }}">Главная</a>
                </nav>
                <nav>
                    @if(auth()->check())
                        <a href="{{ route('account.show', auth()->user()->id) }}">ЛК</a>
                        <a href="{{ route('logout') }}">Выйти</a>
                    @else
                        <a href="{{ route('login.create') }}">Войти</a>
                        <a href="{{ route('register.create') }}">Регистрация</a>
                    @endif
                </nav>
            </div>
            <div class="header-content">
                <nav>
                    <button class="hamburger" id="hamburger"><div class="hamburger-inner"></div></button>
                    @if(App\Models\Category::all()->count() > 0)
                        @foreach(App\Models\Category::all() as $category)
                            <a href="{{ route('category.create', $category->slug) }}" class="category">{{ $category->name }}</a>
                        @endforeach
                    @endif
                </nav>
            </div>
            <div class="header-title">
                <div class="header-title-title">
                    <h1>WebSource</h1>
                    <span>Another Wordpress Magazine</span>
                </div>
                <a href="" class="banner">
                    <img src="{{ asset('img/banner.css') }}" alt="">
                </a>
            </div>
        </div>
    </header>
    <main>
        <div class="container">
            <div class="main-inner">
                <article class="main-content">
                    @yield('main')
                </article>
                <div class="sidebar">
                    <form action="{{ route('search') }}" class="search" method="get">
                        <div class="input">
                            <input type="text" name="search" class="input-search" placeholder="Поиск...">
                        </div>
                        <div>
                            <input type="submit" value="Поиск" class="submit-search">
                        </div>
                    </form>

                    <div class="small-comments">

                        <div class="block-small">
                            @if(App\Models\Post::all()->count() > 0)
                            @foreach(App\Models\Comment::orderBy('id', 'desc')->limit(2)->get() as $comment)
                            <div class="comment">
                                <a href="{{ route('post.create', App\Models\Post::where('id', '=', $comment->post_id)->first()->slug) }}"><h2><h2>{{ App\Models\Post::where('id', '=', $comment->post_id)->first()->name }}</h2></a>
                                <div class="comment-small-inner">
                                    <div class="image-block" style="display:flex;align-items:center;">
                                    @if(App\Models\User::where('id','=',$comment->user_id)->first()->image_path != null )
                                            <img src="{{ asset( App\Models\User::where('id','=',$comment->user_id)->first()->image_path ) }}" alt="" style="width:80px;">
                                        @else
                                            <img src="{{ asset('img/default-account-image.png') }}" alt="" style="width:80px;">
                                        @endif
                                        
                                    </div>
                                    <div class="comment-small-description">{{ $comment->content }}<a href=""> [...]</a></div>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="sitemap">
                        <ul>
                            <li>категории</li>
                            @if(App\Models\Category::all()->count() > 0)
                                @foreach(App\Models\Category::all() as $category)
                                    <li><a href="{{ route('category.create', $category->slug) }}">{{ $category->name }}</a></li>
                                @endforeach
                            @endif
                        </ul>
                        <ul>
                            <li>страницы сайта</li>
                            <li><a href="{{ route('home') }}">Главная</a></li>
                            @if(!auth()->check())
                                <li><a href="{{ route('login.create') }}">Log In</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <div class="container">
            <div class="footer-inner">
                <div class="footer-block">
                    <ul class="misc">
                        <li><img src="{{ asset('img/misc-icon.png') }}" alt="">Misc.</li>
                        @if(!auth()->check())
                        <li><a href="{{ route('login.create') }}">Log In</a></li>
                        <li><a href="{{ route('register.create') }}">Sign Up</a></li>
                        @else
                        <li><a href="{{ route('home') }}">Главная</a></li>
                        @endif
                    </ul>
                    <div class="find">
                        <h2>Соц.сети:</h2>
                        <div class="find-inner">
                            <a href=""><img src="{{ asset('img/facebook-icon.png') }}" alt=""></a>
                            <a href=""><img src="{{ asset('img/red-icons.png') }}" alt=""></a>
                            <a href=""><img src="{{ asset('img/twitter-small-icon.png') }}" alt=""></a>
                            <a href=""><img src="{{ asset('img/linkedin-icon.png') }}" alt=""></a>
                            <a href=""><img src="{{ asset('img/rss-small-icon.png') }}" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="footer-block">
                    <ul class="links">
                        <li><img src="{{ asset('img/links-icon.png') }}" alt="">Ссылки:</li>
                        <li><a href="">Google.com</a></li>
                        <li><a href="">Yahoo! Finance</a></li>
                        <li><a href="">ThemeForest.net</a></li>
                        <li><a href="">Envato</a></li>
                        <li><a href="">DDStuios</a></li>
                        <li><a href="">eanki.com</a></li>
                        <li><a href="">McAfee AntiVirus</a></li>
                    </ul>
                </div>
                <div class="footer-block">
                    <ul class="blog">
                        
                        <li><img src="{{ asset('img/blog-icon.png') }}" alt="">Статьи:</li>
                        @foreach( App\Models\Post::orderBy('id', 'desc')->limit(5)->get() as $post )
                        <li><a href="{{ route('post.create', $post->slug) }}">
                            <h2>{{ $post->name }}</h2>
                            <span>by {{ App\Models\User::where('id', '=', $post->user_id)->first()->name }}     @if(App\Models\Comment::where('post_id', '=', $post->id)->count() > 0) {{ App\Models\Comment::where('post_id', '=', $post->id)->count() }} @else No @endif comments</span>
                        </a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="footer-block">
                    <form action="{{ route('message') }}" method="post">
                        @csrf
                        <h2><img src="{{ asset('img/form-icon.png') }}" alt="">Связь с нами:</h2>
                        <div class="input">
                            <h3>ИМЯ:</h3>
                            <input type="text" name="name" required>
                        </div>
                        <div class="input">
                            <h3>ЕМЕЙЛ:</h3>
                            <input type="email" name="email" required>
                        </div>
                        <div class="input">
                            <h3>СООБЩЕНИЕ:</h3>
                            <textarea name="message" required></textarea>
                        </div>
                        <input type="submit" value="Отправить" class="submit-input">
                    </form>
                </div>
            </div>
        </div>
        <div class="footer-footer">
            <div class="container">
                <span>© 2010 WebSource. Powered by Wordpress</span>
                <span>WebSource by DDStudios</span>
            </div>
        </div>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>