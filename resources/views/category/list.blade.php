
@extends('layouts.app')
@section('content')
    

      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Category</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Category</li>
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
                                <h3 class="card-title">Category List</h3>
                                <div class="card-tools">
                                    <ul class="pagination pagination-sm float-end">
                                        <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                                            <i class="fa fa-plus"></i> Add Category

                                        </a>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="category-table" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Category Name</th>
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
      <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="categoryForm">
                        @csrf
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="category_name" name="category_name" required>
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
                Are you sure you want to delete this category?
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
            fetchCategories();

            function fetchCategories() {
                $.ajax({
                    url: '{{ url("admin/category/data") }}',
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        var tbody = $('#category-table tbody');
                        tbody.empty();
                        $.each(response.data, function(index, category) {
                            var row = '<tr>' +
                                '<td>' + (index + 1) + '</td>' +
                                '<td>' + category.category_name + '</td>' +
                                '<td>' + dayjs(category.created_at).format('YYYY-MM-DD HH:mm:ss') + '</td>' +
                                '<td>' + dayjs(category.updated_at).format('YYYY-MM-DD HH:mm:ss') + '</td>' +
                                '<td>' + 
                        '<button class="btn btn-warning btn-sm edit-btn" data-id="' + category.id + '">Edit</button> ' +
                        '<button class="btn btn-danger btn-sm delete-btn" data-id="' + category.id + '">Delete</button>' +
                    '</td>' +
                                '</tr>';
                            tbody.append(row);
                        });
                        $('.edit-btn').on('click', handleEdit);
                        $('.delete-btn').on('click', handleDelete);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching categories:', error);
                    }
                });
            }

            

            function handleEdit() {
                var categoryId = $(this).data('id');
                $.ajax({
                    url: '{{ url("admin/category/edit") }}/' + categoryId,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#category_name').val(response.data.category_name);
                        $('#addCategoryModal').modal('show');

                        $('#categoryForm').off('submit').on('submit', function(e) {
                            e.preventDefault();
                            var formData = $(this).serialize();
                            $.ajax({
                                url: '{{ url("admin/category/update") }}/' + categoryId,
                                method: 'POST',
                                data: formData,
                                success: function(updateResponse) {
                                    $('#addCategoryModal').modal('hide');
                                    $('#categoryForm')[0].reset();
                                    $('.flashMessage').text(updateResponse.success).fadeIn().delay(3000).fadeOut();
                                    setTimeout(function() {
                                        location.reload();
                                    }, 2000);
                                },
                                error: function(xhr, status, error) {
                                    console.error('Error updating category:', error);
                                }
                            });
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching category data:', error);
                    }
                });
            }

            function handleDelete() {
                deleteCategoryId = $(this).data('id');
                $('#deleteModal').modal('show');
            }

            // Handle the actual deletion when confirmed
$('#confirmDelete').on('click', function() {
    if (deleteCategoryId) {
        $.ajax({
            url: '{{ url("admin/category/delete") }}/' + deleteCategoryId,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                $('#deleteModal').modal('hide');
                fetchCategories();
                $('.flashMessage').text(response.success).fadeIn().delay(3000).fadeOut();
                // Remove reload if not needed
                // setTimeout(function() {
                //     location.reload();
                // }, 2000);
            },
            error: function(xhr, status, error) {
                console.error('Error deleting category:', error);
                $('#deleteModal').modal('hide');
                alert('Error deleting category');
            }
        });
    }
});
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#categoryForm').on('submit', function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: "{{ url('admin/category/store') }}",
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        $('#addCategoryModal').modal('hide');
                        $('#categoryForm')[0].reset();
                        $('.flashMessage').text(response.success).fadeIn().delay(3000).fadeOut();
                        setTimeout(function() {
                            location.reload();
                        }, 2000);

                    },
                    error: function(xhr, status, error) {
                        console.error('Error adding category:', error);
                    }
                });
            });
        });
    </script>

      @endsection
