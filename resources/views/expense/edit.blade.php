
@extends('layouts.app')
@section('content')
    

    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Expense</h3></div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit expense</li>
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
                  <div class="card-header"><div class="card-title">Expense Form</div></div>
                  <form method="POST" action="{{url('admin/expense/edit/'.$getExpense->id)}}">
                    {{csrf_field()}}
                    <div class="card-body">
                        <div class="row mb-3">
                          <label for="description" class="col-sm-2 col-form-label">Description</label>
                          <div class="col-sm-10">
                              <textarea class="form-control" name="description" id="description" type="text" placeholder="expense description" required>{{$getExpense->description}}</textarea>
                          </div>
                        </div>
                      <div class="row mb-3">
                        <label for="amount" class="col-sm-2 col-form-label">Amount</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" name="amount" id="amount" placeholder="expense amount" value="{{$getExpense->amount}}" required />
                        </div>
                      </div>
                    </div>
                    <div class="card-footer">
                      <button type="submit" class="btn btn-warning">Update</button>
                      <a href="{{url(('admin/expense'))}}" class="btn btn-primary float-end">Cancel</a>
                    </div>
                  </form>
                </div>
                </div>
                </div>
                </div>
                </div>
    </main>

@endsection