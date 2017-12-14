<form accept-charset="utf-8" method="post" enctype="multipart/form-data">
    <aside class="right-side">
        <!-- BEGIN: Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <small><?= $title ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= admin_url ?>home/"><i class="fa fa-dashboard"></i> <?= trang_chu ?></a></li>
                <li class="active"><?= $title ?></li>
            </ol>
        </section>
        <!-- BEGIN: Content Header (Page header) -->

        <!-- BEGIN: Main content -->
        <section class="content">
            <div class="row">
                <!-- BEGIN: Box Left -->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="box box-primary">
                        <!-- BEGIN: Box-Header -->
                        <div class="box-header">
                            <i class="fa fa-flag-checkered"></i>
                            <h3 class="box-title"><?= danh_sach?> <?= ngon_ngu?></h3>
                        </div>
                        <!-- END: Box-Header -->

                        <!-- BEGIN: Box-Table-->
                        <div class="box-body table-responsive no-padding">
                            <table id="example1" class="table table-bordered table-striped dataTable" aria-describedby="example1_info">
                                <thead>
                                <tr>
                                    <th style="width: 10px"><?= stt?></th>
                                    <th class="text-center"><?= ngon_ngu?></th>
                                    <th class="text-center"><?= ten_viet_tat?></th>
                                    <th class="text-center"><?= ngay_dang?></th>
                                    <th class="text-center"><?= hinh_dai_dien?></th>
                                    <th class="text-center"><?= thiet_lap?></th>
                                </tr>
                                </thead>
                                <tbody role="alert" aria-live="polite" aria-relevant="all">
                                <?php if($list){
                                    foreach($list as $item){
                                        $language_name = $item["language_name"];
                                        /**picture*/
                                        $picture = $item["language_picture"]!=""?base_url().'public/frontend/uploads/files/language/thumbnail/'.$item["language_picture"]:base_url().'public/backend/images/no_image.png';
                                        $picture_zoom = $item["language_picture"]!=""?base_url().'public/frontend/uploads/files/language/'.$item["language_picture"]:base_url().'public/backend/images/no_image.png';
                                        /**begin trang thai*/
                                        $status = $item["language_status"]==1?"icon-eye-open":"icon-eye-close";
                                        $status_change = $item["language_status"]==1?0:1;
                                        $status_title = $item["language_status"]==1? an : hien_thi ;
                                        $opacity = $item["language_status"] == 1?"":"opcity02";
                                        ?>
                                        <tr class="<?= $opacity?>">
                                            <td class="text-center"><?= $item["language_position"]?></td>
                                            <td><a><?= $language_name?></a></td>
                                            <td class="text-center"><span class="badge bg-aqua"><?= $item["language_name_short"]?></span></td>
                                            <td class="text-center"><span class="alias_cate"><?= date("d/m/Y",$item["language_create_date"])?><span class="time_news">(<?= date("h:m:s a",$item["language_create_date"])?>)</span></span></td>
                                            <td class="text-center">
                                                <a href="<?= $picture_zoom?>" class="image zoom_img tip-bottom cboxElement">
                                                    <img src="<?= $picture?>" title="<?= $language_name?>" alt="<?= $language_name?>" class="img-circle">
                                                </a>
                                            </td>
                                            <td class="text-center">
                                        <span>
                                            <a href="<?= admin_url.'language/update/'.$item["id"].'/'?>" class="btn btn-xs btn-primary" title="<?= cap_nhap?> [<?= $language_name?>]" data-original-title="<?= cap_nhap?> [<?= $language_name?>]"><i class="fa fa-edit"></i></a>
                                            <a href="<?= admin_url.'language/delete/'.$item["id"].'/'?>" class="btn btn-xs btn-danger" title="<?= $language_name?>" data-original-title="<?= bo_vao_thung_rac?>" onclick="return Delete();"><i class="fa fa-trash-o"></i></a>
                                            <a href="<?= admin_url.'language/update_status/'.$item["id"].'/'.$status_change.'/'?>" class="btn btn-xs btn-warning" title="<?= $status_title?>" data-original-title="<?= $status_title?>"><i class="fa fa-eye"></i></a>
                                        </span>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                }?>
                                </tbody>
                            </table>
                        </div>
                        <!-- END: Box-Table-->

                        <!-- BEGIN: Box-Footer -->
                        <div class="box-footer">
                            <?php if(isset($pagination)){echo $pagination;};?>
                            <button class="btn btn-default disabled"><?= tong_cong?>: <?= $record?> <?= ngon_ngu?></button>
                        </div>
                        <!-- END: Box-Footer -->
                    </div>
                </div>
                <!-- END: Box Left -->
                <!-- BEGIN: Box Right -->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="box box-info box-solid">
                        <!-- BEGIN: Box-Header -->
                        <div class="box-header">
                            <i class="fa fa-flag"></i>
                            <h3 class="box-title"><?= them_moi?> <?= ngon_ngu?></h3>
                        </div>
                        <!-- END: Box-Header -->

                        <!-- BEGIN: Box-Body-->
                        <?php
                            $form = array("name"=>"basic_validate","method"=>"post","class"=>"form-horizontal","id"=>"basic_validate","novalidate"=>"novalidate");
                            $language_name = array("name"=>"language_name","id"=>"language_name","class"=>"required form-control","placeholder"=>ngon_ngu);
                            $language_name_short = array("name"=>"language_name_short","id"=>"language_name_short","class"=>"form-control","placeholder"=>ten_viet_tat);
                            $language_position = array("name"=>"language_position","id"=>"language_position","class"=>"form-control","placeholder"=>so_thu_tu);
                        ?>
                        <div class="box-body">
                            <?= form_open_multipart("",$form)?>
                            <div class="row">
                                <?= validation_errors();?>
                                <div class="col-md-6 form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-flag-o"></i></span>
                                        <?= form_input($language_name)?>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-code"></i></span>
                                        <?= form_input($language_name_short)?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                                        <?= form_input($language_position)?>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <div class="input-group">
                                        <div class="controls" style="line-height: 34px;">
                                            <input type="radio" value="1" checked name="language_status">
                                            <i class="fa fa-eye"></i> <?= hien_thi ?>
                                            <input type="radio" value="0" name="language_status">
                                            <i class="fa fa-eye-slash"></i> <?= an ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?= form_label(lang("set.form_add_picture")) ?></label>

                                <div class="controls">
                                    <span class="btn btn-success fileinput-button btn-sm">
                                        <span><?= chon_file ?></span>
                                        <input id="user_logo" type="file" name="files[]" multiple="">
                                    </span>
                                    <div class="progress-ts">
                                        <i class="fa fa-upload"></i>

                                        <div id="progress_picture" class="progress sm progress-striped active">
                                            <div class="progress-bar progress-bar-success bar" role="progressbar" aria-valuenow="20"
                                                 aria-valuemin="0" aria-valuemax="100">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="alert alert-info alert-dismissable">
                                        <i class="fa fa-cloud"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <p><?= file_da_tai_len ?>:</p>
                                        <ul id="files_picture" class="file_reset"></ul>
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
                            <button type="reset" class="btn btn-danger">
                                <i class="fa fa-refresh"></i>
                                <span><?= nhap_lai ?></span>
                            </button>
                        </div>
                        <!-- END: Box-Footer-->
                    </div>
                </div>
                <!-- END: Box Right -->
            </div>
        </section>
        <!-- END: Main content -->
    </aside>
</form>