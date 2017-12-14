<!DOCTYPE html>
<html lang="vn">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= strip_tags($title) ?> » <?=company?></title>
    <meta name="description" content="<?= strip_tags($description); ?>"/>
    <meta name="keywords" content="<?= strip_tags($keywords);?>"/>
    <link rel="shortcut icon" href="<?= base_url()?>favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?= base_url()?>favicon.ico" type="image/x-icon">
    <meta property="og:image" content="<?= trim($picture);?>"/>
    <meta property="og:title" content="<?= strip_tags($title)?>"/>
    <meta property="og:site_name" content="<?= company;?>"/>
    <meta property="og:url" content="<?= current_url()?>"/>
    <meta property="og:description" content="<?= strip_tags($description); ?>" />
    <meta property="og:type" content="website" />
	<link rel="stylesheet" type="text/css" href="<?=base_css?>bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_css?>font-awesome.min.css">		
	<link rel="stylesheet" type="text/css" href="<?=base_css?>head.menu.css">
	<link rel="stylesheet" type="text/css" href="<?=base_css?>jquery.mmenu.all.css">		
	<link rel="stylesheet" type="text/css" href="<?=base_css?>style.css">
	<script type='text/javascript' src="<?=base_js?>jquery.min.js"></script>
	<style>header{margin-top: -21px;}</style>
</head>
<body  > 
<div id="page">
	<?php  $this->load->view('template/frontend/usercontrol/header.php');?>	


	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		<?php if(!empty($slider)){ 
			foreach($slider as $k=>$v){
				$active = $k==0? 'active' : '';
			//	 $strlinkslide .='<li data-target="#myCarousel" data-slide-to="'.$k.'" class="'.$active.'"></li>';
				$strslide .='<div class="item '.$active.'"> <img src="'.base_file."banner/".$v->banner_picture.'" alt=""> </div>';
			}
		}?>
		<ol class="carousel-indicators">  <?//= $strlinkslide?> </ol>
		<div class="carousel-inner">  <?= $strslide?>  </div> 
	</div>
 
	 <div class=" dangky ">
		<div class=" container">
			<div class="row">  
			<?php 
			if(!empty($banner_register)){
				$class = 1 ;
				foreach($banner_register as $k=>$v){
				if($v->banner_link) $link = $v->banner_link.'?class='.$class.'&redirect='.base64_encode(base_url.'thanh-vien/form-dang-ky/?class='.$class.'').'' ; else $link = "#";
			?>
				<div class="col-md-3 col-xs-6 style_prevu_kit  show_<?=$class?>" > <!-- wow animated fadeIn animated   data-wow-delay="0.2s"-->
					<a href="<?=$link;?>"><img src="<?php echo base_file.'banner/'.$v->banner_picture?>" class="img-responsive" ></a>
				</div>
					<?php 
					$class++ ;
				}
			}?>
			</div>
		</div>
	 </div>
	<script>
	if($( window ).width() <= 768){
		var a = $('.dangky>div>.row>.col-xs-6');
            $(a).hide();
            $(a[0]).show();$(a[1]).show();
            var i = 1;
            setInterval(function () {
                $(a).hide();
                $(a[i]).show(); $(a[i+1]).show();
                ++i;
                if (i >= 2) i = 0;
            }, 3300);
	}
	</script>
	<div class="video">
		<div class="container">
			<div class="row">
				<h2>Video bí quyết học Ielts đột phá 	</h2>
				<div class="carousel slide multi-item-carousel" id="theCarousel">
					 <div class="carousel-inner">
					 	<?php 
						if(!empty($video)){  
						$j = 0 ;
						$link_goc = 'http://www.youtube.com/embed/';
						foreach($video as $k=>$v){
								$LK1 = explode("=", $v['video_link']);
								$ls1 = $LK1[1];
								$LK2 = explode("&", $ls1);
								 
						?>
							<div class="item <?php if(!$j) echo 'active';?> ">
								<div class="col-lg-3 col-md-3  col-xs-6"> 
									<div class="embed-responsive embed-responsive-4by3" id="video_return">
										 <iframe class="embed-responsive-item" src="<?=$link_goc . $LK2[0];?>"></iframe>
									 </div>
									<h6 class="namevideo"><?=$v['video_name']?></h6>
								</div>
							 </div>
							<?php $j++; }
						}?>
					 </div>
				 <a class="left carousel-control" href="#theCarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
				 <a class="right carousel-control" href="#theCarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
		
				</div>
			</div>
		</div>
	</div> 
	
	<?php
	$background = array('#ffcc00', '##00a54f' , '#ed1b24' , '#ffcc00' , '#2e2f82'  ) ; $i=0;  
	if(!empty($list_online)){ 
		
		foreach($list_online as $key=>$value) {	
		
	?>
			 
	<div class="container" >
		 
		<div class="col-study-step row " >
			<div class="heading blue-l">
				<h3><a href="javascript:void(0)"><b> <?php echo $value['menu_name']?> </b></a></h3>
			</div>
			<div class="bg-blue col-md-2 col-xs-12" style="background: <?php echo $background[$i]; ?>">
			<ul class="menu-step">
				<h2 class="txt-blue">Chọn mục tiêu</h2>
				<?php if(count($value['sub'])) :?> 
					<?php foreach(  $value['sub'] as $k=>$v  ) :?>
						<li><a href="<?=base_url.$v['menu_alias'].'/' ;?>" title="<?php echo $v['menu_name']?>"><i class="fa fa-chevron-circle-right"></i> <?php echo $v['menu_name']?></a></li>
					<?php  endforeach; ?>
				<?php  endif; ?>
			</ul>
			</div>

			<div class="col-md-10 col-xs-12 pd0">
			<?php 
				if(count($value['posts'])) : 
				
			?>
				<ul class="list_hot_post">
					<?php 
						foreach($value['posts'] as $k=>$v ) : 
						$picture = base_file.'news/'.$v->news_picture ;
					    $link = base_url.$value['menu_alias'].'/'.$v->news_lang_alias.'/' ;
					?>
						<li class="top_post_item col-md-3 col-sm-6 col-xs-6">
							<div class="frame">
								<a href="<?=$link?>"> <img title="<?php echo $v->news_lang_name ;?> " class="img-responsive" alt=" " src="<?php echo $picture ;?>"> </a>
							</div>
							<h3><a class="title title_bold" href="<?=$link?>" title="<?php echo $v->news_lang_name ;?>"> <?php echo $v->news_lang_name ;?> </a></h3>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif;?>
			</div>
		</div>
	</div>
			<?php 
		$i++ ; }
	}?>		
	 
		<?php  $this->load->view('template/frontend/usercontrol/module_news.php');?>
		<?php  $this->load->view('template/frontend/usercontrol/mail_news.php');?>				
		<?php  $this->load->view('template/frontend/usercontrol/footer.php');?>	
	</div>	
</body>
</html>
			 