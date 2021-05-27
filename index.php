<?php
require_once("env.php");

if (!isset($_GET['h'])) {
    // パラメータ"h"がなければ短縮URLにしたいURL入力画面を出す
    $contents = <<< HTML
    <form action="hash.php" method="GET">
      短縮したいURLを入力してください。<br>
      <label for="q" accesskey="q">URL：</label>
      <input type="text" name="q" id="q" value="{$_(BASE_URL)}">
      <input type="submit">
    </form>
HTML;
} else {
    // パラメータ"h"があれば、データベースに登録があるかどうか確認
    $original_url = json_decode(file_get_contents(DB_FILENAME), true)[$_GET['h']];

    if ($original_url) {
        // データベースにダイジェストが登録されている
        header("Location: ${original_url}");
    } else {
        // データベースにダイジェストが登録されていない
        $contents = "該当するURLがありません";
    }
}
require_once('template.php');
