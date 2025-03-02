<section>
    <header>
        <h2 class="h3 mb-2">
            {{ __('Profile Information') }}
        </h2>

        <p class="text-muted mb-4">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="card">
        @csrf
        @method('patch')

        <div class="card-body">
            <div class="mb-3">
                <label class="form-label" for="name">{{ __('Name') }}</label>
                <input id="name" name="name" type="text" class="form-control"
                    value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                @error('name')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="email">{{ __('Email') }}</label>
                <input id="email" name="email" type="email" class="form-control"
                    value="{{ old('email', $user->email) }}" required autocomplete="username">
                @error('email')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                    <div class="mt-2">
                        <div class="alert alert-warning">
                            {{ __('Your email address is unverified.') }}

                            <button form="send-verification" class="btn btn-link p-0 m-0 align-baseline">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </div>

                        @if (session('status') === 'verification-link-sent')
                            <div class="alert alert-success mt-2">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </div>
                        @endif
                    </div>
                @endif
            </div>

            <div class="d-flex align-items-center gap-2">
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

                @if (session('status') === 'profile-updated')
                    <span x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-muted">{{ __('Saved.') }}</span>
                @endif
            </div>
        </div>
    </form>
</section>
