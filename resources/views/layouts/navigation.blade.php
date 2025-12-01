<nav class="bg-white border-t border-gray-200 fixed bottom-0 w-full">
    <div class="flex justify-center items-center h-16 space-x-8">
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Dashboard') }}
        </x-nav-link>

        <x-nav-link :href="route('friends.index')" :active="request()->routeIs('friends.*')">
            {{ __('Friends') }}
        </x-nav-link>

        <x-nav-link :href="route('profile.show')" :active="request()->routeIs('profile.*')">
            {{ __('Profile') }}
        </x-nav-link>
    </div>
</nav>
