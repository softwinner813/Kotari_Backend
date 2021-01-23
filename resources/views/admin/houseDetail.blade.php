
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
	<h3><i class="fa fa-home"></i>&nbsp; {{$house->name}}</h3>
	<br>
		<form class="col-md-12" id="add_form" action="/admin/addHousePost" method="post">
			{{ csrf_field() }}
			<input type="text" name="id" value="{{$house->id}}" style="display: none;">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="name"><i class="fa fa-home"></i>&nbsp; House Name:</label>
						<input type="text" value="{{$house->name}}" class="form-control" name="name" placeholder="House name here..." required>
					</div>

					<div class="form-group">
						<label for="island"><i class="fa fa-map-marker"></i>&nbsp;Island:</label>
						<select name="island" class="form-control" required>
	  						<optgroup label=""> 
		  						<option>HA. Baarah</option>
		  						<option>HA. Dhiddhoo</option>
								<option>HA. Filladhoo</option>
								<option>HA. Hoarafushi</option>
								<option>HA. Ihavandhoo</option>
								<option>HA. Kelaa</option>
								<option>HA. Maarandhoo</option>
								<option>HA. Mulhadhoo</option>
								<option>HA. Muraidhoo</option>
								<option>HA. Thakandhoo</option>
								<option>HA. Thuraakunu</option>
								<option>HA. Uligamu</option>
								<option>HA. Utheemu</option>
								<option>HA. Vashafaru</option>
		  					</optgroup>

	  						<optgroup label=""> 
		  						<option>HDh. Hanimaadhoo</option>
								<option>HDh. Finey</option>
								<option>HDh. Naivaadhoo</option>
								<option>HDh. Nolhivaranfaru</option>
								<option>HDh. Nellaidhoo</option>
								<option>HDh. Nolhivaram</option>
								<option>HDh. Kurinbi</option>
								<option>HDh. Kulhudhuffushi</option>
								<option>HDh. Kumundhoo</option>
								<option>HDh. Neykurendhoo</option>
								<option>HDh. Vaikaradhoo</option>
								<option>HDh. Makunudhoo</option>
								<option>HDh. Hirimaradhoo</option>

		  					</optgroup>
		  					

	  						<optgroup label="">
		  						<option>Sh. Bileffahi</option>
								<option>Sh. Feevah</option>
								<option>Sh. Feydhoo</option>
								<option>Sh. Foakaidhoo</option>
								<option>Sh. Funadhoo</option> 
								<option>Sh. Goidhoo</Funadhoo>
								<option>Sh. Kanditheemu</option>
								<option>Sh. Komandoo</option>
								<option>Sh. Lhaimagu</option>
								<option>Sh. Maaungoodhoo</option>
								<option>Sh. Maroshi</option>
								<option>Sh. Milandhoo</option>
								<option>Sh. Narudhoo</option>
								<option>Sh. Noomaraa</option>
		  					</optgroup>

		  					<optgroup label="">
		  						<option>N. Foddhoo</option>
								<option>N. Henbandhoo</option>
								<option>N. Holhudhoo</option>
								<option>N. Kendhikulhudhoo</option>
								<option>N. Kudafari</option>
								<option>N. Landhoo</option>
								<option>N. Lhohi</option>
								<option>N. Maafaru</option>
								<option>N. Maalhendhoo</option>
								<option>N. Magoodhoo</option>
								<option>N. Manadhoo</option>
								<option>N. Miladhoo</option>
								<option>N. Velidhoo</option>
		  					</optgroup>

		  					<optgroup label="">
		  						<option>R. Alifushi</option>
								<option>R. Angolhitheemu</option>
								<option>R. Fainu</option>
								<option>R. Hulhudhuffaaru</option>
								<option>R. Inguraidhoo</option>
								<option>R. Innamaadhoo</option>
								<option>R. Dhuvaafaru</option>
								<option>R. Kinolhas</option>
								<option>R. Maakurathu</option>
								<option>R. Maduvvaree</option>
								<option>R. Meedhoo</option>
								<option>R. Rasgetheemu</option>
								<option>R. Rasmaadhoo</option>
								<option>R. Ungoofaaru</option>
								<option>R. Vaadhoo</option>
		  					</optgroup>

		  					<optgroup label="">
		  						<option>B. Dharavandhoo</option>
								<option>B. Dhonfanu</option>
								<option>B. Eydhafushi (capital of Baa Atoll)</option>
								<option>B. Fehendhoo</option>
								<option>B. Fulhadhoo</option>
								<option>B. Goidhoo</option>
								<option>B. Hithaadhoo</option>
								<option>B. Kamadhoo</option>
								<option>B. Kendhoo</option>
								<option>B. Kihaadhoo</option>
								<option>B. Kudarikilu</option>
								<option>B. Maalhos</option>
								<option>B. Thulhaadhoo</option>
		  					</optgroup>

		  					<optgroup label="">
		  						<option>Lh. Hinnavaru</option>
								<option>Lh. Kurendhoo</option>
								<option>Lh. Maafilaafushi</option>
								<option>Lh. Naifaru</option> 
								<option>Lh. Olhuvelifushi</option>
		  					</optgroup>

		  					<optgroup label="">
		  						<option>K. Dhiffushi</option>
								<option>K. Gaafaru</option>
								<option>K. Gulhi</option>
								<option>K. Guraidhoo</option>
								<option>K. Himmafushi</option>
								<option>K. Hulhumalé</option>
								<option>K. Huraa</option>
								<option>K. Kaashidhoo</option>
								<option>K. Malé </option>
								<option>K. Maafushi </option>
								<option>K. Thulusdhoo </option>
								<option>K. Vilimalé</option>
		  					</optgroup>

		  					<optgroup label="">
		  						<option>AA. Bodufolhudhoo</option><option>
								<option>AA. Himandhoo</option>
								<option>AA. Maalhos</option>
								<option>AA. Mathiveri</option>
								<option>AA. Rasdhoo</option> 
								<option>AA. Thoddoo</option>
								<option>AA. Ukulhas</option>
								<option>AA. Fesdhoo</option>
		  					</optgroup>

		  					<optgroup label="">
		  						<option>ADh. Dhangethi</option>
								<option>ADh. Dhiddhoo</option>
								<option>ADh. Dhigurah</option>
								<option>ADh. Fenfushi</option>
								<option>ADh. Haggnaameedhoo</option>
								<option>ADh. Kunburudhoo</option>
								<option>ADh. Maamingili</option>
								<option>ADh. Mahibadhoo</option> 
								<option>ADh. Mandhoo</option>
								<option>ADh. Omadhoo</option>
		  					</optgroup>

		  					<optgroup label="">
		  						<option>V. Felidhoo</option> 
								<option>V. Fulidhoo</option>
								<option>V. Keyodhoo</option>
								<option>V. Rakeedhoo</option>
								<option>V. Thinadhoo</option>
		  					</optgroup>

		  					<optgroup label="">
		  						<option>M. Boli Mulah</option>
								<option>M. Dhiggaru</option>
								<option>M. Kolhufushi</option>
								<option>M. Madifushi</option>
								<option>M. Maduvvaree</option>
								<option>M. Muli</option> 
								<option>M. Naalaafushi</option>
								<option>M. Raimmandhoo</option>
								<option>M. Veyvah</option>
		  					</optgroup>

		  					<optgroup label="">
		  						<option>F. Bileddhoo</option>
								<option>F. Dharanboodhoo</option>
								<option>F. Feeali</option>
								<option>F. Magoodhoo</option>
								<option>F. Nilandhoo</option>
		  					</optgroup>

		  					<optgroup label="">
		  						<option>D. Bandidhoo</option>
								<option>D. Gemendhoo</option>
								<option>D. Hulhudheli</option>
								<option>D. Kudahuvadhoo</option> 
								<option>D. Maaenboodhoo</option>
								<option>D. Meedhoo</option>
								<option>D. Rinbudhoo</option>
								<option>D. Vaanee</option>
		  					</optgroup>

		  					<optgroup label="">
		  						<option>Th. Burunee</option>
								<option>Th. Vilufushi</option>
								<option>Th. Madifushi</option>
								<option>Th. Dhiyamingili</option>
								<option>Th. Guraidhoo</option>
								<option>Th. Gaadhiffushi</option>
								<option>Th. Thimarafushi</option>
								<option>Th. Veymandoo</option> 
								<option>Th. Kinbidhoo</option>
								<option>Th. Omadhoo</option>
								<option>Th. Hirilandhoo</option>
								<option>Th. Kandoodhoo</option>
								<option>Th. Vandhoo</option>
		  					</optgroup>

		  					<optgroup label="">
		  						<option>L. Dhanbidhoo</option>
								<option>L. Fonadhoo</option> 
								<option>L. Gan</option> 
								<option>L. Hithadhoo</option>
								<option>L. Isdhoo</option>
								<option>L. Kunahandhoo</option>
								<option>L. Maabaidhoo</option>
								<option>L. Maamendhoo</option>
								<option>L. Maavah</option>
								<option>L. Mundoo</option>
		  					</optgroup>

		  					<optgroup label="">
		  						<option>GA. Dhaandhoo</option>
								<option>GA. Dhevvadhoo</option>
								<option>GA. Gemanafushi</option>
								<option>GA. Kanduhulhudhoo</option>
								<option>GA. Kolamaafushi</option>
								<option>GA. Kondey</option>
								<option>GA. Maamendhoo</option>
								<option>GA. Nilandhoo</option>
								<option>GA. Vilingili</option> 
		  					</optgroup>

		  					<optgroup label="">
		  						<option>GDh. Fares-Maathodaa</option>
								<option>GDh. Fiyoaree</option>
								<option>GDh. Gaddhoo</option>
								<option>GDh. Hoandeddhoo</option>
								<option>GDh. Madaveli</option>
								<option>GDh. Nadellaa</option>
								<option>GDh. Rathafandhoo</option>
								<option>GDh. Thinadhoo</option>
								<option>GDh. Vaadhoo</option>
		  					</optgroup>

		  					<optgroup label="">
		  						<option>Gn. Fuvahmulah</option>
		  					</optgroup>

		  					<optgroup label="">
		  						<option>S.Hithadhoo</option>
								<option>S.Maradhoo</option>
								<option>S.Maradhoo-Feydhoo </option>
								<option>S.Feydhoo</option>
								<option>S.Hulhudhoo </option>
								<option>S.Meedhoo </option>
		  					</optgroup>

						</select>
					</div>

					<!-- <div class="form-group">
						<label for="cur_price"><i class="fa fa-credit-card"></i>&nbsp;Price:</label>
						<input type="number"  value="{{$house->cur_price}}" class="form-control" name="cur_price" placeholder="$500" required>
					</div> -->

					<div class="form-group">
					    <label for="desc"><i class="fa fa-edit"></i>&nbsp;Description</label>
					    <textarea class="form-control" id="desc" name="desc" rows="5">{{$house->desc}}</textarea>
					</div>
				</div>

				<div class="col-md-6">


					<div class="form-group">
						<label for="house_offer"><i class="fa fa-coffee"></i>&nbsp;House Offers:</label>

						<select class="house-offer form-control" name="house_offer[]" multiple="multiple" >

						  	<option @if($house->internet) selected="selected" @endif  value="internet">Wi-Fi</option>
							<option @if($house->restaurant) selected="selected" @endif  value="restaurant">Restaurant</option>
							<option @if($house->bar) selected="selected" @endif  value="bar">Bar</option>
							<option @if($house->room_service) selected="selected" @endif  value="room_service">Room service</option>
							<option @if($house->breakfast) selected="selected" @endif  value="breakfast">Breakfast</option>
							<option @if($house->front_desk) selected="selected" @endif  value="front_desk">Front desk</option>
							<option @if($house->kid) selected="selected" @endif  value="kid">Kid-friendly</option>
							<option @if($house->pool) selected="selected" @endif  value="pool">Pool</option>
							<option @if($house->park) selected="selected" @endif  value="park">Parking</option>
							<option @if($house->fitness) selected="selected" @endif  value="fitness">Fitness center</option>
							<option @if($house->air) selected="selected" @endif  value="air">Air conditioning</option>
							<option @if($house->beach) selected="selected" @endif  value="beach">Beach access</option>
							<option @if($house->hot) selected="selected" @endif  value="hot">Hot tub</option>
							<option @if($house->spa) selected="selected" @endif  value="spa">Spa</option>
							<option @if($house->laundry) selected="selected" @endif  value="laundry">laundry</option>
							<option @if($house->tv) selected="selected" @endif  value="tv">TV</option>
							<option @if($house->smoke) selected="selected" @endif  value="smoke">Smoke-free</option>
							<option @if($house->pool) selected="selected" @endif  value="pool">Water Pool</option>
						</select>
					</div>

					<div class="form-group">
						<label for="facility"><i class="fa fa-car"></i>&nbsp;Facilities:</label>

						<select class="facility-multi form-control" name="facility[]" multiple="multiple">
						  	<option @if($house->f_internet) selected="selected" @endif  value="internet">Wi-Fi</option>
							<option @if($house->f_restaurant) selected="selected" @endif  value="restaurant">Restaurant</option>
							<option @if($house->f_bar) selected="selected" @endif  value="bar">Bar</option>
							<option @if($house->f_room_service) selected="selected" @endif  value="room_service">Room service</option>
							<option @if($house->f_breakfast) selected="selected" @endif  value="breakfast">Breakfast</option>
							<option @if($house->f_front_desk) selected="selected" @endif  value="front_desk">Front desk</option>
							<option @if($house->f_kid) selected="selected" @endif  value="kid">Kid-friendly</option>
							<option @if($house->f_pool) selected="selected" @endif  value="pool">Pool</option>
							<option @if($house->f_park) selected="selected" @endif  value="park">Parking</option>
							<option @if($house->f_fitness) selected="selected" @endif  value="fitness">Fitness center</option>
							<option @if($house->f_air) selected="selected" @endif  value="air">Air conditioning</option>
							<option @if($house->f_beach) selected="selected" @endif  value="beach">Beach access</option>
							<option @if($house->f_hot) selected="selected" @endif  value="hot">Hot tub</option>
							<option @if($house->f_spa) selected="selected" @endif  value="spa">Spa</option>
							<option @if($house->f_laundry) selected="selected" @endif  value="laundry">laundry</option>
							<option @if($house->f_tv) selected="selected" @endif  value="tv">TV</option>
							<option @if($house->f_smoke) selected="selected" @endif  value="smoke">Smoke-free</option>
							<option @if($house->f_pool) selected="selected" @endif  value="pool">Water Pool</option>
						</select>
					</div>
					<br>
					<h5>Contact Information</h5>
					<div class="form-group">
						<label for="email"><i class="fa fa-envelope "></i>&nbsp; Email:</label>
						<input type="email" value="{{$house->email}}" class="form-control" name="email" placeholder="" required>
					</div>

					<div class="form-group">
						<label for="phone"><i class="fa fa-phone"></i>&nbsp; Phone Number:</label>
						<input type="text" value="{{$house->phone}}"  class="form-control" name="phone" placeholder="123-456-7890" required>
					</div>

					<div class="form-group">
						<label for="address"><i class="fa fa-address-card "></i>&nbsp; Address:</label >
						<input type="text" value="{{$house->address}}"  class="form-control" name="address" placeholder="" required>
					</div>

				</div>
		 	</div>	

		 	<div class="col-md-12">
		 		<h5><i class="fa fa-image"></i>&nbsp;Galley</h5>
		 		<div class="row">
		 			@foreach($house->images as $key => $image)
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
					  	@foreach($house->images as $key => $image)
					    <div class="mySlides" style="width: 100%;">
						      <div class="numbertext">{{$key + 1}} / {{count($house->images)}}</div>
						      <img class="col-md-6" style="margin-left: 25%;" src="/{{$image->path}}" >
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
						  	@foreach($house->images as $key => $image)

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
		var island = `{!! $house->island !!}`;
		$('#island option[value="' + island +'"]').prop('selected', true);


		// House Offer Select
		$('.house-offer').select2();
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

		$.post("/admin/houseDetail/delImage",
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