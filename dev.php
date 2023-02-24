<?php
$title="All";
include "header.php";


$q1="select
    file.id,
    file.ten,
    file.tinhtrang1,
    file.date1,
    file.date2,
    file.diachi,
    file.nguoinhan,
    file.sodt,
    file.vat,
    file.ghichu,
    khachhang.tenkh,
    khachhang.sodtkh,
    khachhang.diachikh,
    file.idkh,
    user.name 
    from file inner join user  on file.iduser= user.iduser left join khachhang on file.idkh=khachhang.idkh  ORDER BY file.date1 DESC";
    $r1=confirm_query($q1);
    $sl=mysqli_num_rows($r1);
    while ($kq1 = mysqli_fetch_array($r1,MYSQLI_ASSOC)) {
        if (strlen($kq1["vat"])>6) {
            $kq1["sodt"]=trim(str_replace(" ", "", $kq1["sodt"]));
            $data[$kq1["sodt"]]=$kq1;
        }
        
    }

?>

<table style="width:100%">
  <tr>
    <th>Liên Hệ</th>
    <th>Số ĐT</th>
    <th>Địa chỉ</th>
    <th>Thông tin</th>
  </tr>
  <?php foreach ($data as $key => $value): ?>
      <tr>
        <td><?=$value["nguoinhan"]?></td>
        <td><?=$value["sodt"]?></td>
        <td><?=$value["diachi"]?></td>
        <td><?=$value["vat"]?></td>
      </tr>
  <?php endforeach ?>
  
</table>


<div class="mt-5">
<h3>Câu hỏi thường gặp</h3>
<div  >
        <div class="card">
        <div class="card-header" data-toggle="collapse" data-target="#fqa0" aria-expanded="true" aria-controls="collapseOne">
          <h4 class="float-left">Đồ bảo hộ covid mua ở đâu tp.hcm?</h4>
          <svg class="float-right" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" data-id="IcSystemChevronDown">
              <path d="M6 9L12 15L18 9" stroke="#0194f3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
          </svg>
        </div>
        <div id="fqa0"  aria-labelledby="headingOne" data-parent="#accordionExample">
          <div class="card-body">Công ty chúng tôi chyên cung cấp đồ bảo hộ, Có sẵn hàng số lượng lớn giao ngay trong ngày.</div>
        </div>
      </div>

      <div class="card">
        <div class="card-header" data-toggle="collapse" data-target="#fqa0" aria-expanded="true" aria-controls="collapseOne">
          <h4 class="float-left">Đồ bảo hộ covid giá bao nhiêu?</h4>
          
        </div>
        <div id="fqa0"  aria-labelledby="headingOne" data-parent="#accordionExample">
          <div class="card-body">Giá sản phẩm tùy vào số lượng, số lượng nhiều giá giảm.</div>
        </div>
      </div>

      <div class="card">
        <div class="card-header" data-toggle="collapse" data-target="#fqa0" aria-expanded="true" aria-controls="collapseOne">
          <h4 class="float-left">Có thể đặt số lượng lớn?</h4>
          <svg class="float-right" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" data-id="IcSystemChevronDown">
              <path d="M6 9L12 15L18 9" stroke="#0194f3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
          </svg>
        </div>
        <div id="fqa0"  aria-labelledby="headingOne" data-parent="#accordionExample">
          <div class="card-body">Công ty luôn có sẵn hàng số lượng lớn, ngoài ra bạn đặt số lượng lớn được hưởng ưu đãi giá.</div>
        </div>
      </div>
</div>                
</div>