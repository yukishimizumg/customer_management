<?php

// 関数ファイルを読み込む
require_once __DIR__ . '/functions.php';

// エラーチェック用の配列
$errors = [];

// 新規タスク追加
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // フォームに入力されたデータの受け取り
    $company = filter_input(INPUT_POST, 'company');
    $name = filter_input(INPUT_POST, 'name');
    $email = filter_input(INPUT_POST, 'email');

    // バリデーション
    $errors = insertValidate($company, $name, $email);
    if (empty($errors)) {
        insertCustomer($company, $name, $email);

        header('Location: index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="ja">

<?php include_once __DIR__ . '/_head.html' ?>

<body>
    <div class="wrapper">
        <h1 class="title">顧客管理アプリ</h1>
        <div class="form-area">
            <h2 class="sub-title">登録</h2>
            <?php if ($errors) : ?>
                <ul class="errors">
                    <?php foreach ($errors as $key => $value) : ?>
                        <li><?= h($value) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <form action="" method="post">
                <label for="company">会社名</label>
                <input type="text" id="company" name="company" value="<?= h($company) ?>">
                <label for="name">氏名</label>
                <input type="text" id="name" name="name" value="<?= h($name) ?>">
                <label for="email">メールアドレス</label>
                <input type="email" id="email" name="email" value="<?= h($email) ?>">
                <input type="submit" class="btn submit-btn" value="追加">
            </form>
        </div>
    </div>
</body>
</html>