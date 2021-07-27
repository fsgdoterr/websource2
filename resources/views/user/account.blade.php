@extends('layouts.layout')

@section('main')
                    <section class="account">
                        <div class="block-medium account-image">
                            @if($id->image_path == null)
                                <img src="{{ asset('img/default-account-image.png') }}" alt="">
                            @else
                                <img src="{{ asset( auth()->user()->image_path ) }}" alt="">
                            @endif
                        </div>
                        <div class="block-medium account-info">
                             <div class="account-title">
                                 <h2>{{ $id->name }}</h2>
                                 <span>написал {{ App\Models\Post::where('user_id', '=', $id->id)->count() }} статей для WebSource</span>
                             </div>
                             <div class="account-description">
                                @if($id->description != null)
                                    {{ auth()->user()->description }}
                                @else
                                    <span style="font-style:italic;margin:25px 0;">No Description</span>
                                @endif 
                            </div>
                            <div class="account-footer">
                                @if($id->id === auth()->user()->id)
                                    <a class="button ssetings" href="{{ route('edit.show') }}">Редактировать</a>
                                @endif 
                                @if($id->id === auth()->user()->id && auth()->user()->permissions == 1)
                                    <a class="button ssetings" href="{{ route('admin.create') }}">Админка</a>
                                @endif 
                             </div>
                             
                        </div>
                    </section>
                    @if($id->id === auth()->user()->id )
                    <form class="block-medium form-post" method="post" action="{{ route('account.store', auth()->user()->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="block-small">
                            <img src="" id="imagePreview" height="100px">
                        </div>
                        <div class="input">
                            <input name="image" type="file" id="input__file" class="input input__file" multiple required>
                            <label for="input__file" class="input__file-button">
                               <span class="input__file-icon-wrapper"><img class="input__file-icon" src="https://image.flaticon.com/icons/png/512/51/51112.png" alt="Выбрать файл" width="25"></span>
                               <span class="input__file-button-text">Выберите картинку</span>
                            </label>
                         </div>
                        <div class="input">
                            <h2>Название</h2>
                            <input type="text" name="title" required maxlength="30">
                        </div>
                        <div class="input">
                            <h2>Описание</h2>
                            <input type="text" name="description" required maxlength="100">
                        </div>
                        <div class="input">
                            <h2>Текст</h2>
                            <textarea name="content" required maxlength="10000"></textarea>
                        </div>
                        <div class="input">
                            <h2>Категория</h2>
                            <select name="category" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="submit">
                            <input type="submit" value="ОТПРАВИТЬ">
                        </div>
                    </form>
                    @endif
                    @if($posts->count() > 0)
                    <section class="last-news">
                        <div class="block-big">
                            <ul class="list big-list">
                                @foreach ($posts as $post)
                                <li>
                                    <a class="articles-image" href="{{ route('post.create', ['slug' => $post->slug]) }}">
                                        <img src="{{ asset($post->image_path) }}" alt="">
                                    </a>
                                    <a href="" class="articles-title"><h2>{{ $post->name }}</h2></a>
                                    <span class="post-date">{{ $post->created_at }}</span>
                                    <span class="post-description">{{ $post->description }}<a href=""> [...]</a></span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </section>
                    @endif
@endsection