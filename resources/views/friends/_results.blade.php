@if($users->count() > 0)
    <div class="space-y-4">
        @foreach($users as $user)
            @php
                $isFollowing = in_array($user->id, $followingIds ?? []);
            @endphp

            <div class="flex items-center justify-between border-b pb-2 bg-white rounded-md p-4">
                <div>
                    <div class="font-semibold">
                        {{ $user->firstname }} {{ $user->lastname }}
                    </div>
                    <div class="text-sm text-gray-500">
                        {{ $user->email }}
                    </div>
                </div>

                @if(auth()->id() !== $user->id)
                    <button
                        type="button"
                        class="follow-toggle px-4 py-2 rounded-md text-sm font-semibold
                               {{ $isFollowing ? 'border border-indigo-500 text-indigo-600 bg-white' : 'bg-indigo-600 text-white' }}"
                        data-user-id="{{ $user->id }}"
                        data-following="{{ $isFollowing ? '1' : '0' }}"
                        data-follow-url="{{ route('follow.store', $user) }}"
                        data-unfollow-url="{{ route('follow.destroy', $user) }}"
                    >
                        {{ $isFollowing ? 'Ontvolgen' : 'Volgen' }}
                    </button>
                @endif
            </div>
        @endforeach
    </div>
@elseif(strlen(trim($search ?? '')) > 0)
    <p class="text-sm text-gray-500">
        Geen gebruikers gevonden voor "{{ $search }}".
    </p>
@else
    <p class="text-sm text-gray-500">
        Gebruik de zoekbalk hierboven om gebruikers te zoeken.
    </p>
@endif
