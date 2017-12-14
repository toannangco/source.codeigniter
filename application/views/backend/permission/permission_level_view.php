<form accept-charset="utf-8" method="post" enctype="multipart/form-data">
    <aside class="right-side">
        <!-- BEGIN: Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <small><i class="fa fa-bolt"></i> <?= $title ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= admin_url?>home/" ><i class="fa fa-dashboard"></i> <?= trang_chu?></a></li>
                <li class="active"><?= $title ?></li>
            </ol>
        </section>
        <!-- END: Content Header (Page header) -->

        <!-- BEGIN: Main content -->
        <section class="content">            
				<div class="display_ms"></div>     
                <div class="row">                                                             
                	<div class="col-md-12">
                        <!-- Custom Tabs -->
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class=""><a href="<?= admin_url?>permission" ><i class="fa fa-bolt"></i> Permission</a></li>
                                <li class="active"><a href="<?= admin_url?>permission/grouplevel" ><i class="fa fa-group"></i> Group Level</a></li>                                
                                <!-- <li class=""><a href="<?= admin_url?>permission/groupaction" ><i class="fa fa-check"></i>  Group Action</a></li>                                 -->
                                <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <a href="<?= admin_url?>permission/grouplevel_add" class="btn btn-success pull-right">Add</a>
                                   <table class="table table-bordered table-hover" id="table1">
                                    <thead>
                                        <tr>                                                                                        
                                            <th width="20px">STT</th>                                            
                                            <th width="20%">Tên</th>                                            
                                            <th>Ghi chú</th>                                            
                                            <th width="15%">Create</th>                                            
                                            <th width="10%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if(isset($list) && $list){
                                            $i=1;
                                            foreach ($list as $key => $value) {
                                                # code...                                                
                                                $link_update = admin_url.'permission/grouplevel_edit/'.$value["id"].'/?redirect='.base64_encode(current_url());
                                                $link_delete = admin_url.'permission/grouplevel_delete/'.$value["id"].'/?redirect='.base64_encode(current_url());;
                                                echo '<tr>';                                                                                                   
                                                    echo '<td class="text-center">'.$value["group_order"].'</td>';
                                                    echo '<td>'.$value["group_name"].'</td>';
                                                    echo '<td>'.$value["group_note"].'</td>';                                                    
                                                    echo '<td>'.$value["group_create"].'</td>';

                                                    echo '<td>';
                                                        echo '<div class="toolbar">';
                                                            echo '<div class="btn-group">';
                                                                echo '<button type="button" class="btn btn-sm btn-default">Action</button>';
                                                                echo '<button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">';
                                                                    echo '<span class="caret"></span>';
                                                                echo '</button>';
                                                                echo '<ul class="dropdown-menu dropdown-menu-right">';
                                                                    echo '<li><a href="'.$link_update.'"><i class="fa fa-pencil"></i>Update</a></li>';
                                                                    echo '<li class="divider"></li>';
                                                                    echo '<li><a href="'.$link_delete.'" onclick="return Delete();" class="text-danger"><i class="fa fa-trash-o"></i>Delete</a></li>';
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
                                </div>                               
                            </div>
                        </div>
                    </div>
                </div>
         
            
        </section>
    </aside><!-- /.right-side -->
</form>