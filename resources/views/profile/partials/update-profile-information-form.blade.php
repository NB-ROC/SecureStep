<section>
    <header>
        <div>

        </div>
        <h2 class="text-lg font-medium text-orange-700">
            {{ __($user->name) }}
        </h2>


    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6 flex flex-col">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Voornaam')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full text-black"
                          :value="old('name', $user->firstname)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <div>
            <x-input-label for="name" :value="__('Tussen voegsel')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full text-black"
                          :value="old('name', $user->middlename)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <div>
            <x-input-label for="name" :value="__('Achternaam')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full text-black"
                          :value="old('name', $user->lastname)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <div>
            <x-input-label for="name" :value="__('Profiel foto')" />
            <div class="flex items-center">
                <img
                    src="{{ asset('storage/' . $user->profilepicture) }}"
                    alt="Profile"
                    class="mt-1 w-10 h-10 rounded-full object-cover mr-1.5"
                />
                <x-text-input id="name" name="name" type="text" class="block w-full text-black"
                              :value="old('name', $user->profilepicture)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />

            </div>
        </div>


        <div>
            <x-input-label for="name" :value="__('Telefoon nummer')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full text-black"
                          :value="old('name', $user->phonenumber)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <div>
            <x-input-label for="email" :value="__('E-mail adres')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full text-black"
                          :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2 " :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
