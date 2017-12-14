<?php
 
$form = array("name"=>"basic_validate","method"=>"post","class"=>"form-horizontal","id"=>"basic_validate","novalidate"=>"novalidate");
if(isset($info) && $info){
    $info_company_support_name = $info["company_support_name"];
    $info_company_support_hotline = $info["company_support_hotline"];
    $info_company_support_yahoo = $info["company_support_yahoo"];
    $info_company_support_skype = $info["company_support_skype"];
    $info_company_support_email = $info["company_support_email"];
}else{
    $info_company_support_email = $info_company_support_skype = $info_company_support_yahoo = $info_company_support_hotline=$info_company_support_name = "";
}
?>
<!-- Right side column. Contains the navbar and content of the page -->
<form accept-charset="utf-8" method="post" enctype="multipart/form-data">
<aside class="right-side">
<!-- BEGIN: Content Header (Page header) -->
<section class="content-header">
    <h1>
        <small><?= $title ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= admin_url ?>home/"><i class="fa fa-dashboard"></i> <?= trang_chu ?></a></li>
        <li class="active"><?= $title?></li>
    </ol>
</section>
<!-- END: Content Header (Page header) -->
<!-- BEGIN: Main content -->
<section class="content">
<div class="row">
<!-- BEGIN: Thông tin doanh nghiệp -->
<div class="col-sm-12 col-xs-12">
    <div class="box box-solid box-primary">
        <!-- BEGIN: Box-Header -->
        <div class="box-header">
            <i class="fa fa-info"></i>
            <h3 class="box-title"><?= $title?></h3>
        </div>
        <!-- END: Box-Header -->
        <!-- BEGIN: Box-Body-->
        <div class="box-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="control-group">
                        <label class="control-label">Tên nhóm</label>
                        <div class="controls">
                            <input type="text" required="required" class="form-control" name="company_support_name" value="<?= $info_company_support_name?>" />
                            <div class="help-ts">
                                <i class="fa fa-info-circle"></i>
                                <b class="text-danger">(ví dụ: Phòng kỹ thuật)</b>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="control-group">
                        <label class="control-label">Hotline</label>
                        <div class="controls">
                            <input type="text" class="form-control" name="company_support_hotline" value="<?= $info_company_support_hotline?>" />
                            <div class="help-ts">
                                <i class="fa fa-info-circle"></i>
                                <b class="text-danger">(ví dụ: 0909 977 920)</b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="control-group">
                        <label class="control-label">Email</label>
                        <div class="controls">
                            <input type="text" class="form-control" name="company_support_email" value="<?= $info_company_support_email?>" />
                            <div class="help-ts">
                                <i class="fa fa-info-circle"></i>
                                <b class="text-danger">(ví dụ: tinhnguyenvan91@gmail.com)</b>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="control-group">
                        <label class="control-label">Yahoo</label>
                        <div class="controls">
                            <input type="text" class="form-control" name="company_support_yahoo" value="<?= $info_company_support_yahoo?>" />
                            <div class="help-ts">
                                <i class="fa fa-info-circle"></i>
                                <b class="text-danger">( )</b>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="control-group">
                        <label class="control-label">Skype</label>
                        <div class="controls">
                            <input type="text" class="form-control" name="company_support_skype" value="<?= $info_company_support_skype?>" />
                            <div class="help-ts">
                                <i class="fa fa-info-circle"></i>
                                <b class="text-danger">(ví dụ:  )</b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- END: Box-Body-->

        <!-- BEGIN: Box-Footer-->
        <div class="box-footer text-center">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-save"></i>
                <span><?= luu ?></span>
            </button>
        </div>
        <!-- END: Box-Footer-->
    </div>
</div>
<!-- END: Thông tin doanh nghiệp -->


<!-- END: Thông tin hỗ trợ -->
</div>
</section>
<!-- END: Main content -->
</aside>
</form>
