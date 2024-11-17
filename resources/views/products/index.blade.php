@extends('layouts.app')

@section('title', 'Product List')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="my-4">Product List</h1>
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createProductModal">
            Add New Product
        </button>
    </div>

    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4 mb-4">
                <!-- Product Card -->
                <div class="card shadow-sm">
                    <!-- Product Image -->
                    <img src="{{ asset('images/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 220px; object-fit: cover;">

                    <!-- Card Body -->
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">₱{{ $product->price }}</p>
                    </div>

                    <!-- Card Footer -->
                    <div class="card-footer text-center">
                        <button type="button" class="btn btn-info mt-2" data-bs-toggle="modal" data-bs-target="#productModal{{ $product->id }}">View Details</button>
                    </div>
                </div>

                <!-- Modal for Product Details -->
                <div class="modal fade" id="productModal{{ $product->id }}" tabindex="-1" aria-labelledby="productModalLabel{{ $product->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="productModalLabel{{ $product->id }}">{{ $product->name }} Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <img src="{{ asset('images/' . $product->image) }}" class="img-fluid" alt="{{ $product->name }}">
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Price: ₱{{ $product->price }}</h5>
                                        <p>{{ $product->description }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editProductModal{{ $product->id }}">Edit Product</button>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination links (Centered) -->
    <div class="mt-4 d-flex justify-content-center">
        {{ $products->links() }}  <!-- Pagination links -->
    </div>

    <!-- Create Product Modal -->
    <div class="modal fade" id="createProductModal" tabindex="-1" aria-labelledby="createProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createProductModalLabel">Create New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Create Product Form -->
                    <form action="{{ route('products.store') }}" method="POST">
                        @csrf
                        <!-- Product Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <!-- Product Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Product Description</label>
                            <textarea class="form-control" id="description" name="description" required></textarea>
                        </div>

                        <!-- Product Price -->
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="text" class="form-control" id="price" name="price" required>
                        </div>

                        <!-- Dropdown to Select Image -->
                        <div class="mb-3">
                            <label for="image" class="form-label">Choose Image</label>
                            <select class="form-control" id="image" name="image" required>
                                <option value="image1.jpg">Image 1</option>
                                <option value="image2.jpg">Image 2</option>
                                <option value="image3.jpg">Image 3</option>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-success">Create Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
