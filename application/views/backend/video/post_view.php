<?//p( $s_info)?>
<form accept-charset="utf-8" method="post" enctype="multipart/form-data">
    <aside class="right-side">
        <section class="content-header">
            <h1>
                <small><?= $title ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= admin_url ?>home/"><i class="fa fa-dashboard"></i> <?= trang_chu ?></a></li>
                <li><a href="<?= admin_url ?>video/"><?= danh_sach ?></a></li>
                <li class="active"><?= $title ?></li>
            </ol>
        </section>
        <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    
                    
                    <div class="col-md-6 col-md-offset-3 col-xs-12">
                        <div class="form-group">
                            <label class="control-label">Tiêu đề</label>
                            <div class="controls">
                                <input type="text" class="form-control" name="video_name" id="video_name" value="<?= $formData['video_name']?>" required="required" />
                            </div>
                        </div>
                    </div>
					<div class="col-md-6 col-md-offset-3  col-xs-12">
                        <div class="form-group">
                            <label class="control-label">Link</label>
                            <div class="controls">
                                <input type="text" class="form-control" name="video_link" id="area_name" value="<?= $formData['video_link']?>" required="required" />
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-md-offset-3  col-xs-12">
                        <div class="form-group">
                            <label class="control-label">Số thứ tự</label>
                            <div class="controls">
                                <input type="text" class="form-control" name="video_order" id="video_order" value="<?= $formData['video_order']?>" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer text-center mt10">
                    <button type="submit" class="btn btn-primary" name="fsubmit" value="Save"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </section>
    </aside>
</form>
<style>body > .header{margin-top:-20px;}</style>