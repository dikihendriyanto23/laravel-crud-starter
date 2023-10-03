<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Starter CRUD</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
</head>

<body>
    <div class="container">
        @if (session()->has('success_message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success_message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session()->has('error_message'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session()->get('error_message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <h2 class="mt-3">Product</h2>
        <div class="d-flex justify-content-end">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddProduct">Add
                Product</button>
        </div>
        <table class="table table-bordered table-striped mt-3">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php($i = 0)
                @foreach ($data['products'] as $product)
                    <tr>
                        <td class="text-center">{{ $i += 1 }}.</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->type }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->price }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="#" class="btn btn-warning btn-sm me-2 edit-btn"
                                    id="{{ $product->id }}">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm delete-btn"
                                    id="{{ $product->id }}">Delete</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Add -->
    <div class="modal fade" id="modalAddProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('product-insert') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" name="description" id="description"
                                placeholder="Description">
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <input type="text" class="form-control" name="type" id="type" placeholder="Type">
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" name="quantity" id="quantity" placeholder="2">
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" name="price" id="price" placeholder="5000">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="modalEditProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('product-update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="id_edit" name="id_edit">
                        <div class="mb-3">
                            <label for="description_edit" class="form-label">Description</label>
                            <input type="text" class="form-control" name="description_edit" id="description_edit"
                                placeholder="Description">
                        </div>
                        <div class="mb-3">
                            <label for="type_edit" class="form-label">Type</label>
                            <input type="text" class="form-control" name="type_edit" id="type_edit"
                                placeholder="Type">
                        </div>
                        <div class="mb-3">
                            <label for="quantity_edit" class="form-label">Quantity</label>
                            <input type="number" class="form-control" name="quantity_edit" id="quantity_edit"
                                placeholder="2">
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" name="price_edit" id="price_edit"
                                placeholder="5000">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Delete -->
    <div class="modal fade" id="modalDeleteProduct" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('product-delete') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body text-center">
                        <input type="hidden" id="id_delete" name="id_delete">
                        <span>Are you sure to delete <strong id="strong_delete"></strong></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script>
        $(function() {
            $('.edit-btn').on('click', function(event) {
                event.preventDefault();
                let id = $(this).attr('id');
                $.ajax({
                    url: "{{ url('product-get') }}",
                    method: "GET",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        $('#id_edit').val(response.id);
                        $('#description_edit').val(response.description);
                        $('#type_edit').val(response.type);
                        $('#quantity_edit').val(response.quantity);
                        $('#price_edit').val(response.price);
                        $('#modalEditProduct').modal('show');
                    },
                    error: function() {
                        alert('Error Request, Ajax Error!')
                    }
                })
            });

            $('.delete-btn').on('click', function(event) {
                event.preventDefault();
                let id = $(this).attr('id');
                $.ajax({
                    url: "{{ url('product-get') }}",
                    method: "GET",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        $('#id_delete').val(response.id);
                        $('#strong_delete').html(response.description + '?');
                        $('#modalDeleteProduct').modal('show');
                    },
                    error: function() {
                        alert('Error Request, Ajax Error!')
                    }
                })
            });
        });
    </script>
</body>

</html>
