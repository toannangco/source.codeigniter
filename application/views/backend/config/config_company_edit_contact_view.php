<form accept-charset="utf-8" method="post" enctype="multipart/form-data">
    <aside class="right-side">
        <section class="content-header">
            <h1>
                <small><?= $title ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= admin_url ?>home/"><i class="fa fa-dashboard"></i> <?= trang_chu ?></a></li>
                <li><a href="<?= admin_url ?>config/company/"><?= danh_sach ?></a></li>
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
              <?php
                if(!empty($language))
                {
                    $i=1;
                    foreach ($language as $key => $value) {
                        $active = $i++ == 1 ? 'active' : '';
                        ?>
                        <div role="tabpanel" class="tab-pane <?= $active?>" id="<?= $value->alias?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Tên vị trí <img src="<?= base_file.'language/'.$value->picture;?>" width="20px" /></label>
                                        <div class="controls">
                                            <input type="text" class="form-control" name="company_contact_position_<?= $value->lang?>" id="company_contact_position" value="<?= $formData[$value->lang]['company_contact_position'] ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Địa chỉ <img src="<?= base_file.'language/'.$value->picture;?>" width="20px" /></label>
                                        <div class="controls">
                                            <input type="text" class="form-control" name="company_contact_address_<?= $value->lang?>" id="company_contact_address" value="<?= $formData[$value->lang]['company_contact_address'] ?>"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Bản đồ <img src="<?= base_file.'language/'.$value->picture;?>" width="20px" /></label>
                                        <div class="controls">
                                            <textarea  name="company_contact_maps_<?= $value->lang?>" id="company_contact_maps" class="form-control"><?= $formData[$value->lang]['company_contact_maps'] ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Điện thoại <img src="<?= base_file.'language/'.$value->picture;?>" width="20px" /></label>
                                        <div class="controls">
                                            <input type="text" class="form-control" name="company_contact_phone_<?= $value->lang?>" id="company_contact_phone" value="<?= $formData[$value->lang]['company_contact_phone'] ?>"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Hotline <img src="<?= base_file.'language/'.$value->picture;?>" width="20px" /></label>
                                        <div class="controls">
                                            <input type="text" class="form-control" name="company_contact_hotline_<?= $value->lang?>" id="company_contact_hotline" value="<?= $formData[$value->lang]['company_contact_hotline'] ?>"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Email <img src="<?= base_file.'language/'.$value->picture;?>" width="20px" /></label>
                                        <div class="controls">
                                            <input type="text" class="form-control" name="company_contact_email_<?= $value->lang?>" id="company_contact_email" value="<?= $formData[$value->lang]['company_contact_email'] ?>"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Fax <img src="<?= base_file.'language/'.$value->picture;?>" width="20px" /></label>
                                        <div class="controls">
                                            <input type="text" class="form-control" name="company_contact_fax_<?= $value->lang?>" id="company_contact_fax" value="<?= $formData[$value->lang]['company_contact_fax'] ?>"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Website <img src="<?= base_file.'language/'.$value->picture;?>" width="20px" /></label>
                                        <div class="controls">
                                            <input type="text" class="form-control" name="company_contact_website_<?= $value->lang?>" id="company_contact_website" value="<?= $formData[$value->lang]['company_contact_website'] ?>"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Facebook <img src="<?= base_file.'language/'.$value->picture;?>" width="20px" /></label>
                                        <div class="controls">
                                            <input type="text" class="form-control" name="company_contact_facebook_<?= $value->lang?>" id="company_contact_facebook" value="<?= $formData[$value->lang]['company_contact_facebook'] ?>"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Behance <img src="<?= base_file.'language/'.$value->picture;?>" width="20px" /></label>
                                        <div class="controls">
                                            <input type="text" class="form-control" name="company_contact_google_<?= $value->lang?>" id="company_contact_google" value="<?= $formData[$value->lang]['company_contact_google'] ?>"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Pinterest<img src="<?= base_file.'language/'.$value->picture;?>" width="20px" /></label>
                                        <div class="controls">
                                            <input type="text" class="form-control" name="company_contact_twitter_<?= $value->lang?>" id="company_contact_twitter" value="<?= $formData[$value->lang]['company_contact_twitter'] ?>"/>
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Youtube<img src="<?= base_file.'language/'.$value->picture;?>" width="20px" /></label>
                                        <div class="controls">
                                            <input type="text" class="form-control" name="company_contact_youtube_<?= $value->lang?>" id="company_contact_youtube" value="<?= $formData[$value->lang]['company_contact_youtube'] ?>"/>
                                        </div>
                                    </div>
                                </div> -->
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