<?php
       
        include "function.php";
        if ($admin["cap"]>=3) {
            redirect_to();
        }      
        if(isset($_GET["id"])&& filter_var($_GET['id'], FILTER_VALIDATE_INT, array('min_range' => 1))){
                    $id=$_GET["id"];
                    if (author($id) or $admin["cap"]==0) {
                        $tb="Xóa đơn hàng: ".'<b>'.getvalue("ten","file",$id).'</b>';                        
                        $q = " select * from file right join images on file.id=images.idsp where file.id='".$id."'";
                        $r=confirm_query($q);
                        $sl=mysqli_num_rows($r);
                        if($sl > 0){                       
                            $q = "DELETE file,images  FROM file inner join images ON   file.id = images.idsp  WHERE file.id = $id";
                        }else $q = "DELETE FROM file WHERE id = $id";
                        $r=confirm_query($q);
                        if ($r) {                           
                        thongbao($tb,"red");
                        $url="index.php?tb=deleteok";
                        redirect_to($url);
                        }
                        
                    }
        }

        if(isset($_GET["idimg"])&& filter_var($_GET['idimg'], FILTER_VALIDATE_INT, array('min_range' => 1))){
            $id=$_GET["idimg"];
            $q="SELECT * FROM `images` where id=$id";
            $r=confirm_query($q);
            $kq1 = mysqli_fetch_array($r,MYSQLI_ASSOC); 
            if(mysqli_num_rows($r)> 0){
                $file="images/".$kq1["image"];unlink($file);
                $thum1="images/thumb/100/".$kq1["image"];unlink($thum1);
                $thumb2="images/thumb/200/".$kq1["image"];unlink($thumb2);
                
                $q = "DELETE FROM images WHERE id = {$id} LIMIT 1";
                $r=confirm_query($q);
            }
             
         }


         if(isset($_GET["idkh"])&& filter_var($_GET['idkh'], FILTER_VALIDATE_INT, array('min_range' => 1))){
            $id=$_GET["idkh"];
            $q="SELECT * FROM khachhang where idkh=$id";
            $r=confirm_query($q);
            $kq1 = mysqli_fetch_array($r,MYSQLI_ASSOC); 
            if(mysqli_num_rows($r)> 0){
                $q = "DELETE FROM khachhang WHERE idkh = {$id} LIMIT 1";
                $r=confirm_query($q);
            }
              redirect_to("addkh.php");
         }


        
      redirect_to();
?>