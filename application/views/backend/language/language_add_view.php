<?php
$form = array("name"=>"basic_validate","method"=>"post","class"=>"form-horizontal","id"=>"basic_validate","novalidate"=>"novalidate");
$language_name = array("name"=>"language_name","id"=>"language_name","class"=>"required");
$language_name_short = array("name"=>"language_name_short","id"=>"language_name_short","class"=>"");
$language_position = array("name"=>"language_position","id"=>"language_position","class"=>"w200");
?>
<div id="content-header">
    <h1> CMS Admin</h1>
</div>
<div id="breadcrumb">
    <a href="<?= admin_url?>/home/" title="" class="tip-bottom" data-original-title="Go to Home"><i class="icon-home"></i> Home</a>
    <a href="<?= admin_url?>/language/index/">Danh sách ngôn ngữ</a>
    <a class="current">Thêm mới ngôn ngữ</a>
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <?= form_open_multipart("",$form)?>
            <!--begin bai viet mới nhất-->
            <a href="<?= admin_url?>/language/index/" class="btn btn-success btn-mini">Danh sách</a>
            <input type="submit" value="Save" class="btn btn-primary btn-mini">

            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon"><i class="icon-th"></i></span>
                    <h5>Thêm mới ngôn ngữ</h5>
                </div>
                <div class="widget-content">
                    <?= validation_errors();?>
                    <div class="control-group">
                        <label class="control-label">Tên ngôn ngữ</label>
                        <div class="controls">
                            <?= form_input($language_name)?>
                            <p><span class="text_upload_file">Ví dụ: Việt Nam</span></p>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Tên viết tắt</label>
                        <div class="controls">
                            <?= form_input($language_name_short)?>
                            <p><span class="text_upload_file">Ví dụ: vn</span></p>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Ảnh đại diện</label>
                        <div class="controls">
                                <span class="btn btn-success fileinput-button btn-mini">
                                    <span>Select files...</span>
                                    <input id="language_picture" type="file" name="files[]" multiple="">
                                </span>
                            <p>Upload progress</p>
                            <div id="progress_picture" class="progress progress-success progress-striped">
                                <div class="bar"></div>
                            </div>
                            <p>Files uploaded <span class="text_upload_file">(Bạn có thể upload tối đa 1 hình ảnh): </span></p>
                            <ul id="files_picture" class="file_reset"></ul>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label"><?= so_thu_tu; ?></label>
                        <div class="controls w200">
                            <?= form_input($language_position)?>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Trạng thái</label>
                        <div class="controls">
                            <div class="fl pd5"><label><input type="radio" value="1" checked name="language_status">Hiện thị</label></div>
                            <div class="fl pd5"><label><input type="radio" value="1" name="language_status">Không hiện thị</label></div>
                            <div class="cle"></div>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label"></label>
                        <div class="controls">
                            <input type="submit" value="Save" class="btn btn-primary btn-mini">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>