<?php 
 ?>
 <style type="text/css">
     .thumbnail{
        max-width: 400px !important;
     }
     .thumbnail #myImg{
        max-width: 400px !important;
        max-height: 400px !important;
     }
     tbody tr{
        border-bottom: solid 5px;
     }
 </style>
<tr>
    <?php if ( isset($stt)) { echo "<td style='max-width:10px'>".$stt. "<input type='checkbox' name='id[]' value='".$v["id"]."' ></td>".''; } ?>
    <td><b><?=$k+1?></b></td>   
    <td class="fix_inline">
        <div class="row">
            
            <div class="col-8">
                
                <div style="font-weight: bold; font-size: 16px; color: green">
                    <ul>
                        <?php if (isset($v["vip"])){ ?>
                            <li><small>Người nhận:</small> <?=$v["vip"]?> <span style="font-size: 16px; font-weight: bold; color: red;">Khách VIP, (Làm kỹ).</span></li>
                            
                        <?php }else{ ?>
                            <li><small>Người nhận:</small> <?=$v["nguoinhan"]?></li>
                        <?php } ?>
                        
                        <li><small>ĐC Giao Hàng: </small> <?=$v["diachi_view"];?></li>
                    </ul>                        
                </div>
            </div>
            <div class="col-4">
                Phụ trách : <img style="max-width: 50px;" class="rounded-circle" src="<?=$v["img"]?>"> <b><?=$v["name"]?></b>
            </div>
        </div>     
        
        <hr>
        <?php if (isset($v["list_product"])) {foreach ($v["list_product"] as $k1 => $v1):?>
            <div class="thumbnail">
                <div class="img">
                    <span class="rip rtop"><?=$v1["chatlieu"]?></span>
                    <img id="myImg" src="<?=$v1["image"]["full"]?>">                    
                    <div id="Modal" class="modal">
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
                <div>Số lượng: <span><?=$v1["soluong"]?></span></span>
                    <br> Kích thước: <span><?=$v1["kichthuoc"]?></span>
                    <br>
                    <b style="color: blue; font-size: 24px"><?=$v1[ "ghichu"]?></b>
                </div>
            </div>
        <?php endforeach; } ?>

        <?php if (isset($v["list_mt"])) {foreach ($v["list_mt"] as $k1 => $v1):?>
            <div class="thumbnail">
                <div class="img">
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
                    <b style="color: blue; font-size: 24px"><?=$v1[ "ghichu"]?></b>
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
                    <b style="color: blue; font-size: 24px"><?=$v1[ "ghichu"]?></b>
                </div>
            </div>
        <?php endforeach; } ?>
        
        <hr>
        <div style="font-weight: bold; font-size: 24px; color: blue">
            <?=$v[ "ghichu"];?>
        </div>
    </td>
</tr>

