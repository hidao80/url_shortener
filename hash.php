<?php
require_once("env.php");

if (!isset($_GET['q'])) {
    $contents = "URLの指定がありません！";
} else {
        $fp = fopen(DB_FILENAME, 'a+');
        if (flock($fp, LOCK_EX)) {
            $json = json_decode(fread($fp, filesize(DB_FILENAME)), true);

            $digest = hash('crc32b', $_GET['q']);
            $key = duplicate_avoidance($json, $digest, $_GET['q']);
            $json[$key] = $_GET['q'];

            ftruncate($fp, 0);
            fwrite($fp, json_encode($json));
            fflush($fp);
            flock($fp, LOCK_UN);
        }
        fclose($fp);
    }

    $shorted_url = BASE_URL . "/?h=" . $key;
    
    $contents = <<< HTML
    <p>短縮URLは</p>
    <p><a href='${shorted_url}'>${shorted_url}</a></p>
    <p>です。</p>
HTML;
}

function duplicate_avoidance($db_json, $digest, $url, $index = 0)
{
    if (array_key_exists($digest . $index, $db_json) && $db_json[$digest . $index] !== $url) {
        $index++;
        return duplicate_avoidance($db_json, $digest, $url, $index);
    } else {
        return $digest . $index;
    }
}

require_once('template.php');
