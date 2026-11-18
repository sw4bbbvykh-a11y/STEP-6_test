<?php
// POSTメソッドで送信されていない場合（直接アクセスなど）は contact.php にリダイレクト
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: contact.php');
    exit;
}

// データの取得
$name         = isset($_POST['name']) ? $_POST['name'] : '';
$companyName  = isset($_POST['companyName']) ? $_POST['companyName'] : '';
$email        = isset($_POST['email']) ? $_POST['email'] : '';
$age          = isset($_POST['age']) ? $_POST['age'] : '';
$message      = isset($_POST['message']) ? $_POST['message'] : '';

// 必須項目のチェック
if ($name === '' || $companyName === '' || $email === '' || $age === '' || $message === '') {
    echo "エラー：不正なアクセスです。<a href='contact.php'>フォームに戻る</a>";
    exit;
}

// メール送信の設定
$to = 'あなたのメールアドレス@example.com'; // ご自身が受け取れるメールアドレスに変更してください
$subject = 'お問い合わせがありました';
$body = "お名前: {$name}\n" .
        "会社名: {$companyName}\n" .
        "メールアドレス: {$email}\n" .
        "年齢: {$age}\n" .
        "お問い合わせ内容:\n{$message}";
$headers = "From: {$email}";

// メール送信の実行（Docker環境ではメールは送信されませんが、戻り値による条件分岐があればOKです）
$is_sent = mail($to, $subject, $body, $headers);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>お問い合わせフォーム - 送信完了画面</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <h1>お問い合わせフォーム - 送信完了画面</h1>
    </header>

    <div class="container">
        <!-- サイドバー -->
        <aside>
            <ul>
                <li><a href="#">トップページ</a></li>
                <li><a href="#">人気投稿</a></li>
                <li><a href="#">エンジニアおすすめ商品</a></li>
                <li><a href="#">エンジニアおすすめ記事</a></li>
                <li><a href="#">投稿ページ</a></li>
            </ul>
        </aside>
        <!-- メインコンテンツ -->
        <main>
            <p>
                <?php
                if ($is_sent) {
                    echo "お問い合わせが送信されました。ありがとうございます！";
                } else {
                    echo "メールの送信に失敗しました。しばらく経ってから再度お試しください。";
                }
                ?>
            </p>
            <p><a href="contact.php">お問い合わせフォームに戻る</a></p>
        </main>
    </div>

</body>