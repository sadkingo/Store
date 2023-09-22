@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="mb-5">
                <h3 class="mb-0 ">Add Product</h3>
            </div>
        </div>
    </div>
    <!-- row -->
    <form action="{{ route('Product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-8 col-12">
                <!-- card -->
                <div class="card mb-4">
                    <!-- card body -->
                    <div class="card-body">
                        <div>
                            <!-- input -->
                            <div class="mb-3">
                                <label class="form-label">Product Title</label>
                                <input name="name" type="text" class="form-control" value="{{ old('name') }}"
                                    placeholder="Enter Product Title" required>
                                @error('name')
                                    <span class=" text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                            <!-- input -->
                            <div>
                                <label class="form-label">Product Description</label>
                                <textarea class="form-control" value="{{ old('description') }}" name="description" id="" cols="30"
                                    rows="10" placeholder="Enter Product Description"></textarea>
                                @error('description')
                                    <span class=" text-danger"> {{ $message }} </span>
                                @enderror
                                {{-- <div class="pb-8" id="editor"></div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- card -->
                <div class="card mb-4">
                    <!-- card body -->
                    <div class="card-body">
                        <div>
                            <div class="mb-4">
                                <!-- heading -->
                                {{-- <h4 class="mb-4">Product Gallery</h4> --}}
                                <h5 class="mb-1">Product Image</h5>
                                <p>Add Product main Image.</p>
                                <!-- input -->

                                <input data-preview='image_url' name="image_url" type="file" class="form-control">

                                <div class="col-md-8">
                                    <div class="input-group has-validation">
                                        <span class="input-group-text gap-4 mb-2 mt-2 p-0" id="inputGroupPrepend"><span
                                                class="p-4">{{ __('  Image Preview') }}</span>
                                            <img class="rounded" id="image_url"
                                                src="{{ getFile($product->image_url ?? 'assets\images\no-image.png') }}"
                                                width="140px" height="120px">
                                        </span>
                                    </div>
                                </div>


                                @error('image_url')
                                    <span class=" text-danger"> {{ $message }} </span>
                                @enderror

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="images">Add Product Images</label>
                                        <input type="file" name="images[]" id="images" multiple accept="image/*"
                                            placeholder="Choose images" multiple>
                                    </div>



                                    <div id="image-counter">Selected Images: 0</div>
                                    <div id="image-preview" class="image-preview"></div>
                                    @error('images')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>




                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <!-- card -->
                <div class="card mb-4">
                    <!-- card body -->
                    <div class="card-body">
                        <!-- input -->
                        <div class="mb-3">
                            <label class="form-label">Product Code</label>
                            <input name="product_code" type="text" value="{{ old('product_code') }}" class="form-control"
                                placeholder="Enter Product Code">
                            @error('product_code')
                                <span class=" text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <!-- input -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <label class="form-label">Category</label>
                                <a href="{{ route('Category.create') }}" class="btn-link fw-semi-bold">Add New</a>
                            </div>
                            <!-- select menu -->
                            <select name="category_id" class="form-select" aria-label="Default select example">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach

                            </select>
                            @error('category_id')
                                <span class=" text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <!-- select -->
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" aria-label="Default select example">
                                <option value="Published" selected>Published</option>
                                <option value="Unpublished">Unpublished</option>
                                <option value="Draft">Draft</option>
                            </select>
                            @error('status')
                                <span class=" text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- card -->
                <div class="card mb-4">
                    <!-- card body -->
                    <div class="card-body">
                        <!-- input -->
                        <div class="mb-3">
                            <label class="form-label">Purchase Price</label>
                            <input name="purchase_price" value="{{ old('purchase_price') }}" type="text"
                                class="form-control" placeholder="$ 0.00" required>
                            @error('purchase_price')
                                <span class=" text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <!-- input -->
                        <div class="mb-3">
                            <label class="form-label">Sale Price</label>
                            <input name="sale_price" value="{{ old('sale_price') }}" type="text"
                                class="form-control" placeholder="$ 0.00" required>
                            @error('sale_price')
                                <span class=" text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <!-- input -->
                        <div class="mb-3">
                            <label class="form-label">Quantity</label>
                            <input name="quantity" value="{{ old('quantity') }}" type="text" class="form-control"
                                placeholder="0.00" required>
                            @error('quantity')
                                <span class=" text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- button -->
                <div class="d-grid">
                    <button class="btn btn-primary" type="submit">Create Product</button>
                </div>
            </div>
        </div>
    </form>


    @push('scripts')
        {{-- <script src="{{asset('/assets/js/custom.js')}}"></script> --}}
        {{-- <script>
            $(function() {
                // Multiple images preview with JavaScript
                var previewImages = function(input, imgPreviewPlaceholder) {

                    if (input.files) {
                        var filesAmount = input.files.length;

                        for (i = 0; i < filesAmount; i++) {
                            var reader = new FileReader();

                            reader.onload = function(event) {
                                $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(
                                    imgPreviewPlaceholder);
                            }

                            reader.readAsDataURL(input.files[i]);
                        }
                    }

                };

                $('#images').on('change', function() {
                    previewImages(this, 'div.images-preview-div');
                });
            });
        </script> --}}
        <!-- dropzone -->
        {{-- <script src="{{ asset('/assets/js/dropzone.min.js') }}"></script> --}}
        <!-- flatpickr -->
        <script src="https://dashui.codescandy.com/dashuipro/assets/libs/flatpickr/dist/flatpickr.min.js"></script>

        <!-- quill js -->
        {{-- <script src="https://dashui.codescandy.com/dashuipro/assets/libs/quill/dist/quill.min.js"></script> --}}
        {{-- <script src="https://dashui.codescandy.com/dashuipro/assets/libs/@yaireo/tagify/dist/tagify.min.js"></script> --}}
    @endpush
    <script>
        const fileInput = document.querySelector('[data-preview]');
        if (fileInput) {
            const imgPreview = document.getElementById(fileInput.dataset.preview);
            fileInput.addEventListener("change", () => {
                imgPreview.src = window.URL.createObjectURL(fileInput.files[0]);
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('images');
            const previewContainer = document.getElementById('image-preview');
            const imageCounter = document.getElementById('image-counter');

            input.addEventListener('change', function() {
                const files = input.files;
                for (let i = 0; i < files.length; i++) {
                    if (files[i].type.match('image.*')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            // Create a container for each image with a delete button
                            const imageContainer = document.createElement('div');
                            imageContainer.classList.add('image-container');

                            // Create an image element
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.classList.add('preview-image');

                            // Create a delete button for each image
                            const deleteButton = document.createElement('button');
                            deleteButton.textContent = 'Delete';
                            deleteButton.classList.add('delete-button');
                            deleteButton.dataset.index = i; // Store the index for identification
                            deleteButton.addEventListener('click', function() {
                                // Remove the image and the delete button when clicked
                                imageContainer.remove();
                                updateImageCounter();
                            });

                            // Append image and delete button to the container
                            imageContainer.appendChild(img);
                            imageContainer.appendChild(deleteButton);

                            // Append the container to the preview container
                            previewContainer.appendChild(imageContainer);

                            updateImageCounter();
                        };

                        reader.readAsDataURL(files[i]);
                    }
                }
            });

            function updateImageCounter() {
                const imageCount = previewContainer.querySelectorAll('.image-container').length;
                imageCounter.textContent = `Selected Images: ${imageCount}`;
            }
        });
    </script>
    @push('head')
        <style>
            .image-preview {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
            }

            .image-container {
                position: relative;
            }

            .preview-image {
                height: 150px;
                width: 170px;
                max-width: 170px;
                max-height: 150px;
                border: 1px solid #ff0000;
                margin: 5px;
            }

            .delete-button {
                position: absolute;
                top: 5px;
                right: 5px;
                background-color: #ff0000;
                color: #fff;
                border: none;
                cursor: pointer;
            }
        </style>
    @endpush
@endsection
