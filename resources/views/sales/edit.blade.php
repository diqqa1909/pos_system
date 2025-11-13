
@extends('layouts.app')
@section('content')
    

    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">sales</h3></div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">sales Edit</li>
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
                  <div class="card-header"><div class="card-title">Sales Form</div></div>
                  <form method="POST" action="{{url('admin/sales/edit/'.$getEdit->id)}}">
                    {{csrf_field()}}
                    <div class="card-body">
                      <div class="row mb-3">
                        <label for="member_id" class="col-sm-2 col-form-label">Member Name</label>
                        <div class="col-sm-10">
                          <select name="member_id" id="member_id" class="form-control">
                            <option value="">Select Member</option>
                            @foreach ($getMember as $value)
                                <option {{($getEdit->member_id == $value->member_code) ? 'selected' : ''}} value="{{$value->member_code}}">{{$value->member_name}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="total_item" class="col-sm-2 col-form-label">Total Item</label>
                        <div class="col-sm-10">
                            <input value="{{$getEdit->total_item}}" class="form-control" name="total_item" id="total_item" type="text" placeholder="Total Item" required/>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="total_price" class="col-sm-2 col-form-label">Total Price</label>
                        <div class="col-sm-10">
                            <input value="{{$getEdit->total_price}}" class="form-control" name="total_price" id="total_price" type="text" placeholder="Total Price" required/>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="discount" class="col-sm-2 col-form-label">Discount</label>
                        <div class="col-sm-10">
                          <input value="{{$getEdit->discount}}" type="number" name="discount" class="form-control" id="discount" placeholder="Discount" required/>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="accepted" class="col-sm-2 col-form-label">Accepted</label>
                        <div class="col-sm-10">
                            <select name="accepted" id="accepted" class="form-control">
                                <option {{$getEdit->accepted == 'Yes' ? 'selected' : ''}} value="Yes">Yes</option>
                                <option {{$getEdit->accepted == 'No' ? 'selected' : ''}} value="No">No</option>
                            </select>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="username" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                          <select name="username" id="username" class="form-control">
                            <option value="">Select Username</option>
                            @foreach ($getUser as $value)
                                <option {{($getEdit->user_id == $value->id) ? 'selected' : ''}} value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer ">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      <a href="/admin/sales" class="btn btn-secondary float-end">Cancel</a>
                    </div>
                  </form>
                </div>
                </div>
                </div>
                </div>
                </div>
    </main>

@endsection