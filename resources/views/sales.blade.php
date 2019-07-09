
@extends('layouts.main-layout')

@section('title', 'Sale Dashboard')

@section('sidebar_layout')
  @yield('sidebar', View::make('sidebar'))
@endsection

@section('topbar_layout')
  @yield('topbar', View::make('topbar'))
@endsection

@section('content')
<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Sales</h1>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
          </div>

          <!-- Content Row -->

          <div class="row justify-content-md-center">

            <!-- Load Data -->
            <div class="col-lg-6 ">
              <transition name="slide-fade">
                <div class="card shadow mb-4" v-show="showDataForm">
                  <!-- Card Header - Dropdown -->
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Customer Data</h6>
                  {{--   <div class="dropdown no-arrow">
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
                    </div> --}}
                  </div>
                  <!-- Card Body -->
                  <div class="card-body">
                     <sales-chart></sales-chart>
                  </div>
                </div>
              </transition>
            </div>

          </div>

        
        </div>
        <!-- /.container-fluid -->
@endsection
