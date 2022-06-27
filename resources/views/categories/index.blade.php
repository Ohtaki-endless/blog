<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        [<a href='/posts/create'>create</a>]
        <h1>
            <a href='/'>Blog</a>
        </h1>
        <div class='posts'>
            @foreach ($posts as $post)
                <div class='post'>
                    <h2 class='title'>
                        <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                    </h2>
                    <div>
                        <a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
                    </div>
                    <p class='body'>{{ $post->body }}</p>
                    
                    
                    <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" data-id="{{ $post->id }}" onClick="deletePost();return false;">delete</button> 
                    </form>
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
    </body>
</html>