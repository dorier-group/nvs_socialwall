	                   <div class="success_error"></div>
	                   <form method="post" id="addcomment">
	                   <input type="hidden" name="id" id="id" value="{{$id}}">
	                   
						<input type="hidden" name="type" id="type">
						<input type="file" name="file" style="display:none;" id="file">


						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>First name <span class="text-danger font-weight-bold">*</span></label>
									<input type="text" class="form-control" placeholder="First name" required name="f_name" id="f_name">
									<span class="f_name_error error"></span>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Last name <span class="text-danger font-weight-bold">*</span></label>
									<input type="text" class="form-control" placeholder="Last name" required name="l_name" id="l_name">
									<span class="l_name_error error"></span>
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

						<div class="d-flex flex-column justify-content-center align-items-center">
							<div>
								<button type="button" class="btn customBtn btn-lg shadow-sm mx-1 files"  data-id="1"><i class="far fa-image"></i></button>
								<button type="button" class="btn customBtn btn-lg shadow-sm mx-1 files"  data-id="3"><i class="fas fa-film"></i></button>
							</div>
							<span class="files_error d-block text-center mt-3"></span>
						</div>
						<span class="file_error error d-block text-center mt-3"></span>

						<div class="message_container border-top msg">
							
							@if(!empty($exist))
							<div class="text_box message_box">
								<p class="text message_text msg" >{{$exist->message}}</p>
							</div>
							@endif

							<div class="text_box reply_box">
								<p class="text reply_text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
							</div>

							<div class="text_box reply_box">
								<p class="text reply_text">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
							</div>

							<div class="text_box reply_box">
								<p class="text reply_text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
							</div>

							<div class="text_box reply_box">
								<p class="text reply_text">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
							</div>
						</div>	
						
					  </form>