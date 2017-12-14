<!-- Right side column. Contains the navbar and content of the page -->
<form accept-charset="utf-8" method="post" enctype="multipart/form-data">
    <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <small><?= $title?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Send mail thông báo</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?= $title?></h3>            
                </div>
                <!-- /.box-header -->

                <div class="box-body table-responsive">
                    
                    <div class="control-group ">
                        <label class="control-label">Tiêu đề:</label>

                        <div class="controls">
                            <input type="text" name="mailto_title" class="form-control required"/>
                        </div>
                    </div>

                    <div class="control-group ">
                        <label class="control-label">Nội dung:</label>

                        <div class="controls">
                            <textarea name="mailto_content" id="mailto_content" rows="10"
                                      class="form-control"></textarea>
                        </div>
                    </div>                    
                </div>
                <div class="box-body table-responsive">
                    <div class="control-group">
                        <div class="controls">
                            <input type="submit" class="btn btn-success" name="sendmail" value="Send"/>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            </div>
        </section>
        <!-- /.content -->
    </aside>
    <!-- /.right-side -->
</form>
<script type="text/javascript">
    /**begin ckeditor*/
     CKEDITOR.replace("mailto_content");
     /**end ckeditor*/
</script>
