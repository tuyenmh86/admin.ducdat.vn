<!DOCTYPE html>
<html>
<head>
  <title>HD-<?=$_POST["ten"];?></title>
</head>
<style type="text/css">
*{
  margin: 0px;
  padding: 0px;
}
ul li{
  list-style: none;
}
  .wapper{
    width: 500px;
  }
  .lh{
    font-size: 12px;
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
    padding: 4px;
  }
  .line b{
  }
 table {
  margin: 10px 0px 13px 0px;
  border-collapse: collapse;
  line-height: 23px;
}
td{
  padding-left: 2px;
}

table, td, th {
  border: 1px solid black;
}
</style>
<body>
 <div contenteditable="true" class="wapper">
    <h3 style="text-align: center;
    margin: 10px 0px 10px 0px;">CÔNG TY TNHH MTV SẢN XUẤT TMDV ĐỨC ĐẠT</h3>
    <div class="lh">
      <div style="width: 350px; float: left;">
        <ul>
          <li>Đc: :84/6 Đường số 9,Tổ 7,P.An Phú Đông,Q.12, TP. HCM.</li>
          <li>Hotline: 0975.191.513 - 0902.744.686</li>
          <li>Chuyên: Kỷ Niệm Chương, Cúp Pha lê, Cúp Thể Thao</li>
        </ul>
      </div>

      <div style="width: 150px;">
        <div>Quyển số:.................</div>
        <br>
        <div style="text-decoration-line: underline;">Số:<?=$_POST["id"];?></div>
        
      </div>

      
    </div>
       <div style="clear: both;"></div>
    <h3 style="text-align: center;
    margin: 10px 0px 10px 0px;">HÓA ĐƠN BÁN HÀNG</h3>
    <div class="line">
      <span>Khách hàng:</span><b><?=$data["nguoinhan"]?></b>
    </div>
    <div class="line">
      <span>Số ĐT:</span><b><?=$data["sodt"]?></b>
    </div>
    <div class="line">
      <span>Địa Chỉ:</span><b><?=$data["diachi"]?></b>
    </div>

    <table style="width:100%">

    <tr>
      <th>TT</th>
      <th>Tên hàng</th> 
      <th>Số lượng</th>
      <th>Đơn giá</th>
      <th>Thành tiền</th>
    </tr>
     <?php
      foreach ($data["list"] as $key => $value) {
              ?>
    <tr>
      <td><?=$key?></td>
      <td><?=$value["category"]?></td> 
      <td><?=$value["soluong"]?></td>
      <td><?=number_format($value["dongia"])?></td>
      <td><?=number_format($value["sum"])?></td>
    </tr>   
      
    <?php
      }
   
      for ($key=$key+1; $key <=4 ; $key++) { 
       ?>
          <tr>
            <td><?=$key?></td>
            <td></td> 
            <td></td>
            <td></td>
            <td></td>
          </tr>
    <?php
      }
    ?>
     <tr>
      <td style="text-align: center;" colspan="4">Tổng <small>(1)</small></td>
      <td><?=number_format($data["sums"])?></td>
    </tr>    
    <tr>
      <td style="text-align: center;" colspan="4">VAT <small>(2)</small></td>
      <td><?=number_format($data["vat"])?></td>
    </tr>
    <tr>
      <td style="text-align: center;" colspan="4">Cọc trước <small>(3)</small></td>
      <td><?=number_format($_POST["datcoc"]) ?></td>
    </tr>
    <tr>
      <td style="text-align: center;" colspan="4">Tổng thanh toán <small>(1+2-3)</small></td>
      <td><?=number_format($data["total"])?></td>
    </tr>
  </table>
  <div>
    <span>Thành tiền (viết bằng chữ):</span>
        <b>
          <i>
            <?php            
              if (($data["total"]%1000)==0) {
                $dv=" đồng chẵn";
              }else $dv=" đồng";
              $tmp=tien_chu($data["total"]).$dv;
              echo str_replace("mươi Một", "mươi Mốt", $tmp).".";
              ?>
          </i>
        </b>
  </div>
  <div style="margin-top:15px">
    <div style="width: 250px;float: left; text-align: center;">
      <p></p>
      <br>
      <br>
      KHÁCH HÀNG
    </div>
     <div style="width: 250px;float: right; text-align: center;">
      <p><i>Ngày <?=date_format(date_create($data["date1"]),"d")?> tháng <?=date_format(date_create($data["date1"]),"m")?> năm <?=date_format(date_create($data["date1"]),"Y")?></i></p>
      <br>
      <p>NGƯỜI BÁN HÀNG</p>
    </div>
  </div>
 </div>
<!--  <div>
   Cổng thanh toán <br>
  Chủ Tài Khoản Đỗ Minh Đạt <br>
  + Vietinbank 102.888.79.8686 <br>
  Vietinbank CN 9 Tp HCM <br>
  + ACB 159662899 <br>
  Chi nhánh văn lang, Gò Vấp, HCM <br>
  + Sacombank 060066862022 <br>
  Chi nhánh an nhơn, Gò Vấp, HCM <br>
  + Vietcombank 0911000007157 <br>
  Vietcombank Chi nhánh, Gò Vấp, HCM <br>
 </div> -->
</body>
<script>
//function myFunction() {
 //window.print();
//}
</script>
</html>