

<form accept-charset="utf-8" method="post" enctype="multipart/form-data">
    <aside class="right-side">
        <section class="content-header">
            <h1>
                <small><?= $title ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= admin_url ?>home/"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
                <li class="active"><?= $title?></li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
					 
                    <div class="box box-solid box-primary">
                        <div class="box-header">
                            <i class="fa fa-info"></i>
                            <h3 class="box-title"><?= $title;?></h3>
                        </div>
						<div class="control-group">
                                <label class="control-label">Tên Website</label>
								<div class="controls">
									<?php echo form_input(array('type' => 'text','class' => 'form-control website_name', 'id' => 'website_name',  'name' => 'website_name', 'value' => $data['website_name'], 'maxlength' => 70)); ?>
								</div>
                         </div>
						 <div class="control-group">
                                <label class="control-label">Mô tả</label>
								<div class="controls">
									<?php echo form_input(array('type' => 'text','class' => 'form-control website_description', 'id' => 'website_description',  'name' => 'website_description', 'value' => $data['website_description'])); ?>
								</div>
                         </div>
						 <div class="control-group">
                                <label class="control-label">Email wesite</label>
								<div class="controls">
									<?php echo form_input(array('type' => 'text','class' => 'form-control website_email', 'id' => 'website_email',  'name' => 'website_email', 'value' => $data['website_email'], 'maxlength' => 70)); ?>
								</div>
                         </div>
						   <div class="control-group">
                                <label class="control-label">Địa chỉ</label>
								<div class="controls">
									<?php echo form_input(array('type' => 'text','class' => 'form-control website_address', 'id' => 'website_address',  'name' => 'website_address', 'value' => $data['website_address'])); ?>
								</div>
                         </div>
						  <div class="control-group col-md-6 col-xs-12">
                                <label class="control-label">Hot line Phòng đào tạo</label>
								<div class="controls">
									<?php echo form_input(array('type' => 'text','class' => 'form-control website_phone', 'id' => 'website_phone',  'name' => 'website_phone', 'value' => $data['website_phone'])); ?>
								</div>
                         </div>
						 <div class="control-group col-md-6 col-xs-12">
                                <label class="control-label">Hotline</label>
								<div class="controls">
									<?php echo form_input(array('type' => 'text','class' => 'form-control website_fax', 'id' => 'website_fax',  'name' => 'website_fax', 'value' => $data['website_fax'])); ?>
								</div>
                         </div>
						
						  
						 
						 
						 <div class="control-group">
                                <label class="control-label">Frame page</label>
								<div class="controls">
									<?php echo form_input(array('type' => 'text','class' => 'form-control website_page', 'id' => 'website_page',  'name' => 'website_page', 'value' => $data['website_page'])); ?>
								</div>
							</div> 
                        <div class="box-body">
                            
							<div class="control-group">
                                 <label class="text-left block">Logo</label>
								<div class="controls row">
									<div class="col-lg-12"><input type="file" name="website_logo" class="form-control mb10"></div>
								</div>

								<ul class="mulpic_ser">
								<?php
								if($data['website_logo'])
								{
									echo '<li><img src="'.base_file.'logo/'.$data['website_logo'].'" width="100"  height="100"/><span class="text-danger"><input type="checkbox" name="removepicture" value="1"> <i class="fa fa-trash-o"></i> Trash</span></li>';
								}
								?>
								</ul>
                            </div>
							<div class="control-group ">
                                 <label class="text-left block">Hình banner</label>
								<div class="controls row">
									<div class="col-lg-12"><input type="file" name="website_background" class="form-control mb10"></div>
								</div>

								<ul class="mulpic_ser">
								<?php
								if($data['website_background'])
								{
									echo '<li style="width:100%;"><img src="'.base_file.'logo/'.$data['website_background'].'" style="width:100%;"/><span class="text-danger"><input type="checkbox" name="removepicture2" value="1"> <i class="fa fa-trash-o"></i> Trash</span></li>';
								}
								?>
								</ul>
                            </div>
							
							
                           
							
							 
							<div class="control-group col-md-6 col-xs-12">
                                <label class="control-label">  Banner</label>
                                <div class="controls">
                                    <label class="radio-inline">
									  <input type="radio" name="website_banner" value=1 <?if($data['website_banner']==1)  echo 'checked';?> >On
									</label>
									<label class="radio-inline">
									  <input type="radio" name="website_banner" value=0 <?if($data['website_banner']==0)  echo 'checked';?> >Off
									</label>
                                </div>
                            </div>
							<div class="control-group col-md-6 col-xs-12">
                                <label class="control-label"> Link Banner </label>
                                <div class="controls">
                                    <input name="website_banner_link" id="website_banner_link" class="form-control" value="<?= $data['website_banner_link']; ?>" />
                                </div>
                            </div>
							 
							 <div class="control-group">
                                <label class="control-label">Thông tin Banner text</label>
                                <div class="controls">
                                    <input name="website_banner_detail" id="website_banner_detail" class="form-control" value="<?= $data['website_banner_detail']; ?>" />
                                </div>
                            </div>
							<!--<div class="control-group">
                                <label class="control-label">Quản cáo</label>
                                <div class="controls">
                                    <textarea name="website_banner_advertise" id="website_banner_advertise"  class="summernote">
                                        <?= $data['website_banner_advertise']; ?>
                                    </textarea>
                                </div>
                            </div>-->
							 <div class="control-group">
                                <label class="control-label">Thông tin footer </label>
                                <div class="controls">
                                    <textarea name="website_footer_left" id="website_footer_left" class="summernote">
                                        <?= $data['website_footer_left']; ?>
                                    </textarea>
                                </div>
                            </div>
								 <div class="control-group">
                                <label class="control-label">Google map</label>
								<div class="controls">
									<?php echo form_input(array('type' => 'text','class' => 'form-control website_map', 'id' => 'website_map',  'name' => 'website_map', 'value' => $data['website_map'])); ?>
								</div>
                         </div>
						   
							
                        </div>
                    
                        <div class="box-footer text-center">
                            <button name="fsubmit" type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i>
                                <span>Lưu</span>
                            </button>
                        </div>
                   
					 </div>
                </div>

            </div>
        </section>
    </aside>
</form>
 <style>.control-group {padding:5px 20px;}</style>
 <script>
   
 </script>