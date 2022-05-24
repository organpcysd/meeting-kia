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
                <div class="row mt-2 mb-2">
                    @if(config('adminlte.usermenu_image'))
                        <div class="ml-1 col-sm-3 text-left">
                            <img src="@if(Auth::user()->getFirstMediaUrl('user')) {{asset(Auth::user()->getFirstMediaUrl('user'))}} @else {{asset('image/no-image.jpg')}} @endif" {{-- {{ Auth::user()->adminlte_image() }} --}}
                            class="img-circle elevation-2" width="50" height="50">
                        </div>
                    @endif
                    <div class="col-sm-8">
                        <div class="brand-text font-weight-bold {{ config('adminlte.classes_brand_text') }} @if(!config('adminlte.usermenu_image')) mt-0 @endif">
                            {{ Auth::user()->f_name }} {{ Auth::user()->l_name }}
                        </div>
                        <div class="brand-text font-weight-light {{ config('adminlte.classes_brand_text') }} @if(!config('adminlte.usermenu_image')) mt-0 @endif">
                            <i class="fa fa-fw fa-circle text-success" style="font-size: 10px;"></i> {{ Auth::user()->roles()->get()[0]->name; }}
                        </div>
                    </div>

                </div>




                {{-- Configured sidebar links --}}
                @each('adminlte::partials.sidebar.menu-item', $adminlte->menu('sidebar'), 'item')
            </ul>
        </nav>
    </div>

</aside>
