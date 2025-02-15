@extends('layouts.admin_design')
@section('title','Dashboard')
@section('content')
@if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager')||auth()->user()->hasRole('agent'))
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="javascript:">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
          @if(auth()->user()->hasRole('admin'))
            <div class="info-box">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Customer</span>
                <span class="info-box-number">
                  {{ $cumstomer_count }}
                  <small></small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            @endif
            @if(auth()->user()->hasRole('manager'))
            <div class="info-box">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Sales Boy</span>
                <span class="info-box-number">
                  30
                  <small></small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            @endif
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          @if(auth()->user()->hasRole('admin'))
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-hotel"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Hotel</span>
                <span class="info-box-number">{{ $hotel_count }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          @endif
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>
          @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager'))

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-people-carry"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Package</span>
                <span class="info-box-number">{{ $package_count }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          @endif
           @if(auth()->user()->hasRole('agent'))

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-people-carry"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">My Package</span>
                <span class="info-box-number">{{ $package_count }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-primary elevation-1"><i class="fab fa-linode"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">My orders</span>
                <span class="info-box-number">{{ $package_count }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-red elevation-1"><i class="fas fa-wallet"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">My Wallet</span>
                <span class="info-box-number">{{ $package_count }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-bullhorn  text-white"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">My Offers</span>
                <span class="info-box-number">{{ $package_count }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          @endif


          <!-- /.col -->
          @if(auth()->user()->hasRole('admin'))

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-window-restore"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Coupon</span>
                <span class="info-box-number">{{ $hotelCoupon_count }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          @endif

          <!-- /.col -->
        </div>
        @if(auth()->user()->hasRole('admin'))
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-rupee-sign"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Today Sale</span>
                <span class="info-box-number">
                  {{ number_format($todaySale) }}
                  <small></small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-rupee-sign"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Weekly Sale</span>
                <span class="info-box-number">{{ number_format($weeksale) }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-rupee-sign"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Monthly Sale</span>
                <span class="info-box-number">{{ number_format($monthlysale) }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-rupee-sign"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Yearly Sale</span>
                <span class="info-box-number">{{ number_format($yearlysale) }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        @endif
        <div class="row">
          <!-- Left col -->
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-12">
                <!-- USERS LIST -->
                @if(auth()->user()->hasRole('admin')||auth()->user()->hasRole('manager'))
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Latest Hotels</h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <ul class="users-list clearfix">
                    @foreach ($latest_hotel as $v )
                      <li>
                        <img src="<?php echo url('/')  ?>/logo/{{ $v->logo }}" alt="User Image" style="height:128px">
                        <a class="users-list-name" href="javascript:">{{ ucfirst($v->name) }}</a>
                        <span class="users-list-date">{{ ucfirst($v->location) }}</span>
                      </li>
                    @endforeach  
                    </ul>
                    <!-- /.users-list -->
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer text-center">
                    <a href="{{ url('/administrator/hotels') }}">View All Hotels</a>
                  </div>
                  <!-- /.card-footer -->
                </div>
                @endif
                <!--/.card -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- TABLE: LATEST ORDERS -->
            @if(auth()->user()->hasRole('admin'))
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Latest Orders</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>Order ID</th>
                      <th>User Details</th>
                      <th>Amount</th>
                      <th>TransactionID</th>
                      <th>Created</th>
                    </tr>
                    </thead>
                    <tbody>
                      @forelse ($order_list as $value )
                          <tr>
                            <td><?php echo ucfirst($value->order_id) ?></td>
                            <td>
                              <i class="fas fa-user-tie"></i> &nbsp; {{ $value->user_name }}<br />
                              <i class="fas fa-mobile"></i> &nbsp; {{ $value->user_phone }} <br />
                              <i class="fas fa-envelope"></i> &nbsp; {{ $value->user_email}} <br />
                            </td>
                            <td><?php echo ucfirst($value->amount) ?></td>
                            <td>{{ $value->trans_id }}</td>


                            <td>{{ $value->created_at->diffForHumans() }}</td>
                          </tr>
                      @empty
                        
                      @endforelse

                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a href="{{ url('administrator/orders') }}" class="btn btn-sm btn-secondary float-right">View All Orders</a>
              </div>
              <!-- /.card-footer -->
            </div>
            @endif
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @endif

@endsection