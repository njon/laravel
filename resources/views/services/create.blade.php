@extends('layouts.app')

@section('content')
<div class="page-body">
    <div class="container-xl">

        <div class="row">
            <div class="col-12">
                <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card p-4">
                        <div class="card-body">
                            <div class="row">
                                <!-- Left Column - Service Details -->
                                <h2 class="col-md-12 mb-5">Fill service details</h2>
                                <div class="col-md-8">
                                    <div class="mb-4">
                                        <!-- Basic Information Section -->
                                        <div class="mb-4">
                                            <div class="mb-3">
                                                <label class="form-label required">Service Title</label>
                                                <input type="text" class="form-control form-control-lg" name="title" placeholder="e.g., Professional Website Design" required>
                                                <small class="form-hint">Keep it clear and descriptive</small>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label required">Service Description</label>
                                                <textarea rows="6" class="form-control" name="description" id="tinymce-mytextarea" placeholder="Describe your service in detail"></textarea>
                                            </div>
                                        </div>

                                        <!-- Pricing & Availability Section -->
                                        <div class="mb-4">
                                            <h4 class="mb-3">Pricing &amp; Availability</h4>
                                            <div class="row g-3">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label required">Service Price</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text">€</span>
                                                            <input type="number" class="form-control" name="price" placeholder="0.00" step="1" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                 
                                       
                                                <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label class="form-label required">Length of service (minutes)</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-text">
                                                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-clock"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 7v5l3 3" /></svg>
                                                                    </span>
                                                                    <input type="number" id="to-time" name="duration" class="form-control" step="1" placeholder="Length in minutes"
                                                                            required>
                                                                </div>
                                                                <small class="form-hint">Length of service now is <span class="transform-to-hour">0 minutes</span></small>
                                                            </div>
                                                        </div>

                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Participants</label>
                                                        <div class="input-group">
                                                        <span class="input-group-text ps-2 pe-2"><svg
                                                                            xmlns="http://www.w3.org/2000/svg" width="20"
                                                                            height="20" viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round"><path
                                                                            d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path><circle
                                                                            cx="12" cy="7" r="4"></circle></svg></span>
                                                            <input type="number" class="form-control" name="participants" placeholder="Max participants">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Categorization Section -->
                                        <div class="mb-4">
                                            <h4 class="mb-3">Categorization</h4>
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Service Categories</label>
                                                        <select id="select-categories" class="form-select"  placeholder="Select categories" name="categories[]" multiple>
                                                            <option value="Web Development">Web Development</option>
                                                            <option value="Graphic Design">Graphic Design</option>
                                                            <option value="Digital Marketing">Digital Marketing</option>
                                                            <option value="SEO">SEO</option>
                                                            <option value="Content Writing">Content Writing</option>
                                                        </select>
                                                        <small class="form-hint">Start typing to search existing categories</small>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Stores</label>
                                                        <select id="select-locations" class="form-select" name="locations[]" 
                                                        placeholder="Select stores" multiple>
                                                       
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Additional Information -->
                                        <div class="mb-4">
                                            <h4 class="mb-3">Additional Details</h4>
                                            <div class="mb-3">
                                                <label class="form-label">Exclusions (Optional)</label>
                                                <textarea rows="3" class="form-control" name="exclusions" placeholder="List items not included in this service"></textarea>
                                            </div>
                                        </div>

                        <!-- Form Footer -->
                        <div class="card-footer bg-transparent mt-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('services.index') }}" class="btn btn-link">Cancel</a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="ti ti-check me-2"></i>Publish Service
                                </button>
                            </div>
                        </div>
                                    </form>

                                    </div>
                                </div>

                                <!-- Right Column - Media Upload -->
                                <div class="col-md-4">
                                    <div class="sticky-top" style="top: 20px">
                                        <label class="form-label">Service Images</label>
                                        <!-- Main Image Upload -->
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <h5 class="mb-3">Featured Image</h5>
                                                <form class="dropzone" id="dropzone-main" action="" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="dz-message">
                                                        <i class="ti ti-cloud-upload display-4 text-muted mb-3"></i>
                                                        <h5>Drag &amp; drop or click to upload</h5>
                                                        <small class="text-muted">Recommended size: 1200x800px</small>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <!-- Gallery Upload -->
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="mb-3">Gallery Images</h5>
                                                <form class="dropzone" id="dropzone-extra" action="" method="POST" enctype="multipart/form-data">
                                                    @csrf
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
</div>
@endsection