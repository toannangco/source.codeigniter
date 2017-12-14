<div class="news">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-xs-12">
					<form action="" method="post" name="fmail" class="form " >
						<h6>Đăng ký tư vấn</h6>
						<div class="col-md-12 col-xs-12">
							<p><span class="errname text-center" style="color:red;" > </span></p>
							<p><span class="errphone text-center" style="color:red;" > </span></p>
							<p><span class="erremail text-center" style="color:red;" > </span></p>
						</div>
						<div class="col-md-4  col-xs-12">
							<div class="form-group ">
								<input class="form-control mailto_fullname" type="text" name="mailto_fullname" placeholder="Họ và tên" />
								
							</div>
						</div>
						<div class="col-md-4  col-xs-12">
							<div class="form-group">
								<input class="form-control mailto_phone" type="text" name="mailto_phone" placeholder="Số điện thoại" />
							</div>
						</div>
						<div class="col-md-4  col-xs-12">
							<div class="form-group">
								<input class="form-control mailto_email" type="email" name="mailto_email" placeholder="Email" required  /> <!---->
							</div>
						</div>
					 
						<div class="col-md-4  col-xs-12">
							<div class="form-group">
								<select class="form-control mailto_city"   name="mailto_city" >
									<option value=0> Chọn Tỉnh/ TP </option>
									<?php foreach($allCity as $k=>$v)  :?>
									<option value=<?=$v['id']?>> <?=$v['name']?> </option>
									<?php endforeach ; ?>
								</select>
							</div>
						</div>
						<div class="col-md-4  col-xs-12">
							<div class="form-group">
								<select class="form-control user_quan"   name="mailto_ward" >
									<option value=0> Chọn quận   </option>
									 
								</select>
							</div>
						</div>
						<div class="col-md-4  col-xs-12">
							<div class="form-group">
								 
								<input class="form-control" name="mailto_work" placeholder="Công việc hiện tại"  />
							</div>
						</div>
						<div class="col-md-12  col-xs-12">
							<div class="form-group">
								<textarea class="form-control" name="mailto_content" placeholder="Lời nhắn" > </textarea> 
							</div>
						</div>
						<div class="col-md-12  col-xs-12">
							<div class="form-group">
								<button class="btn btn-lg btn-danger pull-right" type=submit name=fmail   style="background:#ed1b24;color:#fff" > Đăng ký </button>
							</div>
						</div>
					</form>
				</div>
				<div class="col-md-6 col-xs-12">
					<div class="row">
					<div class="item-news">
						<h6>Tin tức hoạt động </h6>
						<div class="col-md-12 col-xs-12">
						<?php
							if(!empty($list_tintuc)){
								foreach($list_tintuc as $k=>$v) {
						?>
								<div class="row mr10">
									<div class="col-md-4 col-xs-5">
										<a href="#" title=""> <img src="<?php echo base_file.'post/'.$v->post_picture ;   ?>" class="img-responsive " alt=""  > </a>
									</div>
									<div class="col-md-8 col-xs-7">
										<h6 class="title-news"> <a href=" <?php echo $v->post_lang_alias ; ?>"  alt="<?php echo $v->post_lang_name ; ?> " >  <?php echo $v->post_lang_name ; ?> </a> </h6>
										<p class="info-des">
											 <?php echo $v->post_lang_summary ; ?>
										</p>
									</div>
								</div>
								<?php
								}
							}
							?> 
						</div>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">

 </script>