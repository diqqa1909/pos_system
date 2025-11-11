
@extends('layouts.app')
@section('content')
    

    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Purchase</h3></div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Purchase Add</li>
                </ol>
                </div>
            </div>
            </div>
        </div>

        <div class="app-content">
          <div class="container-fluid">
            <div class="row g-4">
              <div class="col-12">
                <div class="card card-primary card-outline mb-4">
                  <div class="card-header"><div class="card-title">Purchases Form</div></div>
                  <form method="POST" action="{{url('admin/purchase/add')}}">
                    {{csrf_field()}}
                    <div class="card-body">
                      <div class="row mb-3">
                        <label for="supplier_name" class="col-sm-2 col-form-label">Supplier Name</label>
                        <div class="col-sm-10">
                          <select name="supplier_name" id="supplier_name" class="form-control">
                            <option value="">Select Supplier</option>
                            @foreach ($getRecords as $value)
                                <option value="{{$value->id}}">{{$value->supplier_name}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="total_item" class="col-sm-2 col-form-label">Total Item</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="total_item" id="total_item" type="text" placeholder="Total Item" required/>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="total_price" class="col-sm-2 col-form-label">Total Price</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="total_price" id="total_price" type="text" placeholder="Total Price" required/>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="discount" class="col-sm-2 col-form-label">Discount</label>
                        <div class="col-sm-10">
                          <input type="number" name="discount" class="form-control" id="discount" placeholder="Discount" required/>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer ">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      <a href="/admin/purchase" class="btn btn-secondary float-end">Cancel</a>
                    </div>
                  </form>
                </div>
                </div>
                </div>
                </div>
                </div>
    </main>

@endsection