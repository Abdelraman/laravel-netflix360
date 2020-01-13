<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <div>
            <p class="app-sidebar__user-name">{{ auth()->user()->name }}</p>
            <p class="app-sidebar__user-designation">{{ implode(', ', auth()->user()->roles->pluck('name')->toArray()) }}</p>
        </div>
    </div>
    <ul class="app-menu">
        <li><a class="app-menu__item" href="{{ route('dashboard.welcome') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>

        @if (auth()->user()->hasPermission('read_categories'))
            <li><a class="app-menu__item" href="{{ route('dashboard.categories.index') }}"><i class="app-menu__icon fa fa-list"></i><span class="app-menu__label">Categories</span></a></li>
        @endif

        @if (auth()->user()->hasPermission('read_roles'))
            <li><a class="app-menu__item" href="{{ route('dashboard.movies.index') }}"><i class="app-menu__icon fa fa-play"></i><span class="app-menu__label">Movies</span></a></li>
        @endif

        @if (auth()->user()->hasPermission('read_roles'))
            <li><a class="app-menu__item" href="{{ route('dashboard.roles.index') }}"><i class="app-menu__icon fa fa-anchor"></i><span class="app-menu__label">Roles</span></a></li>
        @endif

        @if (auth()->user()->hasPermission('read_users'))
            <li><a class="app-menu__item" href="{{ route('dashboard.users.index') }}"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Users</span></a></li>
        @endif

        @if (auth()->user()->hasPermission('read_settings'))
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-gear"></i><span class="app-menu__label">Settings</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="{{ route('dashboard.settings.social_login') }}"><i class="icon fa fa-circle-o"></i> Social Login</a></li>
                    <li><a class="treeview-item" href="{{ route('dashboard.settings.social_links') }}"><i class="icon fa fa-circle-o"></i> Social Links</a></li>
                </ul>
            </li>
        @endif

        {{--<li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">UI Elements</span><i class="treeview-indicator fa fa-angle-right"></i></a>--}}
        {{--<ul class="treeview-menu">--}}
        {{--<li><a class="treeview-item" href="bootstrap-components.html"><i class="icon fa fa-circle-o"></i> Bootstrap Elements</a></li>--}}
        {{--<li><a class="treeview-item" href="https://fontawesome.com/v4.7.0/icons/" target="_blank" rel="noopener"><i class="icon fa fa-circle-o"></i> Font Icons</a></li>--}}
        {{--<li><a class="treeview-item" href="ui-cards.html"><i class="icon fa fa-circle-o"></i> Cards</a></li>--}}
        {{--<li><a class="treeview-item" href="widgets.html"><i class="icon fa fa-circle-o"></i> Widgets</a></li>--}}
        {{--</ul>--}}
        {{--</li>--}}


    </ul>
</aside>
