  <?php
    if(isset($v["idkh"])&& filter_var($v["idkh"], FILTER_VALIDATE_INT, array('min_range' => 1))){
                                            $v["nguoinhan"]=$v["tenkh"];
                                            $v["sodt"]=$v["sodtkh"];
                                            $v["diachi"]=$v["diachikh"];
                                            $v["vat"]=$v["vatkh"];
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

                  <li><i class="far fa-calendar-alt"></i> Ngày giao: <?=thedate($v["date1"],1)." ".$v["type"]?></li>
                  <li><i class="fas fa-file"></i> <span> <?=$v["ten"];?> </span></li>
                  <li> <i class="far fa-user-circle"></i> Phụ trách: <?=$v["name"]?></li>
                  <br>                  
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
          <div>Sl:<span><?=$kq1["soluong"]?></span> <br> KT:<b><?=$kq1["kichthuoc"]?></b> </br> <?=$kq1["ghichu"]?></div>
            <!-- The Modal -->
          </div>
        <?php                                           
        }}else echo "Chưa có hình ảnh cho sản phẩm này!<br> Vui lòng liên hệ <b>".$v["name"]."</b>";
        ?>
      </td>
      <td>
           <?=$v["ghichu"];?>
      </td>
      </tr>
