<?php
    $radios = [
        'silverrain' => [
            'title' => 'Серебряный Дождь Красноярск',
            'logo' => 'silverrain.png',
            'url' => 'http://krassilver.ru/online'
        ],
        'radio7' => [
            'title' => 'Радио 7 На семи холмах',
            'logo' => 'radio7.jpg',
            'url' => 'http://hls-01-radio7.emgsound.ru/13/192/playlist.m3u8'
        ],
        'europaplus' => [
            'title' => 'Европа Плюс',
            'logo' => 'EuropaPlus.png',
            'url' => 'http://hls-02-europaplus.emgsound.ru/11/192/playlist.m3u8'
        ],
        'arminvanbuuren' => [
            'title' => 'Armin van Buuren - A State of Trance',
            'logo' => 'arminvanbuuren.png',
            'url' => 'http://139.99.105.227/Trance2'
        ]
    ];

    $cmd = filter_input(INPUT_GET, 'c');
    $radio = filter_input(INPUT_GET, 'r');
    if (in_array($cmd, ['play', 'stop'])) {
        exec("mpc " . $cmd, $status);
    } elseif (isset($radios[$radio])) {
        exec("mpc clear");
        exec("mpc add " . $radios[$radio]['url']);
        exec("mpc play", $status);
    } else {
        exec("mpc", $status);
    }
    
    $isPlaying = strstr(implode('', $status), '[playing]') !== FALSE;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>WebMPC</title>
        
        <link rel="stylesheet" type="text/css" href="semantic/dist/semantic.min.css">
        <script
          src="https://code.jquery.com/jquery-3.1.1.min.js"
          integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
          crossorigin="anonymous"></script>
        <script src="semantic/dist/semantic.min.js"></script>
    </head>
    <body>
        <div class="ui compact segment" style="margin: 24px auto;">
            <div class="ui massive icon buttons">
                <a class="ui button <?=(!$isPlaying ? 'green' : '')?>" href="?c=play"><i class="ui play icon"></i></a>
                <a class="ui button <?=($isPlaying ? 'red' : '')?>" href="?c=stop"><i class="ui stop icon"></i></a>
            </div>
        </div>
        
        <div class="ui centered cards">
            <?PHP
            foreach ($radios as $key => $value) {
            ?>
            <div class="ui card">
            <a class="image" href="?r=<?=$key?>">
              <img src="/images/<?=$value['logo']?>">
            </a>
            <div class="content">
              <a class="header" href="#"><?=$value['title']?></a>
            </div>
          </div>
            <?PHP
            }
            ?>
        </div>
        
        <?php
        if ($status) {
        ?>
        <div class="ui compact segment" style="margin: 24px auto;">
            <p><pre>
                <?=implode($status, "\r\n")?>
            </pre></p>
        </div>
        <?php
        }
        ?>
    </body>
</html>
