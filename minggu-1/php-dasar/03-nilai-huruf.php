<?php
$nilai = 85;

// ---------- Versi if/elseif/else ----------
if ($nilai >= 90) {
    $hurufIf = "A";
} elseif ($nilai >= 80) {
    $hurufIf = "B";
} elseif ($nilai >= 70) {
    $hurufIf = "C";
} elseif ($nilai >= 60) {
    $hurufIf = "D";
} else {
    $hurufIf = "E";
}

// ---------- Versi match ----------
$hurufMatch = match (true) {
    $nilai >= 90 => "A",
    $nilai >= 80 => "B",
    $nilai >= 70 => "C",
    $nilai >= 60 => "D",
    default      => "E",
};

echo "Nilai $nilai<br>";
echo "Versi if: $hurufIf<br>";
echo "Versi match: $hurufMatch<br>";