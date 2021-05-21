<?php
$base_url = "https://";
$title = "URL短縮ツール";
$theme_color = "#d98822";

if (!isset($_GET['h'])) {
    // パラメータ"h"がなければ短縮URLにしたいURL入力画面を出す
    $contents = <<< HTML
    <form action="hash.php" method="GET">
      短縮したいURLを入力してください。<br>
      <label for="q" accesskey="q">URL：</label>
      <input type="text" name="q" id="q" value="${base_url}">
      <input type="submit">
    </form>
HTML;
} else {
    $lock = fopen('./db.lock', 'w');
    flock($lock, LOCK_SH);
    // パラメータ"h"があれば、データベースに登録があるかどうか確認
    $original_url = json_decode(file_get_contents('./db.json'), true)[$_GET['h']];
    flock($lock, LOCK_UN);
    fclose($lock);

    if ($original_url) {
        // データベースにダイジェストが登録されている
        header("Location: ${original_url}");
    } else {
        // データベースにダイジェストが登録されていない
        $contents = "該当するURLがありません";
    }
}
require_once('template.php');
