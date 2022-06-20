<html>
<head> 
<title>EXEL</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="script.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<style> a:link, a:visited {color: black;} 
table, th, td { border: 1px solid rgb(168,168,168); border-collapse: collapse;}input[type=text] {
  border: 3px solid white;
}
 </style>
<style type="text/css">
        .context-menu {
            position: absolute;
            text-align: left;
            background: white;
            border: 3px solid black;
        }
  
        .context-menu ul {
            padding: 5px;
            margin: 5px;
            min-width: 180px;
            list-style: none;
        }
  
        .context-menu ul li {
            padding-bottom: 10px;
            padding-top: 9px;
            border: 1px  black;

        }
  
        .context-menu ul li a {
            text-decoration: none;
            color: black;
        }
  
        .context-menu ul li:hover {
            background: lightgray;
        }
    </style>
</head>

<body>
<?php 
setcookie("kopya",0, time() + (86400 * 30));
setcookie("kes",0, time() + (86400 * 30));
setcookie("veri",0, time() + (86400 * 30));

setcookie("kopya2",0, time() + (86400 * 30));
setcookie("kes2",0, time() + (86400 * 30));
setcookie("veri2",0, time() + (86400 * 30));

setcookie("id",0, time() + 6000);
setcookie("id2",0, time() + 6000);
setcookie("id3",0, time() + 6000);
setcookie("cell","", time() + (86400 * 30));
setcookie("cellcopy",0, time() + (86400 * 30));
setcookie("cellcut",0, time() + (86400 * 30));
setcookie("cellcutid",0, time() + (86400 * 30));
//setcookie("row",0, time() + 60);

error_reporting(E_ERROR | E_PARSE);
switch (@ $_GET['is']){
    case    'dosyaeklemeformu': dosyaeklemeformu($fid=null);
             break; 
    case    'dosyaekle': dosyaekle($_GET['filename'],$_GET['description']);
            anasayfa();
            break;
    case    'dosyaguncelleformu': dosyaeklemeformu($_GET['fid']);
            break; 
    case    'dosyaguncelle': dosyaguncelle ($_GET['fid'],$_GET['filename'],$_GET['description']);
            anasayfa();
            break;
    case    'exelsayfasi' : exelsayfasi($_GET['fid'],$_GET['pozition']);
            break;
    case    'sheetekle' : sheetekle($_GET['fid']);
            break;
    case    'dosyasil' : dosyasil($_GET['fid']);
            anasayfa();
            break;
    case    'sayfasil' : sayfasil($_GET['sid']);
            break;
    case    'sayfasagatasi' : sayfasagatasi($_GET['sid']);
            break;
    case    'sayfasolatasi' : sayfasolatasi ($_GET['sid']);
            break;
    case    'sayfakopyala' : sayfakopyala ($_GET['sid']);
            break;
    case    "satirsil" : satirsil($_GET['id'],$_GET['sid']);
            break;
    case    "satirtemizle" : satirtemizle($_GET['id'],$_GET['sid']);
            break;
    case    "ustesatirekle" : ustesatirekle($_GET['id'],$_GET['sid']);
            break;
    case    "altasatirekle" : altasatirekle($_GET['id'],$_GET['sid']);   
            break;  
    case    "sutunsil" : sutunsil($_GET['id'],$_GET['sid']);        
            break;
    case    "satirtemizle" : satirtemizle($_GET['id'],$_GET['sid']);     
            break;
    case    "sutuntemizle" : sutuntemizle($_GET['id'],$_GET['sid']);  
            break;
    case    "solasutunekle" : solasutunekle($_GET['id'],$_GET['sid']);
            break;
    case    "sagasutunekle" : sagasutunekle($_GET['id'],$_GET['sid']);
            break;
    case    "satirkopyala" : satirkopyala($_GET['id'],$_GET['sid'],$_GET['c']);
            break;
    case    "satiryapistir" : satiryapistir ($_GET['id'],$_GET['sid']);
            break;
    case    "sutunkopyala" : sutunkopyala($_GET['id'],$_GET['sid'],$_GET['c']);
            break;
    case    "sutunyapistir" : sutunyapistir ($_GET['id'],$_GET['sid']);
            break;
    case    "cellkopyala" : cellkopyala($_GET['text'], $_GET['i'],$_GET['cid'],$_GET['fid'],$_GET['pozition']);
            break;
    case    "cellyapistir" : cellyapistir($_GET['cid'], $_GET['fid'],$_GET['pozition']);
            break;
    
    default:  
            anasayfa();
            break;

}
function anasayfa(){
    $baglanti = mysqli_connect('localhost', 'root', '1234', 'proje6');
    $kayitKumesi = mysqli_query($baglanti, "SELECT * FROM FILES ");
    echo "
    <div align='center' class='container'>
        <h1> DOSYALAR </h1>
        <table class='table table-hover'>
            <thead>
            <th> FID </th>
            <th> DOSYA AD </th>
            <th> AÇIKLAMA </th>
            <th> SON DEĞİŞTİRİLME TARIHI </th>
            <th> </th>
            <th>  </th>  
            </tr>
            </thead>
    </div>
    ";
    while($satir = mysqli_fetch_assoc($kayitKumesi)){
    echo  "<tr> 
			<td><button type='button' class='btn btn-outline-success'><a  href='?is=exelsayfasi&fid={$satir['fid']}&pozition=1'><h3>{$satir['fid']}</h3></a></button></td> 
			<td>{$satir['filename']}</td> 
			<td>{$satir['description']}</td> 
			<td>{$satir['lastmodified']}</td>
			<td><button type='button' class='btn btn-outline-danger'><a  href='?is=dosyasil&fid={$satir['fid']}' onclick=\"return confirm('BU DOSYAYI SİLMEK İSTİYOR MUSUNUZ?')\"><h3>SIL</h3></a></button></td>
            <td><button type='button'  class='btn btn-outline-info'><a href='?is=dosyaguncelleformu& fid={$satir['fid']}'><h3>GUNCELLE</h3></a></button></td>
			</tr>";
    } 
    print "</tbody></table><button class='btn btn-outline-warning'><a href='?is=dosyaeklemeformu'><h3>  ➕ YENI BIR DOSYA EKLEYIN </h3></a></button></div>";
    echo "";
    mysqli_close($baglanti);
}
function dosyaeklemeformu($fid){
    $baglanti=mysqli_connect('localhost','root','1234','proje6');
    if($fid){
        $sql="SELECT * FROM FILES WHERE fid = $fid LIMIT 1";
        $kayitKumesi=mysqli_query($baglanti, $sql);
        $files=mysqli_fetch_array($kayitKumesi);
    }

    echo "
    <div align='center' class='container'>
    <h3>DOSYA EKLE/GUNCELLE </h3>
    <form action='?' method=get name='form'>
    <table class='table table-hover'>
    <tr><td></td><td><input name='fid' type='hidden' value='{$files[0]}'></td></tr>
    <tr><td>DOSYA AD</td><td><input name='filename' type=text value='{$files[1]}'  required></td></tr>
    <tr><td>AÇIKLAMA</td><td><input name='description' type=text value='{$files[2]}' required></td></tr>
    <tr><td></td><td><button type='reset' class='btn btn-danger  btn-block'>TEMİZLE</button></td></tr>
    <tr><td></td><td><input name='ekle' type='submit' onsubmit='return alert()' class='btn btn-success  btn-block' value='EKLE'></td></tr>
    </table>
    <input name='is' type='hidden' value='".($fid ? 'dosyaguncelle': 'dosyaekle')."'>
    </form>
    </div>
    ";
}
function dosyaekle($filename, $description){
   
    $baglanti = mysqli_connect('localhost', 'root', '1234', 'proje6');
   // $filename2=$filename+".xlsx";
    $lastmodified=iconv('latin5','utf-8',strftime('%Y-%m-0%e'));
    $sql="INSERT INTO files VALUE(NULL, '$filename.xlsx', '$description', '$lastmodified');"; //dosya eklendi
   
	if(!$baglanti)exit(mysqli_error($baglanti));
	$sonuc = mysqli_query($baglanti, $sql);
	if(!$sonuc)exit(mysqli_error($baglanti));
    
    $file = mysqli_query($baglanti, "SELECT * FROM FILES ORDER BY fid desc limit 1;");
    $lastid = mysqli_fetch_object($file); //yeni eklenen dosyanın fid sini almak için
    
    $sheet = mysqli_query($baglanti, "INSERT INTO SHEETS VALUE (NULL, 'sheet 1',10,10, $lastid->fid ,1 )"); //ilk sheet eklendi
    $sheetid = mysqli_query($baglanti, "SELECT * FROM sheets ORDER BY sid desc limit 1;"); //eklenen sheetin id si alındı
    $lastsheetid = mysqli_fetch_object($sheetid);

    $cell="INSERT INTO CELL VALUES (NULL,1, 1, '',$lastsheetid->sid)"; 
    for($i = 1; $i <=10; $i++ ){ //10-10 luk tablo oluşturuldu
        for($j = 1; $j <=10; $j++){

            if($i==1 && $j==1){
                continue;
            }
            $cell = $cell.",(NULL,$i, $j, '',$lastsheetid->sid)";         
        }
    }
   
    $sonuc2 = mysqli_query($baglanti, $cell);
}
function dosyaguncelle($fid, $filename, $description){
    $sql="UPDATE FILES SET filename='$filename',description='$description' WHERE fid = $fid LIMIT 1;";
    $baglanti = mysqli_connect('localhost', 'root', '1234', 'proje6');
    if(! $baglanti)
	    exit(mysqli_error($baglanti));
	$sonuc = mysqli_query($baglanti, $sql);
	if(! $sonuc)
		exit(mysqli_error($baglanti));
}
function exelsayfasi($fid,$pozition){
    $count = 1;
    $baglanti = mysqli_connect('localhost','root','1234','proje6');
    if($fid){
        $sql = "SELECT * FROM sheets  WHERE fid = $fid and pozition=$pozition LIMIT 1";
        $kayitKumesi = mysqli_query($baglanti, $sql);
        $sheet = mysqli_fetch_array($kayitKumesi);
        $sid = $sheet[0];
        $sname = $sheet[1];
        $rows = $sheet[2];
        $columns = $sheet[3];
    }
    setcookie("id3",$sid, time() + 6000);
    $file = "SELECT * FROM FILES WHERE fid = $fid LIMIT 1";
    $kayit = mysqli_query($baglanti, $file);
    $file2 = mysqli_fetch_array($kayit);
    $filename = $file2[1];

   $cells = "SELECT * FROM cell where sid=$sid order by rownumber, colnumber"; //cellerin içindeki veri için
   $kayitKumesi2 = mysqli_query($baglanti, $cells);

    echo "<table class='table table-bordered'>
    <tr>
    <th><button class='btn btn-outline-warning' ><a href='?is=anasayfa'><h3> ↩ </h3></a></button></th>
    <th colspan='$columns'> <i class='fas fa-file' style='font-size:20px'></i> $filename / $sname  </th>
    </tr>  
    <tr><td style='background-color:rgb(240,240,240)'></td>
    ";
    for($i = 0 ; $i < $columns ; $i++){
        echo "<td id='column$count' style='color:rgb(128,128,128);background-color:rgb(240,240,240)'  oncontextmenu='return rightClick(event,\"contextmenu$i\")'><b>"; echo chr(833+$i);
        echo "<div id='contextmenu$i' class='context-menu' style='display:none'>
            <ul>
            <li><a href='?is=sutunkopyala&id=$count&sid=$sid&c=0'><h3>✂ SUTUN KES </h3></a></li>
            <li><a href='?is=sutunkopyala&id=$count&sid=$sid&c=1'><h3>📋 SUTUN KOPYALA </h3></a></li>
            <li><a href='?is=sutunyapistir&id=$count&sid=$sid'><h3>🚩 SUTUN YAPISTIR </h3></a></li>
            <li><a href='?is=sutuntemizle&id=$count&sid=$sid'><h3>🚮 SUTUN TEMİZLE</h3></a></li>
            <li><a href='?is=sagasutunekle&id=$count&sid=$sid'><h3>➡ SAĞA BİR SUTUN EKLE</h3></a></li>
            <li><a href='?is=solasutunekle&id=$count&sid=$sid'><h3>⬅ SOLA BİR SUTUN EKLE</h3></a></li>
            <li><a href='?is=sutunsil&id=$count&sid=$sid'><h3>🧺 SUTUN SİL</h3></a></li>
        </ul>
        </div>
        </td>";
        $count++;
    }
    echo "</tr>";
    $count=0;
    $x=1;
    while($satir = mysqli_fetch_assoc($kayitKumesi2)){
        if($x==$columns+1 || $count==0){
            $x=1;
            $count++;
            echo "
            </tr>
            <tr id='row$count'><td style='color:rgb(128,128,128);background-color:rgb(240,240,240)' oncontextmenu='return rightClick(event,\"context{$satir['cid']}\")' ><b> {$satir['rownumber']}
            <div id='context{$satir['cid']}' class='context-menu' style='display:none'>
            <ul>
            <li><a href='?is=satirkopyala&id=$count&sid={$satir['sid']}&c=0'><h3>✂ SATIR KES </h3></a></li>
            <li><a href='?is=satirkopyala&id=$count&sid={$satir['sid']}&c=1'><h3>📋 SATIR KOPYALA </h3></a></li>
            <li><a href='?is=satiryapistir&id=$count&sid={$satir['sid']}'><h3>🚩 SATIR YAPISTIR </h3></a></li>
            <li><a href='?is=satirtemizle&id=$count&sid={$satir['sid']}'><h3>🚮 SATIRI TEMİZLE</h3></a></li>
            <li><a href='?is=ustesatirekle&id=$count&sid={$satir['sid']}'><h3>⬆ ÜSTE BİR SATIR EKLE</h3></a></li>
            <li><a href='?is=altasatirekle&id=$count&sid={$satir['sid']}'><h3>⬇ ALTA BİR SATIR EKLE</h3></a></li>
            <li><a href='?is=satirsil&id=$count&sid={$satir['sid']}'><h3>🧺 SATIR SİL</h3></a></li>
         </ul>
        </div>
            </td>";
        } 
            echo "
            <td oncontextmenu='return rightClick(event,\"menu{$satir['rownumber']}-{$satir['colnumber']}\")'><input type='text' id = '{$satir['rownumber']}-{$satir['colnumber']}' value='{$satir['information']}' onkeyup='kaydet({$satir['rownumber']},{$satir['colnumber']},{$satir['cid']});' >
            <div id='menu{$satir['rownumber']}-{$satir['colnumber']}' class='context-menu' style='display:none'>
            <ul>
            <li><a href='?is=cellkopyala&text={$satir['information']}&i=0&cid={$satir['cid']}&fid=$fid&pozition=$pozition'><h3>✂  KES </h3></a></li>
            <li><a href='?is=cellkopyala&text={$satir['information']}&i=1&cid={$satir['cid']}&fid=$fid&pozition=$pozition'><h3>📋  KOPYALA </h3></a></li>
            <li><a href='?is=cellyapistir&cid={$satir['cid']}&fid=$fid&pozition=$pozition'><h3>🚩  YAPISTIR </h3></a></li>
        </ul>
        </div>
            </td>";//ajax kısmı burası
            $x++;
    }
    echo "<tr id='box'>
          <th><button class='btn btn-outline-info'><a href='?is=sheetekle&fid=$fid'><h3> ➕ </h3></a></button></th>";
    
    $sheets = "SELECT * FROM sheets  WHERE fid = $fid order by pozition ";
    $kayitKumesi3 = mysqli_query($baglanti, $sheets);
    
  
    while($satir = mysqli_fetch_assoc($kayitKumesi3)){
        echo "<td id='sheet{$satir['sid']}'style='background-color:rgb(240,240,240)'><a href='?is=exelsayfasi&fid=$fid&pozition={$satir['pozition']}' oncontextmenu='return rightClick(event,\"contextMenu{$satir['sid']}\")'><b> <p id='x{$satir['sid']}'>{$satir['sname']}</p> </a>
        <input type='hidden' id='n{$satir['sid']}' value='{$satir['sname']}' onkeyup='yenidenadlandir({$satir['sid']},{$satir['fid']},{$satir['pozition']})'>
        <div id='contextMenu{$satir['sid']}' class='context-menu' style='display:none'>
        <ul>
            <li><a href='?is=sayfasil&sid={$satir['sid']}'><h3>🗑️ SAYFA SIL </h3></a></li>
            <li><a href='?is=sayfakopyala&sid={$satir['sid']}'><h3>📋 SAYFA KOPYALA </h3></a></li>
            <li><a onclick='showHiddenValue({$satir['sid']})' ><h3>🧾 YENIDEN ADLANDIR </h3></a></li>
            <li><a href='?is=sayfasagatasi&sid={$satir['sid']}'><h3>➡ SAGA TASI</h3></a></li>
            <li><a href='?is=sayfasolatasi&sid={$satir['sid']}'><h3>⬅ SOLA TASI</h3></a></li>
        </ul>
        </div>
        </td>";
    }
    echo "</tr></table>";
   
    
    $lastmodified=iconv('latin5','utf-8',strftime('%Y-%m-%e'));
    $sql="UPDATE FILES SET lastmodified='$lastmodified' WHERE fid = $fid LIMIT 1;";
    $sonuc = mysqli_query($baglanti, $sql);
   
  
}
function sheetekle($fid){
    
    $baglanti = mysqli_connect('localhost','root','1234','proje6');
    $sheetnumber = mysqli_query($baglanti, "SELECT count(*) as total from sheets where fid = $fid");
    $total = mysqli_fetch_object($sheetnumber);
    $totalsheet =$total->total;
    $totalsheet++;

    $sheetnumber = mysqli_query($baglanti, "INSERT INTO SHEETS VALUE (NULL, 'sheet $totalsheet', 10 , 10 , $fid , $totalsheet )");
    
    $sheetid = mysqli_query($baglanti, "SELECT * FROM sheets ORDER BY sid desc limit 1;"); //eklenen sheetin id si alındı
    $lastsheetid = mysqli_fetch_object($sheetid);

  
    $cell="INSERT INTO CELL VALUES (NULL,1, 1, '',$lastsheetid->sid)"; 
    for($i = 1; $i <=10; $i++ ){ //10-10 luk tablo oluşturuldu
        for($j = 1; $j <=10; $j++){
            if($i==1 && $j==1){continue;}
            $cell = $cell.",(NULL,$i, $j, '',$lastsheetid->sid)";         
        }
    }
    $sonuc2 = mysqli_query($baglanti, $cell);
    exelsayfasi($fid,$totalsheet);
}
function dosyasil($fid){
    $baglanti = mysqli_connect('localhost', 'root', '1234', 'proje6');
   
    $sheetnumber = mysqli_query($baglanti, "SELECT count(*) as total from sheets where fid = $fid");
    $total = mysqli_fetch_object($sheetnumber);
    $totalsheet =$total->total;

    for($i = 0; $i <$total->total; $i++){
        $sql = mysqli_query($baglanti, "DELETE FROM cell WHERE sid in (SELECT * FROM SHEETS WHERE fid = $fid and pozition =$totalsheet limit 1 )");
        $sql2 = mysqli_query($baglanti, "DELETE FROM SHEETS WHERE sid in (SELECT * FROM SHEETS WHERE fid = $fid and pozition =$totalsheet limit 1 )";
        $totalsheet-- ;
    }
    $sql3 = mysqli_query($baglanti, "DELETE FROM FILES WHERE fid = $fid");
}
function sayfasil($sid){
    //echo $sid;
     $baglanti = mysqli_connect('localhost', 'root', '1234', 'proje6');
    $sheets = mysqli_query($baglanti, "SELECT * FROM SHEETS WHERE sid = $sid limit 1");
    $sheet = mysqli_fetch_object($sheets); //sheet ile igili bilgiler

    $file = mysqli_query($baglanti, "SELECT count(*) as totalsheet FROM SHEETS WHERE fid = $sheet->fid ");
    $totalsheet = mysqli_fetch_object($file); //total sheet

    if($totalsheet -> totalsheet == 1){
        $sql = mysqli_query($baglanti, "DELETE FROM CELL WHERE sid = $sheet->sid");
        $sql2 = mysqli_query($baglanti, "DELETE FROM SHEETS WHERE sid =  $sheet->sid");
        $sql3 = mysqli_query($baglanti, "DELETE FROM FILES WHERE fid = $sheet->fid");
        anasayfa();
    } 
    else if($totalsheet -> totalsheet == $sheet -> pozition && $totalsheet -> totalsheet != 1){ //son sheet ise
        $sql4 = mysqli_query($baglanti, "DELETE FROM CELL WHERE sid = $sheet->sid");
        $sql5 = mysqli_query($baglanti, "DELETE FROM SHEETS WHERE sid = $sheet->sid");
        exelsayfasi($sheet->fid,1); 
    }
    else {
        $pozition = $sheet -> pozition;
       for( $i = 0; $i < $totalsheet -> totalsheet - $sheet -> pozition; $i++){      
        $updatenextsheet = mysqli_query($baglanti, "UPDATE SHEETS SET pozition=$pozition WHERE sid in (SELECT sid FROM SHEETS WHERE pozition = $pozition+1 and fid = $sheet->fid limit 1);");
        $pozition++;
       }

       $sql6 = mysqli_query($baglanti, "DELETE FROM CELL WHERE sid = $sheet->sid");
       $sql7 = mysqli_query($baglanti, "DELETE FROM SHEETS WHERE sid = $sheet->sid");
       exelsayfasi($sheet->fid,1); 
    }
    

  

}
function sayfasagatasi($sid){
    $baglanti = mysqli_connect('localhost', 'root', '1234', 'proje6');

    $sheet = mysqli_query($baglanti, "SELECT * FROM  sheets where sid=$sid ");
    $sheetinfo = mysqli_fetch_object($sheet);

    $lastsheet = mysqli_query($baglanti, "SELECT * FROM  sheets order by pozition desc limit 1 ");
    $last = mysqli_fetch_object($lastsheet);

    $fid = $sheetinfo -> fid;
    $pozition = $sheetinfo -> pozition;

    if($pozition != $last->pozition ){
    $rightsheets = mysqli_query ($baglanti, "SELECT * FROM SHEETS where pozition=$pozition+1 and fid=$fid limit 1;");
    $rightsheet = mysqli_fetch_object($rightsheets);

    $rightsid = $rightsheet->sid;
    $rightpozition = $rightsheet->pozition ;

    $sql1 = mysqli_query($baglanti, "UPDATE SHEETS SET pozition = $rightpozition WHERE sid = $sid limit 1;");
    $sql2 = mysqli_query($baglanti, "UPDATE SHEETS SET pozition = $pozition where sid= $rightsid limit 1;");
    
    exelsayfasi($fid, $rightpozition);
    } else {
        exelsayfasi($fid, $pozition);
    }
    
}
function sayfasolatasi($sid){
    $baglanti = mysqli_connect('localhost', 'root', '1234', 'proje6');

    $sheet = mysqli_query($baglanti, "SELECT * FROM  sheets where sid=$sid ");
    $sheetinfo = mysqli_fetch_object($sheet);

    $fid = $sheetinfo -> fid;
    $pozition = $sheetinfo -> pozition;

    if($pozition !=1){
    $leftsheets = mysqli_query ($baglanti, "SELECT * FROM SHEETS where pozition=$pozition-1 and fid=$fid limit 1;");
    $leftsheet = mysqli_fetch_object($leftsheets);

    $leftsid = $leftsheet ->sid;
    $leftpozition = $leftsheet -> pozition ;

    $sql1 = mysqli_query($baglanti, "UPDATE SHEETS SET pozition = $leftpozition WHERE sid = $sid limit 1;");
    $sql2 = mysqli_query($baglanti, "UPDATE SHEETS SET pozition = $pozition where sid= $leftsid limit 1;");
    
    exelsayfasi($fid, $leftpozition);
    }
    else {
        exelsayfasi($fid, $pozition);
    }
    
}
function sayfakopyala($sid){
    $baglanti = mysqli_connect('localhost', 'root', '1234', 'proje6');
    
    $sheet = mysqli_query($baglanti, "SELECT * FROM  sheets where sid=$sid ");
    $sheetinfo = mysqli_fetch_object($sheet);

    $fid = $sheetinfo -> fid;
    $pozition = $sheetinfo -> pozition;
    $sname = $sheetinfo -> sname;
    $rows = $sheetinfo -> numberofrows;
    $columns = $sheetinfo -> numberofcols;

    $sheetnumber = mysqli_query($baglanti, "SELECT count(*) as total from sheets where fid = $fid");
    $total = mysqli_fetch_object($sheetnumber);
    $totalsheet =$total->total;
    $totalsheet++;

    $sql = "INSERT INTO SHEETS VALUE (NULL, '$sname kopya', $rows , $columns , $fid , $totalsheet )";
    $sheetnumber = mysqli_query($baglanti, $sql);
    

    $sheetid = mysqli_query($baglanti, "SELECT * FROM sheets ORDER BY sid desc limit 1;"); //eklenen sheetin id si alındı
    $lastsheetid = mysqli_fetch_object($sheetid);
    
    

    for($i = 1; $i <= $rows; $i++ ){ 
    for($j = 1; $j <= $columns; $j++){

            $sql1 = mysqli_query($baglanti, "SELECT * FROM cell where rownumber=$i and colnumber=$j and sid=$sid limit 1;"); 
            $sql2 = mysqli_fetch_object($sql1);

            $cell="INSERT INTO CELL VALUE (NULL,$i, $j, '$sql2->information',$lastsheetid->sid)";
            $sonuc2 = mysqli_query($baglanti, $cell);
        }
    }
    exelsayfasi($fid, $totalsheet);

}
function satirsil($id,$sid){
    $baglanti = mysqli_connect('localhost', 'root', '1234', 'proje6');

    $sheet = mysqli_query($baglanti, "SELECT * FROM  sheets where sid=$sid ");
    $sheetinfo = mysqli_fetch_object($sheet);
    $columns = $sheetinfo->numberofcols;
    $fid = $sheetinfo->fid;
    $pozition = $sheetinfo->pozition;
    $rows=$sheetinfo->numberofrows;

    if($rows == 1){
        sayfasil($sid);
    }
    else if($id==$rows){
        for($i = 1; $i <= $columns; $i++){
            $sql = mysqli_query($baglanti, "DELETE FROM CELL WHERE sid = $sid and colnumber = $i and rownumber=$id");
        }
        exelsayfasi($fid,$pozition);

    }else {
        for($i = 1; $i <= $columns; $i++){
            $sql = mysqli_query($baglanti, "DELETE FROM CELL WHERE sid = $sid and colnumber = $i and rownumber=$id");
        }
            for($i = $id+1 ; $i <=$rows ; $i++){
            for($j =1; $j <= $columns; $j++){
                $a=$i-1;
                $update=mysqli_query($baglanti, "UPDATE CELL SET rownumber=$a WHERE sid = $sid and rownumber=$i and colnumber=$j limit 1");
            }
        }
        
        $update=mysqli_query($baglanti, "UPDATE SHEETS SET numberofrows =numberofrows-1 WHERE sid = $sid limit 1");
        exelsayfasi($fid,$pozition);
    }
    

}
function satirtemizle($id, $sid){
    $baglanti = mysqli_connect('localhost', 'root', '1234', 'proje6');
    $sheet = mysqli_query($baglanti, "SELECT * FROM  sheets where sid=$sid ");
    $sheetinfo = mysqli_fetch_object($sheet);

    for($i = 1; $i <= $sheetinfo->numberofcols; $i++){
        
        $sql = mysqli_query($baglanti, "UPDATE cell SET information ='' WHERE sid = $sid and rownumber=$id and colnumber=$i");

    }
    exelsayfasi($sheetinfo->fid,$sheetinfo->pozition);

}
function ustesatirekle($id, $sid){
    $baglanti = mysqli_connect('localhost', 'root', '1234', 'proje6');
    $sheet = mysqli_query($baglanti, "SELECT * FROM  sheets where sid=$sid ");
    $sheetinfo = mysqli_fetch_object($sheet);

    $sheetnumber = mysqli_query($baglanti, "SELECT count(*) as total from sheets where fid = $sheetinfo->fid");
    $total = mysqli_fetch_object($sheetnumber);

    for($i = $sheetinfo->numberofrows; $i >=$id ; $i--){
    for($j = 1; $j <= $sheetinfo->numberofcols; $j++){
      $a=$i+1;
        $update=mysqli_query($baglanti, "UPDATE CELL SET rownumber=$a WHERE sid = $sid and rownumber=$i and colnumber=$j limit 1");
    }}
    
    for($i = 1; $i <= $sheetinfo->numberofcols; $i++){
        $cell="INSERT INTO CELL VALUE (NULL,$id, $i, '',$sheetinfo->sid)";
        $sonuc2 = mysqli_query($baglanti, $cell);

    }
    $update=mysqli_query($baglanti, "UPDATE SHEETS SET numberofrows =numberofrows+1 WHERE sid = $sid limit 1");
    exelsayfasi($sheetinfo->fid,$sheetinfo->pozition);

}
function altasatirekle($id, $sid){
    $id++;
    $baglanti = mysqli_connect('localhost', 'root', '1234', 'proje6');
    $sheet = mysqli_query($baglanti, "SELECT * FROM  sheets where sid=$sid ");
    $sheetinfo = mysqli_fetch_object($sheet);

    $sheetnumber = mysqli_query($baglanti, "SELECT count(*) as total from sheets where fid = $sheetinfo->fid");
    $total = mysqli_fetch_object($sheetnumber);

    for($i = $sheetinfo->numberofrows; $i >=$id ; $i--){
    for($j = 1; $j <= $sheetinfo->numberofcols; $j++){
      $a=$i+1;
        $update=mysqli_query($baglanti, "UPDATE CELL SET rownumber=$a WHERE sid = $sid and rownumber=$i and colnumber=$j limit 1");
    }}
    for($i = 1; $i <= $sheetinfo->numberofcols; $i++){
        $cell="INSERT INTO CELL VALUE (NULL,$id, $i, '',$sheetinfo->sid)";
        $sonuc2 = mysqli_query($baglanti, $cell);

    }
    $update=mysqli_query($baglanti, "UPDATE SHEETS SET numberofrows =numberofrows+1 WHERE sid = $sid limit 1");
    exelsayfasi($sheetinfo->fid,$sheetinfo->pozition);
}
function sutunsil($id, $sid){
    $baglanti = mysqli_connect('localhost', 'root', '1234', 'proje6');

    $sheet = mysqli_query($baglanti, "SELECT * FROM  sheets where sid=$sid ");
    $sheetinfo = mysqli_fetch_object($sheet);
    $columns = $sheetinfo->numberofcols;
    $fid = $sheetinfo->fid;
    $pozition = $sheetinfo->pozition;
    $rows=$sheetinfo->numberofrows;

    if($columns == 1){
        sayfasil($sid);
    }
    else if($id==$columns){
        for($i = 1; $i <= $rows; $i++){
           $sql = mysqli_query($baglanti, "DELETE FROM CELL WHERE sid = $sid and colnumber = $id and rownumber=$i"); 
        }

        $update=mysqli_query($baglanti, "UPDATE SHEETS SET numberofcols =numberofcols-1 WHERE sid = $sid limit 1");
        exelsayfasi($fid,$pozition); 

    }else {
        for($i = 1; $i <= $rows; $i++){
            $sql = mysqli_query($baglanti, "DELETE FROM CELL WHERE sid=$sid and colnumber=$id and rownumber=$i");
        }
            for($i = $id+1 ; $i <=$columns ; $i++){
                for($j =1; $j <= $rows; $j++){
                $a=$i-1;
                $update=mysqli_query($baglanti, "UPDATE CELL SET colnumber=$a WHERE sid = $sid and rownumber=$j and colnumber=$i limit 1");
                }
             }
        
        $update=mysqli_query($baglanti, "UPDATE SHEETS SET numberofcols =numberofcols-1 WHERE sid = $sid limit 1");
        exelsayfasi($fid,$pozition);
    }
}
function sutuntemizle($id,$sid){
    $baglanti = mysqli_connect('localhost', 'root', '1234', 'proje6');
    $sheet = mysqli_query($baglanti, "SELECT * FROM  sheets where sid=$sid ");
    $sheetinfo = mysqli_fetch_object($sheet);

    for($i = 1; $i <= $sheetinfo->numberofrows; $i++){
        $sql = mysqli_query($baglanti, "UPDATE cell SET information ='' WHERE sid = $sid and colnumber=$id and rownumber=$i");

    }
    exelsayfasi($sheetinfo->fid,$sheetinfo->pozition);
}
function solasutunekle($id, $sid){
    $baglanti = mysqli_connect('localhost', 'root', '1234', 'proje6');
    $sheet = mysqli_query($baglanti, "SELECT * FROM  sheets where sid=$sid ");
    $sheetinfo = mysqli_fetch_object($sheet);


    for($i = $sheetinfo->numberofcols; $i >=$id ; $i--){
    for($j = 1; $j <= $sheetinfo->numberofrows; $j++){
        $a = $i+1;
        $update=mysqli_query($baglanti, "UPDATE CELL SET colnumber=$a WHERE sid = $sid and rownumber=$j and colnumber=$i limit 1");
    }}
    for($i = 1; $i <= $sheetinfo->numberofrows; $i++){
        $cell="INSERT INTO CELL VALUE (NULL,$i, $id, '',$sheetinfo->sid)";
        $sonuc2 = mysqli_query($baglanti, $cell);

    }
    $update=mysqli_query($baglanti, "UPDATE SHEETS SET numberofcols =numberofcols+1 WHERE sid = $sid limit 1");
    exelsayfasi($sheetinfo->fid,$sheetinfo->pozition);
}
function sagasutunekle($id, $sid){
    $id++;
    $baglanti = mysqli_connect('localhost', 'root', '1234', 'proje6');
    $sheet = mysqli_query($baglanti, "SELECT * FROM  sheets where sid=$sid ");
    $sheetinfo = mysqli_fetch_object($sheet);


    for($i = $sheetinfo->numberofcols; $i >=$id ; $i--){
    for($j = 1; $j <= $sheetinfo->numberofrows; $j++){
       $a=$i+1;
        $update=mysqli_query($baglanti, "UPDATE CELL SET colnumber=$a WHERE sid = $sid and rownumber=$j and colnumber=$i limit 1");
    }}
    for($i = 1; $i <= $sheetinfo->numberofrows; $i++){
        $cell="INSERT INTO CELL VALUE (NULL,$i, $id, '',$sheetinfo->sid)";
        $sonuc2 = mysqli_query($baglanti, $cell);

    }
    $update=mysqli_query($baglanti, "UPDATE SHEETS SET numberofcols =numberofcols+1 WHERE sid = $sid limit 1");
    exelsayfasi($sheetinfo->fid,$sheetinfo->pozition);
}
function satirkopyala($id, $sid,$c){
    $baglanti = mysqli_connect('localhost', 'root', '1234', 'proje6');
    $sheet = mysqli_query($baglanti, "SELECT * FROM  sheets where sid=$sid ");
    $sheetinfo = mysqli_fetch_object($sheet);

    $delete = mysqli_query($baglanti , "TRUNCATE TABLE satir2");

    if($c==0){
        for ($i = 1; $i<= $sheetinfo->numberofcols; $i++){
            $cell  = mysqli_query($baglanti, "SELECT * FROM CELL WHERE sid=$sid and rownumber=$id and colnumber=$i");
            $cellinfo = mysqli_fetch_object($cell);
            $satir= mysqli_query ($baglanti, "INSERT INTO satir2 VALUE (NULL,$id, $i, '$cellinfo->information',$sid,$c)");
            setcookie("id2",$id, time() + 60);
        }
    } else if($c==1){
        for ($i = 1; $i<= $sheetinfo->numberofcols; $i++){
            $cell  = mysqli_query($baglanti, "SELECT * FROM CELL WHERE sid=$sid and rownumber=$id and colnumber=$i");
            $cellinfo = mysqli_fetch_object($cell);
            $satir= mysqli_query ($baglanti, "INSERT INTO satir2 VALUE (NULL,$id, $i, '$cellinfo->information',$sid,$c)");
        }
    }
    exelsayfasi($sheetinfo->fid,$sheetinfo->pozition);
}
function satiryapistir($id, $sid){
    $baglanti = mysqli_connect('localhost', 'root', '1234', 'proje6');
    $sheet = mysqli_query($baglanti, "SELECT * FROM  sheets where sid=$sid ");
    $sheetinfo = mysqli_fetch_object($sheet);
    $row=0;
    
    $rnumber = mysqli_query($baglanti, "SELECT count(*) as t FROM satir2");
    $r = mysqli_fetch_object($rnumber);    
    
    $s = mysqli_query($baglanti, "SELECT * FROM satir2 WHERE colnumber=1");
    $sinfo = mysqli_fetch_object($s);        
    $roww=$sinfo->rownumber;
    
    if($r->t==0 || $roww==$id){
        exelsayfasi($sheetinfo->fid,$sheetinfo->pozition);
    }
    else {
        if($sinfo->operation==0){
            echo $roww->operation;
            for ($i = 1; $i<= $r->t; $i++){
                $satir  = mysqli_query($baglanti, "SELECT * FROM satir2 WHERE colnumber=$i");
                $satirinfo = mysqli_fetch_object($satir);        
                $row=$satirinfo->rownumber;
                $w="UPDATE CELL SET information='$satirinfo->information' WHERE rownumber=$id and colnumber=$i and sid=$sid limit 1";
                $update=mysqli_query($baglanti, $w);        

            }
            $update2=mysqli_query($baglanti, "UPDATE satir2 SET operation=1 WHERE rownumber=$sinfo->rownumber and colnumber=1 and sid=$sid and $satirinfo->cid limit 1");

            satirsil($row,$sid);

        } else if($sinfo->operation==1){
            for ($i = 1; $i<= $r->t; $i++){
                $satir  = mysqli_query($baglanti, "SELECT * FROM satir2 WHERE colnumber=$i");
                $satirinfo = mysqli_fetch_object($satir);
                $w="UPDATE CELL SET information='$satirinfo->information' WHERE rownumber=$id and colnumber=$i and sid=$sid  limit 1";
                $update=mysqli_query($baglanti, $w);
            }
            echo $roww->operation;
            exelsayfasi($sheetinfo->fid,$sheetinfo->pozition);
            
        }
    }

    

    
}
function sutunkopyala($id, $sid, $c){
    $baglanti = mysqli_connect('localhost', 'root', '1234', 'proje6');
    $sheet = mysqli_query($baglanti, "SELECT * FROM  sheets where sid=$sid ");
    $sheetinfo = mysqli_fetch_object($sheet);

    $delete = mysqli_query($baglanti , "TRUNCATE TABLE sutun2");

    if($c==0){
        for ($i = 1; $i<= $sheetinfo->numberofrows; $i++){
            $cell  = mysqli_query($baglanti, "SELECT * FROM CELL WHERE sid=$sid and rownumber=$i and colnumber=$id");
            $cellinfo = mysqli_fetch_object($cell);
            $satir= mysqli_query ($baglanti, "INSERT INTO sutun2 VALUE (NULL,$i, $id, '$cellinfo->information',$sid,$c)");
            setcookie("id",$id, time() + 60);
        }
    } else if($c==1){
        for ($i = 1; $i<= $sheetinfo->numberofrows; $i++){
            $cell  = mysqli_query($baglanti, "SELECT * FROM CELL WHERE sid=$sid and rownumber=$i and colnumber=$id");
            $cellinfo = mysqli_fetch_object($cell);
            $satir= mysqli_query ($baglanti, "INSERT INTO sutun2 VALUE (NULL,$i, $id, '$cellinfo->information',$sid,$c)");
        }
    }
    exelsayfasi($sheetinfo->fid,$sheetinfo->pozition);
}
function sutunyapistir($id, $sid){
    $baglanti = mysqli_connect('localhost', 'root', '1234', 'proje6');
    $sheet = mysqli_query($baglanti, "SELECT * FROM  sheets where sid=$sid ");
    $sheetinfo = mysqli_fetch_object($sheet);
    $col=0;
    
    $cnumber = mysqli_query($baglanti, "SELECT count(*) as t FROM sutun2");
    $c = mysqli_fetch_object($cnumber);    
    
    $s = mysqli_query($baglanti, "SELECT * FROM sutun2 WHERE rownumber=1");
    $sinfo = mysqli_fetch_object($s);        
    $coll=$sinfo->colnumber;
    
    if($c->t==0 || $coll==$id){
        exelsayfasi($sheetinfo->fid,$sheetinfo->pozition);
    }
    else {
        if($sinfo->operation==0){
            for ($i = 1; $i<= $c->t; $i++){
                $satir  = mysqli_query($baglanti, "SELECT * FROM sutun2 WHERE rownumber=$i");
                $satirinfo = mysqli_fetch_object($satir);        
               $row=$satirinfo->colnumber;
                $w="UPDATE CELL SET information='$satirinfo->information' WHERE rownumber=$i and colnumber=$id and sid=$sid limit 1";
                $update=mysqli_query($baglanti, $w);        

            }
            $update2=mysqli_query($baglanti, "UPDATE sutun2 SET operation=1 WHERE colnumber=$sinfo->colnumber and rownumber=1 and sid=$sid and $satirinfo->cid limit 1");

            sutunsil($row,$sid);

        } else if($sinfo->operation==1){
            for ($i = 1; $i<= $c->t; $i++){
                $satir  = mysqli_query($baglanti, "SELECT * FROM sutun2 WHERE rownumber=$i");
                $satirinfo = mysqli_fetch_object($satir);
                $w="UPDATE CELL SET information='$satirinfo->information' WHERE rownumber=$i and colnumber=$id and sid=$sid  limit 1";
                $update=mysqli_query($baglanti, $w);
            }
            exelsayfasi($sheetinfo->fid,$sheetinfo->pozition);
            
        }
    }

}
function cellkopyala($text,$i,$cid,$fid,$pozition){
    setcookie("cell",$text, time() + (86400 * 30));
    if($i==0){
        setcookie("cellcut",1, time() + (86400 * 30));
        setcookie("cellcutid",$cid, time() + (86400 * 30));
    }
    else if($i==1){
        setcookie("cellcopy",1, time() + (86400 * 30));
    }
    exelsayfasi($fid,$pozition);
    
}
function cellyapistir($cid ,$fid,$pozition){
    $baglanti = mysqli_connect('localhost', 'root', '1234', 'proje6');
    $d=$_COOKIE["cell"];
    $h="UPDATE cell SET information ='$d' WHERE cid=$cid";
    echo $h;
    echo "<br>";
    $sql=mysqli_query($baglanti,$h);
   
    if($_COOKIE["cellcut"]==1){
    $x=$_COOKIE["cellcutid"];
    $sql=mysqli_query($baglanti,"UPDATE cell SET information ='' WHERE cid=$x");
    }
    exelsayfasi($fid,$pozition);
}
function dd($id, $sid){
    $baglanti = mysqli_connect('localhost', 'root', '1234', 'proje6');
    $sheet = mysqli_query($baglanti, "SELECT * FROM  sheets where sid=$sid ");
    $sheetinfo = mysqli_fetch_object($sheet);
    $row=0;
    
    if($_COOKIE["kopya"]==1 && $_COOKIE["veri"]==1){
        
        for ($i = 1; $i<= $sheetinfo->numberofcols; $i++){
            $satir  = mysqli_query($baglanti, "SELECT * FROM satir WHERE colnumber=$i");
            $satirinfo = mysqli_fetch_object($satir);
            
            $w="UPDATE CELL SET information='$satirinfo->information' WHERE rownumber=$id and colnumber=$i and sid=$sid limit 1";
            //echo $w;
            $update=mysqli_query($baglanti, $w);
        }
        setcookie("kopya",1, time() + (86400 * 30));
        setcookie("veri",1, time() + (86400 * 30));
        exelsayfasi($sheetinfo->fid,$sheetinfo->pozition);
        
    }
    if($_COOKIE["kes"]==1 && $_COOKIE["veri"]==1){
        
        for ($i = 1; $i<= $sheetinfo->numberofcols; $i++){
            $satir  = mysqli_query($baglanti, "SELECT * FROM satir WHERE colnumber=$i");
            $satirinfo = mysqli_fetch_object($satir);        
            $row=$satirinfo->rownumber;
            $w="UPDATE CELL SET information='$satirinfo->information' WHERE rownumber=$id and colnumber=$i and sid=$sid limit 1";
            $update=mysqli_query($baglanti, $w);        
        }
        setcookie("kes",0, time() + (86400 * 30));
        setcookie("kopya",1, time() + (86400 * 30));
        setcookie("veri",1, time() + (86400 * 30));
        satirsil($row,$sid);
        
    }

}
?>
<script>
    var prev_id=null;
    document.onclick = hideMenuu;
    
function hideMenuu() {
        if(prev_id!=null){
            document.getElementById(prev_id).style.display = "none";
            prev_id=null;
        }
    }
 

function hideMenu(id) {
        document.getElementById(id).style.display = "none"
    }
  
function rightClick(e, id) {
        e.preventDefault();     
        if(prev_id!=null){
            if (document.getElementById(id).style.display == "block"){
                hideMenu(id);
                var menu = document.getElementById(id);
                menu.style.display = 'block';
                menu.style.left = e.pageX + "px";
                menu.style.top = e.pageY + "px";        
                prev_id=id;}}
            else { 
                var menu = document.getElementById(id);          
                menu.style.display = 'block';
                menu.style.left = e.pageX + "px";
                menu.style.top = e.pageY + "px";
                prev_id=id;
            }
        }

function showHiddenValue(id) {
		document.getElementById("x"+id).style.display = "none";
		document.getElementById("n"+id).type = "text";            	
	}


function yenidenadlandir(sid,fid,pozition) {   
   //alert(fid);
    
      var input = document.getElementById("n"+sid);
       input.addEventListener("keyup", function(event) {
       if (event.keyCode === 13) {
       
        var information = document.getElementById("n"+sid).value;
       $.ajax({
       type: "POST",
       url: "rename.php",
       data: {
           sid: sid,
           information: information
       },
       success: function(data) {     
        var a= "http://proje6.test/?is=exelsayfasi&fid="+fid+"&pozition="+pozition;
        window.location.href = a;   
       },
       error: function(xhr, ajaxOptions, thrownError) {
           alert(xhr.status);
           alert(thrownError);
       }
       });
        
       }
    });}
function readCookie(name) {
	var cookiename = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++)
	{
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(cookiename) == 0) return c.substring(cookiename.length,c.length);
	}
	return null;}
document.getElementById("row"+readCookie('id2')).style.border = "solid blue"; 
</script>
<script>
function readCookie2(name) {
	var cookiename = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++)
	{
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(cookiename) == 0) return c.substring(cookiename.length,c.length);
	}
	return null;
}
document.getElementById("column"+readCookie2('id')).style.border = "solid red"; 
</script>
<script>
function readCookie3(name) {
	var cookiename = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++)
	{
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(cookiename) == 0) return c.substring(cookiename.length,c.length);
	}
	return null;
}
document.getElementById("sheet"+readCookie2('id3')).style.border = "solid black"; 
</script>
</body>
</html>