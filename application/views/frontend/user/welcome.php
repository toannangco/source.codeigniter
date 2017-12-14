 
<link rel="stylesheet" type="text/css" href="<?=base_css?>user.css">
<div class="list-breadcrum" >
<div class="container" >
	<ul class="list-inline">
		 <li>  <a href="<?=base_url()?>">Trang chủ ></a>  </li>
		 <li> <a  >Thành viên </a>  </li>
	  
	</ul>
</div>
</div>
<main id="content" class="content">
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
                <div class="  text-center ">
                    <div class="alert alert-success">
                        Welcome member: <b> <?= $s_member['s_user_username']?></b>
						
                    </div>
					<div >
		<form method="post" action="" class="form-horizontal" role="form" >
							<h3 class="text-center">Thông tin cá nhân</h3>
							<div class="form-group">
                    <label for="firstName" class="col-sm-3 col-xs-12 control-label text-left">Full Name</label>
                    <div class="col-sm-9">
                        <input type="text" id="firstName" placeholder="Full Name" class="form-control" value="<?=$s_member['s_user_fullname']?>"  readonly>
                       
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 col-xs-12 control-label text-left">Email</label>
                    <div class="col-sm-9">
                        <input type="email" id="email" placeholder="Email" value="<?=$s_member['s_user_email']?>" class="form-control" readonly>
                    </div>
                </div>
				 <div class="form-group">
                    <label for="email" class="col-sm-3  col-xs-12 control-label text-left">Phone</label>
                    <div class="col-sm-9">
                        <input type="text" id="email" placeholder="Phone" value="<?=$s_member['s_user_phone']?>" class="form-control" readonly >
                    </div>
                </div>
				 <div class="form-group">
                    <label for="email" class="col-sm-3 col-xs-12 control-label text-left">Địa chỉ</label>
                    <div class="col-sm-9">
                        <input type="text" id="email" placeholder="Address" value="<?=$s_member['s_user_address']?>" class="form-control" readonly >
                    </div>
                </div>
				  
                  
                <div class="form-group">
                    <label for="birthDate" class="col-sm-3 col-xs-12 control-label text-left ">Date of Birth</label>
                    <div class="col-sm-9">
                        <input type="date" id="birthDate" class="form-control" value="<?=$s_member['user_birthday']?>" readonly >
                    </div>
                </div><!--
                <div class="form-group">
                    <label class="control-label col-sm-3">Gender</label>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="radio-inline">
                                    <input type="radio" id="femaleRadio" value="0"  <?if($s_member['user_birthday']==0) echo 'checked'; ?>  >Female
                                </label>
                            </div>
                            <div class="col-sm-4">
                                <label class="radio-inline">
                                    <input type="radio" id="maleRadio" value="1"  <?if($s_member['user_birthday']==1) echo 'checked'; ?>>Male
                                </label>
                            </div>
                            
                        </div> 
                    </div>  
                </div>  .form-group -->
                
                 
             <!--   <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <button type="submit" class="btn btn-primary btn-block">Edit</button>
                    </div>
                </div> -->
						</form>
					</div>
                </div>
            </div>
        </div>
    </div>
</main>
