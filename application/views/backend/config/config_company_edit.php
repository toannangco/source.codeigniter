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
                                        <label class="control-label">Tên công ty <img src="<?= base_file.'language/'.$value->picture;?>" width="20px" /></label>
                                        <div class="controls">
                                            <input type="text" class="form-control" name="company_name_<?= $value->lang?>" id="company_name" value="<?= $formData[$value->lang]['company_name'] ?>"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Tên viết tắt <img src="<?= base_file.'language/'.$value->picture;?>" width="20px" /></label>
                                        <div class="controls">
                                            <input type="text" class="form-control" name="company_name_short_<?= $value->lang?>" id="company_name_short" value="<?= $formData[$value->lang]['company_name_short'] ?>"/>
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