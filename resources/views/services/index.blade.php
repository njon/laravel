@extends('layouts.app')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-md-12">
                <div class="row row-cards">
                    <div class="space-y">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Services List</h3>
                                </div>
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap datatable">
                                        <thead>
                                            <tr>
                                                <th class="w-1">
                                                    <input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all services">
                                                </th>
                                                <th>Service Name</th>
                                                <th>Stores</th>
                                                <th>Price</th>
                                                <th>Duration</th>
                                                <th>Participants</th>
                                                <th>Created</th>
                                                <th>Status</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($services as $service)
                                            <tr>
                                                <td>
                                                    <input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select service">
                                                </td>
                                                <td>
                                                    <a href="{{ route('services.show', $service->id) }}" class="text-reset">
                                                        {{ $service->service_title }}
                                                    </a>
                                                </td>
                                                <td class="text-truncate table-col">
                                                    @foreach ($service->stores as $store)
                                                        <button class="btn mb-1">{{ $store->business_name }}</button>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    {{ $service->service_price }} €
                                                </td>
                                                <td>
                                                    {{ $service->length_of_service_minutes }} minutes
                                                </td>
                                                <td>
                                                    {{ $service->max_participants ?? 'N/A' }}
                                                </td>
                                                <td>
                                                    {{ $service->created_at->format('d M Y') }}
                                                </td>
                                                <td>
                                                    <button class="btn mb-1">
                                                        <span class="badge {{ $service->status == 'active' ? 'bg-success' : 'bg-danger' }} me-1"></span>
                                                        {{ ucfirst($service->status) }}
                                                    </button>
                                                </td>
                                                <td class="text-end">
                                                    <a href="{{ route('services.edit', $service->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                    <form action="{{ route('services.destroy', $service->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer d-flex align-items-center">
                                    <p class="m-0 text-secondary">Showing {{ $services->count() }} of {{ $services->total() }} entries</p>
                                    <ul class="pagination m-0 ms-auto">
                                        {{ $services->links() }}
                                    </ul>
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