@extends('layouts.app')

@section('content')
<script>
  	var timeObject = {"monday":{"disabled":true},"tuesday":{"start":600,"end":1320},"wednesday":{"start":600,"end":1320},"thursday":{"start":495,"end":1320},"friday":{"start":495,"end":1320},"saturday":{"start":495,"end":1320},"sunday":{"start":495,"end":1320}};
</script>
<div class="page-wrapper">
    @include('partials.page_header', ['asset' => 'store'])
    @include('partials.modal')

    <div class="page-body">
        <div class="container-xl">
            <div class="card p-5">
                <div class="row">
                    <div class="col-12">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="card-header no-border">
                                    <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a href="#tabs-home-3" class="nav-link active" data-bs-toggle="tab" aria-selected="true" role="tab">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon me-2 icon-2">
                                                    <path d="M5 12l-2 0l9 -9l9 9l-2 0"></path>
                                                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
                                                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path>
                                                </svg> Business information
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a href="#tabs-profile-3" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2 icon icon-tabler icons-tabler-outline icon-tabler-clock">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                                    <path d="M12 7v5l3 3"></path>
                                                </svg> Working Hours
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-pane active show" id="tabs-home-3" role="tabpanel">
                                    <h2 class="col-md-12 mb-5 mt-3">Business information</h2>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <!-- Laravel Form -->
                                            <form action="{{ route('stores.store') }}" method="POST" enctype="multipart/form-data">
                                                @csrf <!-- CSRF Token -->
                                                <div class="col-md-12">
                                                    <div class="mb-5">
                                                        <label class="form-label">Business Name</label>
                                                        <input type="text" name="business_name" class="form-control" placeholder="Enter business name" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Mobile Phone</label>
                                                            <input type="tel" name="phone" class="form-control" data-mask="+3\0 0000000000" data-mask-visible="true" placeholder="+3\0 (000) 000-0000" autocomplete="off" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-5">
                                                            <label class="form-label">Email Address</label>
                                                            <input type="email" name="email" class="form-control" placeholder="example@email.com" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-5">
                                                            <label class="form-label">Business Address</label>
                                                            <input type="text" name="address" class="form-control" placeholder="Enter business address" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-5">
                                                            <label class="form-label">Website</label>
                                                            <input type="url" name="website" class="form-control" placeholder="https://www.example.gr">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Description</label>
                                                        <textarea rows="5" name="description" id="tinymce-mytextarea" class="form-control" placeholder="Enter a concise summary of your business"></textarea>
                                                    </div>
                                                </div>
                                                <input type="hidden" id="working-hours-json" name="working_hours">
                                                <div class="card-footer bg-transparent mt-auto">
                                                    <div class="btn-list justify-content-end">
                                                        <a href="{{ route('stores.index') }}" class="btn btn-1">Cancel</a>
                                                        <button type="submit" class="btn btn-primary btn-2">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="sticky-top" style="top: 20px">
                                                <label class="form-label">Store Images</label>
                                                <!-- Main Image Upload -->
                                                <div class="card mb-4">
                                                    <div class="card-body">
                                                        <h5 class="mb-3">Featured Image</h5>
                                                        <form class="dropzone" id="dropzone-main" action="{{ route('stores.uploadImage') }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="dz-message">
                                                                <i class="ti ti-cloud-upload display-4 text-muted mb-3"></i>
                                                                <h5>Drag & drop or click to upload</h5>
                                                                <small class="text-muted">Recommended size: 1200x800px</small>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- Gallery Upload -->
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="mb-3">Gallery Images</h5>
                                                        <form class="dropzone" id="dropzone-extra" action="{{ route('stores.uploadGallery') }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="dz-message">
                                                                <i class="ti ti-photo display-4 text-muted mb-3"></i>
                                                                <h5>Drag & drop or click to upload</h5>
                                                                <small class="text-muted">Maximum 5 images</small>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-profile-3" role="tabpanel">
                                    <h2 class="col-md-12 mt-3 mb-4">Working hours</h2>
                                    <small class="form-hint mb-5 lh-lg">
                                        <ul>
                                            <li><strong>Enabling/Disabling Days:</strong> To completely disable a day, simply uncheck the checkbox next to the day's name. This means customers will not be able to book any services on that day.</li>
                                            <li><strong>Setting Working Hours:</strong> When a day is enabled (checkbox checked), you can adjust the working hours using the slider bar.
                                                <ul>
                                                    <li><strong>Drag the left slider:</strong> Adjust the start time.</li>
                                                    <li><strong>Drag the right slider:</strong> Adjust the end time.</li>
                                                    <li><strong>Time Display:</strong> The selected start and end times are displayed next to the day's name in a 24-hour format (HH:MM).</li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </small>
                                    <div class="col-lg-6">
                                        <div id="working-hours" class="p-1"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Initialize Dropzone for Main Image
        const dropzoneMain = new Dropzone("#dropzone-main", {
            url: "{{ route('stores.uploadImage') }}", // Replace with your upload route
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}" // Include CSRF token for Laravel
            },
            paramName: "image", // The name of the file input field
            maxFiles: 1, // Allow only one file
            acceptedFiles: "image/*", // Accept only images
            addRemoveLinks: true, // Allow removing files
            dictDefaultMessage: "Drag and drop an image here or click to upload",
            success: function (file, response) {
                // Handle success response
                console.log("Main image uploaded successfully:", response);
                alert("Main image uploaded successfully!");
            },
            error: function (file, response) {
                // Handle error response
                console.error("Error uploading main image:", response);
                alert("Failed to upload main image. Please try again.");
            }
        });

        // Optional: Remove file from server when deleted in Dropzone
        dropzoneMain.on("removedfile", function (file) {
            // Make an AJAX request to delete the file
            fetch("{{ route('stores.deleteImage') }}", {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ filename: file.name })
            })
                .then(response => response.json())
                .then(data => {
                    console.log("Main image deleted successfully:", data);
                })
                .catch(error => {
                    console.error("Error deleting main image:", error);
                });
        });

        // Initialize Dropzone for Gallery Images
        const dropzoneExtra = new Dropzone("#dropzone-extra", {
            url: "{{ route('stores.uploadGallery') }}", // Replace with your upload route
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}" // Include CSRF token for Laravel
            },
            paramName: "gallery[]", // The name of the file input field
            maxFiles: 5, // Allow up to 5 files
            acceptedFiles: "image/*", // Accept only images
            addRemoveLinks: true, // Allow removing files
            dictDefaultMessage: "Drag and drop images here or click to upload",
            success: function (file, response) {
                // Handle success response
                console.log("Gallery image uploaded successfully:", response);
                alert("Gallery image uploaded successfully!");
            },
            error: function (file, response) {
                // Handle error response
                console.error("Error uploading gallery image:", response);
                alert("Failed to upload gallery image. Please try again.");
            }
        });

        // Optional: Remove file from server when deleted in Dropzone
        dropzoneExtra.on("removedfile", function (file) {
            // Make an AJAX request to delete the file
            fetch("{{ route('stores.deleteGallery') }}", {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ filename: file.name })
            })
                .then(response => response.json())
                .then(data => {
                    console.log("Gallery image deleted successfully:", data);
                })
                .catch(error => {
                    console.error("Error deleting gallery image:", error);
                });
        });
    });
</script>
@endsection