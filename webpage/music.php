<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Music Viewer</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link href="viewer.css" type="text/css" rel="stylesheet" />
</head>

<body>
    <div id="header">
        <h1>190M Music Playlist Viewer</h1>
        <h2>Search Through Your Playlists and Music</h2>
    </div>
    <div id="listarea">
        <ul id="musiclist">
            <?php
            if(isset($_REQUEST["playlist"])){ ?>
                <a href="music.php">Back</a>
            <?php
             $playlist = $_REQUEST["playlist"];

            foreach(file('songs/' . $playlist) as $line) {?>
            <li class="mp3item">
                <a href="songs/<?= $line ?>"><?= $line ?></a>
            </li>
            <?php } ?>
            <?php } else {?>

            <?php
             foreach (glob("songs/*.mp3") as $filename) { ?>
            <li class="mp3item">
                <a href="<?= $filename ?>"><?= basename($filename) ?></a>
                (<?= sizeinfo(filesize($filename)); ?>)
            </li>
            <?php } ?>

            <?php foreach (glob("songs/*.m3u") as $filename) { ?>
            <li class="playlistitem">
                <a href="music.php?playlist=<?= basename($filename) ?>"><?= basename($filename) ?></a>
                (<?= sizeinfo(filesize($filename)); ?>)
            </li>
            <?php } }?>

        </ul>
    </div>
</body>

</html>

<?php

function sizeinfo($size){
    if (($size > 0) && ($size < 1024)) {
        echo round($size, 2, PHP_ROUND_HALF_UP) . " b";
    }
    elseif (($size >= 1024) && ($size < 1048576)) {
        echo round($size / 1024, 2, PHP_ROUND_HALF_UP) . "kb";
    }
    elseif ($size >= 1048576) {
        echo round($size / 1048576, 2, PHP_ROUND_HALF_UP) . "mb";
    }
}

?>
