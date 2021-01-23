@extends('layouts.admin')
@section('css')

@endsection

@section('js')
<script type="text/javascript">
</script>
@endsection


@section('content')

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

  <!-- Main Content -->
  <div id="content">
    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      </div>

      <hr>
	  <h3><i class="fa fa-home"></i> HOUSE</h3>
      <!-- Content Row -->
      <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
          	<a href="/admin/houselist" style="text-decoration: none;">
	            <div class="card-body">
	              <div class="row no-gutters align-items-center">
	                <div class="col mr-2">
	                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">TOTAL HOUSES </div>
	                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($total_house)}}</div>
	                </div>
	                <div class="col-auto">
	                  <i class="fas fa-home fa-2x text-gray-300"></i>
	                </div>
	              </div>
	            </div>
          	</a>
          </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
          <div class="card border-left-success shadow h-100 py-2">
          	<a href="/admin/houselist/1" style="text-decoration: none;">
	            <div class="card-body">
	              <div class="row no-gutters align-items-center">
	                <div class="col mr-2">
	                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Visible HOUSES</div>
	                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($visible_house)}}</div>
	                </div>
	                <div class="col-auto">
	                  <i class="fas fa-eye fa-2x text-gray-300"></i>
	                </div>
	              </div>
	            </div>
	        </a>
          </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
          	<a href="/admin/houselist/0" style="text-decoration: none;">
	            <div class="card-body">
	              <div class="row no-gutters align-items-center">
	                <div class="col mr-2">
	                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Unvisible HOUSES</div>
	                  <div class="row no-gutters align-items-center">
	                    <div class="col-auto">
	                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{count($unvisible_house)}}</div>
	                    </div>
	                  </div>
	                </div>
	                <div class="col-auto">
	                  <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
	                </div>
	              </div>
	            </div>
	        </a>
          </div>
        </div>

      </div>


		<hr>
	  <h3><i class="fa fa-bed"></i> ROOM</h3>
      <!-- Content Row -->
      <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
          <div class="card border-left-success shadow h-100 py-2">
          	<a href="/admin/roomlist/0" style="text-decoration: none;">
	            <div class="card-body">
	              <div class="row no-gutters align-items-center">
	                <div class="col mr-2">
	                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">TOTAL ROOMS </div>
	                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($total_rooms)}}</div>
	                </div>
	                <div class="col-auto">
	                  <i class="fas fa-home fa-2x text-gray-300"></i>
	                </div>
	              </div>
	            </div>
          	</a>
          </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
          <div class="card border-left-success shadow h-100 py-2">
          	<a href="/admin/roomlist/0/1" style="text-decoration: none;">
	            <div class="card-body">
	              <div class="row no-gutters align-items-center">
	                <div class="col mr-2">
	                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">VISIBLE ROOMS</div>
	                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($visible_rooms)}}</div>
	                </div>
	                <div class="col-auto">
	                  <i class="fas fa-eye fa-2x text-gray-300"></i>
	                </div>
	              </div>
	            </div>
	        </a>
          </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
          	<a href="/admin/roomlist/0/0" style="text-decoration: none;">
	            <div class="card-body">
	              <div class="row no-gutters align-items-center">
	                <div class="col mr-2">
	                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">UNVISIBL ROOMS</div>
	                  <div class="row no-gutters align-items-center">
	                    <div class="col-auto">
	                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{count($unvisible_rooms)}}</div>
	                    </div>
	                  </div>
	                </div>
	                <div class="col-auto">
	                  <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
	                </div>
	              </div>
	            </div>
	        </a>
          </div>
        </div>

      </div>
    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- End of Main Content -->

</div>
<!-- End of Content Wrapper -->
@endsection
