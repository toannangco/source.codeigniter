<form accept-charset="utf-8" method="post" enctype="multipart/form-data">
    <aside class="right-side">
        <!-- BEGIN: Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <small><?= $title ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= admin_url ?>home/"><i class="fa fa-dashboard"></i> <?= trang_chu ?></a></li>
                <li class="active"><?= $title ?></li>
            </ol>
        </section>
        <!-- BEGIN: Content Header (Page header) -->

        <!-- BEGIN: Main content -->
        <section class="content">
            <div class="row">
                <!-- BEGIN: Box Left -->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="box box-primary">
                        <!-- BEGIN: Box-Header -->
                        <div class="box-header">
                            <i class="fa fa-flag-checkered"></i>
                            <h3 class="box-title"><?= danh_sach?> <?= ngon_ngu?></h3>
                        </div>
                        <!-- END: Box-Header -->

                        <!-- BEGIN: Box-Table-->
                        <div class="box-body table-responsive no-padding">
                            <table id="example1" class="table table-bordered table-striped dataTable" aria-describedby="example1_info">
                                <thead>
                                <tr>
                                    <th style="width: 10px"><?= stt?></th>
                                    <th class="text-center">Tên Group</th>
                                    <th class="text-center">Email</th>                                    
                                    <th class="text-center"><?= thiet_lap?></th>
                                </tr>
                                </thead>
                                <tbody role="alert" aria-live="polite" aria-relevant="all">
                                <?php if($list){
                                	$i=1;
                                    foreach($list as $item){                                        
                                        ?>
                                        <tr class="">
                                        	<td><?= $i++?></td>
                                            <td class="text-center"><?= isset($item['email_group']) ? $item['email_group'] : '';?></td>
                                            <td class="text-center"><?= isset($item['email_name']) ? $item['email_name'] : '';?></td>                                                                                        
                                            <td class="text-center">
                                            <?php if(!isset($id)){ ?>
		                                        <span>
		                                            <a href="<?= admin_url.'email/update/'.$item["id"].'/?redirect='.base64_encode(curPageURL())?>" class="btn btn-xs btn-primary" title="<?= cap_nhap?> " data-original-title="<?= cap_nhap?>"><i class="fa fa-edit"></i></a>
		                                            <!-- <a href="<?= admin_url.'email/delete/'.$item["id"].'/?redirect='.base64_encode(curPageURL())?>" class="btn btn-xs btn-danger" title="" data-original-title="<?= bo_vao_thung_rac?>" onclick="return Delete();"><i class="fa fa-trash-o"></i></a>		                                             -->
		                                        </span>
                                                <?php } elseif(isset($id) && $item['id']!=$id){ ?>
                                                    <a href="<?= admin_url.'email/update/'.$item["id"].'/?redirect='.base64_encode(curPageURL())?>" class="btn btn-xs btn-primary" title="<?= cap_nhap?> " data-original-title="<?= cap_nhap?>"><i class="fa fa-edit"></i></a>
                                                    <?php }?>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                }?>
                                </tbody>
                            </table>
                        </div>
                        <!-- END: Box-Table-->

                        <!-- BEGIN: Box-Footer -->
                        <div class="box-footer">
                            <?php if(isset($pagination)){echo $pagination;};?>
                            <button class="btn btn-default disabled"><?= tong_cong?>: <?= $record?> <?= ngon_ngu?></button>
                        </div>
                        <!-- END: Box-Footer -->
                    </div>
                </div>
                <!-- END: Box Left -->
                <!-- BEGIN: Box Right -->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="box box-info box-solid">
                        <!-- BEGIN: Box-Header -->
                        <div class="box-header">
                            <i class="fa fa-flag"></i>
                            <h3 class="box-title"><?= them_moi?> <?= ngon_ngu?></h3>
                        </div>
                        <!-- END: Box-Header -->

                        <!-- BEGIN: Box-Body-->                        
                        <div class="box-body">                            
                            <div class="row">                                
                                <div class="col-md-6 form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-flag-o"></i></span>
                                        <input class="form-control" <?= isset($id) && is_numeric($id) ? "readonly='readonly'":"" ?> required="required" type="text" name="email_group" id="email_group" value="<?= isset($info['email_group']) && $info['email_group'] ? $info['email_group']:'' ?>" placeholder="Phòng ban" />
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-code"></i></span>
                                        <input class="form-control" required="required" type="email" name="email_name" id="email_name" value="<?= isset($info['email_name']) && $info['email_name'] ? $info['email_name']:'' ?>" placeholder="Email" />
                                    </div>
                                </div>
                            </div>                            
                        <!-- END: Box-Body-->

                        <!-- BEGIN: Box-Footer-->
                        <div class="box-footer text-center">
                            <button type="submit" name="btnSave" class="btn btn-primary">
                                <i class="fa fa-save"></i>
                                <span><?= luu ?></span>
                            </button>
                            <button type="reset" class="btn btn-danger">
                                <i class="fa fa-refresh"></i>
                                <span><?= nhap_lai ?></span>
                            </button>
                        </div>
                        <!-- END: Box-Footer-->
                    </div>
                </div>
                <!-- END: Box Right -->
            </div>
        </section>
        <!-- END: Main content -->
    </aside>
</form>