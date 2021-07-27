@extends('layouts.layout')

@section('main')
                    <section class="last-news">
                        <div class="block-big">
                            <div class="title">Последние новости</div>
                            <ul class="list big-list">
                                @foreach($posts as $post)
                                <li>
                                    <a class="articles-image">
                                        <img src="{{ asset($post->image_path) }}" alt="">
                                    </a>
                                    <a href="{{ route('post.create', $post->slug) }}" class="articles-title"><h2>{{ $post->name }}</h2></a>
                                    <span class="post-date">{{ $post->created_at }}</span>
                                    <span class="post-description">{{ $post->description }}<a href="{{ route('post.create', $post->slug) }}"> [...]</a></span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </section>
                    <section class="last-comments">
                        <div class="block-big">
                        <div class="title">Последние комментарии</div>
                            <ul class="list">
                                @if(App\Models\Post::all()->count() > 0)
                                @foreach($comments as $comment)
                                <li class="comment">
                                    <a href="{{ route('post.create', App\Models\Post::where('id', '=', $comment->post_id)->first()->slug) }}"><h2>{{ App\Models\Post::where('id', '=', $comment->post_id)->first()->name }}</h2></a>
                                    <div class="comment-small-inner">
                                        <div class="image-block" style="display:flex;align-items:center;height:80px;">
                                        @if(App\Models\User::where('id','=',$comment->user_id)->first()->image_path != null )
                                            <img src="{{ asset( App\Models\User::where('id','=',$comment->user_id)->first()->image_path ) }}" alt="" style="width:80px;">
                                        @else
                                            <img src="{{ asset('img/default-account-image.png') }}" alt="" style="width:80px;">
                                        @endif
                                        </div>
                                        <span class="comment-small-description">{{ $comment->content }}<a href=""> [...]</a></span>
                                    </div>
                                </li>
                                @endforeach
                                @endif
                                
                            </ul>
                        </div>
                    </section>
@endsection