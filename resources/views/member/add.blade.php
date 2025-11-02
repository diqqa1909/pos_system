
@extends('layouts.app')
@section('content')
    

    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Member</h3></div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Member</li>
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
                  <form>
                    <div class="card-body">
                      <div class="row mb-3">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="name" placeholder="Member Name" />
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="address" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="address" id="address" type="text" placeholder="Member Address"></textarea>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="tel" class="col-sm-2 col-form-label">Telephone</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" id="tel" placeholder="Member Phone"/>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Sign in</button>
                    </div>
                  </form>
                </div>
                </div>
                </div>
                </div>
                </div>
    </main>

@endsection