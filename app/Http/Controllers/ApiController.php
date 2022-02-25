<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;

class ApiController extends Controller
{
    public function index($hushtag){

        try { //ハッシュタグIDの呼び出し
            //apiを呼び出すurlを作成
            $url=config("instagram_api.instagram_api_url")."ig_hashtag_search?user_id=".config("instagram_api.instagram_api_id")."&q=".$hushtag."&access_token=".config("instagram_api.instagram_api_token");
            $method = "GET";
            $count = 1; //データを50件所得

            $client = new Client();
            $response = $client->request($method, $url); //apiの呼び出し

            $results = $response->getBody(); //$responseのbodyを所得
            $hushtag_id = json_decode($results, true)["data"][0]["id"]; //連想配列へ変換

        } catch (RequestException $e) { //エラーが生じた場合の処理
            echo Psr7\Message::toString($e->getRequest());
            if ($e->hasResponse()) {
                echo Psr7\Message::toString($e->getResponse());
            }
        }

        try { //ハッシュタグをもとにinstagramAPIからデータを取得
            $parameters="id,media_url,permalink,like_count,comments_count,caption,timestamp"; //取得するパラメータを選択
            //apiを呼び出すurlを作成。最近のインスタ投稿を取得
            $url = config("instagram_api.instagram_api_url").$hushtag_id."/recent_media?user_id=".config("instagram_api.instagram_api_id")."&fields=".$parameters."&access_token=".config("instagram_api.instagram_api_token")."&limit=50";
            $method = "GET";
            $count = 50; //データを50件所得
            $articles=[];

            for($a = 0; $a <= 2; $a++){
                if($a==0){
                    $client = new Client();
                    $response = $client->request($method, $url); //apiの呼び出し

                    $results = $response->getBody(); //$responseのbodyを所得
                    $articles = json_decode($results, true); //連想配列へ変換
                    $result=$articles["data"];
                   
                }elseif(array_key_exists("paging", $articles)){
                    $url=$articles["paging"]["next"];
                    $response = $client->request($method, $url); //apiの呼び出し

                    $results = $response->getBody(); //$responseのbodyを所得
                    $merge_articles=json_decode($results, true);
                    $result=array_merge($result, $merge_articles["data"]);
                }
            }


        } catch (RequestException $e) { //エラーが生じた場合の処理
            echo Psr7\Message::toString($e->getRequest());
            if ($e->hasResponse()) {
                echo Psr7\Message::toString($e->getResponse());
            }
        }
        return $result;
    }
}


