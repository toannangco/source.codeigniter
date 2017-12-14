<meta name="google-signin-client_id" content="497035533170-nl92qvcp1onu5qi9q9dh5mgm62htm0dc.apps.googleusercontent.com">
<script src="https://apis.google.com/js/platform.js" async defer></script>
<script src="https://apis.google.com/js/api:client.js"></script>
  <div class="list-breadcrum">
	<div class="container" >
		<ul class="list-inline">
			 <li>  <a href="<?=base_url()?>">Trang chủ ></a>  </li>
           <li class="active"><a > Thành viên </a></li>
		</ul>
	</div>
</div>
<link rel="stylesheet" type="text/css" href="<?=base_css?>user.css">
 <!--<script src="https://apis.google.com/js/client:platform.js?onload=startApp"></script>
<meta name="google-signin-client_id" content="497035533170-nl92qvcp1onu5qi9q9dh5mgm62htm0dc.apps.googleusercontent.com"> --->
<div class="container">
<form role="form" class="frm-left" method="post" action="<?= base_url.'user/login/?redirect='.base64_encode(base_url.'thanh-vien/form-dang-ky/?class='.$class.'&type='.$type) ;?>">
<div class="  text-center col-md-6 col-md-offset-3   col-xs-12">
    
         <h4 class="  font-vip color-vip text-center" id="myModalLabel">  
            Đăng nhập
        </h4>
		 
   
	
    <div class="modal-body">
	<div class="row" style="margin-bottom:10px">
		<div class="col-md-6 col-xs-6">
			 <div class="  margintb-10" style="width:100%">
				 <button class="loginBtn loginBtn--facebook btn-sm  text-center"  data-layout="button"   onclick="ajax_facebook_login();"  style="width:100%">
				   Login with Facebook
				</button>
			</div>
		</div>
		<div class="col-md-6 col-xs-6">
			 <div class="  margintb-10" style="width:100%">
				<button class="loginBtn loginBtn--google btn-sm buttonText" style="width:100%">
				 	 <div id="customBtn" class="customGPlusSignIn">
						<span class="buttonText">Login with Google</span>
						</div>
				</button> 
			
			</div>
		</div>
	</div>
	<div class="row">
			<?php
					if(isset($error) && $error)
					{
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
			</div>
        <div class="input-group margintb-10" style="width:100%">
           <label class="pull-left">  Tên tài khoản </label>
            <input type="text" placeholder="Tài khoản" class="form-control" required="required" id="xnuser_acc" name="username">
			</div>
        <div class="input-group margintb-10 "  style="width:100%">
            <label class="pull-left">  Mật khẩu  </label>
            <input type="password" placeholder="Mật khẩu" class="form-control" required="required" id="xnuser_password" name="password">
		</div>
			<input type="hidden" name="class" value="<?=$_REQUEST['class']?>" />
		<div class="row">
			<div class="col-md-6 col-xs-6">
				<div class="input-group margintb-10 "  style="width:100%">
					<button type="submit" name="flogin" class="btn btn-sm btn-info pull-left" id="xndangnhap" style="width:100%;padding:10px;font-size:15px;">  Đăng nhập  </button>
				</div>
			</div>
			<div class="col-md-6 col-xs-6">
				<div class="  margintb-10 "  style="width:100%">
					<a  onclick="document.location.href='<?=base_url?>user/register/'" name="" class="btn btn-sm btn-default pull-left"   style="width:100%;    padding: 10px;border-radius: 4px;    color: #fff;  font-size: 15px;background:#dd4b39">  Đăng ký </a>
				</div>
			</div>
		</div>
		
   </div> 
		
  
</div>
	 
</form>
</div>
<style>#u_0_2{margin-bottom:5px;}</style>

 
  <script>
    function onSuccess(googleUser) {
    //  console.log('Logged in as: ' + googleUser.getBasicProfile().getName());
	  
    }
    function onFailure(error) {
      console.log(error);
    }
    function renderButton() {
      gapi.signin2.render('my-signin2', {
        'scope': 'profile email',
        'width': 240,
        'height': 50,
        'longtitle': true,
        'theme': 'dark',
        'onsuccess': onSuccess,
        'onfailure': onFailure
      });
    }
  </script>
  <script>
  var googleUser = {};
  var startApp = function() {
    gapi.load('auth2', function(){
      
      auth2 = gapi.auth2.init({
        client_id: '497035533170-nl92qvcp1onu5qi9q9dh5mgm62htm0dc.apps.googleusercontent.com',
        cookiepolicy: 'single_host_origin',
        
      });
      attachSignin(document.getElementById('customBtn'));
    });
  };

  function attachSignin(element) {
    console.log(element.id);
    auth2.attachClickHandler(element, {},
        function(googleUser) {
          var name =  googleUser.getBasicProfile().getName();
		  var email = googleUser.getBasicProfile().getEmail() ;
		  var id    = googleUser.getBasicProfile().getId();
			//alert(name);
			loadajax(name,email,id) ;
        }, function(error) {
          //alert(JSON.stringify(error, undefined, 2));
        });
  };
  </script>
 
 
  <script>startApp();</script>
  <script>
 
   function loadajax(name1,email1,id1){  
	  var name = name1 ; var email = email1 ; var id_google = id1 ;
		$.ajax({  
			url: base_url+"user/logingoogle", type:"POST",
			data:{"id_google": id_google , "name":name, "email":email },
	  
		}).done(function( data ) {
			 console.log(data) ;  
			if(data==1){
				 window.location = base_url+"thanh-vien/"; 
			}else{
				alert('Xác nhận lại thông tin!');
				window.location = base_url+'user/register'; 
			} 
		}); 
  };
 
 </script>

