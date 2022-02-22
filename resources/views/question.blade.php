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
    <p class="Form-Item-Label"><span class="Form-Item-Label-Required">このイベントに満足していますか？</p>
	 <input type="radio"　name="satisfaction" value="1">非常に満足
     <input type="radio" name="satisfaction" value="2">やや満足
     <input type="radio" name="satisfaction" value="3">どちらともいえない
     <input type="radio" name="satisfaction" value="4">やや不満
     <input type="radio" name="satisfaction" value="5">非常に不満
  </div>

<div class="Form-Item">
		 <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>このARをどこで知りましたか？(複数選択可能）</p>
	     <input type="checkbox" >1：Webサイト
         <input type="checkbox">2：チラシ
         <input type="checkbox">3：インスタグラム
		<input type="checkbox">4：ツイッター
        <input type="checkbox">5：知らなかった

　</div>
<div class="Form-Item" @if($errors->has('answer')) has-error @endif">>
		 <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>使ったARの感想を教えてください。</p>
     <textarea cols="30" rows="10"></textarea> 
     @if($errors->has('answer'))<span class="text-danger">{{ $errors->first('answer') }}</span> @endif
　</div>

		
  <input type="submit" class="Form-Btn" value="送信する">
</div>
</body>
</html>
