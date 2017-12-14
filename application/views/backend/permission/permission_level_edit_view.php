
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
                                <li class=""><a href="<?= admin_url?>permission/groupaction" ><i class="fa fa-check"></i>  Group Action</a></li>                                
                                <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                   <form class="panel panel-default form-horizontal form-bordered"  method="post">
                            <!-- panel heading/header -->
                            <div class="panel-heading">
                                <h3 class="panel-title">Form control</h3>
                            </div>
                            <!--/ panel heading/header -->
                            <!-- panel body -->
                            <div class="panel-body">
                                <?php
                                if(isset($success) && $success && count($success)>0){
                                    echo '<div class="alert alert-info">';
                                        echo '<ul>';
                                        foreach ($success as $key => $value) {
                                            # code...
                                            echo '<li>'.$value.'</li>';
                                        }
                                        echo '</ul>';
                                    echo '</div>';
                                }
                                ?>     
                                <?php
                                if(isset($error) && $error && count($error) >0 ){
                                    echo '<div class="alert alert-danger">';
                                        echo '<ul>';
                                        foreach ($error as $key => $value) {
                                            # code...
                                            echo '<li>'.$value.'</li>';
                                        }
                                        echo '</ul>';
                                    echo '</div>';
                                }
                                ?>                                                                                            
                                <?php if(isset($info) && $info) { 
                                    echo '<div class="alert alert-info">';
                                        echo '<ul>';
                                        foreach ($info as $key => $value) {
                                            # code...
                                            echo '<li>'.$value.'</li>';
                                        }
                                        echo '</ul>';
                                    echo '</div>';
                                 } ?>
                                 <!--end message-->
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Tên</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="group_name" name="group_name" value="<?= $formData['group_name']?>">
                                    </div>
                                </div>  
                                                                                                                 
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Ghi chú</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" rows="5" id="group_note" name="group_note" ><?= $formData['group_note']?></textarea>                                        
                                    </div>
                                </div>    
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">STT</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="group_order" name="group_order" value="<?= $formData['group_order']?>">
                                    </div>
                                </div>                           
                                <div class="panel-footer">
                                    <div class="form-group no-border">
                                        <label class="col-sm-3 control-label"></label>
                                        <div class="col-sm-9 text-right">
                                            <button type="submit" name="fsubmit" class="btn btn-primary">Save</button>
                                            <a href="<?= admin_url?>permission/grouplevel" class="btn btn-danger">Exit</a>
                                        </div>
                                    </div> 
                                </div>                                                          
                            </div>
                            <!--/ panel body -->
                        </form>
                                </div>                               
                            </div>
                        </div>
                    </div>
                </div>
         
            
        </section>
    </aside><!-- /.right-side -->
