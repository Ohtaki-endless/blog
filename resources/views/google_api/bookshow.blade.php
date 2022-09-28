@extends('layouts.app')

@section('content')
        <h1>PHP/LaravelでGoogle books api 詳細ページ サンプル</h1>
        
            <h2>
                {{ $item['volumeInfo']['title']}}
            </h2>
            @if (array_key_exists('imageLinks', $item['volumeInfo']))
                <img src="{{ $item['volumeInfo']['imageLinks']['thumbnail']}}"><br>
            @endif
                            
            @if (array_key_exists('description', $item['volumeInfo']))
                著者：{{ $item['volumeInfo']['authors'][0] }}<br>
            @endif
            @if (array_key_exists('description', $item['volumeInfo']))
                発売年月：{{ $item['volumeInfo']['publishedDate']}}<br>
            @endif
            <br>
            <hr>
            
@endsection