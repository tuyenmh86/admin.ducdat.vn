<?php
    include "debug.php";    
    ob_start();
    session_start();
    date_default_timezone_set("Asia/Bangkok");
    $now=date("Y-m-d h:i:s");
    $vatvalues=0.1;
    $tinhtrang1=array("Chờ Duyệt","Chờ nội dung","Cắt phôi","Đang sản xuất","Đã giao","Hủy kèo");
    $ptthanhtoan=array("Chưa rõ","CK Cá Nhân","Tiền Mặt","CK Công Ty","Bưu Điện Thu Hộ");
    $ttthanhtoan=array("Chưa Thanh Toán","Đã Thanh Toán");
    $yeucau = array("VAT","Hợp Đồng","Hóa đơn bán lẻ","Hộp đẹp","Phiếu Thu","Ẩn giá","Free Ship");
    $datachatlieu=array("Thủy tinh","K7","Pha Lê","Khác");
    $datacategory=array("Kỷ niệm chương","Kỷ niệm chương gỗ đồng","Cúp pha lê","Cúp golf","Cúp nghệ thuật","Cúp tennis","Cúp bóng đá","Cúp kim loại","Huy Chương","Ship","Khác","Ảnh mẫu","Miêu tả màu","Bill Thanh Toán");
    $datatype = array('','Làm mẫu','Làm mới','Làm thêm','Hỗn Hợp','Sửa lỗi','Sửa lỗi (tính phí)','Khác' );
    $vipmember='(Vip Member <img  src="img/Crown.png">)';
    $shipper=array("Bin","Chú Linh","Chú Ngọ","Grap","CPN","Bưu Điện","Khác");
    $block=array("us"=>"Không có quyền Chỉnh sửa user","adr"=>"Không hiển thị địa chỉ, chỉnh sửa đơn hàng", "bc"=>"Không hiển thị báo cáo doanh thu","ag"=>"Ẩn giá sản phẩm");
    $phoitype=array("P"=>"Phôi", "L"=> "Logo", "H"=> "Hoa Văn", "IMG"=>"Ảnh");
    $strblock="*_* *_^ *.* ^_^ !";
    $ip=file_get_contents('ip.txt', true);
    ini_set('mssql.charset', 'UTF-8');

    include "dbcon.php";
     function confirm_query($query) {
        global $dbc;
        $r = mysqli_query($dbc,$query);
        if(!$r) {
            die("Query {$query} \n<br/> MySQL Error: " .mysqli_error($dbc));
    }else{
        return $r; 
        }
    }
    
     if (!isset($_COOKIE["ad"]) and !isset($loginpage)) {
         redirect_to("login.php");
         exit();
    }elseif (!isset($loginpage)) {
        $us=$_COOKIE["ad"];
        $q1="SELECT * FROM user where iduser={$us}";
        $r1=confirm_query($q1);
        $sl=mysqli_num_rows($r1);

        if ($sl>0) {
            $admin=mysqli_fetch_array($r1,MYSQLI_ASSOC);
            $iduser=$admin["iduser"];
            $admin["block"]=json_decode($admin["block"],true);
        }else {
            redirect_to("login.php");
        }

        /*if ($_SERVER['REMOTE_ADDR']!==$ip and $admin["cap"]>=2) {
            echo "<h1>Bạn hiện đang bị hạn chế truy cập.!</h1> <a href='login.php'>Đăng nhập</a>";
            exit();
        }*/
    }
$classid=0;

if (isset($_GET['action']) && $_GET['action'] == 'backupDatabase') {
    backupDatabase(); // gọi hàm myFunction


  }

function getclassid(){
    global $classid;
    $classid++;
    return md5($classid);
}

function post($bien){
    if (isset($_POST[$bien])) {
        if (is_array($_POST[$bien])) {

            return $_POST[$bien];
        }else return trim(str_replace("'", "&#39", $_POST[$bien]));
        
    }else {
        return "";
    }
}
function hidec($str){
    $str=preg_replace("/[0-9]+/", "*", $str);
    $dc_array=explode(" ",$str);
    $rs="";    
    if (count($dc_array)>=5) {
        $a=round(count($dc_array)*0.1);
        $b=round(count($dc_array)*0.6);
        $kq1["diachi_view"]="";
        foreach ($dc_array as $key => $value) {
            if ($key>=$a and $key<=$b) {
               $value=preg_replace("/[a-z A-Z]+/", "*", $value);
            }        
            $rs=$rs." ".$value;
        }
    }else{
        $rs=$str;
    }
    return $rs;
}

function get_vip($idkh=0){
    if (is_numeric($idkh)) {
       $q1="select * from khachhang where idkh=".$idkh;
    }else $q1="select * from khachhang where idkh=0";
    if ($idkh=="all") {
            $q1="select * from khachhang";
        }    
    $r1=confirm_query($q1);
    $sl=mysqli_num_rows($r1);    
    if($sl > 0){
    $data=array();
    while ($kq1 = mysqli_fetch_array($r1,MYSQLI_ASSOC)) {
        if (strlen($kq1["avatar"])<4) {
           $kq1["avatar"]="img/vip.svg";
        }
        $data[]=$kq1;
    }}
    if (isset($data)) {
        return $data;
    }
}

function get_file($where="",$resutl=""){
    global $vatvalues;
    global $admin;
    global $strblock;
    $data=array();
    $where_text="where";
    if (is_array($where)) {
        $i=1;
        foreach ($where as $key => $value) {
            if ($i==1) {
                $where_text=$where_text.' '.$key.' = '.$value;
                $i++;
            }else{
                $where_text=$where_text.' and '.$key.' = '.$value;
            }
            
        }
    }else $where_text=$where;
  
    $data_month=array();
    $data_tt=array();
    $tongfile=array();

    $q1="select * FROM file inner join user on file.iduser=user.iduser left Join khachhang ON file.idkh = khachhang.idkh ".$where_text." ORDER BY file.date1 desc";
    // select * FROM file inner join user on file.iduser=user.iduser left Join khachhang ON file.idkh = khachhang.idkh where year(date1) = 2023 ORDER BY file.date1 desc

    $r1=confirm_query($q1);
    $sl=mysqli_num_rows($r1);

    while ($kq1 = mysqli_fetch_array($r1,MYSQLI_ASSOC)) {
        $kq1["list"]=array();
        $kq1["sum"]=0;

        $kq1["cr_date1"]=$kq1["date1"];
        $kq1["cr_date2"]=$kq1["date2"];

        $kq1["month"]=date_format(date_create($kq1["date1"]), "m");
        $kq1["date1"]=date_format(date_create($kq1["date1"]), "d/m/y");
        $kq1["date2"]=date_format(date_create($kq1["date2"]), "h:i a - d/m/y");        

        $kq1["his"]=json_decode($kq1["his"],true);
        $kq1["his_html"]="<li>0. Khởi tạo ".$kq1["date2"]."</li>";


        if (strlen($kq1["ten"])<1) {
            $kq1["tenlink"]='<a target="_blank" href="'.BASE_URL.'edit.php?id='.$kq1["id"].'">File name is not valid !!!!</a>';
        }else  $kq1["tenlink"]='<a target="_blank" href="'.BASE_URL.'edit.php?id='.$kq1["id"].'">'.$kq1["ten"].'</a>';

        
        switch ($kq1["ttthanhtoan"]) { 
            case 'Đã Thanh Toán': 
            $kq1["ttthanhtoanview"]= '<span class="badge badge-success"><i class="fas fa-dollar-sign"></i> Đã Thanh Toán </span>'; 
            $kq1["ttthanhtoanviews"]= $kq1["ttthanhtoanview"].' <br> Phương Thức <b>'.$kq1["ptthanhtoan"]."</b>"; 
            break; 
            default:
                if ($kq1["datcoc"]>0) {
                    $kq1["ttthanhtoanview"]= '<span class="badge badge-warning"><i class="fas fa-dollar-sign"></i> Đã Đặt Cọc </span>';
                    $kq1["ttthanhtoanviews"]= $kq1["ttthanhtoanview"]." <br> Đã đặt cọc: <b>". number_format($kq1["datcoc"])."</b>";
                }else{
                    $kq1["ttthanhtoanview"]= '<span class="badge badge-danger"><i class="fas fa-dollar-sign"></i> Chưa Thanh Toán </span>';  
                    $kq1["ttthanhtoanviews"]= $kq1["ttthanhtoanview"];  
                } 
            break; 
        break; }


        $dc_array=explode(" ",$kq1["diachi"]);
        if (count($dc_array)>=5) {
            $a=round(count($dc_array)*0.2);
            $b=round(count($dc_array)*0.6);
            $kq1["diachi_view"]="";
            foreach ($dc_array as $key => $value) {
                if ($key>=$a and $key<=$b) {
                   $value="*";
                }
                if ((isset($dc_array[$key-1])) ) {
                    if (preg_replace("/[^a-zA-Z0-9]+/", "", strtolower(trim($dc_array[$key-1])))=="quan" or preg_replace("/[^a-zA-Z0-9]+/", "", strtolower(trim($dc_array[$key-1])))=="qun") {
                        $value=$value;
                    }else $value=preg_replace("/[^0-9]+/", "*", $value);
                }

                $kq1["diachi_view"]=$kq1["diachi_view"]." ".$value;
            }
        }else{
            $kq1["diachi_view"]=$kq1["diachi"];
        }

        $kq1["diachi_view"]=hidec($kq1["diachi"]);        
        
        $kq1["yeucau"]=json_decode($kq1["yeucau"],true);

        if (strlen($kq1["diachi"])<5) {$kq1["diachiview"] = "Chưa có địa chỉ giao. liên hệ ".$kq1["name"];}else $kq1["diachiview"]=$kq1["diachi"];

        if (!is_array($kq1["yeucau"])) {
            $kq1["yeucau"]=array();
        }

        if (is_array($kq1["his"])) {
            foreach ($kq1["his"] as $key => $value) {
                  $kq1["his_html"]=$kq1["his_html"]."<li>".($key+1).". <i>".$value."</i></li>";
            }
        }

        if ($kq1["hop"]==null or $kq1["hop"]=="") {
            $kq1["hop"]='<div class="order_hop"><span class="yes">Xác nhận đã đặt</span><span> Hộp ?</span></div>';
        }else{
            $kq1["hop"]='<div class="order_hop ok"><span>'.$kq1["hop"].' Đã đặt hộp</span></div>';
        }
        

        $q2="select * from images where idsp=".$kq1["id"];
        $r2=confirm_query($q2);
        $sl=mysqli_num_rows($r2);
        if($sl > 0){
        while ($kq2 = mysqli_fetch_array($r2,MYSQLI_ASSOC)) {
            $list_bill=array("Bill Thanh Toán");
            $list_mt=array("Ảnh mẫu","Miêu tả màu");            
            $list_other = array('Ship');
            $kq2["image"]=json_decode($kq2["image"],true);

    //Block erea
        if (isset($admin["block"]["ag"]) and $admin["iduser"]!==$kq1["iduser"]){
                $kq2["dongiatext"]='';
                $kq2["dongia"]=0;
        }else $kq2["dongiatext"]='ĐG:<span>'.number_format($kq2["dongia"]).'</span>';
    //End block

            $kq1["list_all"][]=$kq2;

            if (in_array($kq2["category"], $list_bill)) {
                $kq1["list_bill"][]=$kq2;
            }elseif (in_array($kq2["category"], $list_mt)) {
                $kq1["list_mt"][]=$kq2;
            }elseif (in_array($kq2["category"], $list_other)) {
                $kq1["list_other"][]=$kq2;
            }else{
                $kq2["sum"]=$kq2["soluong"]*$kq2["dongia"];
                $kq1["list_product"][]=$kq2;
                $kq1["sum"]=$kq1["sum"]+($kq2["soluong"]*$kq2["dongia"]);
            }
        }}

        $tmp=explode("[]",$kq1["congno"]);
          if (count($tmp)>=1) {
            $kq1["congno"]="";
             foreach ($tmp as $key => $value) {
              $kq1["congno"].="<li>".$value."</li>";
            }
        }
        

        if (is_array($kq1["yeucau"]) and in_array("Hộp đẹp", $kq1["yeucau"])) {
            $kq1["list_yc"][]=array(
                "image" => "img/hop do.jpg",
                "category" => "Hộp đẹp",
                "ghichu" => "Ảnh minh họa"
            );
        }

        if (is_array($kq1["yeucau"]) and in_array("Phiếu Thu", $kq1["yeucau"])) {
            $kq1["list_yc"][]=array(
                "image" => "img/phieu thu.jpg",
                "category" => "Phiếu thu",
                "ghichu" => "Ảnh minh họa"
            );
        }

        if (is_array($kq1["yeucau"]) and in_array("Hóa đơn bán lẻ", $kq1["yeucau"])) {
            $kq1["list_yc"][]=array(
                "image" => "img/hoa don.jpg",
                "category" => "Hóa đơn",
                "ghichu" => "Ảnh minh họa"
            );
        }


        $kq1["vat_value"]=0;        
        if (is_array($kq1["yeucau"]) and in_array("VAT", $kq1["yeucau"])) {
            $kq1["vat_value"]=$kq1["sum"]*$vatvalues;
        }
        $kq1["total"]=$kq1["sum"]+$kq1["vat_value"];
        
        if ($kq1["total"]<=2000000) {
            if (in_array("Free Ship", $kq1["yeucau"])) {
                $kq1["ship"]=0;
            }else $kq1["ship"]=50000;
        }else $kq1["ship"]=0;



       
        $kq1["tongthanhtoan"]=$kq1["total"]+$kq1["ship"]-$kq1["datcoc"];
        $kq1["tongthanhtoan_text"]="
        <table class='table-bordered bill_sm'>
          <tr>
            <th>Tổng<small>(1)</small></th>
            <th>VAT<small>(2)</small></th>
            <th>Ship<small>(3)</small></th>
            <th>Cọc<small>(4)</small></th>
            <th>Thanh Toán<small>(1+2+3-4)</small></th>
          </tr>
          <tr>
            <td>".number_format($kq1["sum"])."</td>
            <td>".number_format($kq1["vat_value"])."</td>
            <td>".number_format($kq1["ship"])."</td>
            <td>".number_format($kq1["datcoc"])."</td>
            <td><b>".number_format($kq1["tongthanhtoan"])."<b></td>
          </tr>
        </table>";
        $kq1["tongthanhtoan_text_admin"]=$kq1["tongthanhtoan_text"];

        $tmp_vip=get_vip($kq1["idkh"]);
        if (isset($tmp_vip[0])) {
            $kq1["data_vip"]=$tmp_vip[0];
            $kq1["tenkhview"]= '<img src="img/Crown.png"> <a href="vip.php?view='.$kq1["idkh"].'#tong">'.$kq1["tenkh"].'</a>';
            $kq1["vip"]= '<img src="img/Crown.png"> <b> <a href="vip.php?view='.$kq1["idkh"].'#tong">'.$kq1["tenkh"].'</a> </b> <img width="25px" class="rounded-circle" src="'.$kq1["data_vip"]["avatar"].'">';
            
        }else{
            $kq1["tenkhview"]=$kq1["nguoinhan"];
        }

        if (in_array("Ẩn giá", $kq1["yeucau"])) {
           $kq1["tongthanhtoan_text"]="Giá, liên hệ ".$kq1["name"]."!";
        }

        if ($kq1["idkh"]>0) {
           $kq1["tongthanhtoan_text"]="Thanh toán liên hệ ".$kq1["tenkh"]." ".$kq1["sodtkh"]." !";
        }
//Block erea
        if (isset($admin["block"]["adr"]) and $admin["iduser"]!==$kq1["iduser"]) {
            
            if (strlen($kq1["nguoinhan"])>=2) { $kq1["nguoinhan"]=hidec($kq1["nguoinhan"]); }
            if (strlen($kq1["diachi"])>=2) { $kq1["diachi"]=$kq1["diachi_view"]; }
            if (strlen($kq1["sodt"])>=2) { $kq1["sodt"]=hidec($kq1["sodt"]); }
            if (strlen($kq1["tenlink"])>=2) { $kq1["tenlink"]=$kq1["ten"]; }
            if (strlen($kq1["vat"])>=2) { $kq1["vat"]=hidec($strblock); }
            if (strlen($kq1["mail"])>=2) { $kq1["mail"]=hidec($strblock); }          

            if ($kq1["idkh"]>0) {
            $kq1["tenkhview"]= '<img src="img/Crown.png">'.$kq1["tenkh"];
            $kq1["vip"]= '<img src="img/Crown.png">'.$kq1["tenkh"];
            }else{
                $kq1["tenkhview"]=hidec($kq1["nguoinhan"]);
            }
        }
        if (isset($admin["block"]["ag"]) and $admin["iduser"]!==$kq1["iduser"]){
            $kq1["tongthanhtoan_text"]="";
            $kq1["sum"]=0;
        }
//End block

        if (isset($data_month[$kq1["month"]])) {
            $data_month[$kq1["month"]]+=$kq1["sum"];
        }else  $data_month[$kq1["month"]]=$kq1["sum"];

        
        if ($kq1["ttthanhtoan"]=="Chưa Thanh Toán") {
            if ($kq1["idkh"]>0) {
                $data_tt[$kq1["ttthanhtoan"]]["vip"][]=$kq1;
            }else $data_tt[$kq1["ttthanhtoan"]]["normal"][]=$kq1;
        }else $data_tt[$kq1["ttthanhtoan"]][$kq1["ptthanhtoan"]][]=$kq1;
        $data_tt["all"][]=$kq1;

        if (isset($tongfile[$kq1["name"]])) {
            $tongfile[$kq1["name"]]++;
        }else $tongfile[$kq1["name"]]=1;

        $data[]=$kq1;
    }

    switch ($resutl) {
        case 'month':
            return $data_month;
            break;
        case 'baocao':
            return $data_tt;
            break;
        case 'tongfile':
            return $tongfile;
            break;
        
        default:
            return $data;
            break;
    }
    
}
function add($table,$data){
        if (count($data)>0) {
           global $dbc; 
            $i=0;
            $colname="";
            $colvalue="";
            foreach ($data as $key => $value) {
                if ($i==0) {
                    $colname=$colname." ".$key;
                    $colvalue=$colvalue." "."'".$value."'";
                }else {
                    $colname=$colname." , ".$key;
                    $colvalue=$colvalue." , "."'".$value."'";
                }           
            $i++;
            }       
            $query= "INSERT INTO $table (".$colname.") VALUES (".$colvalue.")";
            $r = mysqli_query($dbc,$query);
            if (!$r) {
               //return false;
                return  mysqli_error($dbc);# code...
            }else return "OK";
        }else return "Thêm không thành công";
    }

function edit($table,$data,$where){
    global $dbc;    
    $i=0;
    $keyval="";
    foreach ($data as $key => $value) {
        if ($i==0) {
            $keyval=$keyval." ".$key." = '".$value."'";
        }else $keyval=$keyval." , ".$key." = '".$value."'";             
    $i++;
    }

    $i=0;
    $dieukien="";
    foreach ($where as $key => $value) {
        if ($i==0) {
            $dieukien=$dieukien." ".$key." = '".$value."'";
        }else $dieukien=$dieukien." and ".$key." = '".$value."'";           
    $i++;
    }
    $query= "UPDATE ".$table." SET ".$keyval." where ".$dieukien;    
    $r = mysqli_query($dbc,$query);
     if (!$r) {
           //return false;
            return  mysqli_error($dbc);# code...
        }else return "OK";
}


function thedate($date,$s){
    if ($s=1) {

        $th=date_format(date_create($date),"D");
        switch($th) {
        case 'Mon':
            $th = 'Thứ hai';
            break;
        case 'Tue':
            $th = 'Thứ ba';
            break;
        case 'Wed':
            $th = 'Thứ tư';
            break;
        case 'Thu':
            $th = 'Thứ năm';
            break;
        case 'Fri':
            $th = 'Thứ sáu';
            break;
        case 'Sat':
            $th = 'Thứ bảy';
            break;
        case 'Sun':
            $th = 'Chủ Nhật';
            break;
        default:
            $th = $th;
            break;
    }
        $return = "<b>".$th."</b> - ".date_format(date_create($date),"d/m/y");
    }else  $return = date_format(date_create($date),"d/m/y");

    return $return;
}

 function redirect_to($page = 'index.php') {
        $url = BASE_URL . $page;
        header("Location: $url");
        exit();
    }
 function conver($number){
    $number=number_format($number,"0",",",".")." VND";
    return $number;
 }
 // Phan trang
    function pagination($idloai, $display = 4){
        global $dbc; global $start;        
            $q = "SELECT COUNT(id) FROM sanpham where idloai=$idloai";
            $r=confirm_query($q);
            list($record) = mysqli_fetch_array($r, MYSQLI_NUM); 
            if($record > $display) {
                $page = ceil($record/$display);
            } else {
                $page = 1;
            }
        
        $output = "<ul>";
        if($page > 1) {
           if(isset($_GET["p"])){
            $current_page = $_GET["p"];            
           }else $current_page=1; 
            if($current_page != 1) {
                $output .= "<li id='pr'><a href='view.php?id={$idloai}&p=".($current_page-1)."'>Lùi Lại</a></li>";
            }
            for($i = 1; $i <= $page; $i++) {
                if($i != $current_page) {
                    $output .= "<li><a href='view.php?id={$idloai}&p=$i'>{$i}</a></li>";
                } else {
                    $output .= "<li class='current'>{$i}</li>";
                }
            }// END FOR LOOP
            if($current_page != $page) {
                $output .= "<li id='pr'><a href='view.php?id={$idloai}&p=".($current_page+1)."'>Kế tiếp</a></li>";
            }
        } // END pagination section
            $output .= "</ul>";
            
            return $output;
    } // END pagination 
    
    function the_content($text) {
        $sanitized = htmlentities($text, ENT_COMPAT, 'UTF-8');
        return str_replace(array("\r\n", "\n"),array("<p>", "</p>"),$sanitized);
    }

    function thongbao($tb,$class){
            global $now;
            global $iduser;
            $q = "INSERT INTO thongbao (iduser, tb,class, date1) 
             VALUES ('$iduser', '$tb','$class', '$now')";
            $temp=confirm_query($q);
    }

    
    function cr_slug ($text, string $divider = '-'){
        // replace non letter or digits by divider

       $unicode = array(
 
           'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
 
           'd'=>'đ',
 
           'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
 
           'i'=>'í|ì|ỉ|ĩ|ị',
 
           'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
 
           'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
 
           'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
 
           'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
 
           'D'=>'Đ',
 
           'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
 
           'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
 
           'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
 
           'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
 
           'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
 
       );
 
      foreach($unicode as $nonUnicode=>$uni){
 
           $text = preg_replace("/($uni)/i", $nonUnicode, $text);
 
      }

      $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

      // transliterate
      $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

      // remove unwanted characters
      $text = preg_replace('~[^-\w]+~', '', $text);

      // trim
      $text = trim($text, $divider);

      // remove duplicate divider
      $text = preg_replace('~-+~', $divider, $text);

      // lowercase
      $text = strtolower($text);

      if (empty($text)) {
        return 'n-a';
      }

      return $text;
    }

function tien_chu( $number )
{
    $hyphen = ' ';
    $conjunction = '  ';
    $separator = ' ';
    $negative = 'âm ';
    $decimal = ' phẩy ';
    $dictionary = array(
        0 => 'Không',
        1 => 'Một',
        2 => 'Hai',
        3 => 'Ba',
        4 => 'Bốn',
        5 => 'Năm',
        6 => 'Sáu',
        7 => 'Bảy',
        8 => 'Tám',
        9 => 'Chín',
        10 => 'Mười',
        11 => 'Mười một',
        12 => 'Mười hai',
        13 => 'Mười ba',
        14 => 'Mười bốn',
        15 => 'Mười năm',
        16 => 'Mười sáu',
        17 => 'Mười bảy',
        18 => 'Mười tám',
        19 => 'Mười chín',
        20 => 'Hai mươi',
        30 => 'Ba mươi',
        40 => 'Bốn mươi',
        50 => 'Năm mươi',
        60 => 'Sáu mươi',
        70 => 'Bảy mươi',
        80 => 'Tám mươi',
        90 => 'Chín mươi',
        100 => 'trăm',
        1000 => 'ngàn',
        1000000 => 'triệu',
        1000000000 => 'tỷ',
        1000000000000 => 'nghìn tỷ',
        1000000000000000 => 'ngàn triệu triệu',
        1000000000000000000 => 'tỷ tỷ'
    );

    if( !is_numeric( $number ) )
    {
        return false;
    }

    if( ($number >= 0 && (int)$number < 0) || (int)$number < 0 - PHP_INT_MAX )
    {
        // overflow
        trigger_error( ' tien_chu only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX, E_USER_WARNING );
        return false;
    }

    if( $number < 0 )
    {
        return $negative .  tien_chu( abs( $number ) );
    }

    $string = $fraction = null;

    if( strpos( $number, '.' ) !== false )
    {
        list( $number, $fraction ) = explode( '.', $number );
    }

    switch (true)
    {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens = ((int)($number / 10)) * 10;
            $units = $number % 10;
            $string = $dictionary[$tens];
            if( $units )
            {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if( $remainder )
            {
                $string .= $conjunction .  tien_chu( $remainder );
            }
            break;
        default:
            $baseUnit = pow( 1000, floor( log( $number, 1000 ) ) );
            $numBaseUnits = (int)($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string =  tien_chu( $numBaseUnits ) . ' ' . $dictionary[$baseUnit];
            if( $remainder )
            {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .=  tien_chu( $remainder );
            }
            break;
    }

    if( null !== $fraction && is_numeric( $fraction ) )
    {
        $string .= $decimal;
        $words = array( );
        foreach( str_split((string) $fraction) as $number )
        {
            $words[] = $dictionary[$number];
        }
        $string .= implode( ' ', $words );
    }
    $string=str_replace("ngàn ngàn", "ngàn", $string);

    return $string;
}

function resize_image_max($image,$max_width,$max_height) {
    $w = imagesx($image); //current width
    $h = imagesy($image); //current height
    if ((!$w) || (!$h)) { $GLOBALS['errors'][] = 'Image couldn\'t be resized because it wasn\'t a valid image.'; return false; }
 
    if (($w <= $max_width) && ($h <= $max_height)) { return $image; } //no resizing needed
 
    //try max width first...
    $ratio = $max_width / $w;
    $new_w = $max_width;
    $new_h = $h * $ratio;
 
    //if that didn't work
    if ($new_h > $max_height) {
        $ratio = $max_height / $h;
        $new_h = $max_height;
        $new_w = $w * $ratio;
    }
 
    $new_image = imagecreatetruecolor ($new_w, $new_h);
    imagecopyresampled($new_image,$image, 0, 0, 0, 0, $new_w, $new_h, $w, $h);
    return $new_image;
}

function resize_image_crop($image,$width,$height) {
    $w = @imagesx($image); //current width
    $h = @imagesy($image); //current height
    if ((!$w) || (!$h)) { $GLOBALS['errors'][] = 'Image couldn\'t be resized because it wasn\'t a valid image.'; return false; }
    if (($w == $width) && ($h == $height)) { return $image; } //no resizing needed
 
    //try max width first...
    $ratio = $width / $w;
    $new_w = $width;
    $new_h = $h * $ratio;
 
    //if that created an image smaller than what we wanted, try the other way
    if ($new_h < $height) {
        $ratio = $height / $h;
        $new_h = $height;
        $new_w = $w * $ratio;
    }
 
    $image2 = imagecreatetruecolor ($new_w, $new_h);
    imagecopyresampled($image2,$image, 0, 0, 0, 0, $new_w, $new_h, $w, $h);
 
    //check to see if cropping needs to happen
    if (($new_h != $height) || ($new_w != $width)) {
        $image3 = imagecreatetruecolor ($width, $height);
        if ($new_h > $height) { //crop vertically
            $extra = $new_h - $height;
            $x = 0; //source x
            $y = round($extra / 2); //source y
            imagecopyresampled($image3,$image2, 0, 0, $x, $y, $width, $height, $width, $height);
        } else {
            $extra = $new_w - $width;
            $x = round($extra / 2); //source x
            $y = 0; //source y
            imagecopyresampled($image3,$image2, 0, 0, $x, $y, $width, $height, $width, $height);
        }
        imagedestroy($image2);
        return $image3;
    } else {
        return $image2;
    }
}
 
function resize_image($method,$image_loc,$new_loc,$width,$height) {
    if (!is_array(@$GLOBALS['errors'])) { $GLOBALS['errors'] = array(); }
 
    if (!in_array($method,array('force','max','crop'))) { $GLOBALS['errors'][] = 'Invalid method selected.'; }
 
    if (!$image_loc) { $GLOBALS['errors'][] = 'No source image location specified.'; }
    else {
        if ((substr(strtolower($image_loc),0,7) == 'http://') || (substr(strtolower($image_loc),0,7) == 'https://')) { /*don't check to see if file exists since it's not local*/ }
        elseif (!file_exists($image_loc)) { $GLOBALS['errors'][] = 'Image source file does not exist.'; }
        $extension = strtolower(substr($image_loc,strrpos($image_loc,'.')));
        if (!in_array($extension,array('.jpg','.jpeg','.png','.gif','.bmp'))) { $GLOBALS['errors'][] = 'Invalid source file extension!'; }
    }
 
    if (!$new_loc) { $GLOBALS['errors'][] = 'No destination image location specified.'; }
    else {
        $new_extension = strtolower(substr($new_loc,strrpos($new_loc,'.')));
        if (!in_array($new_extension,array('.jpg','.jpeg','.png','.gif','.bmp'))) { $GLOBALS['errors'][] = 'Invalid destination file extension!'; }
    }
 
    $width = abs(intval($width));
    if (!$width) { $GLOBALS['errors'][] = 'No width specified!'; }
 
    $height = abs(intval($height));
    if (!$height) { $GLOBALS['errors'][] = 'No height specified!'; }
 
    if (count($GLOBALS['errors']) > 0) { echo_errors(); return false; }
 
    if (in_array($extension,array('.jpg','.jpeg'))) { $image = @imagecreatefromjpeg($image_loc);}
    elseif ($extension == '.png') { $image = @imagecreatefrompng($image_loc); }
    elseif ($extension == '.gif') { $image = @imagecreatefromgif($image_loc); }
    elseif ($extension == '.bmp') { $image = @imagecreatefromwbmp($image_loc); }
    if (!$image) { $GLOBALS['errors'][] = 'Image could not be generated!'; }
    else {
        $current_width = imagesx($image);
        $current_height = imagesy($image);
        if ((!$current_width) || (!$current_height)) { $GLOBALS['errors'][] = 'Generated image has invalid dimensions!'; }
    }
    if (count($GLOBALS['errors']) > 0) { @imagedestroy($image); echo_errors(); return false; }
 
    if ($method == 'force') { $new_image = resize_image_force($image,$width,$height); }
    elseif ($method == 'max') { $new_image = resize_image_max($image,$width,$height); }
    elseif ($method == 'crop') { $new_image = resize_image_crop($image,$width,$height); }
 
    if ((!$new_image) && (count($GLOBALS['errors'] == 0))) { $GLOBALS['errors'][] = 'New image could not be generated!'; }
    if (count($GLOBALS['errors']) > 0) { @imagedestroy($image); echo_errors(); return false; }
 
    $save_error = false;
    if (in_array($extension,array('.jpg','.jpeg'))) { imagejpeg($new_image,$new_loc) or ($save_error = true); }
    elseif ($extension == '.png') { imagepng($new_image,$new_loc) or ($save_error = true); }
    elseif ($extension == '.gif') { imagegif($new_image,$new_loc) or ($save_error = true); }
    elseif ($extension == '.bmp') { imagewbmp($new_image,$new_loc) or ($save_error = true); }
    if ($save_error) { $GLOBALS['errors'][] = 'New image could not be saved!'; }

    if (count($GLOBALS['errors']) > 0) { @imagedestroy($image); @imagedestroy($new_image); echo_errors(); return false; }
 
    imagedestroy($image);
    imagedestroy($new_image);
 
    return true;
}
 
function echo_errors() {
    if (!is_array(@$GLOBALS['errors'])) { $GLOBALS['errors'] = array('Unknown error!'); }
    foreach ($GLOBALS['errors'] as $error) { echo '<p style="color:red;font-weight:bold;">Error: '.$error.'</p>'; }
}

function gettb($idtb){
    switch ($idtb) {
        case 'addmoreok':
            $tb="<p style='color:red'>Chúng tôi đã tạo thành công đơn hàng mới từ đơn hàng cũ. Bạn hãy kiểm tra lại và chắc chắn là mọi thông tin dưới đây là đúng đắn với đơn hàng mới !.</p>";
            break;
         case 'editok':
            $tb="<p style='color:red'>Sửa thành công !.</p>";
            break;
        
        default:
            $tb="Không có thông báo";
            break;
    }

    return $tb;
}
function author($id){
    global $admin;
    $iduser=$admin["iduser"];
    $q1="select count(id) as count from file where iduser='$iduser' and id='$id'";
    $r1=confirm_query($q1);
    $kq1 = mysqli_fetch_array($r1,MYSQLI_ASSOC); 
    if($kq1["count"]>0){
       return "true";
    }else return false;
}

function getparent($id){
    $q1="select parent from file where id='$id'";
    $r1=confirm_query($q1);
    $kq1 = mysqli_fetch_array($r1,MYSQLI_ASSOC); 
    if($kq1["parent"]>0){
       return "true";
    }else return false;
}

function getvalue($row,$table,$id){
    $q1="select * from {$table} where id='$id'";
    $r1=confirm_query($q1);
    $kq1 = mysqli_fetch_array($r1,MYSQLI_ASSOC); 
    return $kq1[$row];
}


function get_name_image($ten,$date1,$ext){
    $tmpstar=rand(1,29);
    if (strlen($ten)<1) {
       $ten="noname";
    }
    $name=$ten." ".substr(md5(rand(1,10000)), $tmpstar,5);  
    $name = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $name);
    $name = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $name);
    $name = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $name);
    $name = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $name);
    $name = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $name);
    $name = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $name);
    $name = preg_replace('/(đ)/', 'd', $name);
    $name = preg_replace('/[^A-Za-z0-9-\s]/', '', $name);
    $name = preg_replace('/([\s]+)/', '-', $name);
    $name=$date1."_".$name; $name=str_replace(" ", "_", $name);$name=$name.$ext;
    $q1="select * from images where image='{$name}'";
    $r1=confirm_query($q1);
    $sl=mysqli_num_rows($r1);
    if ($sl>=1) {
      $name=get_name_image($ten,$date1,$ext);
    }
    return $name;
}
function backupDatabase(){
$servername = "localhost";
$username = "cp818601_admin";
$password = "Minhdat86";
$dbname = "cp818601_app";
// Khởi tạo biến $sql
$sql = '';

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Tên tệp tin sao lưu
$backup_file = "backup.sql";

// Lấy danh sách các bảng trong cơ sở dữ liệu
$tables = array();
$result = mysqli_query($conn, "SHOW TABLES");
while ($row = mysqli_fetch_row($result)) {
    $tables[] = $row[0];
}

// Duyệt qua các bảng và truy vấn dữ liệu
foreach ($tables as $table) {
    $result = mysqli_query($conn, "SELECT * FROM ".$table);
    $num_fields = mysqli_num_fields($result);

    // Ghi thông tin bảng vào tệp tin
    $sql .= "DROP TABLE IF EXISTS ".$table.";";
    $row2 = mysqli_fetch_row(mysqli_query($conn, "SHOW CREATE TABLE ".$table));
    $sql .= "\n\n".$row2[1].";\n\n";

    // Ghi dữ liệu từ bảng vào tệp tin
    for ($i = 0; $i < $num_fields; $i++) {
        while ($row = mysqli_fetch_row($result)) {
            $sql .= "INSERT INTO ".$table." VALUES(";
            for ($j = 0; $j < $num_fields; $j++) {
                $row[$j] = addslashes($row[$j]);
                $row[$j] = preg_replace("/\n/","\\n",$row[$j]);
                if (isset($row[$j])) { $sql .= "'".$row[$j]."'" ; } else { $sql .= "NULL"; }
                if ($j < ($num_fields - 1)) { $sql .= ","; }
            }
            $sql .= ");\n";
        }
    }
    $sql .= "\n\n\n";
}

// Ghi dữ liệu vào tệp tin
$fileHandler = fopen($backup_file,'w+');
fwrite($fileHandler, $sql);
fclose($fileHandler);

// Ngắt kết nối đến cơ sở dữ liệu
$conn->close();

}

?>

<?php 
/*if (!$admin["iduser"]==0) {
   echo ' <h1>Tạm ngưng bảo trì !</h1>';
   exit();
}*/
?>

