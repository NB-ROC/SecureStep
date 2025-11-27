<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vrienden zoeken') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    {{-- Zoekbalk --}}
                    <form method="GET" action="{{ route('friends.index') }}">
                        <div class="flex gap-2">
                            <input
                                type="text"
                                name="q"
                                value="{{ old('q', $search) }}"
                                placeholder="Zoek op naam of e-mail"
                                class="text-black placeholder-gray-400 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                            />

                            <x-primary-button type="submit">
                                {{ __('Zoeken') }}
                            </x-primary-button>
                        </div>
                    </form>

                    {{-- Resultaten --}}
                    @if($users->count() > 0)
                        <div class="mt-6 space-y-4">
                            @foreach($users as $user)
                                <div class="flex items-center justify-between border-b pb-2">
                                    <div>
                                        <div class="font-semibold">
                                            {{ $user->full_name ?? ($user->firstname . ' ' . $user->lastname) }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $user->email }}
                                        </div>
                                    </div>

                                    {{-- Hier kun je later echte "toevoegen / uitnodigen" functionaliteit aan hangen --}}
                                    <x-secondary-button>
                                        {{ __('Toevoegen') }}
                                    </x-secondary-button>
                                </div>
                            @endforeach
                        </div>
                    @elseif($search)
                        <p class="mt-6 text-sm text-gray-500">
                            Geen gebruikers gevonden voor "{{ $search }}".
                        </p>
                    @else
                        <p class="mt-6 text-sm text-gray-500">
                            Gebruik de zoekbalk hierboven om gebruikers te zoeken.
                        </p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
