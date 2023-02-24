<?php
    include "../function.php";
   
    if (isset($_POST["id"])&& filter_var($_POST["id"], FILTER_VALIDATE_INT, array('min_range' => 1))) {
        	$id=post("id");
        	$q1="select * from file inner join user  on file.iduser= user.iduser left join khachhang on file.idkh=khachhang.idkh where file.id=$id";
            $r1=confirm_query($q1);
            $sl=mysqli_num_rows($r1);
            $kq1 = mysqli_fetch_array($r1,MYSQLI_ASSOC);
            $date1=post("date1");
            $nguoinhan=$kq1["nguoinhan"];
            $ten=$kq1["ten"];
            $soluong=$kq1["soluong"];
            $sodt=$kq1["sodt"];
            $diachi=$kq1["diachi"];
            $dongia=$kq1["dongia"];
            $iduser=$admin["iduser"];
            $idkh=$kq1["idkh"];
            
            if ($_POST["submit"]=="addnew") {
                $type="Làm mới";
                $parent="";
            }else{
              $type="Làm thêm";
              $parent=$id;  
            } 
            $capcha=md5(rand(1,1000000));
            $q = "INSERT INTO file (date1,nguoinhan,ten,sodt,diachi,iduser,idkh,capcha,date2,parent,ttthanhtoan,type) 
            VALUES ('$date1', '$nguoinhan', '$ten', '$sodt','$diachi','$iduser', '$idkh', '$capcha','$now','$parent','Chưa Thanh Toán','$type')";
            confirm_query($q);
            			$q2="select id from file where ten='$ten' and nguoinhan='$nguoinhan' and sodt='$sodt' and capcha='$capcha' ";
            			$r2=confirm_query($q2);
            			$kq2 = mysqli_fetch_array($r2,MYSQLI_ASSOC);
            			$idsp=$kq2["id"];
            			if ($idsp) {
            				$qc1="select * from images where idsp={$id}";
            		        $rc1=confirm_query($qc1);
            		        $sl=mysqli_num_rows($rc1);
            		        if($sl > 0){
            		        while ($kq = mysqli_fetch_array($rc1,MYSQLI_ASSOC)) {
            		        	$image=$kq["image"];
            		        	$image_text=$kq["image_text"];
            		        	$ghichu=$kq["ghichu"];
            		        	$chatlieu=$kq["chatlieu"];
            		        	$idsp=$idsp;
            		        	$soluong=$kq["soluong"];
            		        	$dongia=$kq["dongia"];
                                $kichthuoc=$kq["kichthuoc"];
                                $category=$kq["category"];
            		        	$q = "INSERT INTO images (image,image_text,ghichu,chatlieu,idsp,soluong,dongia,kichthuoc,category) 
                                VALUES ('$image', '$image_text', '$ghichu', '$chatlieu', '$idsp', '$soluong','$dongia','$kichthuoc','$category')";
                                if ($_POST["submit"]=="addmr") {
                                   confirm_query($q);
                                }
                        }

		    }
		      $tb="Làm Thêm: ".'<b>'.$ten.'</b>';
              thongbao($tb,"green");
              $url="edit.php?tb=addmoreok&id=".$idsp;
              redirect_to($url);   	
			}
        	
    }
    redirect_to();
?>