<form accept-charset="utf-8" method="post" enctype="multipart/form-data">
    <aside class="right-side">
        <section class="content-header">
            <h1>
                <small><?= $title ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= admin_url ?>home/"><i class="fa fa-dashboard"></i> <?= trang_chu ?></a></li>
                <li><a href="<?= admin_url ?>document/"><?= danh_sach ?></a></li>
                <li class="active"><?= $title ?></li>
            </ol>
        </section>
        <section class="content">
        <div class="box box-primary">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Danh mục cha</label>
                            <div class="controls">
                                <select name="document_parent" class="form-control">
                                    <option value="0" <?= $formData['document_parent']==0 ? 'selected':''; ?>>-- Danh mục cha --</option>
                                     <?php $this->mmenu->dropDownMenu($formData['document_parent'],'document'); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Tiêu đề</label>
                            <div class="controls">
                                <input type="text" class="form-control" name="document_name" id="document_name" value="<?= $formData['document_name']?>" required="required" />
                            </div>
                        </div>
                    </div>
					<div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Mô tả tài liệu</label>
                            <div class="controls">
                                <input type="text" class="form-control" name="document_summary" id="document_summary" value="<?= $formData['document_summary']?>" required="required" style="height:50px;" />
                            </div>
                        </div>
                    </div>
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label"><?= chi_tiet?>   </label>
							<div class="controls">
								<textarea class="form-control summernote" name="document_detail"  ><?= $formData['document_detail'] ?></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-6">
                        <div class="form-group">
                            <label class="text-left block">File đính kèm </label>
                            <div class="controls row">
                                <div class="col-lg-12"><input type="file" name="document_file" class="form-control mb10"></div>
                            </div>

                            <ul class="">
                            <?php
                            if($formData['document_file'])
                            {
                                echo '<li><a href="'.base_file.'document/'.$formData['document_file'] .'">'.$formData['document_file'].' <span class="text-danger"><input type="checkbox" name="removefile" value="1">  	</span></a></li>';
                            }
                            ?>
                            </ul>
                        </div>
                    </div>
					   <div class="col-md-12">
                        <div class="form-group">
                            <label class="text-left block">Hình ảnh đại diện</label>
                            <div class="controls row">
                                <div class="col-lg-12"><input type="file" name="document_picture" class="form-control mb10"></div>
                            </div>

                            <ul class="mulpic_ser">
                            <?php
                            if($formData['document_picture'])
                            {
                                echo '<li><img src="'.base_file.'document/'.$formData['document_picture'].'" width="100"  height="100"/><span class="text-danger"><input type="checkbox" name="removepicture" value="1"> <i class="fa fa-trash-o"></i> Trash</span></li>';
                            }
                            ?>
                            </ul>
                        </div>
                        <div class="alert alert-info">Hình ảnh không vượt quá 2MB. File định dạng GIF | JPG | PNG</div>
                    </div>
                    <!--
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Số thứ tự</label>
                            <div class="controls">
                                <input type="text" class="form-control" name="document_orderby" id="document_orderby" value="<?= $formData['document_orderby']?>" />
                            </div>
                        </div>
                    </div> -->
                </div>
                <div class="box-footer text-center mt10">
                    <button type="submit" class="btn btn-primary" name="fsubmit" value="Save"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </section>
    </aside>
</form>
<style>.box{    display: block;  float: left;}</style>
<script>
  $(function() {
      $('.summernote').summernote({
		height: 300,
		callbacks: {
			onImageUpload: function(files, editor, welEditable) {
				sendFile(files[0]);
			} 
		}});
       function sendFile(file,editor,welEditable) {
          data = new FormData();
          data.append("file", file);
           $.ajax({
			   url:  "<?=admin_url?>document/summernote",
			   data: data,
			   cache: false,
			   contentType: false,
			   processData: false,
			   type: 'POST',
			   success: function(data){
					//alert(data);
					$('.summernote').summernote("insertImage", data, 'file');
				},
			   error: function(jqXHR, textStatus, errorThrown) {
			   console.log(textStatus+" "+errorThrown);
			  }
        });
       }
});
</script>

