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
                        <a href="<?= admin_url ?>document/add/" class="btn btn-primary btn-sm" title="<?= them?>">
                            <i class="fa fa-plus"></i>
                            <span><?= them?></span>
                        </a>
                    </div>
                </div>

                <div id="example1_wrapper" class="box-body" role="grid">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <select onchange="this.form.submit()" class="form-control input-sm" name="parent" id="tparent">
                                <option value="">---<?= loc_theo?> <?= danh_muc?>---</option>
                                 <?php $this->mmenu->dropDownMenu($formData['document_parent'],'document'); ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="box-body table-responsive no-padding">
                    <table id="example1" class="table table-bordered table-striped dataTable table-checkbox" aria-describedby="example1_info">
                        <thead>
                            <tr role="row">
                                <th class="text-center" style="width: 10px;">STT</th>
                                <th><?= tieu_de?></th>
								<th>Hình đại diện</th>
								 <th>File</th>
                                <th class="text-center" width="100px"><?= ngay_dang?></th>
								<th class="text-center" width="100px">Lược tải</th>
                                <th class="text-center" style="width: 129px;"><?= hanh_dong?></th>
                            </tr>
                        </thead>

                        <tbody role="alert" aria-live="polite" aria-relevant="all">
						<?php if(!empty($list)):?>
							<?php  foreach($list as $k=>$v):
									$link_edit = admin_url.'document/update/'.$v['id'].'/?redirect='.base64_encode(curPageURL());
                                   // $link_status = admin_url.'document/status/'.$v['id'].'/'.$status_change.'/?redirect='.base64_encode(curPageURL());
                                    $link_delete = admin_url.'document/delete/'.$v['id'].'/-1/?redirect='.base64_encode(curPageURL());
									$pic = base_file.'document/'.$v['document_picture'] ;
							?>
							<tr>
								<td><?=$v['id']?></td>
								<td><?=$v['document_name']?></td>
								<td class="text-center"><img src="<?=$pic?>" style="width:50px"></td>
								<td>
									<a href="<?php echo base_file.'document/'.$v['document_file'] ; ?>"> <?=$v['document_file']?>  </a>
								</td>
								<td><?=$v['document_dateadd']?></td>
								<td class="text-right"><?=$v['document_count']?></td>
								<td>
									<a href="<?= $link_edit?>" class="btn btn-xs btn-primary" title="Cập nhật"><i class="fa fa-edit"></i></a>
									<a href="<?= $link_delete?>" onclick="return Delete();" title="Xóa" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></a>
									<!--<a href="<?= $link_status?>" class="btn btn-xs btn-warning" title="Ẩn / Hiện"><i class="fa fa-eye"></i></a> -->
                                       
								</td>
								</tr>
							<?php endforeach; ?>
						<?php endif ;?>
                        </tbody>
                    </table>
					<div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <?php if(isset($pagination)){echo $pagination;};?>
                        <li class="disabled"><a><?= tat_ca?>: <?= $record?>  Tài liệu</a></li>
                    </ul>
                </div>
                </div>
            </div>
			
        </section>
    </aside>
</form>