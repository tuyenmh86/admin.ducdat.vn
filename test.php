<?php
 include "function.php";
  $q1="select * from file where ten=''";

  $r1=confirm_query($q1);
  $sl=mysqli_num_rows($r1);
  $data=array();

  if($sl > 0){
  while ($kq1 = mysqli_fetch_array($r1,MYSQLI_ASSOC)) {
     echo '<a href="http://admin.ducdat.vn/edit.php?id='.$kq1["id"].'">'.$kq1["id"].'</a><br>';
  }}



 exit();
  $q1="select * from file";

  $r1=confirm_query($q1);
  $sl=mysqli_num_rows($r1);
  $data=array();

  if($sl > 0){
  while ($kq1 = mysqli_fetch_array($r1,MYSQLI_ASSOC)) {
     $sdt=trim($kq1["sodt"]);
     $edit=array(
        " "=>"",
        "+84"=>"0",
        "."=>""
     );
     foreach ($edit as $key => $value) {
       $sdt = str_replace($key, $value, $sdt);
     }
     $data[$sdt]["ten"]=trim(ucfirst($kq1["nguoinhan"]));
     $data[$sdt]["dc"]=trim($kq1["diachi"]);
     
      
  }}

  foreach ($data as $key => $value) {
  	if (strlen($key)<=11) {
  		?>
  		BEGIN:VCARD
		VERSION:3.0
		FN;CHARSET=UTF-8:KH<?=$value["ten"]?>
		N;CHARSET=UTF-8:KH;<?=$value["ten"]?>;;;
		TITLE;CHARSET=UTF-8:
		ORG;CHARSET=UTF-8:;
		NOTE:<?=$value["dc"]?>
		TEL;VOICE;HOME:<?=$key?>
		END:VCARD
 <?php
	}
    
   } 
?>
