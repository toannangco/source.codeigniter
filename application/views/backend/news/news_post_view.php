<form accept-charset="utf-8" method="post" enctype="multipart/form-data">
    <aside class="right-side">
        <section class="content-header">
            <h1>
                <small><?= $title ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= admin_url ?>home/"><i class="fa fa-dashboard"></i> <?= trang_chu ?></a></li>
                <li><a href="<?= admin_url ?>news/"><?= danh_sach ?></a></li>
                <li class="active"><?= $title ?></li>
            </ol>
        </section>
        <section class="content">
        <div class="row">
            <div class="col-md-12">
              <ul class="nav nav-tabs" role="tablist">
                <?php 
                if(!empty($language))
                {
                    $i = 1;
                    foreach ($language as $key => $value) {
                        $active = $i++ == 1 ? 'active' : '';
                        echo '<li role="presentation" class="'.$active.'"><a href="#'.$value->alias.'" aria-controls="'.$value->alias.'" role="tab" data-toggle="tab"><img src="'.base_file.'language/'.$value->picture.'" /> '.$value->name.'</a></li>';
                    }
                }
                ?>
              </ul>
              <!-- box tag -->
              <div class="tab-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label"><?= danh_muc?></label>
                            <div class="controls">
                                <select name="news_parent" class="form-control">
                                    <?php $this->mmenu->dropDownMenu($formData['news']['news_parent'],'news'); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                if(!empty($language))
                {
                    $i=1;
                    foreach ($language as $key => $value) {
                        $active = $i++ == 1 ? 'active' : '';
                        ?>
                        <div role="tabpanel" class="tab-pane <?= $active?>" id="<?= $value->alias?>">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label"><?= tieu_de?> <img src="<?= base_file.'language/'.$value->picture;?>" width="20px" /></label>
                                        <div class="controls">
                                            <?php echo form_input(array('type' => 'text','class' => 'form-control news_lang_name_'.$value->lang, 'id' => 'news_lang_name',  'name' => 'news_lang_name_'.$value->lang, 'value' => $formData[$value->lang]['news_lang_name'], 'required ' ,  'maxlength' => 70)); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 view_news">
                                    <div class="form-group">
                                        <label class="control-label"><?= tom_tat?> <img src="<?= base_file.'language/'.$value->picture;?>" width="20px" /></label>
                                        <div class="controls">
                                            <textarea class="form-control" name="news_lang_summary_<?= $value->lang?>" id="news_lang_summary_<?= $value->lang?>"><?= $formData[$value->lang]['news_lang_summary'] ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label"><?= chi_tiet?> <img src="<?= base_file.'language/'.$value->picture;?>" width="20px" /></label>
                                        <div class="controls">
                                            <textarea class="form-control summernote" name="news_lang_detail_<?= $value->lang?>" id="news_lang_detail_<?= $value->lang?>"><?= $formData[$value->lang]['news_lang_detail'] ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">SEO Title <img src="<?= base_file.'language/'.$value->picture;?>" width="20px" /></label>
                                        <div class="controls">
                                            <input type="text" class="form-control" name="news_lang_seo_title_<?= $value->lang?>" id="news_lang_seo_title" value="<?= $formData[$value->lang]['news_lang_seo_title'] ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">SEO Keyword <img src="<?= base_file.'language/'.$value->picture;?>" width="20px" /></label>
                                        <div class="controls">
                                            <input type="text" class="form-control" name="news_lang_seo_keyword_<?= $value->lang?>" id="news_lang_seo_keyword" value="<?= $formData[$value->lang]['news_lang_seo_keyword'] ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">SEO Description <img src="<?= base_file.'language/'.$value->picture;?>" width="20px" /></label>
                                        <div class="controls">
                                            <input type="text" class="form-control" name="news_lang_seo_description_<?= $value->lang?>" id="news_lang_seo_description" value="<?= $formData[$value->lang]['news_lang_seo_description'] ?>"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
              <!-- commont -->
                <div class="row">
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label"><?=luot_xem?></label>
                            <div class="controls">
                                <input type="text" class="form-control" name="news_view" id="news_view" value="<?= $formData['news']['news_view']?>" />
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label"><?=so_thu_tu?></label>
                            <div class="controls">
                                <input type="number" class="form-control" name="news_orderby" id="news_orderby" value="<?= $formData['news']['news_orderby']?>" />
                            </div>
                        </div>
                    </div> -->
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="input-group ">
                                <label class="control-label"><?= trang_thai?></label>
                                <div class="controls">
                                    <input type="checkbox" value="1" <?= $formData['news']['news_status'] == 1 ? "checked" : "" ?> name="news_status"> <i class="fa fa-eye"></i> <?= hien_thi?>
                                    <input type="checkbox" value="1" <?= $formData['news']['news_hot'] == 1 ? "checked" : "" ?> name="news_hot"> <i class="fa fa-trophy"></i> <?= noi_bat?>
                                    <!-- <input type="checkbox" value="1" <?= $formData['news']['news_home'] == 1 ? "checked" : "" ?> name="news_home"> <i class="fa fa-home"></i> <?= trang_chu?> -->
                                    <!-- <input type="checkbox" value="1" <?= $formData['news']['news_comment'] == 1 ? "checked" : "" ?> name="news_comment"> <i class="fa fa-comment"></i> <?=binh_luan?> -->
                                </div>
                            </div>
                        </div>
                    </div>
                   <!--  <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Link video</label>
                            <div class="controls">
                                <input type="text" class="form-control" name="news_video" id="news_video" value="<?= $formData['news']['news_video']?>" placeholder="Ví dụ: https://www.youtube.com/watch?v=d9sKAPexIlk" />
                            </div>
                        </div>
                    </div>
                    

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Ngày hiện thị</label>
                            <div class="controls">
                                <input type="text" class="form-control" name="news_create_date" id="news_create_date" value="<?= $formData['news']['news_create_date']?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="clr"></div> -->

                    <!-- <div class="col-md-6">
                        <div class="form-group">
                            <label class="text-left block">File đính kèm 1</label>
                            <div class="controls row">
                                <div class="col-lg-12"><input type="file" name="news_file" class="form-control mb10"></div>
                            </div>

                            <ul class="">
                            <?php
                            if($formData['news']['news_file'])
                            {
                                echo '<li>'.$formData['news']['news_file'].' <span class="text-danger"><input type="checkbox" name="removefile" value="1"> <i class="fa fa-trash-o"></i> Trash</span></li>';
                            }
                            ?>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="text-left block">File đính kèm 2</label>
                            <div class="controls row">
                                <div class="col-lg-12"><input type="file" name="news_file2" class="form-control mb10"></div>
                            </div>

                            <ul class="">
                            <?php
                            if($formData['news']['news_file2'])
                            {
                                echo '<li>'.$formData['news']['news_file2'].' <span class="text-danger"><input type="checkbox" name="removefile2" value="1"> <i class="fa fa-trash-o"></i> Trash</span></li>';
                            }
                            ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="alert alert-warning">File không vượt quá 10MB. File định dạng DOC | PDF | XLS | TXT | GIF | JPG | PNG | |RAR | ZIP. (Khuyến cáo nền dùng PDF)</div>
                    </div> -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="text-left block">Hình ảnh đại diện</label>
                            <div class="controls row">
                                <div class="col-lg-12"><input type="file" name="news_picture" class="form-control mb10"></div>
                            </div>

                            <ul class="mulpic_ser">
                            <?php
                            if($formData['news']['news_picture'])
                            {
                                echo '<li><img src="'.base_file.'news/'.$formData['news']['news_picture'].'" width="100"  height="100"/><span class="text-danger"><input type="checkbox" name="removepicture" value="1"> <i class="fa fa-trash-o"></i> Trash</span></li>';
                            }
                            ?>
                            </ul>
                        </div>
                        <div class="alert alert-info">Hình ảnh không vượt quá 2MB. File định dạng GIF | JPG | PNG</div>
                    </div>
                    <!-- <div class="col-md-12">
                        <div class="form-group">
                            <label class="text-left block">Upload multi hình ảnh</label>
                            <div class="controls row">
                                <div class="col-lg-4"><input type="file" name="news_picture_more[]" class="form-control mb10"></div>
                                <div class="col-lg-4"><input type="file" name="news_picture_more[]" class="form-control mb10"></div>
                                <div class="col-lg-4"><input type="file" name="news_picture_more[]" class="form-control mb10"></div>
                                <div class="col-lg-4"><input type="file" name="news_picture_more[]" class="form-control mb10"></div>
                                <div class="col-lg-4"><input type="file" name="news_picture_more[]" class="form-control mb10"></div>
                                <div class="col-lg-4"><input type="file" name="news_picture_more[]" class="form-control mb10"></div>
                            </div>

                            <ul class="mulpic_ser">
                            <?php
                            $path = base_file.'news/';
                            if($news_picture_more)
                            {
                                foreach ($news_picture_more as $key => $value) {
                                    echo '<li><a href="'.$path.$value.'" class="zoom_img"><img src="'.$path.$value.'" width="100"  height="100"/></a><input type="hidden" name="news_picture_more_old[]" value="'.$value.'"> <a class="removePic text-danger" title="Xóa '.$value.'" data-name="'.$value.'" data-service-id="'.$formData['news_id'].'"><i class="fa fa-trash-o"></i></a></li>';
                                }
                            }
                            ?>
                            </ul>
                        </div>
                        <div class="alert alert-danger">Hình ảnh không vượt quá 2MB. File định dạng GIF | JPG | PNG</div>
                    </div> -->
                </div>
                </div>
            </div>
        </div>

        <div class="box-footer text-center mt10">
            <button type="submit" class="btn btn-primary" name="fsubmit" value="Save"><i class="fa fa-save"></i> Save</button>
        </div>
        </section>
    </aside>
</form>
<script type="text/javascript">
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
			   url:  "<?=admin_url?>news/summernote",
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

<!--begin time-->
<script type="text/javascript" src="<?= admin_js?>jquery-ui.min.js"></script>
<link type="text/css" rel="stylesheet" href="<?= admin_css?>jquery-ui.css" media="screen" />
<script type="text/javascript">
    $(document).ready(function(){
        $("#news_create_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
    });
</script>
<!--end time-->