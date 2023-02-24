<?php
include "function.php";
if ($admin["cap"]==0) {
	$q1="select * from file where kiemduyet IS NULL  ORDER BY file.id DESC limit 20";
	$r1=confirm_query($q1);
	$sl=mysqli_num_rows($r1);
	if($sl > 0){
	    $i=0;
	while ($kq1 = mysqli_fetch_array($r1,MYSQLI_ASSOC)) {
	    echo '<a href="edit.php?id='.$kq1["id"].'">';
	    echo date("h:s d/m",strtotime($kq1["date2"]))."-".$kq1["ten"]."</a></br>";
	}
	}
}
?>
