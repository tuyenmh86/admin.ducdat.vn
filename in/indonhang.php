<?php 
  include "../function.php";
  if (isset($_POST["gh"]) and $admin["chucvu"]=="Admin") {
     foreach ($_POST["data"] as $key => $value) {       
        $q= "UPDATE file SET tinhtrang1='Đã giao' where id =$value;";
        confirm_query($q);
    }

  redirect_to("index.php"); 
  }
 ?>
<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:w="urn:schemas-microsoft-com:office:word"
xmlns:m="http://schemas.microsoft.com/office/2004/12/omml"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<meta name=ProgId content=Word.Document>
<meta name=Generator content="Microsoft Word 14">
<meta name=Originator content="Microsoft Word 14">
<link rel=File-List href="Giao%20Hàng%20Ngày%2027_files/filelist.xml">

<link rel=themeData href="Giao%20Hàng%20Ngày%2027_files/themedata.thmx">
<link rel=colorSchemeMapping
href="Giao%20Hàng%20Ngày%2027_files/colorschememapping.xml">

<style>
<!--
 /* Font Definitions */
 @font-face
  {font-family:Calibri;
  panose-1:2 15 5 2 2 2 4 3 2 4;
  mso-font-charset:0;
  mso-generic-font-family:swiss;
  mso-font-pitch:variable;
  mso-font-signature:-520092929 1073786111 9 0 415 0;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
  {mso-style-unhide:no;
  mso-style-qformat:yes;
  mso-style-parent:"";
  margin-top:0in;
  margin-right:0in;
  margin-bottom:10.0pt;
  margin-left:0in;
  line-height:115%;
  mso-pagination:widow-orphan;
  font-size:11.0pt;
  font-family:"Calibri","sans-serif";
  mso-ascii-font-family:Calibri;
  mso-ascii-theme-font:minor-latin;
  mso-fareast-font-family:Calibri;
  mso-fareast-theme-font:minor-latin;
  mso-hansi-font-family:Calibri;
  mso-hansi-theme-font:minor-latin;
  mso-bidi-font-family:"Times New Roman";
  mso-bidi-theme-font:minor-bidi;}
.MsoChpDefault
  {mso-style-type:export-only;
  mso-default-props:yes;
  font-family:"Calibri","sans-serif";
  mso-ascii-font-family:Calibri;
  mso-ascii-theme-font:minor-latin;
  mso-fareast-font-family:Calibri;
  mso-fareast-theme-font:minor-latin;
  mso-hansi-font-family:Calibri;
  mso-hansi-theme-font:minor-latin;
  mso-bidi-font-family:"Times New Roman";
  mso-bidi-theme-font:minor-bidi;}
.MsoPapDefault
  {mso-style-type:export-only;
  margin-bottom:10.0pt;
  line-height:115%;}
@page WordSection1
  {size:8.5in 11.0in;
  margin:31.5pt 27.0pt 1.0in 31.5pt;
  mso-header-margin:.5in;
  mso-footer-margin:.5in;
  mso-paper-source:0;}
div.WordSection1
  {page:WordSection1;}
-->
</style>

</head>

<body lang=EN-US style='tab-interval:.5in'>

<div class=WordSection1>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span style='font-family:"Times New Roman","serif"'>Giao Hàng Ngày
<?php echo date("d/m/Y");?></span></b></p>

<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0 style='border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;
 mso-yfti-tbllook:1184;mso-padding-alt:0in 5.4pt 0in 5.4pt'>
    <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:17.5pt'>
        <td width=85 valign=top style='width:63.9pt;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:17.5pt'>
            <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-family:"Times New Roman","serif"'>&#272;&#417;n
  Hàng<o:p></o:p></span>
            </p>
        </td>
        <td width=102 valign=top style='width:76.5pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:17.5pt'>
            <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-family:"Times New Roman","serif"'>Ng&#432;&#7901;i
  Nh&#7853;n<o:p></o:p></span>
            </p>
        </td>
        <td width=90 valign=top style='width:67.5pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:17.5pt'>
            <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-family:"Times New Roman","serif"'>S&#272;T<o:p></o:p></span>
            </p>
        </td>
        <td width=330 valign=top style='width:247.5pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:17.5pt'>
            <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-family:"Times New Roman","serif"'>&#272;C<o:p></o:p></span>
            </p>
        </td>
        <td width=108 valign=top style='width:81.0pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:17.5pt'>
            <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-family:"Times New Roman","serif"'>Kèm
  Theo<o:p></o:p></span>
            </p>
        </td>
    </tr>
     <?php
  if (isset($_POST["data"])) {
    foreach ($_POST["data"] as $key => $value) {
      if ($key==0) {
        $qery=$value;
      }else{
        $qery=$qery.",".$value;
      }
    }

    $shiper="";
    $shiper=$_POST["shiper"];

    foreach ($_POST["data"] as $key => $value) {       
        $q = "UPDATE file SET giaohang='{$now}',shiper='{$shiper}',tinhtrang1='Đã giao' where id='{$value}'";
        $kq=confirm_query($q);
    }

    $qery="(".$qery.")";
    $q1="select * from file inner join user  on file.iduser= user.iduser left join khachhang on file.idkh=khachhang.idkh where file.id IN $qery";
    $r1=confirm_query($q1);
    $sl=mysqli_num_rows($r1);
    if($sl > 0){
    while ($kq1 = mysqli_fetch_array($r1,MYSQLI_ASSOC)) {
    if(isset($kq1["idkh"])&& filter_var($kq1["idkh"], FILTER_VALIDATE_INT, array('min_range' => 1))){
                                      $kq1["nguoinhan"]=$kq1["tenkh"];
                                      $kq1["sodt"]=$kq1["sodtkh"];
                                      $kq1["diachi"]=$kq1["diachikh"];
                                  }
    ?>
        
    <tr style='mso-yfti-irow:1;mso-yfti-lastrow:yes'>
        <td width=85 valign=top style='width:63.9pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
            <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-family:"Times New Roman","serif"'><?=$kq1["ten"];?></span>
            </p>
        </td>
        <td width=102 valign=top style='width:76.5pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
            <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-family:"Times New Roman","serif"'><?=$kq1["nguoinhan"];?></span>
            </p>
        </td>
        <td width=90 valign=top style='width:67.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
            <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-family:"Times New Roman","serif"'><?=$kq1["sodt"];?></span>
            </p>
        </td>
        <td width=330 valign=top style='width:247.5pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
            <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-family:"Times New Roman","serif"'><?=$kq1["diachi"];?></span>
            </p>
        </td>
        <td width=108 valign=top style='width:81.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
            <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-family:"Times New Roman","serif"'>
          <?php
                $temp=explode(",", $kq1["yeucau"]); 
                foreach ($temp as $key => $value) {
                    echo "<span style='color:red'>".$value."</span>, ";
                }
            ?>
        </span>
            </p>
        </td>
    </tr>

    <?php }}}?>


    
</table>



</body>

<script>
//function myFunction() {
 window.print();
//}
</script>

</html>
