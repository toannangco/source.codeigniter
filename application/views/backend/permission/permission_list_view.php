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
                                <li class="active"><a href="<?= admin_url?>permission" ><i class="fa fa-bolt"></i> Permission</a></li>
                                <li class=""><a href="<?= admin_url?>permission/grouplevel" ><i class="fa fa-group"></i> Group Level</a></li>                                
                                <!-- <li class=""><a href="<?= admin_url?>permission/groupaction" ><i class="fa fa-check"></i>  Group Action</a></li>                                 -->
                                <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <form class="panel panel-default form-horizontal form-bordered"  method="post">
	                                <table class="table table-hover table-striped" id="table1">                                   
	                                    <thead>
	                                        <th></th>
	                                        <?php
	                                        if(isset($group) && $group)
	                                        {
	                                            foreach ($group as $key => $value) 
	                                            {
	                                                # code...
	                                                echo '<th class="text-center">'.$value["group_name"].'</th>';
	                                            }
	                                        }
	                                        ?>                                        
	                                        <th width="20px" class="text-center"><a class="btn btn-primary btn-xs" href="<?= admin_url?>permission/grouplevel_add/?redirect=<?= base64_encode(current_url())?>"><i class="fa fa-plus"></i></a></th>
	                                    </thead>
	                                    <tbody>
	                                    <?php
	                                    if(isset($groupaction) && $groupaction)
	                                    {
	                                        foreach ($groupaction as $key => $value) 
	                                        {
	                                            # code...
	                                            echo '<tr>';
	                                                echo '<td><code>'.$value["gc_value"].'</code> <small>('.$value["gc_name"].')</small></td>';
	                                                if(isset($group) && $group)
	                                                {
	                                                    foreach ($group as $k => $val) 
	                                                    {
	                                                        # code...         
	                                                            $myPermission = $this->mpermission->getData(array("gc_id"=>$value["id"],"group_id"=>$val["id"]));                                                            
	                                                            $checked = $myPermission ? 'checked="checked"':'';
	                                                            echo '<td class="text-center">';
	                                                                echo '<span class="checkbox custom-checkbox">';
	                                                                    echo'<input type="checkbox" id="aj_proccess_'.$value["id"].'_'.$val["id"].'" '.$checked.' class="aj_proccess" value="'.$value["id"].'-'.$val["id"].'" />';
	                                                                    echo '<label for="aj_proccess_'.$value["id"].'_'.$val["id"].'"></label>';
	                                                                echo '</span>';
	                                                            echo '</td>';                                                        
	                                                    }
	                                                }
	                                                echo '<td></td>';
	                                            echo '</tr>';
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
    </aside><!-- /.right-side -->
</form>