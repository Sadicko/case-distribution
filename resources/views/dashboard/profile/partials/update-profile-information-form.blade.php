<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="row">
            <div class="col-md-6 mb-4">
                <label for="username">Username <small class="text-muted">(You can not edit)</small></label>
                <input type="text" id="username" name="username" type="text" class="mt-1 block form-control"
                value="{{ old('username', $user->username) }}" readonly="readonly" disabled="" />
                <x-input-error class="mt-2 text-danger" :messages="$errors->get('username')" />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <x-input-label for="first_name" :value="__('First name')" />
                    <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block form-control"
                    :value="old('first_name', $user->first_name)" required autofocus autocomplete="first_name" />
                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('first_name')" />
                    </div>

                    <div class="col-md-6 mb-4">
                        <x-input-label for="last_name" :value="__('Last name')" />
                        <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block form-control"
                        :value="old('last_name', $user->last_name)" required autofocus autocomplete="last_name" />
                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('last_name')" />
                        </div>
                        <div class="col-md-6 mb-4">
                            <x-input-label for="phone" :value="__('Phone')" />
                            <x-text-input id="phone" name="phone" type="text" class="mt-1 block form-control"
                            :value="old('phone', $user->phone)" required autofocus autocomplete="phone" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('phone')" />
                            </div>

                            <div class="col-md-6 mb-4">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block form-control"
                                :value="old('email', $user->email)" required autocomplete="username" />
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('email')" />

                                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
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
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button class="btn btn-primary">{{ __('Save') }}</x-primary-button>

                            @if (session('status') === 'profile-updated')
                            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>
