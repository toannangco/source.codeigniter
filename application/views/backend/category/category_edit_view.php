<?php
if($info){
    $info_category_orderby = $info["category_orderby"];
    $info_category_component = $info["category_component"];
    $info_category_action = $info["category_action"];
    $info_category_parent = $info["category_parent"];
    $info_category_icon = $info["category_icon"];
}else{
    $info_category_icon = $info_category_parent = $info_category_component = $info_category_action = $info_category_orderby = "";
}
if($info_lang){
    $info_category_name = $info_lang["category_lang_name"];
}else{
    $info_category_name = "";
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
                <li><a href="<?= admin_url?>/home/" title="<?= lang("set.menuleft_home")?>" data-original-title="<?= lang("set.menuleft_home")?>"><i class="fa fa-dashboard"></i> <?= trang_chu?></a></li>
                <li><a href="<?= admin_url?>/category/" title="<?= lang("set.menuleft_menu_list")?>" data-original-title="<?= lang("set.menuleft_menu_list")?>"><?= danh_sach?> Menu Admin</a></li>
                <li class="active"><?= $title ?></li>
            </ol>
        </section>
        <!-- END: Content Header (Page header) -->

        <!-- BEGIN: Main content -->
        <section class="content">
            <div class="box box-primary">
                <!-- BEGIN: Box-Header -->
                <div class="box-header">
                    <i class="fa fa-plus-square"></i>
                    <h3 class="box-title"><?= $title ?></h3>
                </div>
                <!-- END: Box-Header -->

                <!-- BEGIN: Box-Body-->
                <form role="form">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="control-label"><?= ten_menu?></label>
                            <div class="controls">
                                <input class="form-control category_lang_name" name="category_lang_name" id="category_lang_name" value="<?= $info_category_name?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label><?= danh_muc_cap_cha?></label>
                            <select name="category_parent" class="form-control">
                                <option>--- <?= danh_muc_cap_cha?> ---</option>
                                <?php $this->mcategory->dropDown($info_category_parent); ?>
                            </select>
                            <div class="help-ts">
                                <i class="fa fa-info-circle"></i>
                                <span><?= ban_co_the_chon_hoac_khong_chon?> <?= neu_chon_la_cap_con?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <div class="form-group">
                                    <label class="control-label">Controller</label>
                                    <div class="controls">
                                        <input class="form-control category_component" name="category_component" id="category_component" value="<?= $info_category_component?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <div class="form-group">
                                    <label class="control-label">Action</label>
                                    <div class="controls">
                                        <input class="form-control category_action" name="category_action" id="category_action" value="<?= $info_category_action?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <div class="form-group">
                                    <label class="control-label"><?= so_thu_tu?></label>
                                    <div class="controls">
                                        <input class="form-control category_orderby" name="category_orderby" id="category_orderby" value="<?= $info_category_orderby?>" placeholder="<?= nhap?> <?= so_thu_tu?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label"><?= bieu_tuong?></label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="<?= $info_category_icon?>"></i>
                                </div>
                                <input class="form-control category_icon" name="category_icon" id="category_icon" value="<?= $info_category_icon?>">
                                <span class="input-group-btn">
                                    <a href="http://fontawesome.io/icons/" target="_blank" title="<?= bam_vao_de_tim?> <?= bieu_tuong?>">
                                        <button class="btn btn-info btn-flat" type="button"><i class="fa fa-search"></i></button>
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- END: Box-Body-->

                <!-- BEGIN: Box-Footer-->
                <div class="box-footer text-center">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i>
                        <span><?= luu?></span>
                    </button>
                    <button type="reset" class="btn btn-danger">
                        <i class="fa fa-refresh"></i>
                        <span><?= nhap_lai?></span>
                    </button>
                </div>
                <!-- END: Box-Footer-->
            </div>
        </section>
        <!-- END: Main content -->
    </aside>
    <!-- /.right-side -->
</form>
