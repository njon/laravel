<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Tabler - Premium and Open Source dashboard template with responsive and high quality UI.</title>
    <link href="/dist/css/custom.css" rel="stylesheet" />
    <link href="{{ asset('./dist/css/tabler.min.css?1738096684') }}" rel="stylesheet" />
    <link href="{{ asset('./dist/css/tabler-flags.min.css?1738096684') }}" rel="stylesheet" />
    <link href="{{ asset('./dist/css/tabler-socials.min.css?1738096684') }}" rel="stylesheet" />
    <link href="{{ asset('./dist/css/tabler-payments.min.css?1738096684') }}" rel="stylesheet" />
    <link href="{{ asset('./dist/css/tabler-vendors.min.css?1738096684') }}" rel="stylesheet" />
    <link href="{{ asset('./dist/css/tabler-marketing.min.css?1738096684') }}" rel="stylesheet" />
    <link href="{{ asset('./dist/css/demo.min.css?1738096684') }}" rel="stylesheet" />
    <link href="{{ asset('./dist/libs/dropzone/dist/dropzone.css?1738448791') }}" rel="stylesheet">

    <style>
        @import url('https://rsms.me/inter/inter.css');
    </style>
</head>

<body>
    <script src="{{ asset('./dist/js/demo-theme.min.js?1738096684') }}"></script>
    <div class="page">
        <div class="page-wrapper">
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <h2 class="page-title">
                                Add user
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
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
                                                    <form id="dropzone-main" class="dropzone dropzone-avatar" action="./"
                                                        autocomplete="off">
                                                        <div class="dz-message">
                                                            <span class="avatar avatar-xl"
                                                                style="background-image: url(https://th.bing.com/th/id/OIG2.yJKX65L7iKMmSuK8LoUF?pid=ImgGn)"></span>
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
                                                document.addEventListener("DOMContentLoaded", function() {
                                                    new Dropzone("#dropzone-main")
                                                })
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="row row-cards">
                                <div class="col-12">
                                    <form class="card" action="{{ route('users.store') }}" method="POST">
                                        @csrf
                                        <div class="card-body">
                                            <h3 class="card-title mb-5">User information</h3>
                                            <div class="row row-cards">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Full Name</label>
                                                        <input type="text" class="form-control" name="full_name"
                                                            placeholder="John Doe" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Job Title</label>
                                                        <input type="text" class="form-control" name="job_title"
                                                            placeholder="e.g., Software Engineer" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Work Email</label>
                                                        <input type="email" class="form-control" name="work_email"
                                                            placeholder="john@company.com" required>
                                                        <small class="form-hint">This will be user's login name</small>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Work Phone</label>
                                                        <input type="tel" class="form-control" name="work_phone"
                                                            placeholder="+1 (555) 000-0000">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">System Access Level</label>
                                                        <div class="form-selectgroup">
                                                            <label class="form-selectgroup-item">
                                                                <input type="radio" name="access_level" value="basic"
                                                                    class="form-selectgroup-input" checked>
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
                                                                    class="form-selectgroup-input">
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
                                                                    class="form-selectgroup-input">
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
                                                <button type="submit" class="btn btn-primary">Create Account</button>
                                            </div>
                                        </div>
                                    </form>
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

    </div>
    </div>
    <script>
        document.getElementById('add-avatar').addEventListener('click', function() {
            document.getElementById('dropzone-main').click();
        });
    </script>
    <script src="{{ asset('./dist/libs/nouislider/dist/nouislider.min.js?1738096684') }}" defer></script>
    <script src="{{ asset('./dist/js/custom.js') }}" defer></script>
    <script src="{{ asset('./dist/libs/dropzone/dist/dropzone-min.js?1738448791') }}" defer></script>
    <script src="{{ asset('./dist/js/tabler.min.js?1738096684') }}" defer></script>
    <script src="{{ asset('./dist/js/demo.min.js?1738096684') }}" defer></script>
</body>

</html>