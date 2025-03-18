@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        a
                    </h2>
                    <div class="text-secondary mt-1"> users</div> </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="d-flex">
                        <a href="{{ route('users.create') }}" class="btn btn-primary btn-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="icon icon-2">
                                <path d="M12 5l0 14"/>
                                <path d="M5 12l14 0"/>
                            </svg>
                            New user
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                @foreach($users as $user)  <div class="col-md-6 col-lg-3">
                        <div class="card">
                            <img class="card-img-top"
                                 src="{{ asset($user->image) }}"  alt="User Image" style="max-height: 200px; object-fit: cover;">
                            <div class="card-body p-4">
                                <h3 class="m-0 mb-1">
                                    <a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a> </h3>
                                <div class="mt-2">
                                    <p class="text-secondary m-0">{{ $user->job_title }}</p> </div>
                            </div>
                            <div class="d-flex">
                                <a href="{{ route('users.edit', $user->id) }}" class="card-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                         stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                         width="24" height="24" stroke-width="2" class="icon me-2 text-muted icon-3">
                                        <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4"></path>
                                        <path d="M13.5 6.5l4 4"></path>
                                    </svg>
                                    Edit
                                </a>
                                <a href="#" class="card-btn" data-bs-toggle="modal"
                                   data-bs-target="#delete-user-{{ $user->id }}">
                                    <svg class="icon me-2 text-muted icon-3" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round"
                                         stroke-linejoin="round" width="24" height="24" stroke-width="2">
                                        <path d="M4 7l16 0"></path>
                                        <path d="M10 11l0 6"></path>
                                        <path d="M14 11l0 6"></path>
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                    </svg>
                                    Delete
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="modal modal-blur fade" id="delete-user-{{ $user->id }}" tabindex="-1" role="dialog"
                         aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Delete {{ $user->name }}</h5> <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="text-secondary">
                                        Deleting this user is permanent and can't be undone. Are you sure you want to
                                        delete **{{ $user->name }}**?
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE') <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection