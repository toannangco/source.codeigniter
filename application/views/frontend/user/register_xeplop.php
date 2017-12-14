<div class="list-breadcrum" style="margin-top:-20px;">
<div class="container" >
	<ul class="list-inline">
		 <li>  <a href="<?=base_url()?>">Trang chủ ></a>  </li>
		 <li> <a href="<?=base_url() . 'thanh-vien'?>">Thành viên ></a>  </li>
	   <li class="active"><a ><?=$title?> </a></li>
	   <?if(!empty($type)){?>
	    <li class=""><a ><?=$type?> </a></li>
	   <?}?>
	</ul>
</div>
</div>
<?php

 //p($s_member) ;
?>

<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3 col-xs-12">
		<?php if(!empty($success['addclass'])) {?>  
		<div class="alert alert-success"> <?php echo $success['addclass'] ; ?> </div>
		<?php }else{?>
            <form  method="post" action="" class="form-horizontal" role="form" style=" margin: 20px 0;">
               
                <div class="form-group">
                    <label for="firstName" class="col-sm-3 control-label">Họ tên</label>
                    <div class="col-sm-9">
                        <input type="text" id="firstName" placeholder="Full Name" class="form-control" value="<?=$s_member['s_user_fullname']?>"  readonly>
                       
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-9">
                        <input type="email" id="email" placeholder="Email" value="<?=$s_member['s_user_email']?>" class="form-control" readonly>
                    </div>
                </div>
				 <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Điện thoại</label>
                    <div class="col-sm-9">
                        <input type="text" id="email" placeholder="Email" value="<?=$s_member['s_user_phone']?>" class="form-control"  >
                    </div>
                </div>
				<div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Tỉnh/ TP</label>
                    <div class="col-sm-9">
                        <select name="user_tinhthanh"  class="form-control user_tinhthanh"  >
							<option value= > Chọn Tỉnh TP</option>
							<?php foreach($city as $k=>$v) :?>
							<option value=<?=$v['id']?> <?php  if($s_member['s_user_tinhthanh'] == $v['id'] )  echo 'selected'; ?> > <?=$v['name']?></option>
							<?php endforeach; ?>
						</select>
                    </div>
                </div>
				<div class="form-group">  
                    <label for="email" class="col-sm-3 control-label">Quận huyện</label>
                    <div class="col-sm-9"> 
                        <select name="user_quan"  class="form-control user_quan"   >
							<?php if($s_member['s_user_quan']!=0) : ?>
								<?php foreach($getWardall as $k=>$v) :?>
									<option value=<?=$v['id']?>  <?php  if($v['id']==$s_member['s_user_quan']) echo 'selected'; ?>  >  <?=$v['name']?>  </option>
								<?php endforeach ; ?>
							<?php endif ;?>
							<option value= > Chọn quận huyện</option>
						</select>
                    </div>
                </div> 
				
				<div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Công việc hiện tại</label>
                    <div class="col-sm-9">
                        <select name="user_work"  class="form-control  "   >
							<option value=0  > Chọn    </option>
							<option value=1 <?php if($s_member['s_user_work']==1) echo 'selected'; ?> > Sinh viên  </option>
							<option value=2  <?php if($s_member['s_user_work']==2) echo 'selected'; ?> > Đang tìm việc </option>
							<option value=3	 <?php if($s_member['s_user_work']==3) echo 'selected'; ?> > Đã đi làm  </option>
						</select>
                    </div>
                </div> 
                  
                <div class="form-group">
                    <label for="birthDate" class="col-sm-3 control-label"> Birthday</label>
                    <div class="col-sm-9">
                        <input type="text" id="birthDate" class="form-control" name="user_birthday" value="<?=$s_member['s_user_birthday']?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Gender</label>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="radio-inline">
                                    <input type="radio"  name="user_gender"  value="0"  <?if($s_member['user_birthday']==0) echo 'checked'; ?>  >Female
                                </label>
                            </div>
                            <div class="col-sm-4">
                                <label class="radio-inline">
                                    <input type="radio"  name="user_gender" value="1"  <?if($s_member['user_birthday']==1) echo 'checked'; ?>>Male
                                </label>
                            </div>
                            
                        </div> 
                    </div>
                </div> <!-- /.form-group -->
                 <div class="form-group hide">
                    <label class="control-label col-sm-3">Loại đăng ký</label>
                    <div class="col-sm-9"> 
						<select name=" " class="form-control"   disabled >
						<?php foreach($class_type as $k=>$v):?>
							<option value=<?=$k?>  <?if($_GET['class']==$k) echo 'selected'; else "disabled" ;?> > <?=$v?> </option>
						<?php endforeach ;?>
						</select>
						<input type="hidden" name="class_type" value="<?=str_replace('/','',$_GET['class']);?>" />
						<input type="hidden" name="class_type_orther" value="<?= $_REQUEST['type'];?>" />
					</div>
				</div>
                 
                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <button type="submit" class="btn btn-primary btn-block" name="fclass"  >Đăng ký lớp</button>
                    </div>
                </div>
            </form> <!-- /form -->
		<?php } ; ?>
			</div>
			</div>
        </div> <!-- ./container -->
<style>.alert-success{margin-top:50px;}</style>
<link rel="stylesheet" type="text/css" href="<?=base_css?>user.css">		
<style> .form-group {margin-bottom:17px;} </style>
<script type="text/javascript">
  jQuery('.user_tinhthanh').change(function(){  
	var id_city = $(this).find(":selected").val() ;
	 
			$.ajax({  
				url: "<?php echo base_url?>user/getWard", type:"POST",
                data:{"id_city": id_city  },
          
            }).done(function( data ) {
					console.log(data) ;
				  $('.user_quan').html(data) ;
				});  
				 
        });
 </script>
 