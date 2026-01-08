@if($users->count() > 0)
    <div class="space-y-4">
        @foreach($users as $user)
            @php
                $isFollowing = in_array($user->id, $followingIds ?? []);

                // collections keyBy('requested_id') / keyBy('requester_id')
                $outgoingReq = isset($outgoingPending) ? ($outgoingPending[$user->id] ?? null) : null;
                $incomingReq = isset($incomingPending) ? ($incomingPending[$user->id] ?? null) : null;
            @endphp

            <div class=" flex items-center justify-between border-b pb-2 bg-white rounded-md p-4">
                <div>
                    <div class="font-semibold">
                        {{ $user->firstname }} {{ $user->lastname }}
                    </div>
                    <div class="text-sm text-gray-500">
                        {{ $user->email }}
                    </div>
                </div>

                @if(auth()->id() !== $user->id)

                    {{-- 1) Al following -> Ontvolgen --}}
                    @if($isFollowing)
                        <form method="POST" action="{{ route('follow.destroy', $user) }}">
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="px-4 py-2 rounded-md text-sm font-semibold border border-[#DC362E] text-[#DC362E] bg-white"
                            >
                                Ontvolgen
                            </button>
                        </form>

                        {{-- 2) Jij hebt pending gestuurd -> Ingediend (cancel) --}}
                    @elseif($outgoingReq)
                        <form method="POST" action="{{ route('followRequests.cancel', $outgoingReq) }}">
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="px-4 py-2 rounded-md text-sm font-semibold border border-[#DC362E] text-[#DC362E] bg-white"
                            >
                                Ingediend
                            </button>
                        </form>

                        {{-- 3) Zij hebben jou pending gestuurd -> accept/reject --}}
                    @elseif($incomingReq)
                        <div>
                            <form method="POST" action="{{ route('followRequests.accept', $incomingReq) }}">
                                @csrf
                                <button
                                    type="submit"
                                    class="px-4 py-2 rounded-md text-sm font-semibold bg-[#00E701] text-white"
                                >
                                    Accepteren
                                </button>
                            </form>

                            <form method="POST" action="{{ route('followRequests.reject', $incomingReq) }}" class="mt-2">
                                @csrf
                                <button
                                    type="submit"
                                    class="px-4 py-2 rounded-md text-sm font-semibold border border-[#DC362E] text-[#DC362E] bg-white"
                                >
                                    Weigeren
                                </button>
                            </form>
                        </div>

                        {{-- 4) Geen relatie -> Volgverzoek sturen --}}
                    @else
                        <form method="POST" action="{{ route('followRequests.store', $user) }}">
                            @csrf
                            <button
                                type="submit"
                                class="px-4 py-2 rounded-md text-sm font-semibold bg-[#00E701] text-white"
                            >
                                Volgen
                            </button>
                        </form>
                    @endif

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
