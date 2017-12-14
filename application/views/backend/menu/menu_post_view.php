<form accept-charset="utf-8" method="post" enctype="multipart/form-data">
    <aside class="right-side">
        <section class="content-header">
            <h1>
                <small><?= $title ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= admin_url ?>home/"><i class="fa fa-dashboard"></i> <?= trang_chu ?></a></li>
                <li><a href="<?= admin_url ?>menu/"><?= danh_sach ?></a></li>
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
              <!-- commont -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label"><?= danh_muc_cap_cha?></label>
                            <div class="controls">
                                <select name="menu_parent" class="form-control">
                                    <?php $this->mmenu->dropDownMenu($formData['menu']['menu_parent'],'all'); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label"><?= the_loai?></label>
                            <div class="controls">
                                <select name="menu_com"  id="menu_com" class="form-control">
                                    <?php echo $this->Mcom->dropdown($formData['menu']['menu_com']); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label"><?= so_thu_tu?></label>
                            <div class="controls">
                                <input type="number" class="form-control" name="menu_orderby" id="menu_orderby" value="<?= $formData['menu']['menu_orderby']?>" />
                            </div>
                        </div>
                    </div>
					 <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group ">
                                <label class="control-label"><?= trang_thai?></label>
                                <div class="controls">
                                    <input type="checkbox" value="1" <?= $formData['menu']['menu_status'] == 1 ? "checked" : "" ?> name="menu_status" checked> <i class="fa fa-eye"></i> <?= hien_thi?>
                                      <input type="checkbox" value="1" <?= $formData['menu']['menu_hot'] == 1 ? "checked" : "" ?> name="menu_hot"> <i class="fa fa-trophy"></i> <?= noi_bat?>
                                    <input type="checkbox" value="1" <?= $formData['menu']['menu_home'] == 1 ? "checked" : "" ?> name="menu_home"> <i class="fa fa-home"></i> <?= trang_chu?>  
                                </div>
                            </div>
                        </div>
                    </div>
					<!--
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">View hiện thị</label>
                            <div class="controls">
                                <select name="menu_view" id="menu_view" class="form-control">
                                <?= $menu_view; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                   

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="text-left block">Hình ảnh đại diện</label>
                            <div class="controls row">
                                <div class="col-lg-12"><input type="file" name="menu_picture" class="form-control mb10"></div>
                            </div>

                            <ul class="mulpic_ser">
                            <?php
                            if($formData['menu']['menu_picture'])
                            {
                                echo '<li><img src="'.base_file.'menu/'.$formData['menu']['menu_picture'].'" width="100"  height="100"/><span class="text-danger"><input type="checkbox" name="removefile" value="1"> <i class="fa fa-trash-o"></i> Trash</span></li>';
                            }
                            ?>
                            </ul>
                        </div>
                        <div class="alert alert-warning">Hình ảnh không vượt quá 2MB. File định dạng GIF | JPG | PNG</div>
                    </div>-->

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
                                            <input type="text" class="form-control menu_lang_name_<?= $value->lang?>" name="menu_lang_name_<?= $value->lang?>" id="menu_lang_name" value="<?= $formData[$value->lang]['menu_lang_name'] ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <!-- 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Alias <img src="<?= base_file.'language/'.$value->picture;?>" width="20px" /></label>
                                        <div class="controls">
                                            <input type="text" class="form-control" name="menu_lang_alias_<?= $value->lang?>" id="menu_lang_alias" value="<?= $formData[$value->lang]['menu_lang_alias'] ?>"/>
                                        </div>
                                    </div>
                                </div> -->
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Description <img src="<?= base_file.'language/'.$value->picture;?>" width="20px" /></label>
                                        <div class="controls">
                                            <textarea class="form-control" name="menu_lang_detail_<?= $value->lang?>" id="menu_lang_detail"/><?= $formData[$value->lang]['menu_lang_detail'] ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Seo title <img src="<?= base_file.'language/'.$value->picture;?>" width="20px" /></label>
                                        <div class="controls">
                                            <input type="text" class="form-control menu_lang_title_<?= $value->lang?>" name="menu_lang_title_<?= $value->lang?>" id="menu_lang_title" value="<?= $formData[$value->lang]['menu_lang_title'] ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Seo Keyword <img src="<?= base_file.'language/'.$value->picture;?>" width="20px" /></label>
                                        <div class="controls">
                                            <input type="text" class="form-control menu_lang_keyword_<?= $value->lang?>" name="menu_lang_keyword_<?= $value->lang?>" id="menu_lang_keyword" value="<?= $formData[$value->lang]['menu_lang_keyword'] ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Seo Description <img src="<?= base_file.'language/'.$value->picture;?>" width="20px" /></label>
                                        <div class="controls">
                                            <input type="text" class="form-control menu_lang_description_<?= $value->lang?>" name="menu_lang_description_<?= $value->lang?>" id="menu_lang_description" value="<?= $formData[$value->lang]['menu_lang_description'] ?>"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
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
<?php
    if(!empty($language)){
        foreach ($language as $key => $value) {
            ?>
            CKEDITOR.replace("menu_lang_detail_<?= $value->lang?>", {
                toolbar: [{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'FontSize', 'TextColor','Strike','Styles', 'Format', 'Source', 'RemoveFormat' ] }], //makes all editors use this toolbar
                toolbarStartupExpanded : false,
                toolbarCanCollapse  : false,
                toolbar_Custom: [], //define an empty array or whatever buttons you want.
                enterMode: CKEDITOR.ENTER_BR
            } );
            <?php
        }
    }
?>
<?php if($formData['menu_id']=="" || $formData['menu_id'] == NULL) { ?>
$('.menu_lang_name_vn').bind('blur',function(){
    var _val_vn  = $(this).val();
    <?php if(!empty($language)){ foreach ($language as $key => $value) {?>
        var _tmp_name_<?= $value->lang?> = $('.menu_lang_name_<?= $value->lang; ?>').val();
        if(_tmp_name_<?= $value->lang?> == '')
        {
            $('.menu_lang_name_<?= $value->lang; ?>').val(_val_vn);
        }
    <?php } } ?>
});
<?php } ?>
</script>