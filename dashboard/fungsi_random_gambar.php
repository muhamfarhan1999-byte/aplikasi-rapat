<?php
require '../auth_koneksi/koneksi.php';

function getRandomIcon()
{
    $icons = [
        "../foto/meating.png",
        "../foto/meating3.png",
        "../foto/meating1.png",
        "../foto/meating2.png"
    ];
    return $icons[array_rand($icons)];
}
