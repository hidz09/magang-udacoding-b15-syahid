<?php echo "Hello, World!";

$nama = "syahid";
$umur = 20;
$tinggi = 170;
$status = true;
$nilai = null;

const nama = "syahid";
define("umur", 20);

const tinggi = 170;
define("status", true);

$kelas = [
    "nama" => "syahid",
    "umur" => 20,
    "tinggi" => 170,
    "status" => true,
    "nilai" => null
];

echo $kelas["nama"]; // syahid


var_dump (
    $nama,
    $umur,
    $tinggi,
    $status,
    $nilai
);


$nama = "syahid";

echo "Nama saya $nama";    // Nama saya syahid
echo 'Nama saya $nama';    // Nama saya $nama

$umur = 20;
var_dump($umur); // int(20)

$tinggi = 170;
var_dump($tinggi); // int(170)


$x = 10;
var_dump($x); // int(10)