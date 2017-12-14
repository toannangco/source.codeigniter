<form accept-charset="utf-8" method="get">
    <aside class="right-side">
        <section class="content-header">
            <h1>
                <small><?= $title ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= admin_url?>home/" ><i class="fa fa-dashboard"></i> <?= trang_chu?></a></li>
                <li class="active"><?= $title ?></li>
            </ol>
        </section>

        <section class="content">
            <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-list-alt"></i>
                    <h3 class="box-title"><?= $title ?></h3>
                    <small class="badge bg-aqua"><?= $record?></small>
                    <div class="pull-right box-tools">
                        <a href="<?= admin_url ?>video/add/" class="btn btn-primary btn-sm" title="<?= them?> <?= bai_viet?>">
                            <i class="fa fa-plus"></i>
                            <span><?= them?></span>
                        </a>
                    </div>
                </div>

                <div id="example1_wrapper" class="box-body" role="grid">
                    <div class="row">
                         
                         
                        <div class="form-group col-md-3">
                            <input type="text" name="fkeyword" class="form-control input-sm" placeholder="<?= tim_kiem?>" value="<?= $fkeyword; ?>">
                        </div>
                        <div class="form-group col-md-2">
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> <?= tim_kiem?></button>
                        </div>
                    </div>
                </div>

                <div class="box-body table-responsive row">
                    <div class="col-md-12">
                        <table id="example1" style="font-size:14px;" class="table table-bordered table-striped dataTable table-checkbox" aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th class="text-center" style="width: 10px;">  ID  </th>
                                    <th><?= tieu_de?></th>
                                    <th>Link</th>
									<th>Ngày tạo</th>
                                    <th class="text-center" style="width: 129px;"><?= hanh_dong?></th>
                                </tr>
                            </thead>

                            <tbody role="alert" aria-live="polite" aria-relevant="all">
                            <?php
                            if(isset($list)){  
                                foreach ($list as $key => $value) {
                                    $link_edit = admin_url.'video/update/'.$value['id'].'/?redirect='.base64_encode(curPageURL());
                                    $link_delete = admin_url.'video/status/'.$value['id'].'/-1/?redirect='.base64_encode(curPageURL());
                            ?>
                                    <tr class="odd">
                                        <td class="text-center">
                                            <?= $value['id']?>
                                        </td>
                                        <td> <?=$value['video_name']?></td>
                                        <td>  <?=$value['video_link']?></td>
										 <td>  <?=$value['video_dateadd']?></td>
                                        <td class="text-center">
                                            <a href="<?= $link_edit?>" class="btn btn-sm btn-primary" title="Cập nhật"><i class="fa fa-edit"></i></a>
                                            <a href="<?= $link_delete?>" onclick="return Delete();" title="Xóa" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></a>
                                            
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

                <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <?php if(isset($pagination)){echo $pagination;};?>
                        <li class="disabled"><a><?= tat_ca?>: <?= $record?>  Video</a></li>
                    </ul>
                </div>
            </div>
        </section>
    </aside>
</form>
<style>body > .header{margin-top:-20px;}</style>