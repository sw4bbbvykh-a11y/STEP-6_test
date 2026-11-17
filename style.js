// --- 1 & 2. フォームの未入力チェック と 送信確認ダイアログ ---
// form要素（あるいはsubmitボタン）が送信されるときのイベントを設定します
const form = document.querySelector('form');

if (form) {
    form.addEventListener('submit', function(e) {
        // 入力された値を取得
        const name = document.getElementById('name').value;
        const companyName = document.getElementById('companyName').value;
        const email = document.getElementById('email').value;
        const age = document.getElementById('age').value;
        const message = document.getElementById('message').value;

        // ① 未入力チェック（いずれかが空の場合）
        if (name === "" || companyName === "" || email === "" || age === "" || message === "") {
            alert("必須項目が未入力です。入力内容をご確認ください。");
            e.preventDefault(); // 送信をキャンセルする
            return;
        }

        // ② 送信前の確認ダイアログ
        const confirmMessage = "以下の内容を本当に送信しますか？\n\n" +
            "お名前: " + name + "\n" +
            "会社名: " + companyName + "\n" +
            "メールアドレス: " + email + "\n" +
            "年齢: " + age + "\n" +
            "お問い合わせ内容: " + message;

        // confirm() で確認ダイアログを出す
        if (!window.confirm(confirmMessage)) {
            e.preventDefault(); // 「キャンセル」が押されたら送信を中止する
        }
    });
}


// --- 3. フッターの背景色をループさせる処理 ---
// 「押してみてね！」ボタンを取得
const colorButton = document.querySelector('footer button');
// 背景色を変更する要素（footer）を取得
const footer = document.querySelector('footer');

// 変更する色の配列
const colors = ['blue', 'red', 'yellow', 'gray'];
// 現在の色を管理するインデックス変数
let currentIndex = 0;

if (colorButton && footer) {
    colorButton.addEventListener('click', function() {
        // 次の色にインデックスを進める（剰余算 % を使ってループさせる）
        currentIndex = (currentIndex + 1) % colors.length;
        
        // footerの背景色を変更
        footer.style.backgroundColor = colors[currentIndex];
    });
}