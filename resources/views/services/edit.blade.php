@extends('layouts.app')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') {{--  For updating resources, use the PUT or PATCH method --}}
                    <div class="card p-4">
                        <div class="card-body">
                            <div class="row">
                                <h2 class="col-md-12 mb-5">Edit service details</h2>
                                <div class="col-md-8">
                                    <div class="mb-4">
                                        <div class="mb-4">
                                            <div class="mb-3">
                                                <label class="form-label required">Service Title</label>
                                                <input type="text" class="form-control form-control-lg @error('title') is-invalid @enderror" name="title"
                                                    placeholder="e.g., Professional Website Design" value="{{ old('title', $service->title) }}" required>
                                                <small class="form-hint">Keep it clear and descriptive</small>
                                                @error('title')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label required">Service Description</label>
                                                <textarea rows="6" class="form-control @error('description') is-invalid @enderror" name="description"
                                                    id="tinymce-mytextarea" placeholder="Describe your service in detail">{{ old('description', $service->description) }}</textarea>
                                                @error('description')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <h4 class="mb-3">Pricing &amp; Availability</h4>
                                            <div class="row g-3">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label required">Service Price</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text">€</span>
                                                            <input type="number" class="form-control @error('price') is-invalid @enderror" name="price"
                                                                placeholder="0.00" step="1" value="{{ old('price', $service->price) }}" required>
                                                            @error('price')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label required">Length of service (minutes)</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                    stroke-width="2" stroke-linecap="round"
                                                                    stroke-linejoin="round"
                                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-clock">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                    <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                                                                    <path d="M12 7v5l3 3" />
                                                                </svg>
                                                            </span>
                                                            <input type="number" id="to-time" name="duration"
                                                                class="form-control @error('duration') is-invalid @enderror" step="1"
                                                                placeholder="Length in minutes" value="{{ old('duration', $service->duration) }}"
                                                                required>
                                                            @error('duration')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <small class="form-hint">Length of service now is <span
                                                                class="transform-to-hour">
                                                                {{ $service->duration ?  $service->duration . ' minutes' : '0 minutes' }}
                                                            </span></small>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Participants</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text ps-2 pe-2"><svg
                                                                    xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                    stroke-width="2" stroke-linecap="round"
                                                                    stroke-linejoin="round">
                                                                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2">
                                                                    </path>
                                                                    <circle cx="12" cy="7" r="4"></circle>
                                                                </svg></span>
                                                            <input type="number" class="form-control" name="participants"
                                                                placeholder="Max participants" value="{{ old('participants', $service->participants) }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <h4 class="mb-3">Categorization</h4>
                                            <div class="row g-3">
                                            

                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Stores</label>
                                                        <select id="select-locations" class="form-select" name="locations"
                                                            placeholder="Select stores" multiple>
                                                            @foreach ($service->stores() as $store)
                                                                {{ $store->business_name }}
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <h4 class="mb-3">Additional Details</h4>
                                            <div class="mb-3">
                                                <label class="form-label">Exclusions (Optional)</label>
                                                <textarea rows="3" class="form-control" name="exclusions"
                                                    placeholder="List items not included in this service">{{ old('exclusions', $service->exclusions) }}</textarea>
                                            </div>
                                        </div>

                                        <div class="card-footer bg-transparent mt-4">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <a href="{{ route('services.index') }}" class="btn btn-link">Cancel</a>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="ti ti-check me-2"></i>Update Service
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="sticky-top" style="top: 20px">
                                    <label class="form-label">Service Images</label>
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <h5 class="mb-3">Featured Image</h5>
                                            <form class="dropzone" id="dropzone-main" action="{{ route('services.images.upload', $service->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="image_type" value="main">
                                                <div class="dz-message">
                                                    <i class="ti ti-cloud-upload display-4 text-muted mb-3"></i>
                                                    <h5>Drag &amp; drop or click to upload</h5>
                                                    <small class="text-muted">Recommended size: 1200x800px</small>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="mb-3">Gallery Images</h5>
                                            <form class="dropzone" id="dropzone-extra" action="{{ route('services.images.upload', $service->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="image_type" value="gallery">
                                                <div class="dz-message">
                                                    <i class="ti ti-photo display-4 text-muted mb-3"></i>
                                                    <h5>Drag &amp; drop or click to upload</h5>
                                                    <small class="text-muted">Maximum 5 images</small>
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
@endsection