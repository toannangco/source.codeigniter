<div class="list-breadcrum">
	<div class="container" >
		<ul class="list-inline">
			 <li>  <a href="<?=base_url()?>">Trang chủ ></a>  </li>
            <?php if($menuInfo['menu_name']!=$title) { ?>
            <li> <a href="<?=base_url() . $menuInfo['menu_alias']?>/"><?=$menuInfo['menu_name']?> ></a>  </li>
            <?php } ?>
            <li class="active"><a ><?=$title?> </a></li>
		</ul>
	</div>
</div>
<div class="container" >
<div class="col-study-step row " >
	 
 <?//p($info)?>
	<!--Detail-->
		<div class="col-md-12 col-xs-12 pd0">
			<div id="content">
				<h3 class="title">[<?=$menuInfo['menu_name']?>] - <?= $info->post_lang_name ; ?></h3>
				<div class="tag">
					<!--<i class="fa fa-tags" aria-hidden="true"></i> Tags:-->
					<i class="fa fa-calendar-o" aria-hidden="true"></i>  <?=!empty($info->post_update_date) ? '<i>' . $info->post_update_date . '</i>' : '';?>    
				</div>
				<div class="description " >
					<p>   <?=!empty($info->post_lang_summary) ? '<i>' . $info->post_lang_summary . '</i>' : '';?>   </p>
				</div>
				<div >
				   <?=!empty($info->post_lang_detail) ? $info->post_lang_detail : '';?>
				</div>
			</div>
		</div>
	<!-- end Detail-->
	</div>
	<div class="row">
		<div class="col-md-12 col--12">
		<!----bình luận facebook plugin---->
			<div id="fb-root"></div>
			<script>
				(function(d, s, id) {
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) return;
					js = d.createElement(s); js.id = id;
					js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.5";
					fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));
			</script>
			<div class="fb-comments" data-href="https://www.facebook.com/vuongquocanhngu.edu.vn/" data-width="100%" data-numposts="5" data-colorscheme="light"></div>
			<div class="clear"></div>
			<!--end bình luận-->
		</div>
	</div>
</div>
 
 