<form accept-charset="utf-8" method="post" enctype="multipart/form-data">
    <aside class="right-side">
        <section class="content-header">
            <h1>
                <small><?= $title ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= admin_url ?>home/"><i class="fa fa-dashboard"></i> <?= trang_chu ?></a></li>
                <li class="active"><?= $title ?></li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <i class="fa fa-sliders"></i>
                            <h3 class="box-title" style="text-transform: capitalize;"><?= vi_tri?></h3>
                            <div class="pull-right box-tools">
                            <a href="<?= admin_url ?>banner/add_position/" class="btn btn-primary btn-sm" title="<?= them?>">
                                <i class="fa fa-plus"></i>
                                <span><?= them?></span>
                            </a>
                        </div>
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table id="example1" class="table table-bordered table-striped dataTable" aria-describedby="example1_info">
                                <thead>
                                <tr>
                                    <th style="width: 10px;"><?= stt?></th>
                                    <th class="text-center"><?= ten?> <?= vi_tri?></th>
                                    <th class="text-center">Code <?= vi_tri?></th>
                                    <th class="text-center"><?= hanh_dong?></th>
                                </tr>
                                </thead>
                                <tbody role="alert" aria-live="polite" aria-relevant="all">
                                <?php
                                if($list){
                                    $i=1;
                                    foreach($list as $item){
                                        ?>
                                        <tr>
                                            <td class="text-center"><?= $i++?></td>
                                            <td><?= $item['position_name']?></td>
                                            <td class="text-center" style="color: #999;"><small><?=  $item["position_code"]?></small></td>
                                            <td class="text-center">
                                                <a href="<?= admin_url.'banner/update_position/'.$item["id"].'/?redirect='.base64_encode(curPageURL())?>" class="btn btn-xs btn-primary" title="<?= cap_nhap?>" data-original-title="<?= cap_nhap?>"><i class="fa fa-edit"></i></a>
                                                <a href="<?= admin_url.'banner/delete_position/'.$item["id"].'/?redirect='.base64_encode(curPageURL())?>" class="btn btn-xs btn-danger" title="<?= bo_vao_thung_rac?>" data-original-title="<?= bo_vao_thung_rac?>" onclick="return Delete();"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </section>
    </aside>
</form>