<?php
$base_url = "https://your.domain/path/to/dir";
$title = "URL短縮ツール";
$theme_color = "#d98822";

if (!isset($_GET['q'])) {
    $congtents = "URLの指定がありません！";
} else {
    $digest = hash('crc32b', $_GET['q']);

    $db_json = json_decode(file_get_contents('./db.json'), true);
    $db_json[$digest] = $_GET['q'];
    
    file_put_contents('./db.json', json_encode($db_json));
    
    $shorted_url = $base_url . "/?h=" . $digest;
    
    $contents = <<< HTML
    <p>短縮URLは</p>
    <p><a href='${shorted_url}'>${shorted_url}</a></p>
    <p>です。</p>
HTML;
}
require_once('template.php');
