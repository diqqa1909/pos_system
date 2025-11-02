
@extends('layouts.app')
@section('content')
    

      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Products</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Products</li>
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
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Product List</h3>
                                <div class="card-tools">
                                    <ul class="pagination pagination-sm float-end">
                                        <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                                            <i class="fa fa-plus"></i> Add Product

                                        </a>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="product-table" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Category Name</th>
                                            <th>Product Code</th>
                                            <th>Product Name</th>
                                            <th>Brand</th>
                                            <th>Purchase Price</th>
                                            <th>Selling Price</th>
                                            <th>Discount</th>
                                            <th>Stock</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
      </main>



      {{-- model start --}}
      <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="productForm">
                        @csrf
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Category Name</label>
                            <select name="category_id" id="category_id" class="form-control" required>
                                <option value="">Select Category</option>
                                @foreach($category as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="product_code" class="form-label">Product Code</label>
                            <input type="text" class="form-control" id="product_code" name="product_code" required>
                        </div>

                        <div class="mb-3">
                            <label for="product_name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" required>
                        </div>

                        <div class="mb-3">
                            <label for="brand" class="form-label">Brand</label>
                            <input type="text" class="form-control" id="brand" name="brand" required>
                        </div>

                        <div class="mb-3">
                            <label for="purchase_price" class="form-label">Purchase Price</label>
                            <input type="number" class="form-control" id="purchase_price" name="purchase_price" required>
                        </div>

                        <div class="mb-3">
                            <label for="selling_price" class="form-label">Selling Price</label>
                            <input type="number" class="form-control" id="selling_price" name="selling_price" required>
                        </div>

                        <div class="mb-3">
                            <label for="discount" class="form-label">Discount</label>
                            <input type="number" class="form-control" id="discount" name="discount" required>
                        </div>

                        <div class="mb-3">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="number" class="form-control" id="stock" name="stock" required>
                        </div>


                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
      </div>
      {{-- model end --}}

      <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this product?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <div class="flashMessage alert alert-success" style="display: none;"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dayjs/dayjs.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#productForm').on('submit', function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: "{{ route('product.store') }}",
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        $('.flashMessage').html(response.message).fadeIn().delay(2000).fadeOut();
                        $('#productForm')[0].reset();
                        $('#addProductModal').modal('hide');

                        fetchProducts();

                    },
                    error: function(xhr, status, error) {
                        console.error('Error adding product:', error);
                    }
                });
            });
        });

        function fetchProducts() {
        $.ajax({
            url: "{{ route('product.fetch') }}",
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log('Full response:', response); // Debug log
                
                var tbody = $('#product-table tbody');
                tbody.empty();
                
                // Access the data from response.data
                var products = response.data || [];
                
                if (products.length === 0) {
                    tbody.append('<tr><td colspan="12" class="text-center">No products found</td></tr>');
                    return;
                }
            
            $.each(products, function(index, product) {
                var row = '<tr>' +
                    '<td>' + (index + 1) + '</td>' +
                    '<td>' + (product.category? product.category.category_name : 'N/A') + '</td>' + // Updated for relationship
                    '<td>' + (product.product_code || 'N/A') + '</td>' +
                    '<td>' + (product.product_name || 'N/A') + '</td>' +
                    '<td>' + (product.brand || 'N/A') + '</td>' +
                    '<td>' + (product.purchase_price || '0') + '</td>' +
                    '<td>' + (product.selling_price || '0') + '</td>' +
                    '<td>' + (product.discount || '0') + '</td>' +
                    '<td>' + (product.stock || '0') + '</td>' +
                    '<td>' + (product.created_at ? dayjs(product.created_at).format('YYYY-MM-DD HH:mm:ss') : 'N/A') + '</td>' +
                    '<td>' + (product.updated_at ? dayjs(product.updated_at).format('YYYY-MM-DD HH:mm:ss') : 'N/A') + '</td>' +
                    '<td><button class="btn btn-sm btn-warning edit-btn" data-id="' + product.id + '">Edit</button><button class="btn btn-sm btn-danger delete-btn" data-id="' + product.id + '">Delete</button></td>' +
                    '</tr>';
                tbody.append(row);
            });
            $('.edit-btn').on('click', handleEdit);
            
            // Attach delete event handlers using event delegation
            // Instead of onclick in HTML, you can use event delegation
            $(document).on('click', '.delete-btn', function() {
                deleteProductId = $(this).data('id');
                $('#deleteModal').modal('show');
            });
        },
        error: function(xhr, status, error) {
            console.error('Error fetching products:', error);
            console.log('Status:', status);
            console.log('XHR response:', xhr.responseText);
            
            var tbody = $('#product-table tbody');
            tbody.html('<tr><td colspan="12" class="text-center text-danger">Error loading products</td></tr>');
        }
    });

    
}

    function handleEdit(){
        const id = $(this).data('id');
        $.ajax({
            url: `{{url('admin/product/edit')}}/${id}`,
            type: 'GET',

            success: function(response){
                $('#category_id').val(response.category_id);
                $('#product_code').val(response.product_code);
                $('#product_name').val(response.product_name);
                $('#brand').val(response.brand);
                $('#purchase_price').val(response.purchase_price);
                $('#selling_price').val(response.selling_price);
                $('#discount').val(response.discount);
                $('#stock').val(response.stock);
                $('#addProductModal').modal('show');

                $('#productForm').off('submit').on('submit', function(e){
                    e.preventDefault();
                    const formData = $(this).serialize();
                    $.ajax({
                        url:`{{url('admin/product/update')}}/${id}`,
                        type: 'POST',
                        data: formData,
                        success: function(res){
                            $('.flashMessage').html(res.message).fadeIn().delay(2000).fadeOut();
                            $('#productForm')[0].reset();
                            $('#addProductModal').modal('hide');
                            fetchProducts();
                        },
                        error: function(xhr, status, error){
                            console.error('Error updating product:', error);
                        }
                    });
                });
                
            },
            error: function(xhr, status, error){
                console.error('Error fetching product details:', error);
            }
        })
    }

    
    let deleteProductId=null; // Declare the variable
    function handleDelete(){
        deleteProductId = $(this).data('id');
        $('#deleteModal').modal('show');
    }

$('#confirmDelete').on('click', function(){
    $.ajax({
        url: `{{url('admin/product/delete')}}/${deleteProductId}`, // Use deleteProductId instead of id
        type: 'DELETE',
         headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            _method: 'DELETE' // Make sure this exists
        }, // Fixed syntax - comma was in wrong place
        success: function(response){
            $('.flashMessage').html(response.message).fadeIn().delay(2000).fadeOut();
            $('#deleteModal').modal('hide');
            fetchProducts();
        },
        error: function(xhr, status, error){
            console.error('Error deleting product:', error);
        }
    });
});

    $(document).ready(function() {
        fetchProducts();
    });

        </script>
        
        @endsection
