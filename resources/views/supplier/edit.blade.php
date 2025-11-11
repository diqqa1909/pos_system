
@extends('layouts.app')
@section('content')
    

    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">supplier</h3></div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit supplier</li>
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
                  <div class="card-header"><div class="card-title">Horizontal Form</div></div>
                  <form method="POST" action="{{url('admin/supplier/edit/'.$getSupplier->id)}}">
                    {{csrf_field()}}
                    <div class="card-body">
                      <div class="row mb-3">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="name" id="name" placeholder="supplier Name" value="{{$getSupplier->supplier_name}}" required />
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="address" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="address" id="address" type="text" placeholder="supplier Address" required>{{$getSupplier->supplier_address}}</textarea>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="tel" class="col-sm-2 col-form-label">Telephone</label>
                        <div class="col-sm-10">
                          <input type="number" name="tel" class="form-control" id="tel" value="{{$getSupplier->supplier_telephone}}" placeholder="supplier Phone" required/>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer">
                      <button type="submit" class="btn btn-warning">Update</button>
                      <a href="{{url(('admin/supplier'))}}" class="btn btn-primary float-end">Cancel</a>
                    </div>
                  </form>
                </div>
                </div>
                </div>
                </div>
                </div>
    </main>

@endsection