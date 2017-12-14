 <link  rel="stylesheet" type="text/css" href="<?=base_css?>document.css">
<div class="list-breadcrum" style="margin-top: -21px;">
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
	<!--
		<div class="col-md-8 col-xs-12">
			<?php if(!empty($list)) {  ?>
				<?php 
					foreach($list as $k=>$v) {
						$myMenu  = $this->mmenu->getInfoID($v['document_parent'],$lang);
						$link    = base_url . $myMenu['menu_alias'] . '/' . $v['document_name_alias'].'/';
				?>
					<div class="col-md-12 col-xs-12">
						<div class="thumbnail-news">
							<figure class="col-md-6 col-xs-6"><img src="<?php echo base_file.'document/'.$v['document_picture']?> " class="img-responsive" ></figure>
							<div class="caption col-md-6 col-xs-6">
								<h3><a href="<?=$link;?>" title="<?=$v['document_name']?>"><?=$v['document_name']?></a></h3>
								<p class="date"><i class="fa fa-clock-o"></i> <?=$v['document_dateadd']?></p>
								<p><?=$v['document_summary']?></p>
							</div>
						</div>
					</div>
				<?php } ?>
			<?php }else{
				echo 'Dữ liệu đang cập nhập';
			}?>
		</div>
		<div class="col-md-4 col-xs-12">
			<div class="sidebar-block" style="padding-top:10px;">
				<div class="title-header-bl"><h2>Kho học liệu download</h2><span><i class="fa fa-angle-right arow"></i></span></div>
				
				<ul class="menuSub">
					 <?php // $this->mmenu->dropChild( "document",31,"" ); ?>
				 </ul>
			</div>
		</div>
		-->
		<div class="heading yellow-l">
					<h3><a href="javascript:void(0)"><b>Chọn mục tiêu</b></a></h3>
				</div>
				<div class="bg-blue col-md-2 col-xs-12" style="background: transparent ;">
					<?php  $this->load->view('template/frontend/usercontrol/menu_ielts_online.php');?>
				</div>
				<div class="col-md-10 col-xs-12  " id="list-teacher" >
                    <div class="row">
					<?php if(!empty($list)) {  ?>
				<?php 
					foreach($list as $k=>$v) {
						$myMenu  = $this->mmenu->getInfoID($v['document_parent'],$lang);
						$link    = base_url . $myMenu['menu_alias'] . '/' . $v['document_name_alias'].'/';
				?>
						<div class="col-md-6 col-xs-12">
                            <div class="item-learn">
                               
                                <div class="col-md-6 col-xs-6">
								<a href="<?=$link?>">
                                    <img src="<?php echo base_file.'document/'.$v['document_picture']?>" class="img-responsive" style="padding:5px;" />
                                  </a>   
                                </div>
                                <div class="col-md-6 col-xs-6 info">
                                    <p class="date"><?=$v['document_added']?></p>
                                    <p class="name-teacher"><a href="<?=$link?>"><?=$v['document_name']?></a></p>
                                    <p class="des" ><?=$v['document_summary']?>  </p>
                                </div>
                              
                            </div>
                        </div>
						<?
					}}else{
						echo 'Dữ liệu đang cập nhập';
					}
						?>
					</div>
				</div>
		
	</div>
	
	
	
	<div class="row">
	<ul class="pagi list-inline text-center">
			 <?php echo $pagination; ?>
		</ul>
	</div>
</div>