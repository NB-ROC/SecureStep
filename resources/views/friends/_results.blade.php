@if($users->count() > 0)
    <div class="space-y-4">
        @foreach($users as $user)
            @php
                $isFollowing = in_array($user->id, $followingIds ?? []);
            @endphp

            <div class="flex items-center justify-between border border-neutral-700 bg-neutral-800 rounded-md p-4 hover:bg-neutral-700 transition">
                <div>
                    <div class="font-semibold text-white">
                        {{ $user->firstname }} {{ $user->lastname }}
                    </div>
                    <div class="text-sm text-gray-400">
                        {{ $user->email }}
                    </div>
                </div>

                @if(auth()->id() !== $user->id)
                    <button
                        type="button"
                        class="follow-toggle px-4 py-2 rounded-md text-sm font-semibold shadow-md
                               {{ $isFollowing ? 'border border-[#DC362E] text-[#DC362E] bg-neutral-900 ' : 'bg-[#00E701] text-black ' }}"
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
    <p class="text-sm text-gray-400">
        Geen gebruikers gevonden voor "{{ $search }}".
    </p>
@else
    <p class="text-sm text-gray-400">
        Gebruik de zoekbalk hierboven om gebruikers te zoeken.
    </p>
@endif
