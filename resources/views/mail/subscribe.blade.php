<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <p>{{ $info['user_name'] }}様</p>
  <p>この度は「日本、暮らしの道具店」での定期購読のお申し込み、<br />誠にありがとうございます。</p>
  <br />
  @if ($info['check_news'] === true)
    <p>初回登録者限定の1,000円引きキャンペーンコードを是非ご活用ください。</p>
    <h3>初回定期購読キャンペーン</h3>
    <p>【コード】subsc</p>
    <br />
  @endif
  <p>商品について、何かご不明点などございましたら</p>
  <p>当店までお問い合わせいただけますよう</p>
  <p>どうぞよろしくお願いいたします。</p>
  <br />
  <p>================================================================</p>
  <br />
  <p>日本、暮らしの道具店</p>
  <p>https://nipponkurashi.com</p>
  <p>メールアドレス：info@nipponkurashi.com</p>
  <p>電話番号：090-12345678（運営　鶴田和眞）</p>
  <p>営業時間：月～金 10：00-17：00</p>
  <p>※13：30～14：30はお昼休みをいただいています。</p>
  <br />
  <p>================================================================</p>
</body>
</html>
