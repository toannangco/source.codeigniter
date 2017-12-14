<?php echo form_open_multipart();?>
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
        <?php echo validation_errors(); ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6 form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i> Username</span>
                        <?php echo form_input(array('disabled'=>$disabled,'autocomplete'=>'off','class'=>'form-control','name'=>'user_username','id'=>'user_username','value'=>set_value('user_username',$formData['user_username'])));?>
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
            <div class="control-group">
                <label class="control-label"><?= bai_gioi_thieu ?></label>
                <div class="controls">
                    <textarea id="user_intro" name="user_intro" class="textarea" placeholder="<?= nhap_noi_dung ?>"
                              style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?= $user_intro?></textarea>
                </div>
            </div>

            <div class="col-md-12">
                <div class="control-group">
                    <label class="text-left block">Hình ảnh đại diện</label>
                    <div class="controls row">
                        <div class="col-lg-12"><input type="file" name="user_logo" class="form-control mb10"></div>
                    </div>

                    <ul class="mulpic_ser">
                    <?php
                    if($formData['user_logo'])
                    {
                        echo '<li><img src="'.base_file.'user/'.$formData['user_logo'].'" width="100"  height="100"/><span class="text-danger"><input type="checkbox" name="removepicture" value="1"> <i class="fa fa-trash-o"></i> Trash</span></li>';
                    }
                    ?>
                    </ul>
                </div>
                <div class="alert alert-info">Hình ảnh không vượt quá 2MB. File định dạng GIF | JPG | PNG</div>
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
<?php echo form_close();?>