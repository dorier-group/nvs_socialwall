	                   <div class="success_error"></div>
	                   <form method="post" id="addcomment" enctype="multipart/form-data">
	                   <input type="hidden" name="id" id="id" value="{{$id}}">
	                   
						<input type="hidden" name="type" id="type">
						<input type="file" name="file" style="display:none;" id="file">
						@if(empty($exist))

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Name <span class="text-danger font-weight-bold">*</span></label>
									<input type="text" class="form-control" placeholder="Name" required name="f_name" id="f_name">
									<span class="f_name_error error"></span>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Write a message <span class="text-danger font-weight-bold">*</span></label>
									<textarea class="form-control" rows="5" placeholder="Write a message" required  name="message" id="message" ></textarea>
									<span class="message_error error"></span>
								</div>
							</div>
						</div>

						<div class="btn_box d-flex justify-content-center align-items-center border-bottom">
							
							<button type="button" class="btn customBtn btn-lg shadow-sm mx-1 files"  data-id="1"><i class="far fa-image"></i></button>
							<button type="button" class="btn customBtn btn-lg shadow-sm mx-1 files"  data-id="3"><i class="fas fa-film"></i></button>
							<span class="files_error d-block text-center mt-3"></span>
						</div>
						<span class="file_error error d-block text-center mt-3"></span>
					
						@endif
							 </form>
						@if(!empty($exist))
						<div class="message_container">
							
							<div class="text_box message_box">
								<p class="text message_text msg">{{$exist->message}}</p>
							</div>
								@if(!empty($exist->file))
							<div class="media_box border" >
								<div class="img_box">
									@if($exist->typ==1)
									<img src="{{url('public/uploads/'.$exist->file)}}" height="20px" height="20px">

									@elseif($exist->type==3)
									<video width="320" height="240" controls>
									  <source src="{{url('public/uploads/'.$exist->file)}}" type="video/mp4">
									
								
									</video>
									@endif
									<!-- <embed type="image/jpg" src="https://i.pravatar.cc/300" class=""> -->
								</div>
							</div>
							@endif
							<div id="appendmsg">
							<?php $reply=\App\ReplyModel::where('frm_id',$exist->id)->get();
						

							if(!empty($reply)){
								foreach($reply as $rows){
							
							?>
							<div class="text_box reply_box" >
								<p class="text reply_text"><?php echo $rows->message;?></p>
							</div>
						    <?php }  }?>

						   </div>

							<div class="reply_container border-top" id="imgbox">
								<div class="collapse border-bottom mb-3 pb-3" id="collapseExample">
									<form method="post" id="submitreplyfrm">
									<input type="hidden" name="frm_id" id="frm_id" value="{{$exist->id}}">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Name <span class="text-danger font-weight-bold">*</span></label>
												<input type="text" class="form-control" placeholder="Name" required name="reply_name" id="reply_name">
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>Reply<span class="text-danger font-weight-bold">*</span></label>
												<textarea class="form-control" rows="5" placeholder="Write a reply" required name="reply_message" id="reply_message"></textarea>
											</div>
										</div>
									</div>
									<div class="text-right">
										<button type="button" class="btn customBtn shadow-sm"  id="submitreply">Submit Reply</button>
									</div>
								</form>
								</div>

								<div class="text-right">
									<a class="btn customBtn shadow-sm" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Reply</a>
								</div>
							</div>
						</div>

						
						@endif
						
					 
