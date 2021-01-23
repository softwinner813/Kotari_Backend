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


		$('.toggle-switch').change(function(){
			var id = $(this).attr('id');
			var visible = $(this).attr('checkval');
			console.log(visible);
			var data = {
				id : id,
				visible : visible
			}
			$.post("/admin/houselist/houseVisible",
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
	});
</script>
	
@endsection


@section('content')
<div class="container-fluid">
	<h3><i class="fa fa-list"></i>&nbsp;
		@if(!is_null($visible) && $visible)
		Visible
		@elseif(!is_null($visible) && !$visible)
		Unvisible
		@else
		@endif
	 House List</h3>
	<br>

	<table class="table table-striped table-hover">
	  <thead class="">
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">Name</th>
	      <th scope="col">Island</th>
	      <th scope="col">Services</th>
	      <th scope="col" style="width: 80px;">View Rooms</th>
	      <th scope="col" style="width: 50px;">Visible</th>
	      <th scope="col" style="width: 50px;">Edit</th>
	    </tr>
	  </thead>
	  <tbody>
	  	@foreach($houses as $key => $house)
	    <tr>
	      <td><img src="/{{$house->images[0]->path}}" height="50"></td>
	      <td>{{$house->name}}</td>
	      <td>{{$house->island}}</td>
	      <td>
	      	@if($house->breakfast || $house->f_breakfast)<span class="badge badge-success">Breakfast</span>@endif
	      	@if($house->internet || $house->f_internet)<span class="badge badge-success">Wi-Fi</span>@endif
	      	@if($house->bar || $house->f_bar)<span class="badge badge-success">Bar</span>@endif
	      	@if($house->room_service || $house->f_room_service)<span class="badge badge-success">Room Service</span>@endif
	      	@if($house->front_desk || $house->f_front_desk)<span class="badge badge-success">Front Desk</span>@endif
	      	@if($house->kid || $house->f_kid)<span class="badge badge-success">Kid Friendly</span>@endif
	      	@if($house->pool || $house->f_pool)<span class="badge badge-success">Pool</span>@endif
	      	@if($house->park || $house->f_park)<span class="badge badge-success">Parking</span>@endif
	      	@if($house->fitness || $house->f_fitness)<span class="badge badge-success">Fitness Center</span>@endif
	      	@if($house->air || $house->f_air)<span class="badge badge-success">Air Condition</span>@endif
	      	@if($house->beach || $house->f_beach)<span class="badge badge-success">Beach Access</span>@endif
	      	@if($house->hot || $house->f_hot)<span class="badge badge-success">Hot Tub</span>@endif
	      	@if($house->spa || $house->f_spa)<span class="badge badge-success">Spa</span>@endif
	      	@if($house->laundry || $house->f_laundry)<span class="badge badge-success">Laundry</span>@endif
	      	@if($house->tv || $house->f_tv)<span class="badge badge-success">TV</span>@endif
	      	@if($house->smoke || $house->f_smoke)<span class="badge badge-success">Smoke Free</span>@endif
	      	

	      	

	      </td>
	      <td><a href="/admin/roomlist/{{$house->id}}" class="btn btn-success"><i class="fa fa-eye"></i></a></td>
	      <td>
	      	<label class="switch">
			  	<input type="checkbox" class="toggle-switch" checkval="{{$house->visible}}" id="{{$house->id}}"  @if($house->visible) checked @endif >
			  <span class="slider round"></span>
			</label>
	      </td>
	      <td>
	      	<a href="/admin/houseDetail/{{$house->id}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
	      </td>
	    </tr>
	    @endforeach
	   
	  </tbody>
	</table>
	<ul class="pagination float-right">
	  {{ $houses->links("pagination::bootstrap-4") }}
	</ul>
</div>
@endsection
