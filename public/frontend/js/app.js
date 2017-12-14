	var base_url = 'http://hocvaluyenthiielts.com/';
	jQuery(document).ready(function( $ ) {
			var a = $(".menu ul").html();
			$("#menu ul").html(a);
              $("#menu").mmenu({
                "slidingSubmenus": false,
               "extensions": [
                  "fx-menu-zoom",
                  "fx-panels-zoom",
                  "pagedim-black"
               ],
               "offCanvas": {
                  "position": "right"
               },
              
               "iconPanels": true,
               "navbars": [
                  {
                     "position": "top"
                  }
               ]
            });
         });
   
$('.menu ul li').hover(function() {
	$(this).children('ul').stop(true, false, true).slideToggle(300);
});
$(window).scroll(function() {
		if($(window).scrollTop() > 100) {
		$('.cd-top').fadeIn();
		} else {
		$('.cd-top').fadeOut();
		}
	});
	$('#totop').click(function() { 
		$('html, body').animate({scrollTop:0},300);
	});	 

   /*
	// video
	$('.multi-item-carousel').carousel({
	  interval: false
	});
			$('.multi-item-carousel .item').each(function(){
				  var next = $(this).next();
				  if (!next.length) {
					next = $(this).siblings(':first');
				  }
				  next.children(':first-child').clone().appendTo($(this));
				  
				  if (next.next().length>0) {
					next.next().children(':first-child').clone().appendTo($(this));
				  } else {
					$(this).siblings(':first').children(':first-child').clone().appendTo($(this));
				  }
				});
	// end video	 
	*/
// custom
$('.multi-item-carousel').carousel({
  interval: false
}) ;
$('#myCarousel').carousel({
  
});

$('.multi-item-carousel .item').each(function(){
  var next = $(this).next();
  if (!next.length) {
    next = $(this).siblings(':first');
  }
  next.children(':first-child').clone().appendTo($(this));
  
  for (var i=0;i<2;i++) {
    next=next.next();
    if (!next.length) {
    	next = $(this).siblings(':first');
  	}
    
    next.children(':first-child').clone().appendTo($(this));
  }
});
// end custom	

	  
			$(".item .glyphicon").click(function(){
			 
				$(this).next("ul").toggle(400);
				if($(this).hasClass('glyphicon-chevron-right')){
					$(this).removeClass('glyphicon-chevron-right');
					$(this).addClass('glyphicon-chevron-down');
				}
				else{
					$(this).removeClass('glyphicon-chevron-down');
					$(this).addClass('glyphicon-chevron-right');
				}
			});
	// off banner
	$( ".close-top" ).click(function() {
	   $('.top').css("display","none")
	});
// get quan huyen dang ky mail
  jQuery('.mailto_city').change(function(){  
	var id_city = $(this).find(":selected").val() ;
			$.ajax({  
				url: base_url+"user/getWard", type:"POST",
                data:{"id_city": id_city  },
          
            }).done(function( data ) {
					console.log(data) ;
				  $('.user_quan').html(data) ;
				});  
				 
        });
// end	
// check form register mail 
 $("form[name='fmail']").submit(function(){ 
		 
		if( ! $('.mailto_fullname').val() ){
			 
			$('.errname').text('Điền tên') ;
			$(".mailto_fullname").focus();
			return false ;	
		}else if(! $('.mailto_phone').val() ){
			
			 $('.errname').text('Số điện thoại không để trống') ;
			$(".mailto_phone").focus();
			return false ;
		}else if( $('.mailto_phone').val() ){
			var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
			var str = $('.mailto_phone').val();
			if(! numberRegex.test(str)) {
					$('.errname').text('Phone phải là số') ;
					$(".mailto_phone").focus();
				   return false ;
			}
		} else if( ! validateEmail($('.mailto_email').val() )){
			 	$('.erremail').text('Không phải định dạng email ') ;
			$(".mailto_email").focus();
			return false ;
		}else {
			return true ;
		}
	});
	
	 $("form[name='search']").submit(function(){ 
		if( ! $('.fkey').val() ){
			 
			alert("Nhập từ khóa") ;
			$(".fkey").focus();
			return false ;	
		}else {
			return true ;
		}
	 });
// lược tải .

 $( ".clickdownload" ).click(function() {
   var id_document = ($(this).attr("data-id"));
			$.ajax({  
				url: base_url+"document/countDownload", type:"POST",
                data:{"id_document": id_document  },
          
            }).done(function( data ) {
				 
			}); 
});
// end luoc tai
 
  function ajax_facebook_login(){  
 FB.login( function(response) { 
 FB.api('/me?fields=id,age_range,birthday,email,first_name,gender,last_name,link,location,locale,middle_name,name,timezone,is_verified,name_format,updated_time,cover', 
 function(response){ 
	 $.ajax({ 
	 type:"POST", url:base_url+"user/login_facebook",
	  
	 data:response, 
	 
	 success:function(a){ 
		console.log(a) ;
	  if(a ==1){
				 	//alert('Ðang nh?p thành công') ;
				 
			  window.location = base_url+"user/"; 
	 	
		  }else if(a==2){ 
		  // 
				alert('Xác nhận lại !');
				window.location = base_url+'user/register'; 
		 
	 } 
} });
 }); }, 
 {scope:'public_profile,email'} ); } 
 
 // login google
 


 
 
        
	 			 
 