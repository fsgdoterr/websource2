@extends('layouts.layout')

@section('main')
                    <section class="last-news">
                        <div class="block-big">
                            <div class="title">Поиск по статьям</div>
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
@endsection