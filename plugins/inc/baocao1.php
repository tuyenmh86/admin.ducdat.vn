<?php
    $tongfile=array();
  foreach ($value as $k1 => $v1) {
    $tongfile[$v1["name"]][]=1;
  }

  foreach ($tongfile as $k2 => $v2) {
   // echo $k2." Có ".array_sum($v2)." đơn hàng <br>";
  }
?>

<table  class="table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Ngày giao</th>
        <th>Tên file</th>
        <th>Người nhận</th>
        <th>Số lượng</th>
        <th>Đơn giá</th>
        <th>Thành tiền</th>
    </tr>
    </thead>


    <tbody>
        <?php $tongtien=0;  foreach ($value as $k => $v): $tong=$v["dongia"]*$v["soluong"];  $tongtien=$tongtien+$tong; ?>
                    <tr>
                       <td><?=$v["date1"]?></td>
                       <td><a href="edit.php?id=<?=$v["idsp"]?>"><?=$v["ten"]?></a><br><?=$v["ghichu"]?></td>
                       <td><?=$v["nguoinhan"]?></td>
                       <td><?=$v["soluong"]?></td>
                       <td><?=number_format($v["dongia"])?></td>
                       <td><?=number_format($tong)?></td>
                    </tr>        
        <?php endforeach ?>
                     <tr>
                       <td></td>
                       <td></td>
                       <td></td>
                       <td></td>
                       <td></td>
                       <td><?=number_format($tongtien)?></td>
                    </tr>        
  
    </tbody>
</table>


