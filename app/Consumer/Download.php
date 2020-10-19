<?php
declare(strict_types=1);
require __DIR__ . '/vendor/autoload.php';

use YoutubeDl\Options;
use YoutubeDl\YoutubeDl;

$yt = new YoutubeDl();

$collection = $yt->download(
    Options::create('/downloads')
        ->url('https://www.youtube.com/watch?v=bQL2FsHe7G4')
);

foreach ($collection->getVideos() as $video) {
    if ($video->getError() !== null) {
        echo "Error downloading video: {$video->getError()}.";
    } else {
        echo $video->getTitle(); // Will return Phonebloks
        // $video->getFile(); // \SplFileInfo instance of downloaded file
    }
}