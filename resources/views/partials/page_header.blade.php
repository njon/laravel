@php
    $page = Request::segment(1);
    $segments = Request::segments();
    $action = end($segments);

    $link = $action == 'create' ? route($page.'.index') : route($page.'.create');
@endphp
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">{{ $page }} Management</div>
                    @if ($action == 'create')
                        <h2 class="page-title">Create {{ $page }}</h2>
                    @elseif ($action == 'edit')
                        <h2 class="page-title">Edit {{ $page }}</h2>
                    @else 
                        <h2 class="page-title">{{ $page }} List</h2>
                    @endif
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    @if($action !== $page)
                        <span class="d-none d-sm-inline">
                            <a href="{{ route($page . '.index') }}" class="btn btn-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M18 6l-12 12"></path><path d="M6 6l12 12"></path></svg>
                                Back
                            </a>
                        </span>
                    @endif
                    <span class="d-none d-sm-inline">
                        <a @if($action == $page) href="{{ route($page.'.create') }}" @else href="#" id="submit-form" @endif class="btn btn-primary btn-5 d-none d-sm-inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-checks"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M7 12l5 5l10 -10"></path><path d="M2 12l5 5m5 -5l5 -5"></path></svg>
                        @if($action == $page OR $action == 'create') Create @else Update @endif
                    </a>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>