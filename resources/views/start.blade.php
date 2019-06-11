
@extends('layouts.main-layout')

@section('title', 'Start')

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
                   <form>
                     <div class="form-group">
                        <input type="text" class="form-control" id="customerName" v-model="customerName" aria-describedby="customerHelp" name="" placeholder="Customer Name">
                     </div>
                      <label for="exampleFormControlFile1">Customer Data File</label>
                       
                      <csv-importer v-model="customerData" ref="importer" :map-fields="['Part Number', 'QOH', 'Previous 12M', 'Last 12M', 'Current Price']" load-btn-text="Load Data File" ></csv-importer>

                      <csv-importer v-model="customerPricing" ref="importer" :map-fields="['MTR Part Number', 'Quoted Price']" load-btn-text="Load Price File" ></csv-importer>

                      <button class="btn btn-success btn-block">GO <i class="fas fa-arrow-right"></i></button>
                   </form>
                   
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
      $('#customPricing').hide();
      $('#pricingSelect').change(function() {
          opt = $(this).val();
          if (opt=="custom") {
              $('#customPricing').show();
            }
      });
    });
  </script>
@endsection