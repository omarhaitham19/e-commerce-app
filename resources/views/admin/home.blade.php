@extends('admin.layout')

@section('body')

<div class="row">
    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3>
                            {{\App\Models\Product::count()}}   
                          </h3>
                        </div>                     
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-success">
                            <span class="mdi mdi-cart icon-item"></span>
                        </div>
                    </div>
                </div>
                <h6 class="text-muted font-weight-normal">Total Products</h6>
            </div>
        </div>
    </div>

    <!-- Add more cards with similar structure for other statistics -->
    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                            <h3 class="mb-0">
                            {{\App\Models\Order::count()}}   
                            </h3>
                        </div>
                        
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-danger">
                            <span class="mdi mdi-cart-plus icon-item"></span>
                        </div>
                    </div>
                </div>
                <h6 class="text-muted font-weight-normal">Total Orders</h6>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
      <div class="card">
          <div class="card-body">
              <div class="row">
                  <div class="col-9">
                      <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0">
                            {{\App\Models\User::where("type" , "customer")->count()}}   
                          </h3>
                      </div>
                     
                  </div>
                  <div class="col-3">
                      <div class="icon icon-box-danger">
                          <span class="mdi mdi-account icon-item"></span>
                      </div>
                  </div>
              </div>
              <h6 class="text-muted font-weight-normal">Total Customers</h6>
          </div>
      </div>
  </div>

    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
      <div class="card">
          <div class="card-body">
              <div class="row">
                  <div class="col-9">
                      <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0">
                            {{\App\Models\User::where("type" , "admin")->count()}}   
                          </h3>
                      </div>
                     
                  </div>
                  <div class="col-3">
                      <div class="icon icon-box-danger">
                          <span class="mdi mdi-account-supervisor icon-item"></span>
                      </div>
                  </div>
              </div>
              <h6 class="text-muted font-weight-normal">Total Admins</h6>
          </div>
      </div>
  </div>

    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                            <h3 class="mb-0">
                              {{\App\Models\Order::sum('amount')}} L.E   
                            </h3>
                        </div>
                       
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-success">
                            <span class="mdi mdi-currency-usd icon-item"></span>
                        </div>
                    </div>
                </div>
                <h6 class="text-muted font-weight-normal">Total Revenue </h6>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
      <div class="card">
          <div class="card-body">
              <div class="row">
                  <div class="col-9">
                      <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0">
                            {{\App\Models\Order::where("delivery_status" , "delivered")->count()}}   
                          </h3>
                      </div>
                      
                  </div>
                  <div class="col-3">
                      <div class="icon icon-box-success">
                          <span class="mdi mdi-truck-delivery icon-item"></span>
                      </div>
                  </div>
              </div>
              <h6 class="text-muted font-weight-normal"> Orders Delivered </h6>
          </div>
      </div>
  </div>

  <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-9">
                    <div class="d-flex align-items-center align-self-start">
                        <h3 class="mb-0">
                          {{\App\Models\Order::where("delivery_status" , "undelivered")->count()}}   
                        </h3>
                    </div>
                </div>
                <div class="col-3">
                    <div class="icon icon-box-success">
                        <span class="mdi mdi-package-variant-closed icon-item"></span>
                    </div>
                </div>
            </div>
            <h6 class="text-muted font-weight-normal"> Orders Undelivered  </h6>
        </div>
    </div>
</div>
</div>

@endsection
