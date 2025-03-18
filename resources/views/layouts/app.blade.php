<!DOCTYPE html>
<html lang="en">
    @include('partials.header') 
    <body>
        <div class="page">
            @include('partials.navmenu') 
            
            @yield('content')
        </div>
        @include('partials.footer')
    </body>
</html>