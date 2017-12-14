<?
if( isset($_SESSION['facebook'])){
	$facebook = $_SESSION['facebook'] ;   
	if($facebook){
		$user_username  = $facebook['email'] ;
		$user_email = $facebook['email'] ;
		$user_phone  = $facebook['phone'] ;
		$user_facebook     = $facebook['id'];
		$user_address = $facebook['address'];
		$user_first_name = $facebook['first_name']. ' ' . $facebook['last_name'] ;
	}
}else if(isset($_SESSION['google'])){
	$google = $_SESSION['google'] ;   
	if($google){ 
		$user_username  = $google['email'] ;
		$user_email = $google['email'] ;
		$user_google     = $google['id'];
		$user_first_name =  $google['name'];
	}
}
 
?>
<link rel="stylesheet" type="text/css" href="<?=base_css?>user.css">
<meta name="google-signin-client_id" content="497035533170-nl92qvcp1onu5qi9q9dh5mgm62htm0dc.apps.googleusercontent.com">
<script src="https://apis.google.com/js/platform.js" async defer></script>
<script src="https://apis.google.com/js/api:client.js"></script>
<form role="form"  class="frm-right" method="post"  action="<?= base_url.'user/register/'?>">
<div class="modal-dialog">
    <div class=" text-left">
        
            <h4 class="text-center font-vip color-vip" id="myModalLabel">  Đăng ký  </h4>
     
        <div class="modal-body">
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
			<div class="row" style="margin-bottom:10px">
				<div class="col-md-6 col-xs-6">
					 <div class="  margintb-10" style="width:100%">
						 <button class="loginBtn loginBtn--facebook btn-sm  text-center"  data-layout="button"   onclick="ajax_facebook_login();"  style="width:100%">
						   Login with Facebook
						</button>
					</div>
				</div>
				<div class="col-md-6 col-xs-6">
					<button class="loginBtn loginBtn--google btn-sm buttonText" style="width:100%">
				 	 <div id="customBtn" class="customGPlusSignIn">
						<span class="buttonText">Login with Google</span>
						</div>
				</button> 
				</div>
			</div>
            <div class="row">
                <div class="col-sm-12 col-xs-12">
					<label>User <span style="color:red">(*)</span></label>
                    <div class="input-group margintb-10">
                       
                        <input type="text" value="<?=htmlspecialchars($user_username)?>" placeholder="Tài khoản" required class="form-control" id="user_username" name="user_username" autocomplete="off"></div>
                </div>
				 <div class="col-sm-12 col-xs-12">
				 <label>Email <span style="color:red">(*)</span></label>
                    <div class="input-group margintb-10">
                        
                        <input type="email" value="<?=htmlspecialchars($user_email)?>" placeholder="Email" required class="form-control" id="user_email" name="user_email" autocomplete="off"></div>
						<input type="hidden" name="user_facebook" value="<?=$user_facebook?>">
						<input type="hidden" name="user_google" value="<?=$user_google?>">
				</div>
                <div class="col-sm-12 col-xs-12">
				<label>Mật khẩu <span style="color:red">(*)</span></label>
                    <div class="input-group margintb-10">
                         
                        <input type="password" placeholder=" " class="form-control" required id="user_password" name="user_password" autocomplete="off"></div>
                </div>
				<div class="col-sm-12 col-xs-12">
				<label>Xác nhận mật khẩu <span style="color:red">(*)</span></label>
                    <div class="input-group margintb-10">
                         
                        <input type="password" placeholder=" " class="form-control" required id="re_user_password" name="re_user_password" autocomplete="off"></div>
                </div>
        <div class="col-sm-12 col-xs-12">
		<label>Tên đầy đủ <span style="color:red">(*)</span></label>
            <div class="input-group margintb-10">
                
                <input type="text" value="<?=htmlspecialchars($user_first_name)?>" placeholder="Họ và Tên" required class="form-control" id="user_first_name" autocomplete="off" name="user_first_name">
			</div>
		</div> 
		 <div class="col-sm-12 col-xs-12">
		 <label>Địa chỉ <span style="color:red">(*)</span></label>
            <div class="input-group margintb-10">
                 
                <input type="text" value="<?=htmlspecialchars($user_address)?>" placeholder=" " required class="form-control" id="user_address" name="user_address" autocomplete="off"></div>
         </div> 
                <div class="col-sm-12 col-xs-12">
					<label>Điện thoại <span style="color:red">(*)</span></label>
                    <div class="input-group margintb-10">
                         
                        <input type="text" value="<?=htmlspecialchars($user_phone)?>" placeholder=" " required class="form-control" id="user_phone" name="user_phone" autocomplete="off"></div>
                </div>
               
            </div>
        </div>
        <div class="row" style="margin:0;">
			<div class="col-md-6 col-xs-6">
				<div class="input-group margintb-10 "  style="width:100%">
					<button type="submit" class="btn btn-main2 pull-left btn-info" id="xndangky"   style="width:100%;padding:8px;font-size:15px;">   Đăng ký   </button>
				</div>
			</div>
			<div class="col-md-6 col-xs-6">
				<div class="  margintb-10 "  style="width:100%">
					 <a  onclick="document.location.href='<?=base_url?>login/'" name="" class="btn btn-sm btn-default pull-left"   style="width:100%;    padding: 10px;border-radius: 4px;    color: #fff;  font-size: 15px;background:#dd4b39">  Đăng nhập </a>
				</div>
			</div>
            <!--<button class="loginBtn loginBtn--facebook btn-sm" onclick="ajax_facebook_login();">
			  Register with Facebook
			</button>

			<button class="loginBtn loginBtn--google btn-sm">
			  Register with Google
			</button>-->
        </div>
    </div>
</div>
</form>
<?//p($_SESSION['facebook'])?>
<style>.input-group{width:100%;}.form-control{height:33px;}</style>

 
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

 
 