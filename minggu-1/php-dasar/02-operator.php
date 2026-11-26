<?php

$a = 20;
$b = 30;

echo $a += $b; //20+30 = 50?

echo $a; //$hasil = $a + $b = 50, $a tetap 20, $b tetap 30 Jadi += itu permanen, sedangkan + saja tidak.

$a = 20;
$b = 30;

echo $a + $b;       // 50
echo "<br>";
echo $a;            // 20

echo "<br>";

$a += $b;
echo $a;            // 50

$c = $a + $b; // 80
$a += 5; // 25
$b -= 10; //20

echo "<br>a = $a, b = $b, c = $c";

$x = 10; //
$x += 5;
$x *= 2;
$x -= 4;
$x++;


$y = 8;
$y *= 3; //8 x 3 = 24
$y -= 4; //24 - 4 = 20
$y += 10;//20 + 10 =30
$y++; //30 + 1 = 31\


$y = 8;
$y *= 3;
echo $y . "<br>";   // 24
$y -= 4;
echo $y . "<br>";   // 20
$y += 10;
echo $y . "<br>";   // 30
$y++;
echo $y . "<br>";   // 31



$p = 17;
$q = 5;

echo "Penjumlahan: " . ($p + $q) . "<br>";
