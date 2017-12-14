<form accept-charset="utf-8" method="post" enctype="multipart/form-data">
    <aside class="right-side">
        <section class="content-header">
            <h1>
                <small><?= $title ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= admin_url ?>home/"><i class="fa fa-dashboard"></i> <?= trang_chu ?></a></li>
                <li><a href="<?= admin_url ?>area/"><?= danh_sach ?></a></li>
                <li class="active"><?= $title ?></li>
            </ol>
        </section>
        <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Danh mục cha</label>
                            <div class="controls">
                                <select name="area_parent" class="form-control">
                                    <option value="0" <?= $formData['area_parent']==0 ? 'selected':''; ?>>-- Danh mục cha --</option>
                                    <?php $this->marea->dropdown($formData['area_parent']); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Tiêu đề</label>
                            <div class="controls">
                                <input type="text" class="form-control" name="area_name" id="area_name" value="<?= $formData['area_name']?>" required="required" />
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Số thứ tự</label>
                            <div class="controls">
                                <input type="text" class="form-control" name="area_orderby" id="area_orderby" value="<?= $formData['area_orderby']?>" />
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