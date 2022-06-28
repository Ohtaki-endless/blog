@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="/posts" method="POST">
            @csrf
            <div class="title card-title">
                <h2>Title</h2>
                <input type="text" name="post[title]" placeholder="タイトル" value="{{ old('post.title') }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
            </div>
            <div class="body card-text">
                <h2>Body</h2>
                <textarea name="post[body]" placeholder="今日も1日お疲れさまでした。">{{ old('post.body') }}</textarea>
                <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
            </div>
            <div class="category card-text">
                <h2>Category</h2>
                <select name="post[category_id]">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <br>
            <input type="submit" class="btn btn-primary" value="保存"/>
        </form>
        <br>
        <div class="back">
            [<a href="/">back</a>]
        </div>
    </div>
</div>
@endsection