  <?php
  $tmp="";
    if(isset($v["idkh"])&& filter_var($v["idkh"], FILTER_VALIDATE_INT, array('min_range' => 1))){
                                            $v["nguoinhan"]=$v["tenkh"];
                                            $v["sodt"]=$v["sodtkh"];
                                            $v["diachi"]=$v["diachikh"];
                                            $v["vat"]=$v["vatkh"];
                                            $tmp='<img  src="img/Crown.png">';
                                        }
  if (isset($v["type"]) and !$v["type"]=="") {
    $v["type"]="(".$v["type"].")";
  }
?>
  <tr>    
            <?php
                  if (  isset($stt)) {
                    echo "<td style='max-width:10px'>".$stt."</td>";
                  }
            ?>
          <td>
              <ul class="info">
                  <li><i class="far fa-calendar-alt"></i> <?=thedate($v["date1"],1)?> <span style="font-weight: 300" class="badge badge-<?=$v["tinhtrang1"]=="Đã giao"?"success":"danger"?>"></span> <b><?=$v["type"]?></b> <?=$v["shiper"]?></li>
                  <li><i class="fas fa-file"></i> <span><a href="<?=BASE_URL."edit.php?id=".$v["id"]?>"><?=$v["ten"];?></a></span></li>
                  <li><i class="far fa-user-circle"></i> <?=$v["name"]?>  <?=date_format(date_create($v["date2"]),"h:i d/m");?></li>
                  <hr>
                  <li><span><i class="far fa-user"></i> </span><?=$v["nguoinhan"]." ".$v["sodt"];?> <?=$tmp?> </li>
                  <li ><div style="max-width: 300px; word-wrap: break-word;"><span><i class="fas fa-map-marker"></i> </span> Đc: <?=$v["diachi"]?></li>
                  <li><span>Y/c:</span>
                        <?php
                            $temp=explode(",", $v["yeucau"]); 
                            foreach ($temp as $key => $value) {
                                if ($value=="VAT") {
                                  $vat=$value;
                                }
                                echo '<label class="badge badge-info">'.$value.'</label>&nbsp;&nbsp;';
                            }
                        ?>
                  </li>
                  <li><span> T/t:</span>
                    <?php
                            switch ($v["ttthanhtoan"]) {
                              case 'Đã Thanh Toán':
                                 $cl="badge-success";
                                break;
                              case 'Đã Đặt Cọc':
                                $cl="badge-warning";
                                break;
                              
                              default:
                               $cl="badge-danger";
                                break;
                            }
                            echo '<span class="badge badge-info">'.$v["ptthanhtoan"].'</span>&nbsp;&nbsp;';
                            echo '<span class="badge '.$cl.'">'.$v["ttthanhtoan"].'</span>&nbsp;&nbsp;';
                        if (strlen(trim($v["vat"]))>15 && isset($vat) ) { $class=getclassid(); ?>

                         <button type="button" class="badge badge-info" data-toggle="modal" data-target="#<?=$class?>">TT Xuất Hóa Đơn</button>

                          <!-- Modal -->
                          <div class="modal fade" id="<?=$class?>" role="dialog">
                            <div class="modal-dialog">
                            
                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Thông tin xuất hóa đơn</h4>
                                  <div><b color="red"><?=$v["ten"]?></b></div>
                                </div>
                                <div class="modal-body">
                                  <p><?=preg_replace("/[\n\r]/","<br>",$v["vat"])?></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        <?php                                                           
                            }
                        ?> 
                  </li>
                  <li><input name="data[]"  type="checkbox" value="<?=$v['id'];?>"> <a href="in/infull.php?id=<?=$v['id'];?>"><i class="fas fa-print"></i> Giấy Hàng</a></li>
              </ul>
          </td>
      <td>
        <?php
        $qc1="select * from images where idsp={$v['id']}";
        $rc1=confirm_query($qc1);
        $sl=mysqli_num_rows($rc1);
        if($sl > 0){
        while ($kq1 = mysqli_fetch_array($rc1,MYSQLI_ASSOC)) {
        ?>
          <div class="thumbnail" >
          <img id="myImg" src="images/<?=$kq1["image"]?>">
           <div id="myModal" class="modal">
            <span class="close">&times;</span>
            <img class="modal-content" src="images/<?=$kq1["image"]?>" id="">
            <div id="caption"></div>
          </div>
          <span class="rip"><?=$kq1["chatlieu"]?></span>
          <div>Sl:<span><?=$kq1["soluong"]?></span> ĐG:<span><?=number_format($kq1["dongia"]);?></span> <br> KT:<span><?=$kq1["kichthuoc"]?></span> <br> <?=$kq1["ghichu"]?></div>
            <!-- The Modal -->
          </div>
        <?php                                           
        }}else echo "Chưa có hình ảnh cho sản phẩm này!"; 

        if (isset($v["soluong"]) and $v["soluong"]>0) {
          echo "<br>";
            echo "SL:<b 'class red'>".$v["soluong"]."</b>";
          }
        if (isset($v["dongia"]) and $v["dongia"]>0) {
          echo "<br>";
            echo "Đơn Giá:<b 'class red'>".$v["dongia"]."</b>";
          }
        if (isset($v["tongtien"]) and $v["tongtien"]>0) {
          echo "<br>";
            echo "Tổng tiền:<b 'class red'>".$v["tongtien"]."</b>";
          }        

        ?>

      </td>
      <td>
           <?=$v["ghichu"];?>
      </td>
      </tr>