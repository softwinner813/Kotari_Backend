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

	/* The Modal (background) */
	.modal {
	  display: none;
	  position: fixed;
	  z-index: 1;
	  padding-top: 100px;
	  left: 0;
	  top: 0;
	  width: 100%;
	  height: 100%;
	  overflow: auto;
	  background-color: black;
	}

	/* Modal Content */
	.modal-content {
	  position: relative;
	  background-color: #fefefe;
	  margin: auto;
	  padding: 0;
	  width: 90%;
	  max-width: 1200px;
	}

	/* The Close Button */
	.close {
	  color: white;
	  position: absolute;
	  top: 10px;
	  right: 25px;
	  font-size: 35px;
	  font-weight: bold;
	}

	.close:hover,
	.close:focus {
	  color: #999;
	  text-decoration: none;
	  cursor: pointer;
	}

	.mySlides {
	  display: none;
	}

	.cursor {
	  cursor: pointer;
	}

	/* Next & previous buttons */
	.prev,
	.next {
	  cursor: pointer;
	  position: absolute;
	  top: 50%;
	  width: auto;
	  padding: 16px;
	  margin-top: -50px;
	  color: white;
	  font-weight: bold;
	  font-size: 20px;
	  transition: 0.6s ease;
	  border-radius: 0 3px 3px 0;
	  user-select: none;
	  -webkit-user-select: none;
	}

	/* Position the "next button" to the right */
	.next {
	  right: 0;
	  border-radius: 3px 0 0 3px;
	}

	/* On hover, add a black background color with a little bit see-through */
	.prev:hover,
	.next:hover {
	  background-color: rgba(0, 0, 0, 0.8);
	}

	/* Number text (1/3 etc) */
	.numbertext {
	  color: #f2f2f2;
	  font-size: 12px;
	  padding: 8px 12px;
	  position: absolute;
	  top: 0;
	}

	img {
	  margin-bottom: -4px;
	}

	.caption-container {
	  text-align: center;
	  background-color: black;
	  padding: 2px 16px;
	  color: white;
	}

	.demo {
	  opacity: 0.6;
	}

	.active,
	.demo:hover {
	  opacity: 1;
	}

	img.hover-shadow {
	  transition: 0.3s;
	}

	.hover-shadow:hover {
	  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
	}


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

@section('content')




<!-- Begin Page Content -->
<div class="container-fluid">
	<h3><i class="fa fa-bed"></i>&nbsp; {{$room->name}} (<i class="fa fa-home"></i>{{$room->house->name}})</h3>
	<br>
		<form class="col-md-12" id="add_form" action="/admin/addRoomPost" method="post">
			{{ csrf_field() }}
			<input type="text" name="id" value="{{$room->id}}" style="display: none;">
			<input style="display: none;" type="text" name="house_id" value="{{$room->house->id}}">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="name"><i class="fa fa-bed"></i>&nbsp; Room Name:</label>
						<input type="text" value="{{$room->name}}" class="form-control" name="name" placeholder="Room name here..." required>
					</div>

					
					<div class="form-group">
						<label for="cur_price"><i class="fa fa-credit-card"></i>&nbsp;Price:</label>
						<input type="number"  value="{{$room->cur_price}}" class="form-control" name="cur_price" placeholder="$500" required>
					</div>


					<div class="form-group">
						<label for="cut_visible"><i class="fa fa-eye"></i>&nbsp;Cut off visible:</label>
						<br>
						<label class="switch">
						  	<input type="checkbox" name="visible_cut" class="toggle-switch" checkval="{{$room->visible_cut}}"  @if($room->visible_cut) checked @endif>
						  <span class="slider round"></span>
						</label>
					</div>
			
					<div class="form-group">
					    <label for="desc"><i class="fa fa-edit"></i>&nbsp;Description</label>
					    <textarea class="form-control" id="desc" name="desc" rows="5">{{$room->desc}}</textarea>
					</div>
				</div>

				<div class="col-md-6">


					<div class="form-group">
						<label for="room_offer"><i class="fa fa-coffee"></i>&nbsp;Room Offers:</label>

						<select class="room-offer form-control" name="room_offer[]" multiple="multiple" >
							<option @if($room->internet) selected="selected" @endif value="internet">Wi-Fi</option>
							<option @if($room->restaurant) selected="selected" @endif value="restaurant">Restaurant</option>
							<option @if($room->bar) selected="selected" @endif value="bar">Bar</option>
							<option @if($room->room_service) selected="selected" @endif value="room_service">Room service</option>
							<option @if($room->breakfast) selected="selected" @endif value="breakfast">Breakfast</option>
							<option @if($room->front_desk) selected="selected" @endif value="front_desk">Front desk</option>
							<option @if($room->kid) selected="selected" @endif value="kid">Kid-friendly</option>
							<option @if($room->pool) selected="selected" @endif value="pool">Pool</option>
							<option @if($room->park) selected="selected" @endif value="park">Parking</option>
							<option @if($room->fitness) selected="selected" @endif value="fitness">Fitness center</option>
							<option @if($room->air) selected="selected" @endif value="air">Air conditioning</option>
							<option @if($room->beach) selected="selected" @endif value="beach">Beach access</option>
							<option @if($room->hot) selected="selected" @endif value="hot">Hot tub</option>
							<option @if($room->spa) selected="selected" @endif value="spa">Spa</option>
							<option @if($room->laundry) selected="selected" @endif value="laundry">laundry</option>
							<option @if($room->tv) selected="selected" @endif value="tv">TV</option>
							<option @if($room->smoke) selected="selected" @endif value="smoke">Smoke-free</option>
							<option @if($room->pool) selected="selected" @endif value="pool">Water Pool</option>
						</select>
					</div>

					<div class="form-group">
						<label for="facility"><i class="fa fa-car"></i>&nbsp;Facilities:</label>

						<select class="facility-multi form-control" name="facility[]" multiple="multiple">
						  	<option @if($room->f_internet) selected="selected" @endif value="internet">Wi-Fi</option>
							<option @if($room->f_restaurant) selected="selected" @endif value="restaurant">Restaurant</option>
							<option @if($room->f_bar) selected="selected" @endif value="bar">Bar</option>
							<option @if($room->f_room_service) selected="selected" @endif value="room_service">Room service</option>
							<option @if($room->f_breakfast) selected="selected" @endif value="breakfast">Breakfast</option>
							<option @if($room->f_front_desk) selected="selected" @endif value="front_desk">Front desk</option>
							<option @if($room->f_kid) selected="selected" @endif value="kid">Kid-friendly</option>
							<option @if($room->f_pool) selected="selected" @endif value="pool">Pool</option>
							<option @if($room->f_park) selected="selected" @endif value="park">Parking</option>
							<option @if($room->f_fitness) selected="selected" @endif value="fitness">Fitness center</option>
							<option @if($room->f_air) selected="selected" @endif value="air">Air conditioning</option>
							<option @if($room->f_beach) selected="selected" @endif value="beach">Beach access</option>
							<option @if($room->f_hot) selected="selected" @endif value="hot">Hot tub</option>
							<option @if($room->f_spa) selected="selected" @endif value="spa">Spa</option>
							<option @if($room->f_laundry) selected="selected" @endif value="laundry">laundry</option>
							<option @if($room->f_tv) selected="selected" @endif value="tv">TV</option>
							<option @if($room->f_smoke) selected="selected" @endif value="smoke">Smoke-free</option>
							<option @if($room->f_pool) selected="selected" @endif value="pool">Water Pool</option>
						</select>
					</div>
					<br>
					<h5>Contact Information</h5>
					<div class="form-group">
						<label for="email"><i class="fa fa-envelope "></i>&nbsp; Email:</label>
						<input type="email" value="{{$room->email}}" class="form-control" name="email" placeholder="" required>
					</div>

					<div class="form-group">
						<label for="phone"><i class="fa fa-phone"></i>&nbsp; Phone Number:</label>
						<input type="text" value="{{$room->phone}}"  class="form-control" name="phone" placeholder="123-456-7890" required>
					</div>

					<div class="form-group">
						<label for="address"><i class="fa fa-address-card "></i>&nbsp; Address:</label >
						<input type="text" value="{{$room->address}}"  class="form-control" name="address" placeholder="" required>
					</div>

				</div>
		 	</div>	

		 	<div class="col-md-12">
		 		<h5><i class="fa fa-image"></i>&nbsp;Galley</h5>
		 		<div class="row">
		 			@foreach($room->images as $key => $image)
					  <div class="col-md-3" style="padding:5px;position: relative;" id="delimg{{$image->id}}">
					    <img src="/{{$image->path}}" style="width:100%" onclick="openModal();currentSlide( {{$key +1}})" class="hover-shadow cursor">
					    <div>
					  		<span class="btn btn-outline-danger btn-sm"  style="position: absolute;bottom: 10px;left: 10px;" onclick="delImage({{$image->id}})">&times;</span>
					    </div>
					  </div>

					@endforeach
				</div>

				<div id="myModal" class="modal">
				  <span class="close cursor" onclick="closeModal()">&times;</span>
				  <div class="row">
				  	<div class="col-md-12">
					  	@foreach($room->images as $key => $image)
					    <div class="mySlides" style="width: 100%;">
						      <div class="numbertext">{{$key + 1}} / {{count($room->images)}}</div>
						      <img class="col-md-6" src="/{{$image->path}}" style="margin-left: 25%;">
					    </div>
					    @endforeach
				  	</div>

				    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
				    <a class="next" onclick="plusSlides(1)">&#10095;</a>

				    <div class="caption-container">
				      <p id="caption"></p>
				    </div>

				    <div class="row mt-5">
				    	<center>
						  	@foreach($room->images as $key => $image)

						      <img class="demo cursor col-md-1 p-0" src="/{{$image->path}}" onclick="currentSlide({{$key + 1}})">
						    @endforeach
				    		
				    	</center>
				    </div>
				  </div>
				</div>
				<br>
		 		<h5><i class="fa fa-upload"></i>&nbsp;Image File Uploads</h5>
				<div class="well" data-bind="fileDrag: multiFileData">
				    <div class="form-group row">
				    	  <div class="col-md-12">
				            <input type="file" name="images[]" multiple data-bind="fileInput: multiFileData, customFileInput: {
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

		// Island Select Init
		var island = `{!! $room->island !!}`;
		$('#island option[value="' + island +'"]').prop('selected', true);


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

						setTimeout(function(){ 
							window.location.assign(window.location.href);
						}, 500);
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


	//================ Galley =============
	function openModal() {
	  document.getElementById("myModal").style.display = "block";
	}

	function closeModal() {
	  document.getElementById("myModal").style.display = "none";
	}

	var slideIndex = 1;
	showSlides(slideIndex);

	function plusSlides(n) {
	  showSlides(slideIndex += n);
	}

	function currentSlide(n) {
	  showSlides(slideIndex = n);
	}

	function showSlides(n) {
	  var i;
	  var slides = document.getElementsByClassName("mySlides");
	  var dots = document.getElementsByClassName("demo");
	  var captionText = document.getElementById("caption");
	  if (n > slides.length) {slideIndex = 1}
	  if (n < 1) {slideIndex = slides.length}
	  for (i = 0; i < slides.length; i++) {
	      slides[i].style.display = "none";
	  }
	  for (i = 0; i < dots.length; i++) {
	      dots[i].className = dots[i].className.replace(" active", "");
	  }
	  slides[slideIndex-1].style.display = "block";
	  dots[slideIndex-1].className += " active";
	  captionText.innerHTML = dots[slideIndex-1].alt;
	}

	// Delete Image
	function delImage(id) {
		console.log(id);

		$.post("/admin/roomDetail/delImage",
			{id:id},
			function(data, status){
		   		var res = JSON.parse(data);
				console.log(res);
		   		if(res['status'] == 200) {
					toastr['success'](res['message'], "Success!");

					$('#delimg' + id).remove();
		   		} else {
					toastr['error'](res['message'], "Error!");
		   		}
	    });
	}

</script>

@endsection