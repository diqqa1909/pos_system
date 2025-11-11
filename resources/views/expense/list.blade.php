
@extends('layouts.app')
@section('content')
    
 <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Expenses</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Expenses</li>
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Search Member</h3>
                            </div>
                            <form action="" method="GET">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-1">
                                            <label>ID</label>
                                            <input type="text" name="id" value="{{Request()->id}}" placeholder="" class="form-control">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Description</label>
                                            <input type="text" name="description" value="{{Request()->description}}" placeholder="" class="form-control">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Amount</label>
                                            <input type="text" name="amount" value="{{Request()->amount}}" placeholder="" class="form-control">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Created At</label>
                                            <input type="date" name="created_at" value="{{Request()->created_at}}" class="form-control">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Updated At</label>
                                            <input type="date" name="updated_at" value="{{Request()->updated_at}}" class="form-control">
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="col-md-12" style="margin-top:15px;">
                                            <button class="btn btn-primary" type="submit">Search</button>
                                            <a href="{{url('admin/expense')}}" class="btn btn-success">Reset</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                    <br>
                        @include('_message')
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Expenses List</h3>
                                <div class="card-tools">
                                    <ul class="pagination pagination-sm float-end">
                                        <a href="{{url('admin/expense/add')}}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-plus"></i> Add Expense

                                        </a>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Description</th>
                                            <th>Amount</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalAmount = 0;
                                        @endphp
                                        @forelse ($getRecord as $value)
                                            @php
                                                $totalAmount+=$value->amount;
                                            @endphp
                                            <tr>
                                                <td>{{$value->id}}</td>
                                                <td>{{$value->description}}</td>
                                                <td>{{number_format($value->amount,2)}}</td>
                                                <td>{{date('d-m-Y H:i A', strtotime($value->created_at))}}</td>
                                                <td>{{date('d-m-Y H:i A', strtotime($value->updated_at))}}</td>
                                                <td>
                                                    <a href="{{url('admin/expense/edit/'.$value->id)}}" class="btn btn-sm btn-primary">Edit</a>
                                                    <a data-id="{{$value->id}}" data-url="{{url('admin/expense/delete/'.$value->id)}}" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-sm btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="100%">No records found!</td>
                                            </tr>
                                        @endforelse
                                            @if(!@empty($totalAmount))
                                                <tr>
                                                    <th colspan="2">Total Amount: </th>
                                                    <td>{{number_format($totalAmount, 2)}}</td>
                                                    <th colspan="3"></th>
                                                </tr>
                                                
                                            @endif

                                    </tbody>
                                </table>
                                <div style="padding: 10px; float: right;">
                                    {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Confirm Delete</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            Are you sure you want to delete this member? This action cannot be undone.
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <a id="confirmDelete" href="#" class="btn btn-danger">Delete</a>
        </div>
        </div>
    </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function(){
            const deleteModal = document.getElementById('deleteModal');
            const confirmModal = document.getElementById('confirmDelete');

            deleteModal.addEventListener('show.bs.modal', function(event){
                const button = event.relatedTarget;
                const expenseId = button.getAttribute('data-id');
                const deleteUrl = button.getAttribute('data-url');

                confirmModal.setAttribute('href', deleteUrl);
            })
        })
    </script>

@endsection
