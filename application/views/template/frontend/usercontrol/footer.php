</section>
	<footer id="footer">
			<div class="container">
				<div class="row">
					<div class="col-md-5 col-sm-6 col-xs-12 info">
						<div class="col-md-6 col-xs-6">
							<img src="<?=base_file.'logo/'.$web['website_logo']?>" class="img-responsive">
						</div>
						<div class="col-md-6 col-xs-6">
							<h2>Ielts Dominic</h2>
						</div>
						<div class="col-md-12 col-xs-12 contact-f">  <?//p($web);?>
						<!--
							<p> <i class="fa fa-map-marker" aria-hidden="true"></i>  <strong> Địa chỉ:</strong> 79 Nguyễn Oanh, Phường 10, Quận Gò Vấp, Tp. Hồ Chí Minh </p>
							<p> <i class="fa fa-phone" aria-hidden="true"></i><strong> Hotline: </strong>  
								<span>Phòng đào tạo: <b>0283 951 619</b></span><br>
								<span class="hotline-f" >Hotline: <b>0283 951 619</b></span>
							</p>
							<p><i class="fa fa-envelope" aria-hidden="true"></i> <strong>Email:</strong> ieltsdaminh.phongdaotao@gmail.com </p>
							<p> <i class="fa fa-globe" aria-hidden="true"></i>  <strong>Website:</strong> ieltsdaminh.edu.vn  </p>
							-->
							<?//p($web)?>
							<?=$web['website_footer_left'];?>
							<ul class="list-inline" >
								<li><a href="#"><img src="<?=base_images?>facebook.png"></a></li>
								<li><a href="#"><img src="<?=base_images?>google.png"></a></li>
								<li><a href="#"><img src="<?=base_images?>twicer.png"></a></li>
								<li><a href="#"><img src="<?=base_images?>youtube.png"></a></li>
							</ul>
						</div>
					</div>
					<div class="col-md-3 col-xs-12 ">
						<div class="support-f" >
							<h5>Thông tin hỗ trợ</h5>
							<ul>
							<?php
								 if (!empty($menuTop)){
								foreach ($menuTop as $key => $value) {
									$link = base_url() . $value['menu_alias'] . '/';
									if ($value['menu_com'] == 'home') {
										$link = base_url();
									}
							?>
								<li><a href="<?=$link;?>"><?=strip_tags($value['menu_name'])?></a></li>
								 <?php }}?>
							</ul>
						</div>
					</div>
					<div class="col-md-4 col-xs-12">
						<div class="support-f" > 
						<h5>Fanpage</h5>
						<div id="fb-root"></div>
							 
							 <!--<div class="fb-like-box" data-href="<?=$web['website_page']?>"  data-height="300" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>-->
							 <div class="fb-like-box fb_iframe_widget" data-href="https://www.facebook.com/ieltsdaminh/" data-height="300" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true" fb-xfbml-state="rendered" fb-iframe-plugin-query="app_id=1372650639511833&amp;color_scheme=light&amp;container_width=360&amp;header=true&amp;height=300&amp;href=https%3A%2F%2Fwww.facebook.com%2Fieltsdaminh%2F&amp;locale=en_US&amp;sdk=joey&amp;show_border=true&amp;show_faces=true&amp;stream=false"><span style="vertical-align: bottom; width: 300px; height: 214px;"><iframe name="f2cf2bc8851abc" width="1000px" height="300px" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" title="fb:like_box Facebook Social Plugin" src="https://www.facebook.com/v2.11/plugins/like_box.php?app_id=1372650639511833&amp;channel=http%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter%2Fr%2FlY4eZXm_YWu.js%3Fversion%3D42%23cb%3Df15e2ad1e29fb18%26domain%3Dhocvaluyenthiielts.com%26origin%3Dhttp%253A%252F%252Fhocvaluyenthiielts.com%252Ff1d6fbbe1611f8%26relation%3Dparent.parent&amp;color_scheme=light&amp;container_width=360&amp;header=true&amp;height=300&amp;href=https%3A%2F%2Fwww.facebook.com%2Fieltsdaminh%2F&amp;locale=en_US&amp;sdk=joey&amp;show_border=true&amp;show_faces=true&amp;stream=false" style="border: none; visibility: visible; width: 300px; height: 214px;" class=""></iframe></span></div>
						
					
						</div>
					</div> 
			</div>
		</footer>
		<!-----fix resgister----->
		<div class="pnright">
			<div class="mitem yellow">
			<?
			$link1 = base_url.'thanh-vien/form-dang-ky/?class=1&redirect='.base64_encode(base_url.'thanh-vien/form-dang-ky/?class=1').'' ;
			$link3 = base_url.'thanh-vien/form-dang-ky/?class=3&redirect='.base64_encode(base_url.'thanh-vien/form-dang-ky/?class=3').'' ;
			?>
                <a title="LỊCH KHAI GIẢNG" href="<?=$link1?>">
                    <div><i class="fa fa-calendar-o" aria-hidden="true"></i></div>
                    <div>Lịch khai giảng - Quà tặng khủng</div>
                </a>
            </div>
			<div class="mitem red">
                <a title="ĐK THI THỬ IELTS MIỄN PHÍ" href="<?=$link3?>">
                    <div><i class="fa fa-pencil-square-o" aria-hidden="true"></i></div>
                    <div>Đăng ký thi - Nhận quà - Giảm lệ phí</div>
                </a>
            </div>
		</div>
		<!---end fix resgister--->
	</div>
	
	<script type='text/javascript' src="<?=base_js?>wow.min.js"></script>
	<script type='text/javascript' src="<?=base_js?>bootstrap.min.js"></script>
	<script type='text/javascript' src="<?=base_js?>jquery.mmenu.min.all.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
	<script  src="<?=base_js?>/app.js"> </script>
	<script>
	<!--new WOW().init();-->
	</script>  
	<script>
	 
		 
		$('#birthDate').datepicker({
			format: 'mm-dd-yyyy',
			todayHighlight: true,
			autoclose: true,
		});
			$(window).scroll(function() {
		if($(window).scrollTop() > 100) {
		$('#top').fadeIn();
		} else {
		$('#top').fadeOut();
		}
	});
	$('#top').click(function() {
	$('html, body').animate({scrollTop:0},300);
	});	 
	 
	</script>
	<a class="cd-top " id="top"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
	