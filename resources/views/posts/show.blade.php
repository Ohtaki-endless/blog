@extends('layouts.app')

@section('content')

    <!--書籍画像表示部分-->
    @if ($image)
        <img src="{{ $image }}">
    @endif
    
    <h1 class="title">
        {{ $post->title }}
    </h1>
    
    <div class="content">
        <div class="content__post">
            <p>{{ $post->body }}</p>    
        </div>
    </div>
    
    <a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
    
    <p class="edit">[<a href="/posts/{{ $post->id }}/edit">edit</a>]</p>
    
    <div class="footer">
        <a href="/">戻る</a>
    </div>
@endsection