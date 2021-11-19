			<div class="circle_text_box">
				@if(!empty($category))
				<?php  $t=0; ?>
				@foreach($category as $rows)
				<?php  $t++;   $tes=''; if($t>=21 && $t<=40){ $tes='rotate_text';}?>
				<div class="text text-{{$t}}">
					<a href="#" class="link_text" data-toggle="tooltip" title="{{$rows['category_name']}}">
						<span class="text {{$tes}}" >{{$rows['category_name']}}</span>
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
					<a href="javascript:void(0);" class="fill {{$submit}} " data-id="{{$row->id}}" id="{{$row->id}}" >
						<div class="info_box">
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