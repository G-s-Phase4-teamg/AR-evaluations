<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Yonde新規お問い合わせフォーム</title>
<link rel="stylesheet" href="{{ asset('/css/yonde_from.css') }}" >
</head>

<body>
<div class="Form">
<img src="{{ asset('/img/yonde.png') }}" ><h3> AR使用後のアンケートご協力ください！</h3>
  <div class="Form-Item">
    <p class="Form-Item-Label">
      <span class="Form-Item-Label-Required">必須</span>年齢
    </p>
    <input type="text" class="Form-Item-Input" placeholder="例）32歳">
  </div>

　<div class="Form-Item">
    <p class="Form-Item-Label"><span class="Form-Item-Label-Required">このイベントに満足していますか？</p>
	 <input type="radio"　name="sex" value="1">非常に満足
     <input type="radio" name="sex" value="2">やや満足
     <input type="radio" name="sex" value="3">どちらともいえない
     <input type="radio" name="sex" value="4">やや不満
     <input type="radio" name="sex" value="5">非常に不満
     
  </div>

<div class="Form-Item">
		 <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>このARをどこで知りましたか？(複数選択可能）</p>
	     <input type="checkbox" >1：Webサイト
         <input type="checkbox">2：チラシ
         <input type="checkbox">3：インスタグラム
		<input type="checkbox">4：ツイッター
        <input type="checkbox">5：知らなかった

　</div>
<div class="Form-Item">
		 <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>使ったARの感想を教えてください。</p>
	     
　</div>

		
  <input type="submit" class="Form-Btn" value="送信する">
</div>
</body>
</html>
