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
                <div class="col-md-6">
                    
                    <div class="form-group">
                        <label class="control-label">Chọn vị trí</label>
                        <div class="controls">
                            <select name="position_id" class="form-control">
                                <?php $this->mposition->dropDown($formData['banner']['position_id']);?>
                            </select>
                        </div>
                    </div> 
                    
                    <div class="form-group">
                        <label><?= so_thu_tu?></label>
                        <div class="controls">
                            <input type="text" class="form-control" name="banner_orderby" id="banner_orderby" value="<?= $formData['banner']['banner_orderby'] ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= trang_thai?></label>
                        <div class="controls" style="line-height: 34px;">
                            <input type="radio" value="1" <?= $formData['banner']['banner_status']==1?"checked":""?> name="banner_status"/> <i class="fa fa-eye"></i> <?= hien_thi?>
                            <input type="radio" value="0" <?= $formData['banner']['banner_status']==0?"checked":""?> name="banner_status"/> <i class="fa fa-eye-slash"></i> <?= an?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?= tieu_de?></label>
                        <div class="controls">
                            <input type="text" required="required" class="form-control" name="banner_title" id="banner_title" value="<?= $formData['banner']['banner_title'] ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Link <?= lien_ket?></label>
                        <div class="controls">
                            <input type="text" class="form-control" name="banner_link" id="banner_link" placeholder="<?= nhap?> link" value="<?= $formData['banner']['banner_link'] ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="text-left block">Hình ảnh đại diện</label>
                        <div class="controls row">
                            <div class="col-lg-12"><input type="file" name="banner_picture" class="form-control mb10"></div>
                        </div>

                        <ul class="mulpic_ser">
                        <?php
                        if($formData['banner']['banner_picture'])
                        {
                            echo '<li><img src="'.base_file.'banner/'.$formData['banner']['banner_picture'].'" width="100"  height="100"/><span class="text-danger"><input type="checkbox" name="removefile" value="1"> <i class="fa fa-trash-o"></i> Trash</span></li>';
                        }
                        ?>
                        </ul>
                    </div>
					
                    <div class="alert alert-warning">Hình ảnh không vượt quá 2MB. File định dạng GIF | JPG | PNG</div>
                    
                </div>
            </div>
		<!--	<div class="col-md-12 col-xs-12">
				<?if($tpos=2):?>
					<div class="form-group">
                        <label> Nội dung</label>
                        <div class="controls">
                            <textarea  class="form-control summernote2" name="banner_detail" id="banner_detail" placeholder="<?= nhap?> link" > <?= $formData['banner']['banner_detail'] ?> </textarea>
                        </div>
                    </div>
					<? endif;?>
			</div> -->
            <div class="box-footer text-center">
                <button type="submit" class="btn btn-primary" value="Save" name="fsubmit">
                    <i class="fa fa-save"></i>
                    <span><?= luu ?></span>
                </button>
            </div>
        </section>
    </aside>
</form>
<script>
$(document).ready(function() {
  $('.summernote2').summernote({height:300});
});
</script>