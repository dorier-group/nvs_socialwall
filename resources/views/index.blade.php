<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{csrf_token() }}">

	<title>Okela</title>

	<link rel="stylesheet" type="text/css" href="{{url('public/assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('public/assets/css/style.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('public/assets/css/dots.css')}}">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-1/css/all.css" />
</head>

<body>
	<main class="container-fluid px-0 py-5">
		<div class="container">
			<div class="col-xl-6 col-lg-7 col-md-10 col-12 mx-auto mb-5">
				<p class="welcome_text mb-0">Welcome to the guestbook of the Virtual Exhibition, supporting the Co-Creating Impact Summit 2021! Use this guest book to leave your reactions, impressions, thoughts and ideas.</p>
			</div>
		</div>

		<div class="frame">
		    <div class="bg_box"></div>
			<div class="circle_text_box">
				@if(!empty($category))
				<?php  $t=0; ?>
				@foreach($category as $rows)
				<?php  $t++; $tes=''; if($t>=21 && $t<=40){ $tes='rotate_text';} ?>
				<div class="text text-{{$t}}">
					<a href="#" class="link_text" data-toggle="tooltip" title="{{$rows['category_name']}}">
						<span class="text {{$tes}}">{{$rows['category_name']}}</span>
					</a>
				</div>
				@endforeach
				@endif
				
			</div>
			<?php 
			$i=0;
			$count=count($array)-3;
			foreach($array as $key=>$rows){
			$i++;
			?>
			<div class="ring ring-{{$i}}">
				<?php $j=0; ?>
				@foreach($rows as $row)
				<?php $j++; 

					$alre=\App\CategoryDetails::where('p_id',$row->id)->first();
					if(!empty($alre)){
						$submit="submit";
						$name=$alre->f_name;
						$lname=$alre->l_name;

					}else{
						$submit="";
						$name="";
						$lname="";
					}
					  if($i >$count){ $ani="reverse"; }else{ $ani="forward"; }
				?>
				<div class="dot dot-{{$j}}">
					<a href="javascript:void(0);" class="fill   {{$submit}} " data-id="{{$row->id}}" id="{{$row->id}}" >
						<div class="info_box" style="background-image: url(https://s3-eu-west-1.amazonaws.com/devenv-okela-stage/artists/images/000/000/156/medium_dark/avatar.jpg?1585044291);">
							<h6 class="name_text">
								<span class="first_name">{{$name}}</span>
								<span class="last_name">{{$lname}}</span>
							</h6>
						</div>
					</a>
				</div>
				@endforeach
			</div>
			<?php } ?>

			
		</div>


		<div class="modal fade dataModal" id="myModal">
			<div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
			  	<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Share Something</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>

					<div class="modal-body" id="usermodel">
						
					</div>

					<div class="modal-footer">
						<button type="button" class="btn customBtn shadow-sm" id="submitcomment">Share <i class="fas fa-angle-right ml-1"></i></button>
					</div>
			  	</div>
			</div>
		</div>
	</main>

	<script src="{{url('public/assets/js/jquery-3.6.0.min.js')}}"></script>
	<script src="{{url('public/assets/js/popper.min.js')}}"></script>
	<script src="{{url('public/assets/js/bootstrap.min.js')}}"></script>

<script>
		$(document).ready(function() {
			$("div.ring-1 div.dot a.fill, div.ring-2 div.dot a.fill, div.ring-3 div.dot a.fill, div.ring-4 div.dot a.fill, div.ring-5 div.dot a.fill, div.ring-6 div.dot a.fill, div.ring-7 div.dot a.fill, div.ring-8 div.dot a.fill, div.ring-9 div.dot a.fill, div.ring-10 div.dot a.fill, div.ring-11 div.dot a.fill, div.ring-12 div.dot a.fill, div.ring-13 div.dot a.fill").hover(
				function () {
					$("a.fill").addClass("animation_forward");
				},
				function () {
					$("a.fill").removeClass("animation_forward");
				}
			);

			$("div.ring-14 div.dot a.fill, div.ring-15 div.dot a.fill, div.ring-16 div.dot a.fill").hover(
				function () {
					$("a.fill").addClass("animation_reverse");
				},
				function () {
					$("a.fill").removeClass("animation_reverse");
				}
			);

			$("div.bg_box").hover(
				function () {
					$("a.fill").addClass("bg_box_animation");
				},
				function () {
					$("a.fill").removeClass("bg_box_animation");
				}
			);
		});
	</script>

	<script>
		$(document).ready(function() {
			$("a.fill").hover(
				function () {
					$(this).parent().addClass("index_1");
					$(this).parent().parent().addClass("index_1");
				},
				function () {
					$(this).parent().removeClass("index_1");
					$(this).parent().parent().removeClass("index_1");
				}
			);
		});
	</script>

	<script>
		$(document).ready(function(){
			$('[data-toggle="tooltip"]').tooltip();   
		});
	</script>

	<script>
		$('body').on('click','.fill',function(){
			var id=$(this).attr('data-id');
			var url='{{url("show_frm")}}';
			 $.ajaxSetup({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            }

	        });
		    $.ajax({
            type: 'post',
            url: url,
            data:{'id':id},
            success: function (data) {
             $('#usermodel').html(data); 
              $('#myModal').modal('show'); 

            }
          });
			
		})

		$('body').on('click','.files',function(){
			var type=$(this).attr('data-id');
			$('#type').val(type);
			// $('#file').click();
			// var filename = $('input[type=file]').val().replace(/C:\\fakepath\\/i, '');  
	  //           $('.file_error').text(filename);
	             $('#file').trigger('click');
			    $('#file').change(function() {
			        var filename = $('#file').val();
			        if (filename.substring(3,11) == 'fakepath') {
			            filename = filename.substring(12);
			        } // Remove c:\fake at beginning from localhost chrome
			         $('.files_error').text(filename);
			         $('.file_error').text(' ');
			   });
			
		})
		

	$('body').on('click','#submitcomment',function(){
	   var f_name = $("#f_name").val();
	   if (f_name=="" || f_name==null) {
		       $('.f_name_error').text('Enter First Name');
		       $("#f_name").focus();
		        return false;
	   }else{
		         $('.f_name_error').text(' ');
		    
	   }
	   var l_name = $("#l_name").val();
	   if (l_name=="" || l_name==null) {
		      $('.l_name_error').text('Enter Last Name');
		       $("#l_name").focus();
		        return false;
	   }else{
		         $('.l_name_error').text(' ');
		    
	   }	
	   var title = $("#message").val();
	   if (title=="" || title==null) {
		       $('.message_error').text('Enter Message');
		       $("#message").focus();
		        return false;
	   }else{
		         $('.message_error').text(' ');
		    
	   }
	   // var image = document.getElementById("file").value;
	   // var ext = image.split('.').pop().toLowerCase();
	   // if(image=="")
	   // {
	   //     $('.file_error').text('Please Select File');
	   //     document.getElementById("file").focus();
	   //     return false;
	   // }
	    // else if(image!="") ['pdf','doc','docx','xls']
	    // {    
	    // if($.inArray(ext, ['png','jpg','jpeg']) == -1)
	    // {
	    //     $('.file_error').text('Wrong File Format!..Please Select Right Format');
	    //     document.getElementById("file").value='';
	    //     document.getElementById("file").focus();
	    //     return false;
	    // }
	    // }
	
	var form_data = new FormData();
      form_data.append("file", document.getElementById('file').files[0]);
      form_data.append('message', $("#message").val());
      form_data.append('f_name', $("#f_name").val());
      form_data.append('l_name', $("#l_name").val());
      form_data.append('type', $("#type").val());
      form_data.append('id', $("#id").val());
      var url='{{url("add_comment")}}';
      var msg=$("#message").val();
      var id=$("#id").val();
       $('#'+id).addClass('submit');
       $.ajaxSetup({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            }

	        });
		   $.ajax({
	       type: 'post',
	       url: url,
	       data: form_data,
		   contentType: false,
		   cache: false,
		   processData: false,
		   dataType:'JSON',
	       success: function (data) {
	            	if(data.sucess==true){
	                 
	                 
	            	  $('#'+id).html('<div class="info_box" style="background-image: url(https://s3-eu-west-1.amazonaws.com/devenv-okela-stage/artists/images/000/000/156/medium_dark/avatar.jpg?1585044291);"><h6 class="name_text"><span class="first_name">'+f_name+'</span><span class="last_name">'+l_name+'</span></h6></div>');
	            	   $('#addcomment')[0].reset();
	                  $('#myModal').modal('hide'); 
	                  $('.success_error').html('<div class="alert alert-success" role="alert">Form Submit Successfully</div>');
	            	}else{
	            	  $('.success_error').html('<div class="alert alert-danger" role="alert">Something went wrong</div>');	
	            	}
	            	$('.msg').prepend('<div class="text_box message_box"><p class="text message_text msg" >'+msg+'</p></div>');
	            


	            }
	          });
		})
	setInterval(function () {
    	 var url='{{url("show_graph")}}';
        $.ajaxSetup({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            }

	        });
		$.ajax({
            type: 'post',
            url: url,
           
            success: function (data) {
             $('.frame').html(data); 
             $("div.bg_box").hover(
				function () {
					$("a.fill").addClass("bg_box_animation");
				},
				function () {
					$("a.fill").removeClass("bg_box_animation");
				}
			);
             $("div.ring-1 div.dot a.fill, div.ring-2 div.dot a.fill, div.ring-3 div.dot a.fill, div.ring-4 div.dot a.fill, div.ring-5 div.dot a.fill, div.ring-6 div.dot a.fill, div.ring-7 div.dot a.fill, div.ring-8 div.dot a.fill, div.ring-9 div.dot a.fill, div.ring-10 div.dot a.fill, div.ring-11 div.dot a.fill, div.ring-12 div.dot a.fill, div.ring-13 div.dot a.fill").hover(
				function () {
					$("a.fill").addClass("animation_forward");
				},
				function () {
					$("a.fill").removeClass("animation_forward");
				}
			);

			$("div.ring-14 div.dot a.fill, div.ring-15 div.dot a.fill, div.ring-16 div.dot a.fill").hover(
				function () {
					$("a.fill").addClass("animation_reverse");
				},
				function () {
					$("a.fill").removeClass("animation_reverse");
				}
			);

			
			$("a.fill").hover(
				function () {
					$(this).parent().addClass("index_1");
					$(this).parent().parent().addClass("index_1");
				},
				function () {
					$(this).parent().removeClass("index_1");
					$(this).parent().parent().removeClass("index_1");
				}
			);

            }
          });
    },30000);
	</script>
	<style type="text/css">
		span.error {
		    color: red;
		}
	</style>

</body>

</html>