@extends('layouts.app')

@section('content')

<h3 class=""><a href='/posts/create'>create</a></h3>
<h3 class=""><a href='/map'>Map API サンプルページ</a></h3>
<h3 class=""><a href='/book'>Book API サンプルページ</a></h3>

    <!--Stripe決済機能-->
    <div class="content">
        <form action="/charge" method="POST">
            {{ csrf_field() }}
            <script
                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="{{ env('STRIPE_KEY') }}"
                data-amount="1000"
                data-name="Stripe Demo"
                data-label="決済"
                data-description="Online course about integrating Stripe"
                data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                data-locale="auto"
                data-currency="JPY">
            </script>
        </form>
    </div>

<div class='posts'>
    @foreach ($posts as $post)
        <div class='card'>
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
                
                <a href="/posts/{{ $post->id }}/role" class="btn btn-primary">
                    完了
                </a>
                
            </div>
        </div>
    @endforeach
</div>

    <div class="card">
        <div class="card-body">
            <div class="card-title">
                teratail API で質問を表示（Laravel応用 WEB API）
            </div>
            @foreach($questions as $question)
                <div>
                    <a href="https://teratail.com/questions/{{ $question['id'] }}">
                        {{ $question['title'] }}
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <!--削除ボタン処理-->
    <script>
        function deletePost(e) {
            'use strict';
            if(confirm('削除すると復元できません。\n本当に削除しますか？')) {
                document.getElementById('form_' + e.dataset.id).submit();
            }
        }
    </script>

@endsection