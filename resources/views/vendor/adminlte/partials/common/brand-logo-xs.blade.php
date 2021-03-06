@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@php( $dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home') )

@if (config('adminlte.use_route_url', false))
    @php( $dashboard_url = $dashboard_url ? route($dashboard_url) : '' )
@else
    @php( $dashboard_url = $dashboard_url ? url($dashboard_url) : '' )
@endif

<div style="background-color: #17a2b8;" class="text-center">
    <a href="{{ $dashboard_url }}"
        @if($layoutHelper->isLayoutTopnavEnabled())
            class="navbar-brand {{ config('adminlte.classes_brand') }}"
        @else
            class="brand-link {{ config('adminlte.classes_brand') }}"
        @endif>
                {{-- Small brand logo --}}
                {{-- <img src="{{ asset(setting('logonav')) }}"
                alt="{{ config('adminlte.logo_img_alt', 'AdminLTE') }}"
                class="{{ config('adminlte.logo_img_class', 'brand-image img-circle elevation-3') }}"
                style="opacity:.8"> --}}
                <span class="brand-text font-weight-bold text-white{{ config('adminlte.classes_brand_text') }}">
                {{-- {!! config('adminlte.logo', '<b>Admin</b>LTE') !!} --}}
                {!! setting('title') !!}
                </span>
            {{-- Brand text --}}
    </a>
</div>
