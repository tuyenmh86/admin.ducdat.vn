<!DOCTYPE html>
<html>
<head>
  <title>Biên Nhận-<?=$_POST["ten"]?></title>
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<style type="text/css">
*{
  margin: 0px;
  padding: 0px;
  font-family: time;
}
.f18 {
  font-size: 18px;
}
.f20{
  font-size: 20px;
}
.f22{
  font-size: 22px;
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
            <div style="text-align: center;">
                Đc: 84/6 Đường số 9,Tổ 7,P.An Phú Đông,Q.12, TP. HCM.<br>
                Hotline: 0975.191.513 - 0902.744.686<br>
            </div>
        </div>
        <div class="col-6">
            <h4 style="text-align: center;"><b>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</b></h4>
            <h6 style="text-align: center;"><b>Độc lập – Tự do – Hạnh phúc</b></h6>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12 mt-2" style="text-align: center;">
            <h3>BIÊN BẢN GIAO NHẬN</h3>
        </div>
        <div class="col-12 mt-3">
            <div class="f18"><i>- Căn cứ Đơn đặt hàng ngày <?=date_format(date_create($data["cr_date2"]), "d")?>/<?=date_format(date_create($data["cr_date2"]), "m")?>/<?=date_format(date_create($data["cr_date2"]), "Y")?> của quý khách hàng.</i></div>
            <div class="f18"><i>- Hôm nay, ngày <?=date_format(date_create($data["cr_date1"]), "d")?> tháng   <?=date_format(date_create($data["cr_date1"]), "m")?> năm <?=date_format(date_create($data["cr_date1"]), "Y")?>, chúng tôi gồm:</i></div>
            <div class="f22 mt-4">
              <ul>
                <li><b>BÊN A (Bên nhận hàng) :  <?=$data["nguoinhan"]?></b></li>
                <li>-    Địa chỉ  :  <?=$data["diachi"]?></li>
                <li>-    Điện thoại: <?=$data["sodt"]?> </li>
              </ul>
              <ul>
                <li><b>BÊN B (Bên giao hàng) :  CÔNG TY TNHH MTV SX _TM_DV ĐỨC ĐẠT</b></li>
                <li>-   Địa chỉ  :84/6 Đường số 9,Tổ 7,P.An Phú Đông,Q.12, TP. HCM</li>
                <li>-   Điện thoại: 02837199177        Fax : 02837199177</li>
              </ul>
            </div>
            <div class="f20">Hai bên cùng nhau thống nhất số lượng giao hàng  như sau:</div>
            <table class="table table-bordered f20">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col" style="text-align: center;">Tên hàng</th>
                  <th scope="col" style="text-align: center;">Ảnh</th>
                  <th scope="col">Số lượng</th>
                  <th scope="col">ĐVT</th>
                  <th scope="col">Ghi chú</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data["list_product"] as $key => $value) {              ?>
                <tr>
                  <td scope="row"><?=$key+1?></td>
                  <td style="text-align: center;"><?=$value["category"]?></td> 
                  <td style="text-align: center;"><img style="max-height: 200px" src="<?=$value["image"]["full"]?>"></td> 
                  <td><?=$value["soluong"]?></td>
                  <td>Cái</td>
                  <td></td>
                </tr>   
      
                <?php } for ($key=$key+2; $key <=3 ; $key++) { ?>
                  <tr>
                    <td scope="row"><?=$key?></td>
                    <td></td> 
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                <?php } ?>
               
              </tbody>
            </table>
            <div class="f20">
              Bên A xác nhận Bên B đã giao cho Bên A đúng chủng loại và đủ số lượng hàng như trên. Hai bên đồng ý, thống nhất ký tên. Biên bản được lập thành 02 bản, bên A giữ 1 bản, bên B giữ 1 bản có giá trị pháp lý như nhau.
            </div>
        </div>
        <div class="col-12" style="height: 30px"></div>
        <div class="col-6 f22" style="text-align: center;">
          <b>ĐẠI DIÊN BÊN A</b><br><b>(Bên nhận hàng)</b>                                                               
        </div>
        <div class="col-6 f22" style="text-align: center;">
          <b>ĐẠI DIỆN BÊN B</b><br><b>(Bên giao hàng)</b><br>
          <div class="mt-1"><img style="width: 200px" src="img/sg.png"></div>
          <b class="mt-2">Đỗ Minh Đức</b>
        </div>
      
    </div>
   
  </div>
</body>
</html>
