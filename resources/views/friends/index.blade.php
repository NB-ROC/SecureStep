<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Vrienden zoeken') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-neutral-900 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    {{-- Zoekbalk --}}
                    <form method="GET" action="{{ route('friends.index') }} ">
                        <div class="flex gap-2 ">
                            <input
                                id="friends-search"
                                type="text"
                                name="q"
                                value="{{ old('q', $search) }}"
                                placeholder="Zoek op naam of e-mail"
                                class="placeholder-gray-400 border-gray-300 rounded-md shadow-sm w-full h-12 pl-3"
                            />
                        </div>
                    </form>

                    {{-- Resultaten container --}}
                    <div id="friends-results" class="mt-6">
                        @include('friends._results', [
                            'users'           => $users,
                            'search'          => $search,
                            'followingIds'    => $followingIds,
                            'outgoingPending' => $outgoingPending ?? collect(),
                            'incomingPending' => $incomingPending ?? collect(),
                        ])
                    </div>

                    {{-- Live search --}}
                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
                            let friendsSearchTimer;
                            const input   = document.getElementById('friends-search');
                            const results = document.getElementById('friends-results');

                            if (!input || !results) return;

                            input.addEventListener('input', function () {
                                const query = this.value;

                                clearTimeout(friendsSearchTimer);

                                friendsSearchTimer = setTimeout(() => {
                                    const url = new URL("{{ route('friends.index') }}", window.location.origin);
                                    url.searchParams.set('q', query);

                                    fetch(url, {
                                        headers: {
                                            'X-Requested-With': 'XMLHttpRequest'
                                        }
                                    })
                                        .then(response => response.text())
                                        .then(html => {
                                            results.innerHTML = html;
                                        })
                                        .catch(err => console.error(err));
                                }, 300);
                            });
                        });
                    </script>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
