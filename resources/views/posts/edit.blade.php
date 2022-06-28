@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <h1 class="title">編集画面</h1>
        <div class="content">
            <form action="/posts/{{ $post->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class='content__title card-title'>
                    <p>タイトル</p>
                    <input type='text' name='post[title]' value="{{ $post->title }}">
                </div>
                <div class='content__body card-text'>
                    <p>本文</p>
                    <input type='text' name='post[body]' value="{{ $post->body }}">
                </div>
                <br>
                <input type="submit" class="btn btn-primary" value="保存">
            </form>
        </div>
   </div>
</div>
@endsection