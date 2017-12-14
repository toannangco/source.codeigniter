 <style>#page,.list-breadcrum{margin-top:-21px;}.content_lophoc{min-height:300px;}</style>
  <div class="list-breadcrum">
	<div class="container" >
		<ul class="list-inline">
			 <li>  <a href="<?=base_url()?>">Trang chủ ></a>  </li>
           <li class="active"><a ><?=$title?> </a></li>
		</ul>
	</div>
</div>
<div class="container" style="background:#fff">
	<div class="row">
		<div class="col-md-12 col-xs-12">
			<div class="content_lophoc">
			<h2>Lớp học cộng đồng</h2>
				<?php   echo $class['classpublic_detail']?>
			 </div>
		</div>
		<div class="col-md-4 col-md-offset-4 col-xs-12">
			<form class="form" method="post" action="" class="text-center" >
				<div style="padding: 5px 6px 12px 22px;border:2px solid red;" >
				<?php if($class['classpublic_class']) :?>
					<?
					$value = explode("---",$class['classpublic_class']);  
					for($i=0;$i<count($value) ; $i++){
						//$name =  mb_strtolower(url_title(convert_alias($value[$i])));
						$name = $value[$i];
					?>
					       <div class="checkbox">
							  <label>
								<input type="checkbox" value="<?=$name?>" name="type[]" >
								<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
								 
									
									<!--<?=base_url?>thanh-vien/form-dang-ky/?class=4&type=<?=$name?>&redirect=<?=base64_encode(base_url.'thanh-vien/form-dang-ky/?class=4&type='.$name)?>-->
							  </label>
							  <p style="color:#3f48cc;font-weight:bold; float: right;  text-align: left; position: absolute; top: 4px;  left: 56px;"><?= $value[$i] ;?></p>
							</div>
					<?}?>
					<button type="submit" class="btn btn-danger btn-sm"  name="lopcongdong" 
						style="margin-left:20px;background:#ed1c24;color:#fff;border-radius:5px;font-weight:bold;    padding: 6px 20px; font-size: 15px;border: 1px solid red;;">
						Đăng ký
					</button>
					
					<button type="reset" class="btn btn-danger btn-sm"  name="lopcongdong" 
					style="margin-left:20px;background:#3f48cc;color:#fff;border-radius:5px;font-weight:bold;padding: 6px 20px; font-size: 15px;border: 1px solid red;">
					Hủy</button>
                <?php endif;?>
				</div>
				</form>
			</div>
	</div>
</div>
<style>
.checkbox label:after, 
.radio label:after {
    content: '';
    display: table;
    clear: both;
}
.glyphicon-ok:before{font-size:30px;}
.checkbox .cr,
.radio .cr {
    position: relative;
    display: inline-block;
    border: 1px solid #a9a9a9;
    border-radius: .25em;
    width: 33px;
    height: 26px;
    float: left;
    margin-right: .5em;
}

.radio .cr {
    border-radius: 50%;
}

.checkbox .cr .cr-icon,
.radio .cr .cr-icon {
    position: absolute;
    font-size: .8em;
    line-height: 0;
    top: 50%;
    left: 20%;
}

.radio .cr .cr-icon {
    margin-left: 0.04em;
}

.checkbox label input[type="checkbox"],
.radio label input[type="radio"] {
    display: none;
}

.checkbox label input[type="checkbox"] + .cr > .cr-icon,
.radio label input[type="radio"] + .cr > .cr-icon {
    
    opacity: 0;
    transition: all .3s ease-in;
}

.checkbox label input[type="checkbox"]:checked + .cr > .cr-icon,
.radio label input[type="radio"]:checked + .cr > .cr-icon {
    
    opacity: 1;
}

.checkbox label input[type="checkbox"]:disabled + .cr,
.radio label input[type="radio"]:disabled + .cr {
    opacity: .5;
}
 .glyphicon-ok:before {font-size:17px !important;}
 .checkbox .cr, .radio .cr {    border: 1px solid #3f48cc;  border-radius: 0;width:28px;height:25px;}
 .checkbox label { color: #3f48cc;  font-weight: bold;}
</style>