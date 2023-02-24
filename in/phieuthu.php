<?php 
    if (isset($_POST["t"]) and is_numeric($_POST["t"])) {
  $tien=$_POST["t"];
}else $tien=0;
  ?>
<!DOCTYPE html>
<html>
<head>
  <title>HD-<?=$_POST["ten"]?></title>
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<style type="text/css">
*{
  margin: 0px;
  padding: 0px;
  font-family: time;
  font-size: 18px;
}
h3{
    font-size: 30px !important;
    font-weight: bold;
}
h5{
    font-size: 20px !important;
    font-weight: bold;
}
ul li{
  list-style: none;
}


  .lh{
    
  }
  .lh div{
    display: inline-block;
  }
  .line{
    border-bottom: dotted 1px;
    margin-bottom: 3px;
    font-size: 15px;
  }
  .line span{
    background: #fff;
    padding: 5px;
  }
 
 table {
  margin: 10px 0px 13px 0px;
  border-collapse: collapse;
  line-height: 23px;
}

table, td, th {
  border: 1px solid black;
}
</style>
<body>
 <div class="wapper" contenteditable="true">
    <div class="row">
        <div class="col-6">
            <h5 style="text-align: center;">CÔNG TY TNHH MTV SẢN XUẤT TMDV ĐỨC ĐẠT</h5>
            <div >
                Đc: :84/6 Đường số 9,Tổ 7,P.An Phú Đông,Q.12, TP. HCM.<br>
                Hotline: 0975.191.513 - 0902.744.686<br>
            </div>
        </div>
        <div class="col-6" style=" text-align: center;">
            Mẫu số 01 - TT<br>
            (Ban hành theo Thông tư số: 200/2014/TT-
            <br>BTC ngày 22/12./2014 của BTC)
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-3">
            
        </div>
        <div class="col-6" style="text-align: center;">
            <h3>PHIẾU THU</h3>
Ngày  <?=date_format(date_create($_POST["date1"]),"d")?> tháng <?=date_format(date_create($_POST["date1"]),"m")?> năm <?=date_format(date_create($_POST["date1"]),"Y")?>
        </div>
        <div class="col-3">
            Quyển số:…………..

Số:………………….
        </div>
        <div class="col-12 mt-4">
            <div class="line">
                <span>Họ và tên người nộp tiền:</span>
                <b><?=$_POST["nguoinhan"]?></b>
            </div>
            <div class="line">
                <span>Địa chỉ:</span>
                <b><?=$_POST["diachi"]?></b>
            </div>
            <div class="line">
                <span>Lý do nộp:</span>
                <b><?=$_POST["ld"]?></b>
            </div>
            <div class="line">
                <span>Số tiền:</span>
                <b><?=number_format($tien)?></b>
                <span><i>(Viết bằng chữ):</i></span>
                <b><?=ucfirst(tien_chu($tien))?></b>
            </div>
        </div>
        <div class="col-12 mt-3" style="text-align: right;">
            Ngày  <?=date_format(date_create($_POST["date1"]),"d")?> tháng <?=date_format(date_create($_POST["date1"]),"m")?> năm <?=date_format(date_create($_POST["date1"]),"Y")?>
        </div>
    </div>
    <div class="row mt-3" style="text-align: center;">
        <div class="col-3">
            <b>Giám đốc</b><br>(Ký, họ tên, đóng dấu)
        </div>
        <div class="col-3">
            <b>Kế toán trưởng</b><br>(Ký, họ tên)
        </div>
        <div class="col-3">
            <b>Người nộp tiền</b><br>(Ký, họ tên)
        </div>
        <div class="col-3">
            <b>Người lập phiếu</b><br>(Ký, họ tên)
        </div>
    </div>
    <div style="height: 80px">
        
    </div>
    <div class="row mt-5">
        <div class="col-12">
            <div class="line">
                <span>Đã nhận đủ số tiền (viết bằng chữ):</span>
            </div>
        </div>
        <div class="col-12">
            <div class="line">
               <span> (Liên gửi ra ngoài phải đóng</span>
            </div>
        </div>
    </div>
  </div>
</body>
</html>
