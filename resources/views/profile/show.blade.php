<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl leading-tight">
                {{ __('Profiel') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Basis account info --}}
            <div class="bg-neutral-900 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold  mb-4">
                        Account
                    </h3>

                    <p class="text-sm ">
                        <span class="font-semibold">Naam:</span>
                        {{ $user->firstname }} {{ $user->middlename }} {{ $user->lastname }}
                    </p>

                    <p class="text-sm  mt-2 ">
                        <span class="font-semibold">Email:</span>
                        {{ $user->email }}
                    </p>

                    <a
                        href="{{ route('profile.edit') }}"
                        class="inline-flex items-center mt-5 px-4 py-2 bg-[#00B401] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#00B401] focus: focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition"
                    >
                        Settings
                    </a>
                </div>
            </div>

            {{-- Volgers / volgend overzicht --}}
            <div class="bg-neutral-900 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">
                        Connecties
                    </h3>

                    <div class="flex gap-8 mb-6">
                        <div>
                            <div class="text-2xl font-bold">{{ $followersCount }}</div>
                            <div class="text-xs uppercase tracking-wide">Volgers</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold">{{ $followingCount }}</div>
                            <div class="text-xs uppercase tracking-wide">Volgend</div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Volgers lijst --}}
                        <div>
                            <h4 class="font-semibold text-[#00E701] mb-2">Volgers</h4>
                            @if($followers->count())
                                <ul class="space-y-2 text-sm">
                                    @foreach($followers as $follower)
                                        <li class="flex justify-between">
                                            <span>
                                                {{ $follower->firstname }} {{ $follower->lastname }}
                                            </span>
                                            <span class="text-gray-400">
                                                {{ $follower->email }}
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-sm ">
                                    Nog geen volgers.
                                </p>
                            @endif
                        </div>

                        {{-- Volgend lijst --}}
                        <div>
                            <h4 class="font-semibold text-[#00E701] mb-2">Volgend</h4>
                            @if($following->count())
                                <ul class="space-y-2 text-sm">
                                    @foreach($following as $followed)
                                        <li class="flex justify-between">
                                            <span>
                                                {{ $followed->firstname }} {{ $followed->lastname }}
                                            </span>
                                            <span class="text-gray-400">
                                                {{ $followed->email }}
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-sm text-gray-500">
                                    Je volgt nog niemand.
                                </p>
                            @endif
                        </div>
                    </div>

                    {{-- Optioneel: link naar vrienden zoeken --}}
                    <div class="mt-6">
                        <a
                            href="{{ route('friends.index') }}"
                            class="text-sm text-[#00E701]  hover:text-[#00B401] font-medium"
                        >
                            Zoek vrienden om te volgen →
                        </a>
                    </div>
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
