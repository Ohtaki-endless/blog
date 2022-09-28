<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class GoogleAPIController extends Controller
{
    public function map(){
        $api_key = config('app.api_key');
        
        return view('google_api/map')->with([
            'api_key' => $api_key,
        ]);
    }
    
    public function book(Request $request){
        
        $items = null;
        $keyword = $request->keyword;
 
        if (!empty($request->keyword))
        {
            // 検索キーワードあり
            // 日本語で検索するためにURLエンコードする
            $title = urlencode($request->keyword);
 
            // APIを発行するURLを生成
            $url = 'https://www.googleapis.com/books/v1/volumes?q=' . $title . '&country=JP&tbm=bks';
    
            $client = new Client();
 
            // GETでリクエスト実行
            $response = $client->request("GET", $url);
    
            $body = $response->getBody();
            
            // レスポンスのJSON形式を連想配列に変換
            $bodyArray = json_decode($body, true);
    
            // 書籍情報部分を取得
            $items = $bodyArray['items'];
 
            // レスポンスの中身を見る
            // dd($items);
        }
        
        return view('google_api.book')->with([
            'items' => $items,
            'keyword' => $keyword
        ]);
    }
    
    public function bookshow(Request $request){
        
        if (!empty($request->title))
        {
            // 日本語で検索するためにURLエンコードする
            $title = urlencode($request->title);
            
            // APIを発行するURLを生成
            $url = 'https://www.googleapis.com/books/v1/volumes?q=' . $title . '&country=JP&tbm=bks';
            
            $client = new Client();
            
            // GETでリクエスト実行
            $response = $client->request("GET", $url);
            
            $body = $response->getBody();
            
            // レスポンスのJSON形式を連想配列に変換
            $bodyArray = json_decode($body, true);
            
            // 書籍情報部分を取得
            $item = $bodyArray['items'][0];
            
            // レスポンスの確認
            // dd($item);
        }
        
        return view('google_api.bookshow')->with(['item' => $item]);
    }
}
