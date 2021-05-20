<?php
$base_url = "https://your.domain/path/to/dir";
$title = "URL短縮ツール";
$theme_color = "#d98822";

if (!isset($_GET['q'])) {
    $congtents = "URLの指定がありません！";
} else {
    $db_json = json_decode(file_get_contents('./db.json'), true);

    $digest = hash('crc32b', $_GET['q']);
    $key = duplicate_avoidance($db_json, $digest, $_GET['q']);
    $db_json[$key] = $_GET['q'];
    
    file_put_contents('./db.json', json_encode($db_json), LOCK_EX);
    
    $shorted_url = $base_url . "/?h=" . $key;
    
    $contents = <<< HTML
    <p>短縮URLは</p>
    <p><a href='${shorted_url}'>${shorted_url}</a></p>
    <p>です。</p>
HTML;
}

function duplicate_avoidance($db_json, $digest, $url, $index = 0) {
    if (array_key_exists($digest . $index, $db_json) && $db_json[$digest . $index] !== $url) {
        $index++;
        return duplicate_avoidance($db_json, $digest, $url, $index);
    } else {
        return $digest . $index;
    }
}

require_once('template.php');
