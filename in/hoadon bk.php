<!DOCTYPE html>
<html>
<head>
  <title>HD-<?=$_POST["ten"]?></title>
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
      <span>Khách hàng:</span><b><?=$nguoinhan?></b>
    </div>
    <div class="line">
      <span>Số ĐT:</span><b><?=$sodt?></b>
    </div>
    <div class="line">
      <span>Địa Chỉ:</span><b><?=$diachi?></b>
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
     $category=$_POST["editcategory"];
     $soluong=$_POST["editsoluong"];
     $dongia=$_POST["editdongia"];
      $sum=0;
      $i=0;
      foreach ($category as $key => $value) {
      $thanhtien=$dongia[$key]*$soluong[$key];
      $sum=$sum+$thanhtien;
      $i++;        
              ?>
    <tr>
      <td><?=$i?></td>
      <td><?=$value?></td> 
      <td><?=$soluong[$key];?></td>
      <td><?=number_format($dongia[$key])?></td>
      <td><?=number_format($thanhtien)?></td>
    </tr>   
      
     <?php
      }
   
      for ($i=$i+1; $i <=6 ; $i++) { 
       ?>
          <tr>
            <td><?=$i?></td>
            <td></td> 
            <td></td>
            <td></td>
            <td></td>
          </tr>
    <?php
      }
    ?>
     <tr>
      <td style="text-align: center;" colspan="2">Tổng cộng</td>
      <td></td>
      <td></td>
      <td><?=number_format($sum)?></td>
    </tr>
  </table>
  <div class="line">
    <span>Thành tiền (viết bằng chữ):</span>
        <b>
          <i>
            <?php            
              if (($sum%1000)==0) {
                $dv=" đồng chẵn";
              }else $dv=" đồng";
              $tmp=tien_chu($sum).$dv;
              echo str_replace("mươi Một", "mươi Mốt", $tmp) ;
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
      <p><i>Ngày <?=date_format(date_create($date1),"d")?> tháng <?=date_format(date_create($date1),"m")?> năm <?=date_format(date_create($date1),"Y")?></i></p>
      <br>
      <p>NGƯỜI BÁN HÀNG</p>
    </div>
  </div>
 </div>
</body>
<script>
//function myFunction() {
 //window.print();
//}
</script>
</html>