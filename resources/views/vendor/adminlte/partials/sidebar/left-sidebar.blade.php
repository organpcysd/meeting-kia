<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    {{-- Sidebar brand logo --}}
    @if(config('adminlte.logo_img_xl'))
        @include('adminlte::partials.common.brand-logo-xl')
    @else
        @include('adminlte::partials.common.brand-logo-xs')
    @endif


    {{-- Sidebar menu --}}
    <div class="sidebar">
        <nav class="pt-2">
            <ul class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}"
                data-widget="treeview" role="menu"
                @if(config('adminlte.sidebar_nav_animation_speed') != 300)
                    data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}"
                @endif
                @if(!config('adminlte.sidebar_nav_accordion'))
                    data-accordion="false"
                @endif>

                {{-- Profiles --}}
                @if(config('adminlte.usermenu_image'))
                    <div class="col text-center">
                        <img src="{{ Auth::user()->adminlte_image() }}" {{-- {{ Auth::user()->adminlte_image() }} --}}
                        class="img-circle elevation-2" width="50">
                @endif
                    <span class="brand-text font-weight-light {{ config('adminlte.classes_brand_text') }} @if(!config('adminlte.usermenu_image')) mt-0 @endif">
                        {{ Auth::user()->f_name }} {{ Auth::user()->l_name }}
                    </span>
                    </div>

                {{-- Configured sidebar links --}}
                @each('adminlte::partials.sidebar.menu-item', $adminlte->menu('sidebar'), 'item')
            </ul>
        </nav>
    </div>

</aside>
