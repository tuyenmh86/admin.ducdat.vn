<div id="<?=$v["id"]?>" class="dh">
    <div class="stt"><b><?=$k+1?></b></div>
    <div class="info">
        <ul>
            <li>
                <div style="display: flex;justify-content: space-between;">
                    <ul>
                        <li><i class="far fa-calendar-alt"></i><?=thedate($v[ "cr_date1"],1)?>  <b><?=$v["type"]?> </b></li>
                    </ul>
                    <?=$v["hop"]?>
                </div>                                
            </li>
            <li><i class="fas fa-file"></i> <b><?=$v["tenlink"]?></b></li>
            <li style="border-bottom: dashed 1px #ccc; padding: 3px;">
                <img style="width: 25px; height: auto; border-radius: 50%;" src="<?=$v["img"]?>">
                <?=$v["name"]?>
                <small><?=$v["date2"];?></small>  
            </li>

            <li>
                <?=isset($v["vip"])?$v["vip"]."<br>":""?>
                <i class="far fa-user"></i>
                <?=$v["nguoinhan"];?> <b><?=$v[ "sodt"]?></b> 
            </li>
            <?php if (isset($v["mail"]) and strlen($v["mail"])>=5) {
                echo '<li><i class="far fa-envelope"></i> '.$v["mail"].'</li>';
            } ?>
            <li>
                <div style="word-wrap: break-word;"><i class="fas fa-map-marker"></i> <b><?=$v[ "diachi"]?></b></div>
            </li>
            <?php if (!isset($admin["block"]["adr"])) {?>
            <li><span>Y/c:</span>
                <?php 
                    foreach ($v["yeucau"] as $key=> $value) { 
                    if ($value=="VAT") { $vat=$value; } 
                    echo '<label class="badge badge-info">'.$value.'</label>&nbsp;&nbsp;'; 
                    }
                 ?>
            </li>
            <li style="border-bottom: dashed 1px #ccc; padding-bottom: 5px"><span> T/t:</span>
                <?php  echo $v["ttthanhtoanviews"]; 
                
                if (strlen(trim($v[ "vat"]))>15 && isset($vat) ) { $class=getclassid(); ?>

                <button style="cursor: pointer; border: none;" type="button" class="badge badge-info" data-toggle="modal" data-target="#<?=$class?>">TT Xuất Hóa Đơn</button>

                <!-- Modal -->
                <div class="modal fade" id="<?=$class?>" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Thông tin xuất hóa đơn</h4>
                                <div><b color="red"><?=$v["ten"]?></b>
                                </div>
                            </div>
                            <div class="modal-body">
                                <p style="font-size: 28px;">
                                    <?=preg_replace( "/[\n\r]/", "<br>",$v[ "vat"])?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <br>
            </li>
            
            <li class="shipper">Shiper: 
                <?php foreach ($shipper as $skey => $svalue):
                    if ($svalue==trim($v["shiper"])) {
                        $check="checked";
                    }else $check="";
                 ?>                    
                    <input <?=$check?> type="checkbox" id="<?=$v["id"]?>" value="<?=$svalue?>">
                    <label><?=$svalue?></label>
                <?php endforeach ?>
            </li>
             <li >
                <a href="in/infull.php?id=<?=$v['id'];?>"><i class="fas fa-print"></i> Giấy Hàng</a>                
            </li>
            <?php }?>
        </ul>
    </div>
    <div class="detail">
        <div class="af" style="display: flex;">
            <?php if (isset($v["list_product"])) {foreach ($v["list_product"] as $k1 => $v1):?>
                <div class="thumbnail">
                    <div class="img">
                        <span class="rip rtop"><?=$v1["chatlieu"]?></span>
                        <span class="rip rbottom"><?=$v1["category"]?></span>
                        <img id="myImg" src="<?=$v1["image"]["full"]?>">                    
                        <div id="Modal">
                            <span class="close">&times;</span>
                            <div class="nct">
                                Số lượng: <span style="font-size: 24px"><?=$v1["soluong"]?></span><br>
                                Chất liệu: <span style="font-size: 24px"><?=$v1["chatlieu"]?></span><br>
                                <?php if (strlen($v1["ghichu"])>2): ?>
                                    Chi chú: <span style="font-size: 18px"><?=$v1["ghichu"]?></span>
                                <?php endif ?>                            
                            </div>                                        
                            <img class="modal-content" src="<?=$v1["image"]["full"]?>" id="">                        
                        </div>
                    </div>                    
                    <div>Sl:<span><?=$v1["soluong"]?></span> <?=$v1["dongiatext"]?> 
                        <br> KT:<span><?=$v1["kichthuoc"]?></span>
                        <br>
                        <b style="color: blue"><?=$v1["ghichu"]?></b>
                    </div>
                </div>
            <?php endforeach; } ?>

            <?php if (isset($v["list_mt"])) {foreach ($v["list_mt"] as $k1 => $v1):?>
                <div class="thumbnail">
                    <div class="img">
                        <span class="rip rbottom"><?=$v1["category"]?></span>
                        <img id="myImg" src="<?=$v1["image"]["full"]?>">                    
                        <div id="Modal" class="modal">
                            <span class="close">&times;</span>
                            <div class="nct">
                                Loại: <span style="font-size: 24px"><?=$v1["category"]?></span><br>
                                <?php if (strlen($v1["ghichu"])>2): ?>
                                    Chi chú: <span style="font-size: 18px"><?=$v1["ghichu"]?></span>
                                <?php endif ?>                            
                            </div>   
                            <img class="modal-content" src="<?=$v1["image"]["full"]?>" id="">
                            <div id="caption"></div>
                        </div>
                    </div>
                    <div>
                        <b style="color: blue"><?=$v1["ghichu"]?></b>
                    </div>
                </div>
            <?php endforeach; } ?>

            <?php if (isset($v["list_yc"])) {foreach ($v["list_yc"] as $k1 => $v1):?>
                <div class="thumbnail">
                    <div class="img">
                        <span class="rip rtop"><?=$v1["category"]?></span>
                        <img id="myImg" src="<?=$v1["image"]?>">                    
                        <div id="Modal" class="modal">
                            <span class="close">&times;</span>
                            <div class="nct">
                                Loại: <span style="font-size: 24px">Yêu cầu</span><br>
                            </div>   
                            <img class="modal-content" src="<?=$v1["image"]?>" id="">
                            <div id="caption"></div>
                        </div>
                    </div>
                     <div>
                        <b style="color: blue"><?=$v1["ghichu"]?></b>
                    </div>
                </div>
            <?php endforeach; } ?>
        </div>
         <div ><?=$v["tongthanhtoan_text"]?></div>
    </div>
    <div class="note">     
        <div class="txt">
            <?=$v["ghichu"];?>
            <php echo ?>
        </div>
    </div>
</div>