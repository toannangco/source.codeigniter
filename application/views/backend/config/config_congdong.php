

<form accept-charset="utf-8" method="post" enctype="multipart/form-data">
    <aside class="right-side">
        <section class="content-header">
            <h1>
                <small><?= $title ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= admin_url ?>home/"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
                <li class="active"><?= $title?></li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-solid box-primary">
                        <div class="box-header">
                            <i class="fa fa-info"></i>
                            <h3 class="box-title"><?= $title;?></h3>
                        </div>
						
						<div class="control-group">
								
                               <!-- <div class="controls">
                                    <input name="website_congdong_name" id="<?=$file?>" class=" form-control" value=" <?= $data['website_congdong_name']; ?>" >
                                       
                                    
                                </div> -->
                            </div> 

						   <div class="control-group">
								
                                <div class="controls">
                                    <textarea name="website_congdong_detail" id="<?=$file?>" class="summernote_contact form-control" >
                                        <?= $data['website_congdong_detail']; ?>
                                    </textarea>
                                </div>
                            </div> 
					 
							<div class="control-group col-md-6 col-xs-6 col-md-offset-3" style="min-height:300px;">
								
                                <div class="controls addClass">
                                  <span id="more">Thêm lớp học</span>
								  <?php if(count($data['website_congdong_class'])) { 	
									  $array =  explode("---",$data['website_congdong_class']);
										if(count($array)){
											for($i=0;$i<count($array);$i++){
											 
									  ?>
									
		Tên lớp :		<input type='text' name='website_congdong_class[]' value="<?=$array[$i]?>"  class='class form-control'/> 
											<?php  
								  }}}
									 ?>
                                </div>
                            </div> 
					 
							
                        </div>
                    
                        <div class="box-footer text-center">
                            <button name="fsubmit" type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i>
                                <span>Lưu</span>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </aside>
</form>
<script type="text/javascript" charset="utf-8" async defer>
   
    $(document).ready(function() {
	  $('.summernote_contact').summernote({
		height:400
	  });
	});
	 
</script>
<script type="text/javascript">
        jQuery(document).ready(function($) {
            $('#more').on('click',function(x){
                var textMore = "Tên lớp : <input type='text' name='website_congdong_class[]' class='class form-control'/> ";
                $(".addClass").append(textMore);
            });

            
        });
    </script>
<style>
 #more {    
	padding: 7px; margin-top:17px;
    float: right;
    background: red;
    color: #fff;
    border-radius: 5px;
    cursor: pointer;}
	.class{width:300px;}
</style>