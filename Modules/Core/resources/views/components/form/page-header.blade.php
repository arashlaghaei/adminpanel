@props([
    'resource',
    'page' => null,
    'notBreadcrumbs' => false,
])

@php
    $dashboardRoute = route('core.web.admin.dashboard');

    $title = $page ? "{$page} {$resource}" : $resource;


    if ($notBreadcrumbs){
         $breadcrumbs = [
            ['label' => 'خانه', 'route' => $dashboardRoute],
        ];
    } else {
        $indexRoute = route(getNamePage('index'));
        $breadcrumbs = [
            ['label' => 'خانه', 'route' => $dashboardRoute],
            ['label' => "لیست {$resource}‌ها", 'route' => $indexRoute],
        ];
    }

    if ($page) {
        $breadcrumbs[] = ['label' => "{$page} {$resource}"];
    }
@endphp

<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0 mb-3">
                {{ $title }}
            </h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                @foreach($breadcrumbs as $index => $breadcrumb)
                    @if($index !== 0)
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                    @endif
                    <li class="breadcrumb-item text-muted">
                        @if(isset($breadcrumb['route']))
                            <a href="{{ $breadcrumb['route'] }}" class="text-muted text-hover-primary">{{ $breadcrumb['label'] }}</a>
                        @else
                            {{ $breadcrumb['label'] }}
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
