@extends('layouts.app')

@section('content')
<h5>
    <a href='/posts/create'>create</a>
</h5>
<div class='posts'>
    @foreach ($posts as $post)
        <div class='post card'>
            <div class="card-body">
                <h5 class='title card-title'>
                    <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                </h5>
                
                <p class='body card-text'>
                    {{ $post->body }}
                </p>
                
                <p class="card-text">
                    カテゴリ：<a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
                </p>
                
                <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-primary" type="submit" data-id="{{ $post->id }}" onClick="deletePost();return false;">delete</button> 
                </form>
            </div>
        </div>
    @endforeach
</div>

<script>
    function deletePost(e) {
        'use strict';
        if(confirm('削除すると復元できません。\n本当に削除しますか？')) {
            document.getElementById('form_' + e.dataset.id).submit();
        }
    }
</script>

@endsection