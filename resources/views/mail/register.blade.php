<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <p>{{ $info['user_name'] }} 様</p>
  <p>この度は「日本、暮らしの道具店」への会員登録、<br />誠にありがとうございます。</p>
  <p>下記のとおり、会員登録が完了いたしましたので、<br />今一度ご確認くださいませ。</p>
  <p>【お名前】　{{ $info['user_name'] }} 様<br />
  【フリガナ】　{{ $info['user_kana'] }} 様<br />
  【メールアドレス】　{{ $info['email'] }}<br />
  【郵便番号】　{{ $info['zip_code'] }}<br />
  【ご住所】　{{ $info['address'] }}<br />
  【電話番号】　{{ $info['phone'] }}</p>
  <p>登録内容について、何かご不明点などございましたら<br />
  当店までお問い合わせいただけますよう<br />
  どうぞよろしくお願いいたします。</p>
  <p>================================================================</p>
  <p>日本、暮らしの道具店</p>
  <p>https://nipponkurashi.com</p>
  <p>メールアドレス：nippon.kurashi@gmail.com</p>
  <p>電話番号：090-12345678（運営　鶴田和眞）</p>
  <p>営業時間：月～金 10：00-17：00</p>
  <p>※13：30～14：30はお昼休みをいただいています。</p>
  <p>================================================================</p>
</body>
</html>
