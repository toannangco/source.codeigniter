 <?php
	$post = $this->mpost->getPost() ;
		if(!empty($post)){
			foreach( $post as $k=>$v ) {
				$myMenu  = $this->mmenu->getInfoID( $v->post_parent , 'vn');
				$link    = base_url . $myMenu['menu_alias'] . '/' . $v->post_lang_alias.'/';
				$v->post_lang_alias = $link ;
				if($v->post_parent ==36 ){
					$list_tintuc[$k] = $v ; 
				 }else {
					 $list_phuongphap[$k] = $v ; 
				} 
			}
		}
 ?>
 
 <div class="phuongphap container">
				<div class="row col-study-step" >
					 <div class="heading  ">
						<h3><a href="#"><b>Phương pháp học ielts siêu cấp - bí quyết - bí mật - giải đáp thắt mắt về ielts</b></a></h3>
					</div>
					<?php if(!empty($list_phuongphap)):  ?>
						<?php foreach($list_phuongphap as $k=>$v):?>
							<?php
								 
							?>
							<div class="col-md-6 col-xs-12 pd10"> 
								<div class="item-pp">
									<img src="<?php echo base_file.'post/'.$v->post_picture ;   ?>" class="img-responsive">
									<h4> <a href="<?php echo $v->post_lang_alias ; ?>" title="">  <?php echo $v->post_lang_name ; ?> </a> </h4>
									<div class="des">   <?php echo $v->post_lang_summary ; ?> </div>
								</div>
							</div>
						<?php endforeach; ?>
					<?php endif ;?>
				</div>
			</div>
			