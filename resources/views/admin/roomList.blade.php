@extends('layouts.admin')

@section('css')
<style type="text/css">
	/* The switch - the box around the slider */
	.switch {
	  position: relative;
	  display: inline-block;
	  width: 60px;
	  height: 34px;
	}

	/* Hide default HTML checkbox */
	.switch input {
	  opacity: 0;
	  width: 0;
	  height: 0;
	}

	/* The slider */
	.slider {
	  position: absolute;
	  cursor: pointer;
	  top: 0;
	  left: 0;
	  right: 0;
	  bottom: 0;
	  background-color: #ccc;
	  -webkit-transition: .4s;
	  transition: .4s;
	}

	.slider:before {
	  position: absolute;
	  content: "";
	  height: 26px;
	  width: 26px;
	  left: 4px;
	  bottom: 4px;
	  background-color: white;
	  -webkit-transition: .4s;
	  transition: .4s;
	}

	input:checked + .slider {
	  background-color: #2196F3;
	}

	input:focus + .slider {
	  box-shadow: 0 0 1px #2196F3;
	}

	input:checked + .slider:before {
	  -webkit-transform: translateX(26px);
	  -ms-transform: translateX(26px);
	  transform: translateX(26px);
	}

	/* Rounded sliders */
	.slider.round {
	  border-radius: 34px;
	}

	.slider.round:before {
	  border-radius: 50%;
	}
</style>
@endsection

@section('js')
<script type="text/javascript">
	$(document).ready(function() {

		// Visible or Unvisible Room

		$('.toggle-switch').change(function(){
			var id = $(this).attr('id');
			var visible = $(this).attr('checkval');
			console.log(visible);
			var data = {
				id : id,
				visible : visible
			}
			$.post("/admin/roomlist/setVisible",
				data,
				function(data, status){
			   		var res = JSON.parse(data);
					console.log(res);
			   		if(res['status'] == 200) {
						toastr['success'](res['message'], "Success!");
			   		} else if(res['status'] == 300) {
						toastr['info'](res['message'], "Alert!");
			   		} else {
						toastr['error'](res['message'], "Error!");
			   		}
		    });
		});


		// Delete Room
		$('.del-btn').click(function(){
			var id = $(this).attr('delid');
			console.log(id);
			var data = {
				id: id
			};


			$.post("/admin/roomlist/deleteRoom",
				data,
				function(data, status){
			   		var res = JSON.parse(data);
					console.log(res);
			   		if(res['status'] == 200) {
						toastr['success'](res['message'], "Success!");

						setTimeout(function(){ 
							window.location.assign(window.location.href);
						}, 500);

			   		} else if(res['status'] == 300) {
						toastr['info'](res['message'], "Alert!");
			   		} else {
						toastr['error'](res['message'], "Error!");
			   		}
		    });

		});
	});
</script>
	
@endsection


@section('content')
<div class="container-fluid">
	<h3>
		<i class="fa fa-list"></i>&nbsp;
		@if(!is_null($visible) && $visible)
		Visible
		@elseif(!is_null($visible) && !$visible)
		Unvisible
		@else
		@endif
	 	
	 	Rooms @if(!is_null($house))of {{$house->name}} @endif
		@if(is_null($house))
		<a href="/admin/addroom/0" class="btn btn-success btn-circle float-right"><i class="fa fa-plus"></i></a>

		@else
		<a href="/admin/addroom/{{$house->id}}" class="btn btn-success btn-circle float-right"><i class="fa fa-plus"></i></a>
		
		@endif
	</h3>
	<br>

	<table class="table table-striped table-hover">
	  <thead class="">
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">Name</th>
	      @if(is_null($house))
	      <th scope="col">House</th>
	      @endif
	      <th scope="col">Price ($)</th>
	      <th scope="col">Pre Price ($)</th>
	      <th scope="col">Island</th>
	      <th scope="col">Visible</th>
	      <th scope="col">Edit</th>
	      <th scope="col">Delete</th>
	    </tr>
	  </thead>
	  <tbody>
	  	@foreach($rooms as $key => $room)
	    <tr>
	      <td><img src="/{{$room->images[0]->path}}" height="50"></td>
	      <td>{{$room->name}}</td>
	      @if(is_null($house))
	      <td>{{$room->house->name}}</td>
	      @endif
	      <td>
	      	{{$room->cur_price}}
	      	&nbsp;
	      	@if($room->visible_cut)
      		<span class="badge badge-danger">{{$room->cut_rate}}% off</span>
	      	@endif
	      </td>
	      <td>{{$room->pre_price}}</td>
	      <td>{{$room->island}}</td>
	      <td>
	      	<label class="switch">
			  	<input type="checkbox" class="toggle-switch" checkval="{{$room->visible}}" id="{{$room->id}}"  @if($room->visible) checked @endif >
			  <span class="slider round"></span>
			</label>
	      </td>
	      <td>
	      	<a href="/admin/roomDetail/{{$room->id}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
	      </td>


	      <td>
	      	<button class="btn btn-danger del-btn" delid= "{{$room->id}}"><i class="fa fa-trash"></i></a>
	      </td>
	    </tr>
	    @endforeach
	   
	  </tbody>
	</table>
	<ul class="pagination float-right">
	  {{ $rooms->links("pagination::bootstrap-4") }}
	</ul>
</div>
@endsection
