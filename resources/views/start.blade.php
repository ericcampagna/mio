
@extends('layouts.main-layout')

@section('sidebar_layout')
  @yield('sidebar', View::make('sidebar'))
@endsection

@section('topbar_layout')
  @yield('topbar', View::make('topbar'))
@endsection
@section('content')
<!-- Begin Page Content -->
        <div class="container-fluid" id="app">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">MIO Start Page</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
          </div>

          <!-- Content Row -->

          <div class="row justify-content-md-center">

            <!-- Area Chart -->
            <div class="col-lg-6 ">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Customer Data</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                   <form>
                     <div class="form-group">
                        <input type="text" class="form-control" id="customerName" aria-describedby="customerHelp" name="" placeholder="Customer Name">
                     </div>
                     <div class="form-group">
                      <label for="exampleFormControlFile1">Customer Data File</label>
                      <input type="file" class="form-control-file" id="exampleFormControlFile1">
                    </div>
                    <label>Pricing</label>
                    <select class="form-control form-control-lg" id="pricingSelect">
                      <option>APW</option>
                      <option>Alliance</option>
                      <option>MotoRad Gold</option>
                      <option>MotoRad Silver</option>
                      <option value="custom">Custom...</option>
                    </select>
                     <div class="form-group" id="customPricing" style="display:none;">
                      <label for="exampleFormControlFile1">Customer Pricing File</label>
                      <input type="file" class="form-control-file" id="exampleFormControlFile1">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary my-1">Run...</button>
                   </form>
                   
                  </div>
                </div>
              </div>
            </div>

          </div>

        
        </div>
        <!-- /.container-fluid -->
@endsection

@section('addToFooter')
  <script>
    $(document).ready(function () {
      $('#pricingSelect').change(function() {
          opt = $(this).val();
          if (opt=="custom") {
              $('#customPricing').show()
            }
      });
    });
  </script>
@endsection