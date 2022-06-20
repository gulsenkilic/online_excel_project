<?php 
 $sid = $_POST['sid'];
 $information = $_POST['information'];

 $baglanti = mysqli_connect('localhost', 'root', '1234', 'proje6');

 $sql="UPDATE sheets SET sname='$information' WHERE sid=$sid LIMIT 1;";
 echo $sql;
 $sonuc = mysqli_query($baglanti, $sql);

 
 
 if(!$baglanti)exit(mysqli_error($baglanti));

?>