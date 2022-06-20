<?php 
 $cid = $_POST['cid'];
 $information = $_POST['information'];

 $baglanti = mysqli_connect('localhost', 'root', '1234', 'proje6');

 $sql="UPDATE CELL SET information='$information' WHERE cid=$cid LIMIT 1;";
 $sonuc = mysqli_query($baglanti, $sql);
 
 if(!$baglanti)exit(mysqli_error($baglanti));

?>