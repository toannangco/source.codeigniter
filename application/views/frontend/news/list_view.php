<div class="list-breadcrum">
	<div class="container" >
		<ul class="list-inline">
			 <li>  <a href="<?=base_url()?>">Trang chủ ></a>  </li>
            <?php if($menuInfo['menu_name']!=$title) { ?>
            <li> <a href="<?=base_url() . $menuInfo['menu_alias']?>.html"><?=$menuInfo['menu_name']?> ></a>  </li>
            <?php } ?>
            <li class="active"><a ><?=$title?> </a></li>
		</ul>
	</div>
</div>

 <div class="container" >
			<div class="col-study-step row " >
				<div class="heading yellow-l">
					<h3><a href="javascript:void(0)"><b>Chọn mục tiêu</b></a></h3>
				</div>
				<div class="bg-blue col-md-2 col-xs-12" style="background: transparent ;">
					<?php  $this->load->view('template/frontend/usercontrol/menu_ielts_online.php');?>
				</div>

			<div class="col-md-10 col-xs-12 pd0">
				<ul class="list_hot_post">
				 <?php
            if (!empty($list)) {
                foreach ($list as $key => $value) {
                    $picture = base_file . 'news/' . $value->news_picture;
                    $myMenu  = $this->mmenu->getInfoID($value->news_parent, $lang);
                    $link    = base_url . $myMenu['menu_alias'] . '/' . $value->news_lang_alias.'/';
                    ?>
					<li class="top_post_item col-md-3 col-sm-6 col-xs-6">
						<div class="frame">
							<a href="<?= $link?>"> <img title=" " class="img-responsive" alt=" " src="<?= $picture?>"> </a>
						</div>
						<h3><a class="title title_bold" href="<?= $link ?>" title="#"><?=$value->news_lang_name ;?></a></h3>
					</li>
					<?php
				}
			}else{
				echo 'Dữ liệu đang cập nhập  ';
			}
					?>  
						 			 
				</ul>
				 
					<div class="col-md-12 col-xs-12">
						<ul class="pagi list-inline text-center">
							 <?php echo $pagination; ?>
						</ul>
					</div>
				 
			</div>
			</div>
			</div>
 	<?php  $this->load->view('template/frontend/usercontrol/module_news.php');?>		
 