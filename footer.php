<div id="myModal" class="modal">
    
</div>

<script>
$("body").on( "click", "#myImg", function() {
    img = $(this).attr("src");
    //$(this).next("#myModal").css("display","block");
    $("#myModal").css("display","block").html($(this).next("#Modal").html());
    
})
$("body").on( "click", "#myModal span", function() {
    $(this).parent("#myModal").css("display","none");
})

$("body").on("click",".info .shipper input", function(){
    var name=encodeURIComponent($(this).val());
    var url="action.php?action=shiper&id="+$(this).attr("id")+"&name="+name;
    $(this).parents(".shipper").load(url);
})

$("body").on("click",".order_hop .yes", function(){
    var name=encodeURIComponent($(this).val());
    var url="action.php?action=order_hop&id="+$(this).parents(".dh").attr("id")+"&name=a";
    console.log(url);
    $(this).parents(".order_hop").load(url);
})

</script>



<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <?php echo $_SERVER['REMOTE_ADDR']; date("Y")?> © BY <a href="/"> Đức Đạt VN </a>.
            </div>
        </div>
    </div>
</footer>
<!-- End Footer -->

 <!-- Toastr js -->
<script src="../plugins/jquery-toastr/jquery.toast.min.js" type="text/javascript"></script>
<script src="assets/pages/jquery.toastr.js" type="text/javascript"></script>

<!-- App js -->
<script src="assets/js/jquery.core.js"></script>
<script src="assets/js/jquery.app.js"></script>