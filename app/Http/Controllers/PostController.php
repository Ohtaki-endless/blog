<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\Http\Requests\PostRequest;
use GuzzleHttp\Client;

class PostController extends Controller
{
    public function index(Post $post)
    {
        // クライアントインスタンス生成
        $client = new \GuzzleHttp\Client();

        // GET通信するURL
        $url = 'https://teratail.com/api/v1/questions';

        // リクエスト送信と返却データの取得
        // Bearerトークンにアクセストークンを指定して認証を行う
        $response = $client->request(
            'GET',
            $url,
            ['Bearer' => config('services.teratail.token')]
        );
        
        // API通信で取得したデータはjson形式なので
        // PHPファイルに対応した連想配列にデコードする
        $questions = json_decode($response->getBody(), true);
        
        // index bladeに取得したデータを渡す
        return view('posts/index')->with([
            'posts' => $post->getPaginateByLimit(),
            'questions' => $questions['questions'],
        ]);
    }
    
    
    public function show(Post $post)
    {
        $image = null;
        
        // postsテーブルのtitleカラムに合致する書籍画像を検索する
        if (!empty($post->title))
        {
            // 日本語で検索するためにURLエンコードする
            $title = urlencode($post->title);
 
            // APIを発行するURLを生成
            $url = 'https://www.googleapis.com/books/v1/volumes?q=' . $title . '&country=JP&tbm=bks';
            
            // Clientをインスタンス化
            $client = new Client();
 
            // GETでリクエスト実行
            $response = $client->request("GET", $url);
            $body = $response->getBody();
            
            // レスポンスのJSON形式を連想配列に変換
            $bodyArray = json_decode($body, true);
    
            // 書籍情報の1つ目のみを取得
            $item = $bodyArray['items'][0];
            
            //書籍情報から書籍画像部分を取得して変数に代入
            $image = $item['volumeInfo']['imageLinks']['thumbnail'];
        }
        
        return view('posts/show')->with([
            'post' => $post,
            'image' => $image    
        ]);
    }
    
    
    public function create(Category $category)
    {
        return view('posts/create')->with(['categories' => $category->get()]);
    }
    
    public function store(PostRequest $request, Post $post)
    {
        $input = $request['post'];
        $post->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }
    
    public function edit(Post $post)
    {
        return view('posts/edit')->with(['post' => $post]);
    }
    
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        $post->fill($input_post)->save();
    
        return redirect('/posts/' . $post->id);
    }
    
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
    
    public function role(Post $post)
    {
        if($post->role === 1){
            $post->where('id', $post->id)->update(['role' => 10]);
        } else {
            $post->where('id', $post->id)->update(['role' => 1]);
        }
        return back();
    }
    
}
?>
