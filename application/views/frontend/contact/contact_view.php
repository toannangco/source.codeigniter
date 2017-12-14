 <style> #page{margin-top:-21px;}.form-control{margin-bottom:10px}iframe{max-width: 100%;width:100%;} </style>
 <div class="list-breadcrum">
	<div class="container" >
		<ul class="list-inline">
			 <li>  <a href="<?=base_url()?>">Trang chủ ></a>  </li>
           <li class="active"><a ><?=$title?> </a></li>
		</ul>
	</div>
</div>
		<div class="container" style="background:#fff">
			<div class="col-md-12 col-xs-12">
				<h4 class="text-center"> Thông tin liên hệ </h4>
				<?=$website_contact_detail?>
			
				<?=$map?>
			</div>
<?if($_REQUEST['test']):?>
			<div class="col-md-6 col-xs-12">
				 <div class="col-xs-12 fromcontact"  >
				 <h4 class="text-center"> Lời nhắn </h4>
		    	   <form method="post">
						<?php if(strlen($err['error']) > 5 ) { ?>
								<div class="alert alert-danger">
							  <strong>Chú ý!</strong> <?=$err['error']?>
							</div>
							<?php  } ?>
						 <?php if(strlen($sucess) > 5 ) { ?>
								<div class="alert alert-info">
							  <strong>Chú ý!</strong> <?=$sucess?>
							</div>
							<?php  } ?>
						<input name="name" type="text" value="<?=$name?>" class="form-control" placeholder="Họ Tên">
						
						<input name="adress" type="text" value="<?=$adress?>" class="form-control" placeholder="Địa chỉ">
						<input name="phone"  type="text" value="<?=$phone?>" class="form-control" placeholder="Số điện thoại">
						
						<input name="email" type="text" value="<?=$email?>" class="form-control" placeholder="Email">
						<input name="titlecontact" type="text" value="<?=$titlecontact?>" class="form-control" placeholder="Tiêu đề">
						
						
						<textarea name="content" rows="5" class="form-control" placeholder="Nội dung"><?=$content?></textarea>
						<br>
						<button name="fsubmit" type="submit" class="btn btn-danger">Gởi liên hệ</button>
						<button type="reset" class="btn btn-danger">Nhập lại</button>
				   </form>
		   </div>
			</div> 
			
<? endif;?>
		</div>
 