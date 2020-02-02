<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $contentheader ?? '' }}</h1>
            </div>
            <div class="col-sm-6">
                @include('layouts.sections.breadcrumbs')
            </div>
        </div>
    </div>
</section>
<section class="content" style="display: none;">
    <div class="container-fluid">
        @yield('content')
    </div>
</section>
