<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?= isset($title)?$title:""?> | CMS</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link rel="shortcut icon" href="<?= base_url()?>favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?= base_url()?>favicon.ico" type="image/x-icon">
        <link href="<?= admin_css_no?>bootstrap.min.css" rel="stylesheet" type="text/css" />        
        <link href="<?= admin_css_no?>font-awesome.min.css" rel="stylesheet" type="text/css" />        
        <link href="<?= admin_css_no?>ionicons.min.css" rel="stylesheet" type="text/css" />        
        <link href="<?= admin_css?>morris.css" rel="stylesheet" type="text/css" />        
        <link href="<?= admin_css?>jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />        
        <link href="<?= admin_css?>fullcalendar.css" rel="stylesheet" type="text/css" />        
        <link href="<?= admin_css?>daterangepicker-bs3.css" rel="stylesheet" type="text/css" />        
        <link href="<?= admin_css?>bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />        
        <link href="<?= admin_css?>AdminLTE.css" rel="stylesheet" type="text/css" />        
        <link href="<?= admin_css?>my_style_admin.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="<?= admin_css?>colorbox.css" />
        <link rel="stylesheet" href="<?= admin_css?>select2.css" />
        <link href="<?= admin_css?>custom.css" rel="stylesheet" type="text/css" />
		<link href="<?= admin_css?>summernote.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript">
            var configs = {
            base_url: '<?= base_url()?>',
            base_public: '<?= base_url()?>public/',
            admin_url:'<?= admin_url?>',
            admin_img:'<?= admin_img?>',
            base_js: '<?= base_url()?>public/backend/js/',
            admin_name: '<?=$this->uri->segment(1)?>',
            base_component: '<?=$this->uri->segment(2)?>',
            task:'<?= $this->uri->segment(3)?>',
            lang:'<?= $lang?>',
            page:'<?= $this->uri->segment(4)?>',
            curren_url: '<?= current_url();?>',
            }
        </script>
        <script src="<?= admin_js_no?>jquery.min.js"></script>
    
        <script type="text/javascript" src="<?= base_url()?>public/backend/js/maps.js"></script>
        <script src="<?= admin_js?>summernote.js" type="text/javascript"></script>
		<script>
			
		</script>
         
    </head>
       <body class="skin-blue">
        <header class="header">
            <a href="<?= admin_url?>" class="logo">
                  Admin Cpanel
            </a>
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <!--<ul class="nav navbar-nav ajLang"></ul>-->
                    <ul class="nav navbar-nav">                        
                        <!--<li class="dropdown messages-menu ajLoadBirthday"></li>
                        <li class="dropdown messages-menu ajLoadMailHead"></li>-->


                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user"></i>
                                <span><?= $s_info["s_user_username"]?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                
                                <li class="user-body">
                                    
                                    <div class="col-xs-4 text-center">
                                        <a href="<?= admin_url?>index/logout/" class="">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <aside class="left-side sidebar-offcanvas">
	<section class="sidebar"> 
		 
	  <ul class="sidebar-menu">
			<li class="treeview  ">
				<a><i class="fa fa-cogs"></i> <span>Cấu hình chung</span>   <i class="fa pull-right fa-angle-down"></i></a>
				<ul class=" treeview-menu  <?if(strpos(current_url() , 'config')) echo 'active';?>"  >
					 <li class=""><a href="<?=admin_url?>config/setting/" style="margin-left: 10px;">
						<i class="icon fa fa-chevron-right"></i> Thông tin chung</a>
					 </li>
					 <li class=""><a href="<?=admin_url?>config/contact/" style="margin-left: 10px;">
						<i class="icon fa fa-chevron-right"></i> Trang liên hệ</a>
					 </li>
					 
				 </ul>
			 </li>
			 <li style="display:none;"><a href="<?=admin_url?>menu/index"><i class="fa fa-bars" aria-hidden="true"></i> <span>Menu</span> </a></li>
			 <li class=""> <a href="<?=admin_url?>banner/?tpos=1"  ><i class="icon fa fa-info"></i>Slider</a> </li>
			 <li class=""> <a href="<?=admin_url?>banner/?tpos=2"  ><i class="icon fa fa-info"></i>Hình ảnh form đăng ký</a> </li>
			<li class=""><a href="<?=admin_url?>config/congdong/"  > <i class="icon fa fa-pencil-square-o"></i> Trang lớp học cộng đồng</a> </li>
			<li class="  "><a href="<?=admin_url?>news/index" "=""><i class="fa fa-pencil-square-o" title=""></i> <span>Bài viết ngoại ngữ</span></a></li>
			 <li class="  "><a href="<?=admin_url?>post/index" "=""><i class="fa fa-pencil-square-o" title=""></i> <span>Tin tức</span></a></li>
			 <li class="  "><a href="<?=admin_url?>document/index" "=""><i class="fa fa-file" title=""></i> <span> Kho tài liệu download </span></a></li> 
			 <li><a href="<?=admin_url?>video/index"><i class="fa fa-youtube-play" aria-hidden="true"></i> <span>Video</span> </a></li>
			 <li class="  "><a href="<?=admin_url?>mailto/index"><i class="fa fa-envelope" ></i> <span>Thông tin nhận tư vấn</span></a></li>
			 
			 <li class="treeview  <?if(strpos(current_url() , 'user')) echo 'active';?>"><a><i class="fa fa-user"></i> <span>User quản trị</span>  <i class="fa fa-angle-left pull-right"></i></a>
				 <ul class=" treeview-menu">
					<li class="  "><a href="<?=admin_url?>user/index/" style="margin-left: 10px;">
						<i class="icon fa fa-chevron-right"></i> Quản trị</a></li>
						 
				</ul>
			 </li>
			 <li class="treeview  <?if(strpos(current_url() , 'customer')) echo 'active';?>  "><a><i class="fa fa-user"></i> <span>User đăng ký các form</span>  <i class="fa fa-angle-left pull-right"></i></a>
				 <ul class=" treeview-menu">
					<li class="  "><a href="<?=admin_url?>customer/index/?class=1" style="margin-left: 10px;">
						<i class="icon fa fa-chevron-right"></i> Thi Xếp Lớp  </a>
					</li>
					<li class="  "><a href="<?=admin_url?>customer/index/?class=2" style="margin-left: 10px;">
						<i class="icon fa fa-chevron-right"></i> Thi thử đề thật  </a>
					</li>
					<li class="  "><a href="<?=admin_url?>customer/index/?class=3" style="margin-left: 10px;">
						<i class="icon fa fa-chevron-right"></i> Thi thật IDP  </a>
					</li>
					<li class="  "><a href="<?=admin_url?>customer/index/?class=4	" style="margin-left: 10px;">
						<i class="icon fa fa-chevron-right"></i> Lớp học cộng đồng  </a>
					</li>
				</ul>
			</li>
		</ul>		
	 
	
	</section>
            </aside>
