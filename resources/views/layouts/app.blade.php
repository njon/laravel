<!DOCTYPE html>
<html lang="en">
    @include('partials.header') 
    <body>
        <div class="page">
            @include('partials.navmenu') 
            <div class="page-wrapper">
                @include('partials.page_header', ['asset' => 'user', ])

            @yield('content')
        </div>
        @include('partials.footer')
    </body>
</html>