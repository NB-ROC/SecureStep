<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight bg">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class=" max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-neutral-900 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 ">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class=" max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-neutral-900 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 ">
                    <h1>map</h1>
                </div>
            </div>
        </div>
    </div>
    <x-footer-nav
        left-label="Dashboard"
        left-link="/dashboard"
        center-label="SOS"
        right-label="Profile"
        right-link="/profile"
        secondary-label="Map"
        secondary-link="/"
        aux-label="Friends"
        aux-link="/friends"
    />

</x-app-layout>
