<form accept-charset="utf-8" method="post" enctype="multipart/form-data">
    <aside class="right-side">
        <section class="content-header">
            <h1>
                <small><?= $title ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= admin_url ?>home/"><i class="fa fa-dashboard"></i> <?= trang_chu ?></a></li>
                <li><a href="<?= admin_url ?>banner/"><?= danh_sach ?> banner</a></li>
                <li class="active"><?= $title ?></li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">Tên vị trí</label>
                        <div class="controls">
                            <input type="text" id="position_name" name="position_name" value="<?= $formData['position_name']?>" class="form-control" required="required">
                            <p class="text_upload_file">Ví dụ: Banner Trang Chủ .</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Mã vị trí</label>
                        <div class="controls">
                            <input type="text" id="position_code" name="position_code" value="<?= $formData['position_code']?>" class="form-control" required="required">
                            <p class="text_upload_file">Ví dụ: bannertop .</p>
                        </div>
                    </div>
                    <div class="control-group">
                        <input type="submit" value="Save" class="btn btn-primary btn-mini" name="fsubmit">
                    </div>
                </div>
            </div>
        </section>
    </aside>
</form>