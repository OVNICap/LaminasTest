<?php

$days = [
    '2021-04-01',
    '2021-04-02',
    '2021-04-03',
    '2021-04-04',
];

function progress($ratio)
{
    static $previousRatio = null;
    static $barLength = 50;
    $ratio = round(100 * $ratio);

    if ($ratio === $previousRatio) {
        return;
    }

    $percent = str_pad($ratio, 3, ' ', STR_PAD_LEFT);
    $length = round($barLength * $ratio / 100);
    $fill = "\033[1;34m" . str_repeat('█', $length) . "\033[0m";
    $empty = "\033[1;30m" . str_repeat('░', $barLength - $length) . "\033[0m";

    echo "\r$percent % $fill$empty";
}

foreach ($days as $d => $day) {
    progress($d / 4);
    $file = fopen(__DIR__ . '/data/cache/' . $day . '.log', 'w');
    $count = mt_rand(300000, 900000);

    for ($i = 0; $i < $count; $i++) {
        $date = new DateTime($day, new DateTimeZone('UTC'));
        $microseconds = round(24 * 3600 * 1000000 * $i / $count);
        $seconds = floor($microseconds / 1000000);
        $microseconds %= 1000000;
        $date->modify("$seconds seconds $microseconds microseconds");
        fwrite($file,
            $date->format('Y-m-d H:i:s.u') .
            str_pad(mt_rand(0, 255) . '.' . mt_rand(0, 255) . '.' . mt_rand(0, 255) . '.' . mt_rand(0, 255), 20, ' ', STR_PAD_LEFT) .
            "\n"
        );
        progress(($d + ($i + 1) / $count) / 4);
    }

    fclose($file);
}

echo "\n";

