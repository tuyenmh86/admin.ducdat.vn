<?php
 include "function.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?=isset($title)?$title:"DUC DAT "?>-Ver 2.3</title>

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

     
        <!-- Multi Item Selection examples -->
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

        <!-- App css -->
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

        <script src="assets/js/modernizr.min.js"></script>
        <link href="plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>

        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>

        <script src="jquery.pagenav.js"></script>
        <script>
            $(document).ready(function ()
              {
                    $('nav a').pageNav({'scroll_shift': $('nav').outerHeight() + 20});
                    $("#tb").click(function(){
                    $.ajax({url: "tb.php", success: function(result){
                    $("#tbs").html(result);
                  }});
              });
            });
        </script>
        
        <style type="text/css">
            .yc input[type="checkbox"] {
              margin-left:20px;
            }

            .red {
              color:red;
            }

            .green {
              color:green;
            }

            .orange {
              color:orange;
            }

            .images .itlist {
              margin-top:10px;
              padding:10px 0 10px 0;
              position:relative;
              border-top: solid 1px #ccc;
            }

            .delete {
              color:red;
              cursor:pointer;
              position:absolute;
              display:block;
              border:solid 1px;
              padding:0 6px 0 6px;
              border-radius:23px;
            }

            .images .delete {
              top:-7px;
              right:-11px;
            }

            table.viewdh {
                word-break: break-word;
            }

            .dh{
                display: flex;
                justify-content: flex-start;
                border: solid 1px #ccc;
            }
            .dh .info,.dh .detail,.dh .note{
                border-left: solid 1px #ccc;
                width: 100%;                
            }
            .dh .stt,.dh .info,.dh .detail,.dh .note{
                padding: 10px;
            }
            .dh .info{
              max-width: 30%;
            }
            .dh .note{
              max-width: 25%;
            }
            .dh .af{
                display: flex;
                flex-wrap: wrap;
            }
            .dh .note .txt{
              font-weight: bold;
              font-size: 20px;
              color: blue;
            }

             .order_hop{
                border: dashed 1px #888;
                border-radius: 3px;
                padding: 0px 3px 0px 3px;
                cursor: pointer;
            }
            .order_hop.ok{
              border:solid 1.5px green;
              font-weight: bold;
              color: green;
            }
            .order_hop:hover .yes,.order_hop:hover .no{
                display: inline-block;
            }
            .order_hop .yes{
                display: none;
                font-weight: bold;
            }
            .order_hop .yes:hover{
                color: blue;
                font-weight: bold;
            }

            .thumbnail .delete {
              top:-7px;
              right:-11px;
            }

            .thumbnail #myImg {
              max-width:150px;
              max-height:150px;
              height:auto;
            }

            .thumbnail-lage {
              width:auto;
              display:-webkit-inline-box;
              position:relative;
            }

            .thumbnail-lage .delete {
              position:absolute;
              top:5px;
              left:5px;
            }

            .thumbnail-lage img {
              max-width:200px;
              height:auto;
            }

            .hidden {
              display:none;
            }

            .thumbnail {
              max-width:160px;
              min-height:190px;
              border:solid 1px #ccc;
              padding:3px;
              position:relative;
            }

            .fix_inline .thumbnail {
              float: left;
            }

            td hr {
              margin-top:5px;
              margin-bottom:5px;
              border:dashed 1px #ccc;
            }

            .thumbnail div span {
              font-weight:bold;
              color:red;
            }

            .thumbnail span.rip {
              position:absolute;
              padding:0 2px 0 2px;
              background:rgb(255,255,255,0.8);
              font-weight:bold;
              border-radius:2px;
            }

            .thumbnail span.rtop {
              top:5px;
              left:0;
              color:red;
            }

            .thumbnail span.rbottom {
              top:0;
              right:0;
              color:#000;
              font-size:6.6px;
            }

            .input {
              border:1px solid #d9e3e9;
              border-radius:4px;
              max-width:100%;
              padding:.469rem .75rem;
              font-size:14px;
              -webkit-box-shadow:none;
              box-shadow:none;
              -webkit-transition:all 300ms linear;
              -moz-transition:all 300ms linear;
              -o-transition:all 300ms linear;
              transition:all 300ms linear;
            }

            .inline {
              display:inline-block;
            }

            li {
              list-style:none;
            }

            table {
              font-size:14px;
            }

            ul {
              padding:0;
            }

            ul.info span {
              font-weight:bold;
            }

            .left {
              float:left;
            }

            .table td,
            .table th {
              padding:2px;
            }

            svg {
              color:#02c0ce;
            }

            nav {
              top:117px;
              width:75px;
              position:fixed;
              z-index:9;
              background:#02c0ce;
              list-style:none;
              right:0;
              margin:0;
              padding:3px;
            }

            nav a {
              text-align:center;
              display:block;
              color:#000;
              border-top:solid 1px;
              font-size:13px;
            }

            nav a.Active {
              font-weight:bold;
              color:#fff;
            }

            nav a:first-child {
              border:none !important;
            }

            .input {
              border:solid 1px #ccc;
              border-radius:4px;
              padding:5px;
              background:#fff;
            }

            .row.in div {
              border:solid 1px #ccc;
              margin-left:11px;
              border-radius:5px;
            }

            .row.in div input {
              /* border-right:solid 1px #ccc;
              */

                border:none;
              /* border-right:solid 1px #ccc;
              */;
            }

            .clear {
              clear:both;
            }

            
            red {
              color:red;
            }

            blue {
              color:blue;
            }

            #myImg {
              cursor:pointer;
              transition:0.3s;
            }

            /* The Modal (background) */
            #Modal{
              display: none;
            }
            .modal {
              display:none;
              /* Hidden by default */

                position:fixed;
              /* Stay in place */

                z-index:999991;
              /* Sit on top */

                padding-top:10px;
              /* Location of the box */

                left:0;
              top:0;
              width:100%;
              /* Full width */

                height:100%;
              /* Full height */

                overflow:auto;
              /* Enable scroll if needed */

                background-color:rgb(0,0,0);
              /* Fallback color */

                background-color:rgba(0,0,0,0.9);
              /* Black w/ opacity */;
            }

            .modal .nct {
              color:#ccc;
              text-align:center;
            }

            .modal .nct span {
              font-weight:bold;
              color:#fff;
            }

            /* Modal Content (image) */

            .modal-content {
              margin:auto;
              display:block;
              max-width:90%;
              width:auto;
              height:auto;
            }

            /* Caption of Modal Image */

            #caption {
              margin:auto;
              display:block;
              width:80%;
              max-width:700px;
              text-align:center;
              color:#ccc;
              padding:10px 0;
              height:150px;
            }

            /* Add Animation */

            .modal-content,
            #caption {
              -webkit-animation-name:zoom;
              -webkit-animation-duration:0.6s;
              animation-name:zoom;
              animation-duration:0.6s;
            }

            @-webkit-keyframes zoom {
              from {
                -webkit-transform:scale(0);
              }
              to {
                -webkit-transform:scale(1);
              }
            }

            @keyframes zoom {
              from {
                transform:scale(0);
              }
              to {
                transform:scale(1);
              }
            }

            /* The Close Button */

            .close {
              position:absolute;
              top:15px;
              right:35px;
              color:#f1f1f1;
              font-size:40px;
              font-weight:bold;
              transition:0.3s;
            }

            .close:hover,
            .close:focus {
              color:#bbb;
              text-decoration:none;
              cursor:pointer;
            }

            @media only screen and (max-width:700px) {
              .modal-content {
                width:100%;
              }
            }

        <?php
            for ($i=1; $i <11 ; $i++) { 
                echo ".w-".$i. "{";
                echo "width: ".$i."0%;";
                echo "}";
            }
        ?>
        /*.holiday{
              background-image: url(img/hoa-mai.png);
              background-repeat: no-repeat;
              background-position: -0px -15px;
        }
        .view{
              background-position: 0px -30px;
        }*/


        .holiday{
              background-image: url(img/noel.png);
              background-repeat: no-repeat;
              background-position: -10px 0px;
        }
        .view{
              background-position: -25px -9px;
        }
        .view tr th{
          color: blue;
        }
        </style>
</head>
