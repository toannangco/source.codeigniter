<aside class="right-side">
    <section class="content-header">
        <h1>
            <small><i class="fa fa-bolt"></i> <?= $title ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= admin_url?>home/" ><i class="fa fa-dashboard"></i> <?= trang_chu?></a></li>
            <li class="active"><?= $title ?></li>
        </ol>
    </section>
    <section class="content">
        <div class="display_ms"></div>
        <div class="row">
            <?php if(!empty($error)) { ?>
            <div class="col-md-12">
                <div class="alert alert-danger">
                    <?= $error?>
                </div>
            </div>
            <?php } ?>
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class=""><a href="<?= admin_url?>permission" ><i class="fa fa-bolt"></i> Permission</a></li>
                        <li class=""><a href="<?= admin_url?>permission/grouplevel" ><i class="fa fa-group"></i> Group Level</a></li>
                        <li class="active"><a href="<?= admin_url?>permission/groupaction" ><i class="fa fa-check"></i>  Group Action</a></li>
                        <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <form method="get">
                                <input type="text" name="fkey" value="<?= $fkey;?>" class="form-control" placeholder="Nhập từ khóa tìm kiếm ... Nhấn enter">
                            </form>
                            <form method="post">
                            <table class="table table-bordered table-hover" id="table1">
                                <thead>
                                    <tr>
                                        <th colspan="7">
                                            <div class="pull-left"> 
                                                <select name="fstatus" class="form-control">
                                                    <option value="1">Hiện thị</option>
                                                    <option value="0">Ẩn</option>
                                                </select>
                                            </div>
                                            <div class="pull-left" style="margin-left:10px;"> 
                                                <input class="btn btn-primary" type="submit" name="ck_status_all" value="Lưu check chọn" />
                                            </div>
                                            <div class="pull-right"> 
                                                <a href="<?= admin_url?>permission/groupaction_add" class="btn btn-success ">Thêm mới</a>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th width="20px">STT</th>
                                        <th width="20%">Tên</th>
                                        <th>Action</th>
                                        <th width="15%">Create</th>
                                        <th width="10%">Status</th>
                                        <th width="10%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if(isset($list) && $list){
                                        $i=1;
                                        foreach ($list as $key => $value) {
                                            $link_update = admin_url.'permission/groupaction_edit/'.$value["id"].'/?redirect='.base64_encode(current_url());
                                            $link_delete = admin_url.'permission/groupaction_delete/'.$value["id"].'/?redirect='.base64_encode(current_url());
                                            $value["gc_status"] = $value["gc_status"] == 1 ? '<small class="label label-primary">Hiển thị</small>':'<small class="label label-danger">Không hiển thị</small>';
                                            echo '<tr>';
                                                echo '<td class="text-center"><input type="checkbox" name="ck_status[]" value="'.$value["id"].'" /></td>';
                                                echo '<td class="text-center">'.$i.'</td>';
                                                echo '<td>'.$value["gc_name"].'</td>';
                                                echo '<td><code>'.$value["gc_value"].'</code></td>';
                                                echo '<td>'.$value["gc_create"].'</td>';
                                                echo '<td>'.$value["gc_status"].'</td>';
                                                echo '<td>';
                                                    echo '<div class="toolbar">';
                                                        echo '<div class="btn-group">';
                                                            echo '<button type="button" class="btn btn-sm btn-default">Action</button>';
                                                            echo '<button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">';
                                                                echo '<span class="caret"></span>';
                                                            echo '</button>';
                                                            echo '<ul class="dropdown-menu dropdown-menu-right">';
                                                                echo '<li><a href="'.$link_update.'"><i class="icon ico-pencil"></i>Update</a></li>';
                                                                echo '<li class="divider"></li>';
                                                                echo '<li><a href="'.$link_delete.'" onclick="return Delete();" class="text-danger"><i class="icon ico-remove3"></i>Delete</a></li>';
                                                            echo '</ul>';
                                                        echo '</div>';
                                                    echo '</div>';
                                                echo '</td>';
                                            echo '</tr>';
                                            $i++;
                                        }
                                    }
                                    ?>
                                    
                                </tbody>
                            </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</aside>