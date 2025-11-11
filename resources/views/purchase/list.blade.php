
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
                    <li class="breadcrumb-item active" aria-current="page">Purchase</li>
                </ol>
                </div>
            </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Search Supplier</h3>
                            </div>
                            <form action="" method="GET">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-1">
                                            <label>ID</label>
                                            <input type="text" name="id" value="{{Request()->id}}" placeholder="" class="form-control">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Supplier Name</label>
                                            <input type="text" name="supplier_name" value="{{Request()->supplier_name}}" placeholder="" class="form-control">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Total Item</label>
                                            <input type="text" name="total_item" value="{{Request()->total_item}}" placeholder="" class="form-control">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Price</label>
                                            <input type="text" name="price" value="{{Request()->price}}" placeholder="" class="form-control">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Discount</label>
                                            <input type="text" name="discount" value="{{Request()->discount}}" placeholder="" class="form-control">
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
                                            <a href="{{url('admin/purchase')}}" class="btn btn-success">Reset</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <br>
                        @include('_message')
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Purchases List</h3>
                                <div class="card-tools">
                                    <ul class="pagination pagination-sm float-end">
                                        <a href="{{url('admin/purchase/add')}}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-plus"></i> Add purchase

                                        </a>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Supplier Name</th>
                                            <th>Total Item</th>
                                            <th>Price</th>
                                            <th>Discount</th>
                                            <th>Net Discount</th>
                                            <th>Total Price</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalItem = 0;
                                            $price = 0;
                                            $totalDiscount = 0;
                                            $totalNet = 0;
                                            $totalP = 0;
                                        @endphp
                                        @forelse ($datas as $value)
                                        @php
                                            $netDiscount = $value->total_price * $value->discount / 100;
                                            $totalPrice = $value->total_price - $netDiscount;
                                            $totalItem += $value->total_item;
                                            $price += $value->total_price;
                                            $totalDiscount += $value->discount;
                                            $totalNet += $netDiscount;
                                            $totalP += $totalPrice;
                                        @endphp
                                            <tr>
                                                <td>{{$value->id}}</td>
                                                <td>{{$value->supplier_name}}</td>
                                                <td>{{$value->total_item}}</td>
                                                <td>{{$value->total_price}}</td>
                                                <td>{{$value->discount}}%</td>
                                                <td>{{$netDiscount}}</td>
                                                <td>{{$totalPrice}}</td>
                                                <td>{{date('d-m-Y H:i A', strtotime($value->created_at))}}</td>
                                                <td>{{date('d-m-Y H:i A', strtotime($value->updated_at))}}</td>
                                                <td>
                                                    <a href="{{url('admin/purchase/edit/'.$value->id)}}" class="btn btn-sm btn-primary">Edit</a>
                                                    <a data-id="{{$value->id}}" data-url="{{url('admin/purchase/delete/'.$value->id)}}" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-sm btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="100%">No records found!</td>
                                            </tr>
                                        @endforelse
                                        <tr>
                                            <th colspan="2">Total Sum: </th>
                                            <td>{{$totalItem}}</td>
                                            <td>{{$price}}</td>
                                            <td>{{$totalDiscount}}</td>
                                            <td>{{$totalNet}}</td>
                                            <td>{{$totalP}}</td>
                                            <th colspan="3"></th>
                                        </tr>
                                    </tbody>
                                </table>
                                <div style="padding: 10px; float: right;">
                                    {!! $datas->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
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
        Are you sure you want to delete this purchase? This action cannot be undone.
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
            const memberId = button.getAttribute('data-id');
            const deleteUrl = button.getAttribute('data-url');

            confirmModal.setAttribute('href', deleteUrl);
        })
    })
</script>

@endsection