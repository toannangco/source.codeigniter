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
                    <i class="fa fa-customers"></i>
                    <h3 class="box-title"><?= $title ?></h3>
					<!--
                    <div class="pull-right box-tools">
                        <a href="<?= admin_url ?>customer/add/" class="btn btn-primary btn-sm" title="<?= them?> customer">
                            <i class="fa fa-plus"></i>
                            <span><?= them?></span>
                        </a>
                    </div>-->
                </div>
                <!-- END: Box-Header -->

                <!-- BEGIN: Tìm kiếm -->

                <div id="example1_wrapper" class="box-body" role="grid">
                    <div class="row">
                       <!-- <div class="form-group col-md-4">
                            <select class="form-control input-sm" name="status" onchange="this.form.submit()" >
                                <option <?= (isset($_REQUEST['status']) && $_REQUEST['status']=="all")?"selected":"";?> value="all">-<?= trang_thai?>-</option>
                                <option <?= (isset($_REQUEST['status']) && $_REQUEST['status']=="1")?"selected":"";?> value="1"><?= hoat_dong?></option>
                                <option <?= (isset($_REQUEST['status']) && $_REQUEST['status']=="0")?"selected":"";?> value="0"><?= khoa?></option>
                            </select>
                        </div>-->
                        
                        <div class="form-group col-md-4">
                            <div class="input-group">
                                <input type="text" name="fkeyword" class="form-control input-sm" placeholder="<?= tim_kiem?>" value="<?= (isset($_REQUEST['fkeyword']) && $_REQUEST['fkeyword'])?$_REQUEST['fkeyword']:""?>">
                                <span class="input-group-btn">
                                    <button class="btn btn-md btn-success" type="submit" name="fsearchtour" id="fsearchtour" ><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Tìm kiếm -->

                <!-- BEGIN: Box-Table-->
                <div class="box-body table-responsive no-padding">
                    <table id="example1" class="table table-bordered table-hover dataTable" aria-describedby="example1_info" style="font-size:14px;">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 70px">STT</th>
                                <th class="text-center"> Tên</th>
								<th class="text-center"> Email</th>
								<th class="text-center"> Số điện thoại</th>
								<th class="text-center"> Địa chỉ</th>
								<?php if($_REQUEST['class']==4):?>
								<th  class="text-center"> Loại lớp </th>
								<?php endif?>
                                <th class="text-center">Ngày đăng ký</th>
                                <th class="text-center"></th>
                               
                            </tr>
                        </thead>
                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                        <?php
                        $i=1;
                        if($list){
                            foreach ($list as $key => $value) {
						 
								$query = $this->db->query('select * from tkwp_user where id = '.$value["user_id"].' ');
								$user =  $query->result_array();$user = $user[0] ;
								$query2 = $this->db->query('select name from tkwp_quanhuyen_category where id = '.$user["user_tinhthanh"].' ');
								$city =  $query2->result_array();$city = $city[0] ;
								$query3 = $this->db->query('select name from tkwp_quanhuyen where id = '.$user["user_quan"].' ');
								$quan =  $query3->result_array();$quan = $quan[0] ;
                              	?>
                                <tr class="<?= $opacity?>">
                                    <td class="text-center"> <?=$i?></td>
                                    <td class="text-left" > 
									<? echo       $user['user_first_name']. ' ' .$user['user_last_name'];   ?> 
									</td>
									<td class="text-left" > <?=  $user['user_email'] ?>  </td>
									<td class="text-left" > <?=  $user['user_phone'] ?> </td>
									<td class="text-left" > <?php 
									
									echo 'Địa chỉ: '. $user['user_address'].' ' .$city['name'] .' - '  . $quan['name'] ;?>  </td>
									
									<?php if($_REQUEST['class']==4):?>
									<td  class="text-left"> 
									<? 
									if($value['class_type_orther']){
										$lop =	explode('/', $value['class_type_orther']) ;
										for($i=0;$i<count($lop);$i++){
											echo  '- '. $lop[$i] .'<br>';
										}
									}
								
									?> 
									</td>
									<?php endif?>
                                     <td class="text-center"><?=$value['date_add']?></td>
                                    
                                    <td class="text-center">
                                       
                                    </td>
                                </tr>
                            <?php $i++ ;
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
                        <li class="disabled"><a><?= tat_ca?>: <?= $record?> customer</a></li>
                    </ul>
                
                </div>
                <!-- END: Box-Footer -->
            </div>
        </section>
        <!-- END: Main content -->
    </aside><!-- /.right-side -->
</form>
<style>body > .header {
margin-top: -20px;}</style>