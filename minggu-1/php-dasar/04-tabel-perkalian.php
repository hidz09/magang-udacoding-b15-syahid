<?php

$barang = [
    'baju',
    'buku',
    'pena'
];

$harga = [
    'baju => 2000',
    'buku => 5000',
    'pena => 7000'
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pengulangan</title>
</head>
<body>
    <h1>Contoh Pengulangan</h1>
</body>
</html>


  <!-- ===== 1. for: angka 1 sampai 5 ===== -->
  <h2>1. for</h2>
<?php
for($i = 1; $i <= 10; $i++) {
    echo "putaran ke-$i<br>";
}
?>

  <!-- ===== 2. while: hasil sama dengan for ===== -->
  <h2>2. while</h2>
<?php
$n = 1;                        //awal ditulis di luar
while ($n <= 10 ) {           //Syarat
    echo "putaran ke-$n<br>";  //langkah di tulis 
}

?>



  <!-- ===== 3. foreach: menelusuri array ===== -->
  <h2>3. foreach (array biasa)</h2>
<?php
foreach ($barang as $item ){
    echo "buah: $item<br>";
}


