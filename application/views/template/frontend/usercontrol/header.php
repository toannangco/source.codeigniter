 
 <header>
<!--menu mobi-->
  <nav id="menu"  >
  <ul></ul>
</nav> 
<!--end menu mobi-->
<?php if($web['website_banner']) :?>
	<div  >
 	 
			 <img src="<?=base_file.'logo/'.$web['website_background']?>" class="img-responsive" style="margin-bottom:-1px;" >
					<h1 style="display:none">Ngoại ngữ đa minh official partner of idp việt nam</h1>
	 
		<a href="#" class="close-top" data-dismiss="alert">×</a>
	</div>
<?php endif ;?>
<div class="hot"  >
	<div class="container">
		<div class="row">  
			<div class="col-md-12 col-xs-12  ">
				 <ul class="list-inline pull-left info-hot">
					<li><i class="fa fa-phone"></i> Phòng đào tạo: <span><?=$web['website_phone']?></span> </li>
					<li><i class="fa fa-phone"></i> Hotline: 	 <span><?=$web['website_fax']?></span></li>
					<li><i class="fa fa-envelope"></i> Email: <?=$web['website_email']?></li>
				 </ul>
				
				<ul class="list-inline pull-right list-login" style="padding:0;">
				 
					<li>
					<form name="search" action="<?=base_url?>news/search" style="display: inline-table;">
						<div>
							<div id="search">
							<i class="fa fa-search trigger" aria-hidden="true"  style="float:right;margin-top:13px"></i> 
								<div class="search-bar" style="display:none;">
									<input name="fkey" type="text" id="ctl00_txtSearch" class="searchbox fkey" value="Search" onfocus="this.value=''"  style="color:#000;"/>           
									<button type="submit" class="btn dtn-info btn_search" >Tìm</button>
								</div>
							</div>
						 </div>		 
					</form>
					</li>
					<?php  if(!empty($s_member)) { ?>
					<li><i class="fa fa-user"></i>  <a  href="<?=base_url?>thanh-vien/"  ><?=$s_member['s_user_fullname']  ;?>  </a></li>
					<li>  <a href="<?=base_url?>user/logout/" > Logout </a></li>
					<?php }else {?>
					<li><a href="<?=base_url?>dang-ky-thanh-vien/">Đăng ký</a></li>
					<li> | </li>
					<li><a href="<?=base_url?>dang-nhap/">Đăng nhập</a></li>
					<?php }?>
					 
				</ul>
			</div>
		</div>
	</div>
</div>
<script type='text/javascript'>
   
</script>
<div class="menu-main">
	<div class="container">
		<div class="row ">
			 <div class="navbar navbar-default" role="navigation">
				  <div class="navbar-header">
						 
					<a class="navbar-brand" href="<?=base_url?>">
					  <img src="<?=base_file.'logo/'.$web['website_logo']?>" class="img-responsive">
					</a>
					<?php  if(!empty($s_member)) { ?>
					<span class=" aaa hidden-md hidden-lg hidden-sm"><i class="fa fa-user"></i>  <a  href="<?=base_url?>thanh-vien/"  ><?=$s_member['s_user_fullname']  ;?>  | </a></span>
					<span class="bbb hidden-md hidden-lg hidden-sm">  <a href="<?=base_url?>user/logout/" > Logout </a></span>
					<?php }else {?>
					<span class="loginmb"> <a href="<?=base_url?>dang-ky-thanh-vien/">Đăng ký  </a></span>
					<span class="resmb"><a href="<?=base_url?>dang-nhap/">Đăng nhập |</a></span>
					<?}?>
					 <a id="menu-button" href="#menu"  class="fa fa-bars" ></a>
				  </div>
				  <div class="navbar-collapse collapse menu">
						<ul class="nav navbar-nav dropDownMenu"> 
						  <?php 
							 if (!empty($menuTop)){
								foreach ($menuTop as $key => $value) {
									$link = base_url() . $value['menu_alias'] . '/';
									if ($value['menu_com'] == 'home') {
										$link = base_url();
									}
									$string  = ''; $down = '';  
									if(count($value['sub']>0)){
										foreach($value['sub'] as $k=>$val){
											$link_sub = base_url(). $val['menu_alias'] . '/';
											$string .= '<li class="level2"><a   href="' . $link_sub . '">'  . strip_tags($val['menu_name']) .  '</a>';
											if(count($val['sub2'])){
												$string .= '<ul class="level3">';
												foreach($val['sub2']  as $khoa => $giatri  )
												{
													$string .= '<li class="vl3">  <a  href="'.base_url.$giatri['menu_alias'].'/"> '.$giatri['menu_name'].' </a>  </li>';
												}
												$string .= '</ul>';
											}
											echo '</li>';
										}
									}
									 $active = $value['menu_alias'] == $menuInfo['menu_alias'] || $menuInfo['menu_parent'] == $value['id'] ? 'active' : '';
									echo '<li class=" sub ">'  ;
									echo '<a class="sub-a"  href="' . $link . '">'  . strip_tags($value['menu_name']) .  '</a>';
									if($string){
										echo '<ul class="drop" >  '. $string .' </ul>';
									}
									echo '</li>';  
								}
							}
							?> 
						</ul>
					</div>
			</div><!--/.nav-collapse -->
		</div>
	</div>
</div> 
</header>
<section class="main">

<script>
$(document).ready(function() {
    $('#search .trigger').click(function(){
        $('.search-bar').animate({width: 'toggle'},1500);
    });
});
</script>
 
