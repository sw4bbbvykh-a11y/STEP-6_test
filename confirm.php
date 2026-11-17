<?php
// POSTメソッドで送信されていない場合（直接アクセスなど）は contact.php にリダイレクト
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: contact.php');
    exit;
}

// POSTデータの取得とエスケープ処理（安全に表示・送信するため）
$name         = isset($_POST['name']) ? $_POST['name'] : '';
$companyName  = isset($_POST['companyName']) ? $_POST['companyName'] : '';
$email        = isset($_POST['email']) ? $_POST['email'] : '';
$age          = isset($_POST['age']) ? $_POST['age'] : '';
$message      = isset($_POST['message']) ? $_POST['message'] : '';

// 必須項目の未入力チェック
if ($name === '' || $companyName === '' || $email === '' || $age === '' || $message === '') {
    echo "エラー：未入力の項目があります。<a href='contact.php'>フォームに戻る</a>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>お問い合わせフォーム - 確認画面</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <h2>お問い合わせフォーム - 確認画面</h2>
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

        <!-- メインコンテンツ（確認テーブル） -->
        <main>
            <form action="send.php" method="post">
                <!-- send.phpへデータを引き継ぐためのhiddenフィールド -->
                <input type="hidden" name="name" value="<?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>">
                <input type="hidden" name="companyName" value="<?php echo htmlspecialchars($companyName, ENT_QUOTES, 'UTF-8'); ?>">
                <input type="hidden" name="email" value="<?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>">
                <input type="hidden" name="age" value="<?php echo htmlspecialchars($age, ENT_QUOTES, 'UTF-8'); ?>">
                <input type="hidden" name="message" value="<?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?>">

                <table border="3">
                    <tr>
                        <th>お名前</th>
                        <td><?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                    <tr>
                        <th>会社名</th>
                        <td><?php echo htmlspecialchars($companyName, ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                    <tr>
                        <th>メールアドレス</th>
                        <td><?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                    <tr>
                        <th>年齢</th>
                        <td><?php echo htmlspecialchars($age, ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                    <tr>
                        <th>お問い合わせ内容</th>
                        <td><?php echo nl2br(htmlspecialchars($message, ENT_QUOTES, 'UTF-8')); ?></td>
                    </tr>
                </table>

                <!-- 送信ボタン と 戻るボタン（history.back使用） -->
                <input type="submit" value="送信">
                <button type="button" onclick="history.back();">戻る</button>
            </form>
        </main>
    </div>

</body>
</html>