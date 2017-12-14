
<?php echo form_open();?>
<aside class="right-side">
<section class="content-header">
    <h1>
        <small><?= $title ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= admin_url ?>home/"><i class="fa fa-dashboard"></i> <?= trang_chu ?></a></li>
        <li><a href="<?= admin_url ?>user/"><?= danh_sach ?> User</a></li>
        <li class="active"><?= $title ?></li>
    </ol>
</section>
<section class="content">
<div class="row">
<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header">
            <i class="fa fa-info-circle"></i>
            <h3 class="box-title"><?= tai_khoan ?></h3>
        </div>
		 
        <?php   echo validation_errors();  ?>
 
        <div class="box-body">
            <div class="row">
                <div class="col-md-6 form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i> Username</span>
                        <?php
                        if(!empty($disabled))
                        {
                            echo form_input(array('disabled'=>$disabled,'autocomplete'=>'off','class'=>'form-control','name'=>'user_username','id'=>'user_username','value'=>set_value('user_username',$formData['user_username'])));
                        }
                        else{
                            echo form_input(array('autocomplete'=>'off','class'=>'form-control','name'=>'user_username','id'=>'user_username','value'=>set_value('user_username',$formData['user_username'])));
                        }
                        ?>
                    </div>
                </div>
               
                <div class="col-md-6 form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-key"></i> Password</span>
                        <?php echo form_input(array('type'=>'password','autocomplete'=>'off','class'=>'form-control','name'=>'user_password','id'=>'user_password','value'=>set_value('user_password',$formData['user_password'])));?>
                    </div>
                </div>
                <div class="col-md-6 form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i> <?= ho_ten_dem ?></span>
                        <?php echo form_input(array('class'=>'form-control','name'=>'user_last_name','id'=>'user_last_name','value'=>set_value('user_last_name',$formData['user_last_name'])));?>
                    </div>
                </div>
                <div class="col-md-6 form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i> <?= ten ?></span>
                        <?php echo form_input(array('class'=>'form-control','name'=>'user_first_name','id'=>'user_first_name','value'=>set_value('user_first_name',$formData['user_first_name'])));?>
                    </div>
                </div>

                <div class="col-md-6 form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i> Email</span>
                        <?php echo form_input(array('type'=>'email','class'=>'form-control','name'=>'user_email','id'=>'user_email','value'=>set_value('user_email',$formData['user_email'])));?>
                    </div>
                </div>

                <div class="col-md-6 form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i> Sinh nhật</span>
                        <?php echo form_input(array('type'=>'date','class'=>'form-control','name'=>'user_birthday','id'=>'user_birthday','value'=>set_value('user_birthday',$formData['user_birthday'])));?>
                    </div>
                </div>
                <div class="col-md-6 form-group">
                    <div class="form-group">
                        <label class="control-label"><?= trang_thai ?></label>
                        <div class="controls">
                            <input type="radio" value="1" <?= $formData['user_status'] == 1 ? "checked" : "" ?>  name="user_status">
                            <i class="fa fa-eye"></i> <?= hien_thi ?>
                            <input type="radio" value="0" <?= $formData['user_status'] == 0 ? "checked" : "" ?> name="user_status">
                            <i class="fa fa-eye-slash"></i> <?= an ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 form-group">
                    <div class="input-group">
                        <label class="control-label">Giới tính</label>
                        <div class="controls" style="line-height: 34px;">
                            <input type="radio" value="1" <?= $formData['user_gender'] == 1 ? "checked" : "" ?>
                                   name="user_gender"><i class="fa fa-male"></i> <?= nam ?>
                            <input type="radio" value="0" <?= $formData['user_gender'] == 0 ? "checked" : "" ?>
                                   name="user_gender"><i class="fa fa-female"></i> <?= nu ?>
                        </div>
                    </div>
                </div>
                <div class="clr"></div>
			 
                <div class="col-md-6 form-group">
                    <div class="controls">
                        <select class="form-control" name="user_level">
                            <option value="10"> Quyền  </option>
                            <?php  $this->mgroup->dropdown($formData['user_level']); ?>
                        </select>
                    </div>
                </div> 
                <div class="col-md-6 form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-home"></i></span>
                        <?php echo form_input(array('class'=>'form-control','name'=>'user_address','id'=>'user_address','value'=>set_value('user_address',$formData['user_address'])));?>
                    </div>
                </div>

                <div class="col-md-6 form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                        <?php echo form_input(array('class'=>'form-control','name'=>'user_phone','id'=>'user_phone','value'=>set_value('user_phone',$formData['user_phone'])));?>
                    </div>
                </div>
                <div class="col-md-6 form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-mobile-phone"></i></span>
                        <?php echo form_input(array('class'=>'form-control','name'=>'user_hotline','id'=>'user_hotline','value'=>set_value('user_hotline',$formData['user_hotline'])));?>
                    </div>
                </div>
                <div class="col-md-6 form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-skype"></i></span>
                        <?php echo form_input(array('class'=>'form-control','name'=>'user_skype','id'=>'user_skype','value'=>set_value('user_skype',$formData['user_skype'])));?>
                    </div>
                </div>
                <div class="col-md-6 form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-yahoo"></i></span>
                        <?php echo form_input(array('class'=>'form-control','name'=>'user_yahoo','id'=>'user_yahoo','value'=>set_value('user_yahoo',$formData['user_yahoo'])));?>
                    </div>
                </div>
                <div class="col-md-6 form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-facebook"></i></span>
                        <?php echo form_input(array('class'=>'form-control','name'=>'user_facebook','id'=>'user_facebook','value'=>set_value('user_facebook',$formData['user_facebook'])));?>
                    </div>
                </div>
                <div class="col-md-6 form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-google-plus"></i></span>
                        <?php echo form_input(array('class'=>'form-control','name'=>'user_google','id'=>'user_google','value'=>set_value('user_google',$formData['user_google'])));?>
                    </div>
                </div>
                <div class="col-md-6 form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-twitter"></i></span>
                        <?php echo form_input(array('class'=>'form-control','name'=>'user_twitter','id'=>'user_twitter','value'=>set_value('user_twitter',$formData['user_twitter'])));?>
                    </div>
                </div>
            </div>
            
            <div class="control-group text-center mt10">
                <input type="submit" value="Save" class="btn btn-primary">
            </div>
        </div>
    </div>
</div>
</div>
</section>
</aside>
<?php  echo form_close();?>