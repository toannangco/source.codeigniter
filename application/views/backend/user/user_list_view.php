<form accept-charset="utf-8" method="get" enctype="multipart/form-data">
    <aside class="right-side">
        <!-- BEGIN: Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <small><?= $title ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= admin_url?>/home/" title="<?= lang("set.menuleft_home")?>" data-original-title="<?= lang("set.menuleft_home")?>"><i class="fa fa-dashboard"></i> <?= trang_chu?></a></li>
                <li class="active"><?= $title ?></li>
            </ol>
        </section>
        <!-- END: Content Header (Page header) -->

        <!-- BEGIN: Main content -->
        <section class="content">
            <div class="box box-primary">
                <!-- BEGIN: Box-Header -->
                <div class="box-header">
                    <i class="fa fa-users"></i>
                    <h3 class="box-title"><?= $title ?></h3>

                    <div class="pull-right box-tools">
                        <a href="<?= admin_url ?>user/add/" class="btn btn-primary btn-sm" title="<?= them?> User">
                            <i class="fa fa-plus"></i>
                            <span><?= them?></span>
                        </a>
                    </div>
                </div>
                <!-- END: Box-Header -->

                <!-- BEGIN: Tìm kiếm -->

                <div id="example1_wrapper" class="box-body" role="grid">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <select class="form-control input-sm" name="status" onchange="this.form.submit()" >
                                <option <?= (isset($_REQUEST['status']) && $_REQUEST['status']=="all")?"selected":"";?> value="all">-<?= trang_thai?>-</option>
                                <option <?= (isset($_REQUEST['status']) && $_REQUEST['status']=="1")?"selected":"";?> value="1"><?= hoat_dong?></option>
                                <option <?= (isset($_REQUEST['status']) && $_REQUEST['status']=="0")?"selected":"";?> value="0"><?= khoa?></option>
                            </select>
                        </div>
                      <div class="form-group col-md-4">
                            <select class="form-control input-sm" name="level" onchange="this.form.submit()" >
                                <option value="0">-<?= quyen?>-</option>
                                <?php    $level = isset($_REQUEST['level']) ? $_REQUEST['level']:''; $this->mgroup->dropdown($level);?>
                            </select>
                        </div> 
                        <div class="form-group col-md-4">
                            <div class="input-group">
                                <input type="text" name="fkeyword" class="form-control input-sm" placeholder="<?= tim_kiem?>" value="<?= (isset($_REQUEST['fkeyword']) && $_REQUEST['fkeyword'])?$_REQUEST['fkeyword']:""?>">
                                <span class="input-group-btn">
                                    <button class="btn btn-sm btn-success" type="submit" name="fsearchtour" id="fsearchtour" ><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Tìm kiếm -->

                <!-- BEGIN: Box-Table-->
                <div class="box-body table-responsive no-padding">
                    <table id="example1" class="table table-bordered table-hover dataTable" aria-describedby="example1_info">
                        <thead>
                            <tr>
                                <th style="width: 10px">ID</th>
                                <th>Username</th>
                                <th><?= ho_va_ten?></th>
                                <th>Email</th>
                                <th class="text-center"><?= di_dong?></th>
                             <!--   <th class="text-center"><?= ngay_tao?></th>-->
                                <th class="text-center"><?= quyen?></th>
                               
                                <th class="text-center" style="width: 129px;"><?= hanh_dong?></th>
                            </tr>
                        </thead>
                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                        <?php
                        //print_arr($list);
                        if($list){
                            foreach ($list as $key => $value) {
                                /**begin trang thai*/
                                $status = $value["user_status"]==1?"fa fa-eye":"fa fa-eye-slash";
                                $status_change = $value["user_status"]==1?0:1;
                                $status_title = $value["user_status"]==1? hien_thi : an ;
                                $opacity = $value["user_status"] == 1?"":"opcity02";

                                $link_edit = admin_url.'user/update/'.$value["id"].'/?redirect='.base64_encode(curPageURL());
                                $link_delete = admin_url.'user/delete/'.$value["id"].'/?redirect='.base64_encode(curPageURL());
                                $link_update = admin_url.'user/update_status/'.$value["id"].'/'.$status_change.'/?redirect='.base64_encode(curPageURL());

                                /**level*/
                               // $getLevel = $this->mgroup->getData(array("id"=>$value["user_level"]));
							    if($value['user_level'] == 1){
									$quyen = 'Admin';
								}else if($value['user_level']==10){
									$quyen = 'Hoc viên';
								}else if($value['user_level']==2) {
									$quyen = 'Giáo viên';
								}
                                if($getLevel){
                                    $level_name = $getLevel["group_name"];
                                }else{
                                    $level_name = chua_phan_quyen;
                                }
                                $picture = $value["user_logo"]!=""?base_file.'user/'.$value["user_logo"]:base_url().'public/backend/images/no_image.png';
                                ?>
                                <tr class="<?= $opacity?>">
                                    <td class="text-center"><?= $value["id"]?>.</td>
                                    <td><small><?= $value["user_username"]?></small></td>
                                    <td><b><?= $value["user_last_name"]?> <?= $value["user_first_name"]?></b></td>
                                    <td><a   title=" "><?= $value["user_email"]?></a></td>
                                    <td class="text-center" style="font-size: 1.1em;"><span class="label label-primary"><i class="fa fa-phone"></i> <?= $value["user_phone"]?></span></td>
                                <!--    <td class="text-center"><small class="text-gray"><?= date("d/m/Y",$value["user_createdate"])?><br /><?= date("h:m:s a",$value["user_createdate"])?></small></td>-->
                                    <td class="text-center">
										<?=$quyen ;?>
									</td>
                                    
                                    <td class="text-center">
                                        <?php if($s_info['s_user_level']==1 ) { ?>
                                            <a href="<?= $link_edit?>" class="btn btn-sm btn-primary" title="<?= cap_nhap?> [<?= $value["user_username"]?>]" data-original-title="<?= cap_nhap?> [<?= $value["user_username"]?>]"><i class="fa fa-edit"></i></a>
                                            <!--<a href="<?= $link_delete?>" class="btn btn-sm btn-danger" title="<?= xoa?> [<?= $value["user_username"]?>]" data-original-title="<?= xoa?> [<?= $value["user_username"]?>]" onclick="return Delete();"><i class="fa fa-trash-o"></i></a>
                                            <a href="<?= $link_update?>" class="btn btn-sm btn-warning" title="<?= $status_title?>" data-original-title="<?= $status_title?>"><i class="fa fa-unlock"></i></a>-->
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <!-- END: Box-Table-->

                <!-- BEGIN: Box-Footer -->
                <div class="box-footer">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <?php if(isset($pagination)){echo $pagination;};?>
                        <li class="disabled"><a><?= tat_ca?>: <?= $record?> User</a></li>
                    </ul>
                
                </div>
                <!-- END: Box-Footer -->
            </div>
        </section>
        <!-- END: Main content -->
    </aside><!-- /.right-side -->
</form>