 <div class="slimscroll" style="max-height: 230px;">

<?php
include "function.php";
$q1="select * from thongbao inner join user  on thongbao.iduser= user.iduser ORDER BY `idtb` DESC LIMIT 0, 10";
$r1=confirm_query($q1);
$sl=mysqli_num_rows($r1);
if($sl > 0){
while ($kq1 = mysqli_fetch_array($r1,MYSQLI_ASSOC)) {
?>
	

<!-- item-->
<a href="javascript:void(0);" class="dropdown-item notify-item">
    <div class="notify-icon"><img src="<?=$kq1["img"]?>" class="img-fluid rounded-circle" alt="" /> </div>
    <p class="notify-details <?=$kq1["class"]?>"><?=$kq1["tb"]?></p>
    <p class="text-muted font-13 mb-0 user-msg">Lúc:<?=date_format(date_create($kq1["date1"])," h:i d/m");?></p>
</a>

<?php }} ?>
</div>      
