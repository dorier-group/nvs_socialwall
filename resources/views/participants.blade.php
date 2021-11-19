<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{csrf_token() }}">

	<title>Dorier</title>

	<link rel="stylesheet" type="text/css" href="{{url('public/assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('public/assets/css/style.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('public/assets/css/dots.css')}}">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-1/css/all.css" />
</head>

<body>
	<main class="container-fluid px-0 pt-5">
		<div class="container">
			<div class="col-xl-6 col-lg-7 col-md-10 col-12 mx-auto mb-5">
				<p class="welcome_text mb-0">Welcome to the guestbook of the Virtual Exhibition, supporting the Co-Creating Impact Summit 2021! Use this guest book to leave your reactions, impressions, thoughts and ideas.</p>
			</div>
		</div>
		<form method="post" id="groupsadd">
		  <div class="form-group">
		    <label for="exampleInputEmail1">Group</label>
		   <select class="form-control" name="group" id="group">
		   	<option value="">Select Group</option>
		   	@if(!empty($ring))

		   	@foreach($ring as $rows)
		   	<option value="{{$rows->id}}">{{$rows->groups}}</option>
		   	@endforeach
		   	@endif
		   </select>
		  </div>
		  <div class="form-group">
		    <label for="exampleInputPassword1">Participants</label>
		    <input type="text" class="form-control" id="participant" name="participant">
		  </div>
		 
		  <button type="button" class="btn btn-primary submitparticpant">Submit</button>
		</form>

	</main>
</body>

	<script src="{{url('public/assets/js/jquery-3.6.0.min.js')}}"></script>
	<script src="{{url('public/assets/js/popper.min.js')}}"></script>
	<script src="{{url('public/assets/js/bootstrap.min.js')}}"></script>
	<script type="text/javascript">
		$('body').on('click','.submitparticpant',function(){
			 $.ajaxSetup({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            }

	        });
			var url='{{url("add_particpant")}}';
			    $.ajax({
	            type: 'post',
	            url: url,
	            data:$('#groupsadd').serialize(),
	            success: function (data) {
	             

	            }
	          });
		})
	</script>
</html>