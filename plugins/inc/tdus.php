 
  <tr>
          <td>
              <ul class="info">
                 <li><i class="far fa-calendar-alt"></i> <?=thedate($v["date1"],1)?> <span style="font-weight: 300" class="badge badge-<?=$v["tinhtrang1"]=="Đã giao"?"success":"danger"?>"></span> <b><?=$v["type"]?></b></li>
                  <li><span>File:</span><?=$v["ten"];?></li>
                  <li><span>By</span> <?=$v["name"]?>  <?=date_format(date_create($v["date2"]),"h:i d/m/");?></li>
                  <li><span>Y/c:</span>
                        <?php
                            $temp=explode(",", $v["yeucau"]); 
                            foreach ($temp as $key => $value) {
                                echo '<label class="badge badge-info">'.$value.'</label>&nbsp;&nbsp;';
                            }
                        ?>          

                  </li>
                  
              </ul>
          </td>
      <td>
          
                <?php

        $q1="select * from images where idsp={$v['id']}";
        $r1=confirm_query($q1);
        $sl=mysqli_num_rows($r1);
        if($sl > 0){
        while ($kq1 = mysqli_fetch_array($r1,MYSQLI_ASSOC)) {
        ?>
          <div class="thumbnail" >
          <img src="images/<?=$kq1["image"]?>" data-toggle="modal" data-target="#<?=md5($kq1["image"])?>">
          <span class="rip"><?=$kq1["chatlieu"]?></span>
          <div>Sl:<span><?=$kq1["soluong"]?></span> <br> KT:<b><?=$kq1["kichthuoc"]?></b> <br> <?=$kq1["ghichu"]?></div>
            <!-- The Modal -->
          </div>
          <!-- Modal -->
          <div id="<?=md5($kq1["image"])?>" class="modal fade" role="dialog">
            <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content">
                <img src="images/<?=$kq1["image"]?>" >
              </div>

            </div>
          </div>
        <?php                                           
        }}else echo "Chưa có hình ảnh cho sản phẩm này!<br> Vui lòng liên hệ <b>".$v["name"]."</b>";
        
        ?>
      </td>
      <td>
           <?=$v["ghichu"];?>
      </td>
      </tr>
