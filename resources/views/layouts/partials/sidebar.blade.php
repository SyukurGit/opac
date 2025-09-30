{{-- resources/views/layouts/partials/sidebar.blade.php --}}
<nav class="flex-1 p-4 space-y-2 overflow-y-auto">
    @foreach (config('admin_menu') as $menu)
        <a href="{{ route($menu['route']) }}"
           class="flex items-center px-4 py-2.5 rounded-lg transition-colors duration-200 {{ request()->routeIs($menu['route']) ? 'bg-blue-600 text-white shadow-lg' : 'hover:bg-gray-700 hover:text-white' }}">
            {!! $menu['icon'] !!}
            <span>{{ $menu['title'] }}</span>
        </a>
    @endforeach
</nav>