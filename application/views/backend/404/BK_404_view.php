<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="ro-RO">
<head profile="http://gmpg.org/xfn/11">
<title><?= $title?></title>
<meta charset="utf-8"/>
<meta http-equiv="Content-Language" content="ro"/>
<meta name="robots" content="all,index,follow"/>
<meta name="keywords" content="mogoolab, templates, 404 error page"/>
<meta name="description" content="Traffic HTML Error Pages v 1.0 . Developed by MogooLab - www.mogoolab.com"/>
<meta name="publisher" content="mogoolab.com" />
<meta name="author" content="mogoolab.com" />
<meta http-equiv="X-UA-Compatible" content="IE=8">
<link href='http://fonts.googleapis.com/css?family=Istok+Web|Chivo|Lekton' rel='stylesheet' type='text/css'>

<link rel="stylesheet" type="text/css" media="all" href="<?= base_url()?>public/backend/js/404/impromptu/css.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?= base_url()?>public/backend/css/404.css" />

<script type="text/javascript" src="<?= base_url()?>public/backend/js/jquery.min.js"></script>
<script type="text/javascript" src="<?= base_url()?>public/backend/js/404/impromptu/jquery-impromptu.js"></script>
<script type="text/javascript" src="<?= base_url()?>public/backend/js/404/jquery-global.js"></script>

</head>

<body>


<div class="wrapper">

	<div class="mainWrapper">
    	
        <div id="hideMsg">Hệ thống sẽ tự động chuyển trang trong <span>10</span> giây nữa. <br />Hoặc có thể click <a href="<?= admin_url?>">vào đây</a> trờ về trang chủ nếu bạn chờ quá lâu ?</div>
    
        <div class="mainHolder">
            <div class="message">Bạn không có quyền truy cập vào đây !</div>
            <!-- end .message -->
            <div class="errorNumber"><a href="<?= admin_url?>">404</a></div> 
            <!-- end .errorNumber -->
            
            
            <div class="trafficLight">404 Error</div>
            
        </div>
        <!-- end .mainHolder -->
      
      
        <footer>
        <p class="copy">Copyright &copy 2014 thietkewebpro247.com.</p>
        <menu>
            <li><a id="back_home" href="<?= admin_url?>" title="Trở về">Click quay về trang chủ</a></li>            
        </menu>
        </footer>
        <!-- end footer -->
	</div>
     <!-- end .mainWrapper -->

</div>
<!-- end .wrapper -->


</body>
</html>