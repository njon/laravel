@extends('layouts.app')
@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-lg-3">
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Profile picture</h3>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-12 mb-5">
                                        <form id="dropzone-main" class="dropzone dropzone-avatar" action="{{ route('users.update', $user->id) }}"
                                            autocomplete="off">
                                            <div class="dz-message">
                                                <span class="avatar avatar-xl"
                                                    style="background-image: url({{ $user->image }})"></span>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-6">
                                        <a id="add-avatar" class="btn btn-1">
                                            Change avatar
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="#" class="btn btn-ghost-danger btn-3">
                                            Delete avatar
                                        </a>
                                    </div>
                                </div>
                                <script>
                                    document.addEventListener("DOMContentLoaded", function () {
                                        // Initialize Dropzone
                                        const dropzone = new Dropzone("#dropzone-main", {
                                            // url: "{{ route('users.uploadAvatar', $user->id) }}", // Replace with your upload route
                                            url: 'https://humble-doodle-rr54477gg7hxp6-8000.app.github.dev/users/1/upload-avatar',
                                            method: "POST",
                                            headers: {
                                                "X-CSRF-TOKEN": "{{ csrf_token() }}" // Include CSRF token for Laravel
                                            },
                                            paramName: "avatar", // The name of the file input field
                                            maxFiles: 1, // Allow only one file
                                            acceptedFiles: "image/*", // Accept only images
                                            addRemoveLinks: true, // Allow removing files
                                            dictDefaultMessage: "Drag and drop an image here or click to upload",
                                            success: function (file, response) {
                                                // Handle success response
                                                console.log("File uploaded successfully:", response);
                                                alert("Avatar updated successfully!");
                                            },
                                            error: function (file, response) {
                                                // Handle error response
                                                console.error("Error uploading file:", response);
                                                alert("Failed to upload avatar. Please try again.");
                                            }
                                        });

                                        // Optional: Remove file from server when deleted in Dropzone
                                        dropzone.on("removedfile", function (file) {
                                            // Make an AJAX request to delete the file
                                            fetch("{{ route('users.deleteAvatar', $user->id) }}", {
                                                method: "DELETE",
                                                headers: {
                                                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                                    "Content-Type": "application/json"
                                                },
                                                body: JSON.stringify({ filename: file.name })
                                            })
                                                .then(response => response.json())
                                                .then(data => {
                                                    console.log("File deleted successfully:", data);
                                                })
                                                .catch(error => {
                                                    console.error("Error deleting file:", error);
                                                });
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row row-cards">
                    <div class="col-12">
                        <form class="card" action="{{ route('users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <h3 class="card-title mb-5">User information</h3>
                                <div class="row row-cards">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Full Name</label>
                                            <input type="text" class="form-control" name="full_name"
                                                value="{{ $user->full_name }}" placeholder="John Doe" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Job Title</label>
                                            <input type="text" class="form-control" name="job_title"
                                                value="{{ $user->job_title }}" placeholder="e.g., Software Engineer" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Work Email</label>
                                            <input type="email" class="form-control" name="work_email"
                                                value="{{ $user->email }}" placeholder="john@company.com" required>
                                            <small class="form-hint">This will be user's login name</small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Work Phone</label>
                                            <input type="tel" class="form-control" name="work_phone"
                                                value="{{ $user->work_phone }}" placeholder="+1 (555) 000-0000">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">System Access Level</label>
                                            <div class="form-selectgroup">
                                                <label class="form-selectgroup-item">
                                                    <input type="radio" name="access_level" value="basic"
                                                        class="form-selectgroup-input" {{ $user->access_level == 'basic' ? 'checked' : '' }}>
                                                    <span class="form-selectgroup-label text-start">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" width="20" height="20"
                                                            stroke-width="2">
                                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                                            <path
                                                                d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6">
                                                            </path>
                                                        </svg>
                                                        Basic Access
                                                        <small class="form-hint d-block">View-only
                                                            permissions</small>
                                                    </span>
                                                </label>
                                                <label class="form-selectgroup-item">
                                                    <input type="radio" name="access_level" value="editor"
                                                        class="form-selectgroup-input" {{ $user->access_level == 'editor' ? 'checked' : '' }}>
                                                    <span class="form-selectgroup-label text-start">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 24 24" fill="none" width="20"
                                                            height="20" stroke-width="2" stroke-linejoin="round"
                                                            stroke-linecap="round" stroke="currentColor">
                                                            <path
                                                                d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4">
                                                            </path>
                                                            <path d="M13.5 6.5l4 4"></path>
                                                            <path d="M16 19h6"></path>
                                                            <path d="M19 16v6"></path>
                                                        </svg>
                                                        Editor Access
                                                        <small class="form-hint d-block">Create/edit
                                                            content</small>
                                                    </span>
                                                </label>
                                                <label class="form-selectgroup-item">
                                                    <input type="radio" name="access_level" value="admin"
                                                        class="form-selectgroup-input" {{ $user->access_level == 'admin' ? 'checked' : '' }}>
                                                    <span class="form-selectgroup-label text-start">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" width="20" height="20"
                                                            stroke-width="2">
                                                            <path
                                                                d="M13.163 2.168l8.021 5.828c.694 .504 .984 1.397 .719 2.212l-3.064 9.43a1.978 1.978 0 0 1 -1.881 1.367h-9.916a1.978 1.978 0 0 1 -1.881 -1.367l-3.064 -9.43a1.978 1.978 0 0 1 .719 -2.212l8.021 -5.828a1.978 1.978 0 0 1 2.326 0z">
                                                            </path>
                                                            <path d="M12 13a3 3 0 1 0 0 -6a3 3 0 0 0 0 6z"></path>
                                                            <path
                                                                d="M6 20.703v-.703a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v.707"></path>
                                                        </svg>
                                                        Admin Access
                                                        <small class="form-hint d-block">Full system
                                                            privileges</small>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="">
                                            <div class="row">
                                                <div class="col-auto">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="40"
                                                        height="40" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon-tabler icons-tabler-outline icon-tabler-lock">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                        </path>
                                                        <path
                                                            d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z">
                                                        </path>
                                                        <path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0"></path>
                                                        <path d="M8 11v-4a4 4 0 1 1 8 0v4"></path>
                                                    </svg>
                                                </div>
                                                <div class="col">
                                                    <div class="mb-3">
                                                        <label class="form-label">Welcome email will be
                                                            sent with login instructions</label>
                                                        <small class="form-hint">Password is automatically
                                                            generated upon account creation and added in
                                                            email message</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <button type="submit" class="btn btn-primary">Update Account</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection