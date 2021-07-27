<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <section class="sidebar">
        <ul class="list">
            <li class="active" id="ssetings">Настройки</li>
            <li id="messages">Сообщения</li>
            <li><a href="{{ route('account.show', auth()->user()->id) }}" style="text-decoration: none; color:white;">На сайт</a></li>
        </ul>
    </section>
    <section class="main">
        <div class="ssetings">
            <div class="category">
                <h1>Категории</h1>
                <ul class="category-list">
                    @foreach($categories as $category)
                    <li>
                        <h3>{{ $category->name }}</h3>
                        <form action="{{ route('delete.category') }}" id="delete" method="post">
                            @csrf
                            <input name="id" type="hidden" value="{{ $category->id }}">
                            <input type="submit" class="delete" form="delete" value="удалить">
                        </form>
                    </li>
                    @endforeach
                </ul>
                <form action="{{ route('add.category') }}" method="post">
                    @csrf
                    <div class="input">
                        <input type="text" name="category">
                    </div>
                    <input type="submit" value="добавить" class="submit">
                </form>
            </div>
        </div>
        <div class="messages">
            <ul>
                @foreach($messages as $message)
                <li>
                    <div class="inner">
                        <h3>Name: {{ $message->name }}</h3>
                        <h3>Email: {{ $message->email }}</h3>
                        <h3>Date: {{ $message->created_at }}</h3>
                    </div>
                    <div class="content">
                    {{ $message->message }}
                    </div>
                </li>
                @endforeach
            </ul>
        </div>  
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>