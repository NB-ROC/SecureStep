<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
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
                                id="friends-search"
                                type="text"
                                name="q"
                                value="{{ old('q', $search) }}"
                                placeholder="Zoek op naam of e-mail"
                                class="text-black placeholder-gray-400 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                            >
                        </div>
                    </form>

                    {{-- Resultaten container --}}
                    <div id="friends-results" class="mt-6">
                        @include('friends._results', [
                            'users'        => $users,
                            'search'       => $search,
                            'followingIds' => $followingIds,
                        ])
                    </div>

                    {{-- Live search + follow/unfollow --}}
                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
                            let friendsSearchTimer;
                            const input   = document.getElementById('friends-search');
                            const results = document.getElementById('friends-results');
                            const csrfTag = document.querySelector('meta[name="csrf-token"]');
                            const csrf    = csrfTag ? csrfTag.getAttribute('content') : '';

                            if (!input || !results) return;

                            // LIVE SEARCH
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

                            // FOLLOW / UNFOLLOW toggle (event delegation)
                            document.addEventListener('click', function (event) {
                                const button = event.target.closest('.follow-toggle');
                                if (!button) return;

                                const isFollowing = button.dataset.following === '1';
                                const url    = isFollowing ? button.dataset.unfollowUrl : button.dataset.followUrl;
                                const method = isFollowing ? 'DELETE' : 'POST';

                                fetch(url, {
                                    method: method,
                                    headers: {
                                        'X-CSRF-TOKEN': csrf,
                                        'X-Requested-With': 'XMLHttpRequest',
                                        'Accept': 'application/json',
                                    },
                                })
                                    .then(response => {
                                        if (!response.ok) {
                                            throw new Error('Request failed');
                                        }
                                        return response.json().catch(() => ({}));
                                    })
                                    .then(() => {
                                        const nowFollowing = !isFollowing;
                                        button.dataset.following = nowFollowing ? '1' : '0';
                                        button.textContent = nowFollowing ? 'Ontvolgen' : 'Volgen';

                                        // classes updaten
                                        button.classList.toggle('bg-indigo-600', !nowFollowing);
                                        button.classList.toggle('text-white', !nowFollowing);
                                        button.classList.toggle('border', nowFollowing);
                                        button.classList.toggle('border-indigo-500', nowFollowing);
                                        button.classList.toggle('text-indigo-600', nowFollowing);
                                        button.classList.toggle('bg-white', nowFollowing);
                                    })
                                    .catch(error => console.error(error));
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
