@extends('layouts.admin')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://rawgit.com/adrotec/knockout-file-bindings/master/knockout-file-bindings.css" rel="stylesheet" />


<style type="text/css">
	.disable-option {
		color: grey;
		font-style: italic;
		padding: 20px;
		margin-left: 20px;
	}
</style>
@endsection

@section('content')




<!-- Begin Page Content -->
<div class="container-fluid">
	<h3><i class="fa fa-bed"></i>&nbsp; ADD ROOM  @if(isset($house))of {{$house->name}}@endif</h3>
	<br>
		<form class="col-md-12" id="add_form" action="/admin/addRoomPost" method="post">
			{{ csrf_field() }}

			<div class="row">
				<div class="col-md-6">
					@if(!is_null($house))
					<input style="display: none;" type="text" name="house_id" value="{{$house->id}}">
					@elseif(!is_null($houses))
					<div class="form-group">

						<label for="name"><i class="fa fa-home"></i>&nbsp; House:</label>
						<select class="form-control" name="house_id">
							@foreach($houses as $key => $house)
							<option value="{{$house->id}}">{{$house->name}}</option>
							@endforeach
						</select>
					</div>

					@endif

					<div class="form-group">
						<label for="name"><i class="fa fa-bed"></i>&nbsp; Room Name:</label>
						<input type="text"  class="form-control" name="name" placeholder="Room name here..." required>
					</div>

					
					<div class="form-group">
						<label for="cur_price"><i class="fa fa-credit-card"></i>&nbsp;Price:</label>
						<input type="number"  class="form-control" name="cur_price" placeholder="MVR 500" required>
					</div>
			
					<div class="form-group">
					    <label for="desc"><i class="fa fa-edit"></i>&nbsp;Description</label>
					    <textarea class="form-control" id="desc" name="desc" rows="5"></textarea>
					</div>
				</div>

				<div class="col-md-6">


					<div class="form-group">
						<label for="room_offer"><i class="fa fa-coffee"></i>&nbsp;Room Offers:</label>

						<select class="room-offer form-control" name="room_offer[]" multiple="multiple">
						 	<option value="internet">Wi-Fi</option>
							<option value="restaurant">Restaurant</option>
							<option value="bar">Bar</option>
							<option value="room_service">Room service</option>
							<option value="breakfast">Breakfast</option>
							<option value="front_desk">Front desk</option>
							<option value="kid">Kid-friendly</option>
							<option value="pool">Pool</option>
							<option value="park">Parking</option>
							<option value="fitness">Fitness center</option>
							<option value="air">Air conditioning</option>
							<option value="beach">Beach access</option>
							<option value="hot">Hot tub</option>
							<option value="spa">Spa</option>
							<option value="laundry">laundry</option>
							<option value="tv">TV</option>
							<option value="smoke">Smoke-free</option>
							<option value="pool">Water Pool</option>
						</select>
					</div>

					<div class="form-group">
						<label for="facility"><i class="fa fa-car"></i>&nbsp;Facilities:</label>

						<select class="facility-multi form-control" name="facility[]" multiple="multiple">
						  	<option value="internet">Wi-Fi</option>
							<option value="restaurant">Restaurant</option>
							<option value="bar">Bar</option>
							<option value="room_service">Room service</option>
							<option value="breakfast">Breakfast</option>
							<option value="front_desk">Front desk</option>
							<option value="kid">Kid-friendly</option>
							<option value="pool">Pool</option>
							<option value="park">Parking</option>
							<option value="fitness">Fitness center</option>
							<option value="air">Air conditioning</option>
							<option value="beach">Beach access</option>
							<option value="hot">Hot tub</option>
							<option value="spa">Spa</option>
							<option value="laundry">laundry</option>
							<option value="tv">TV</option>
							<option value="smoke">Smoke-free</option>
							<option value="pool">Water Pool</option>
						</select>
					</div>
					<br>
					<h5>Contact Information</h5>
					<div class="form-group">
						<label for="email"><i class="fa fa-envelope "></i>&nbsp; Email:</label>
						<input type="email"  class="form-control" name="email" placeholder="" required>
					</div>

					<div class="form-group">
						<label for="phone"><i class="fa fa-phone"></i>&nbsp; Phone Number:</label>
						<input type="text"  class="form-control" name="phone" placeholder="123-456-7890" required>
					</div>

					<div class="form-group">
						<label for="address"><i class="fa fa-address-card "></i>&nbsp; Address:</label >
						<input type="text"  class="form-control" name="address" placeholder="" required>
					</div>

				</div>
		 	</div>	

		 	<div class="col-md-12">
		 		<h5><i class="fa fa-upload"></i>&nbsp;Image File Uploads</h5>
				<div class="well" data-bind="fileDrag: multiFileData">
				    <div class="form-group row">
				    	  <div class="col-md-12">
				            <input required type="file" name="images[]" multiple data-bind="fileInput: multiFileData, customFileInput: {
				              buttonClass: 'btn btn-success',
				              fileNameClass: 'disabled form-control',
				              onClear: onClear,
				            }" accept="image/*">
				        </div>
				        <div class="col-md-12">
				                  <!-- ko foreach: {data: multiFileData().dataURLArray, as: 'dataURL'} -->
				                  <img style="height: 100px; margin: 5px;" class="img-rounded  thumb" data-bind="attr: { src: dataURL }, visible: dataURL">
				                  <!-- /ko -->
				            <div data-bind="ifnot: fileData().dataURL">
				                <label class="drag-label">Drag files here</label>
				            </div>
				        </div>
				      
				    </div>
				</div>
		 	</div>	
		  	<button type="submit" id="save_btn" class="btn btn-success float-right col-md-12"><i class="fa fa-save "></i>&nbsp;Save</button>
		</form>
	
</div>
<!-- /.container-fluid -->
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/knockout/3.1.0/knockout-min.js"></script>
<script src="https://rawgit.com/adrotec/knockout-file-bindings/master/knockout-file-bindings.js"></script>

<script type="text/javascript" src="/js/jquery.form.js"></script>

<script type="text/javascript">

	$(document).ready(function() {
	    


		

		// Room Offer Select
		$('.room-offer').select2();
		$('.facility-multi').select2();




		$('#add_form').submit(function(e){
	 		e.preventDefault();
	 		console.log("fdsfds");

	 		$('#save_btn').attr('disabled', true);

	 		$('#add_form').ajaxSubmit({
				success: function (data) {
					var res = JSON.parse(data);
					console.log("data", res);
					if(res['status'] == 200) {
						toastr['success'](res['message'], "Success!");
					} else {
						toastr['error'](res['message'], "Error!");
					}
					$('#save_btn').removeAttr('disabled');
	            }
			});	

		});
	});


	$(function(){
	  var viewModel = {};
	  viewModel.fileData = ko.observable({
	    dataURL: ko.observable(),
	    // base64String: ko.observable(),
	  });
	  viewModel.multiFileData = ko.observable({
	    dataURLArray: ko.observableArray(),
	  });
	  viewModel.onClear = function(fileData){
	    if(confirm('Are you sure?')){
	      fileData.clear && fileData.clear();
	    }                            
	  };
	  viewModel.debug = function(){
	    window.viewModel = viewModel;
	    console.log(ko.toJSON(viewModel));
	    debugger; 
	  };
	  ko.applyBindings(viewModel);
	});
</script>

@endsection