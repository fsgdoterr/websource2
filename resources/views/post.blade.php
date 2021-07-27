@extends('layouts.layout')

@section('main')
<section class="single">
                        <div class="block-medium">
                            <div class="title">{{ $post->name }}</div>
                            <img src="{{ asset($post->image_path) }}" alt="" class="big-image">
                            <h2 class="description">{{ $post->description }}</h2>
                            <h3 class="single-content">{{ $post->content }}</h3>
                        </div>
                    </section>
                    <h1>О Авторе</h1>
                    <section class="about-author block-medium flex">
                        @if($author->image_path != null)
                            <img src="{{ asset($author->image_path) }}" alt="">
                        @else
                            <img src="{{ asset('img/default-account-image.png') }}" alt="" style="width:80px;">
                        @endif
                        <div class="flex">
                            <h2 class="author-link"><a href="">{{ $author->name }}</a></h2>
                            <div class="description">
                                @if($author->description != null)
                                    {{ $author->description }}
                                @else
                                    No description
                                @endif
                            </div>
                        </div>
                    </section>
                    @if($comments->count()>0)
                    <h1>{{ $comments->count() }} комментариев к “{{$post->name}}”</h1>
                    <section class="post-comments">
                        @foreach($comments as $comment)
                        <div class="post-comment">
                            <div class="post-comment-info">
                                <a href="">
                                    @if(App\Models\User::where('id','=',$comment->user_id)->first()->image_path != null )
                                        <img src="{{ asset( App\Models\User::where('id','=',$comment->user_id)->first()->image_path ) }}" alt="" style="width:80px;">
                                    @else
                                        <img src="{{ asset('img/default-account-image.png') }}" alt="" style="width:80px;">
                                    @endif
                                </a>
                                <a href="">{{ App\Models\User::where('id','=',$comment->user_id)->first()->name }}</a>
                            </div>
                            <div class="post-comment-description">
                                {{ $comment->content }}
                            </div>
                        </div>
                        @endforeach
                    </section>
                    @endif
                    @if(auth()->check())
                    <h1>Написать комментарий</h1>
                    <form action="{{ route('post.store', $slug) }}" method="post" class="post-comment-form">
                        @csrf
                        <div class="input">
                            <textarea name="comment" class="description_edit"></textarea>
                        </div>
                        <div class="input">
                            <input type="submit" value="ОТПРАВИТЬ">
                        </div>
                    </form>
                    @endif
@endsection