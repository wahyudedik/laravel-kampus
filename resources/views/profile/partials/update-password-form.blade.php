<section>
    <header>
        <h2 class="h3 mb-2">
            {{ __('Update Password') }}
        </h2>

        <p class="text-muted mb-4">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="card">
        @csrf
        @method('put')

        <div class="card-body">
            <div class="mb-3">
                <label class="form-label" for="update_password_current_password">{{ __('Current Password') }}</label>
                <input type="password" class="form-control" id="update_password_current_password" name="current_password" autocomplete="current-password">
                @error('current_password', 'updatePassword')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="update_password_password">{{ __('New Password') }}</label>
                <input type="password" class="form-control" id="update_password_password" name="password" autocomplete="new-password">
                @error('password', 'updatePassword')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="update_password_password_confirmation">{{ __('Confirm Password') }}</label>
                <input type="password" class="form-control" id="update_password_password_confirmation" name="password_confirmation" autocomplete="new-password">
                @error('password_confirmation', 'updatePassword')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex align-items-center gap-2">
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

                @if (session('status') === 'password-updated')
                    <span 
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-muted"
                    >{{ __('Saved.') }}</span>
                @endif
            </div>
        </div>
    </form>
</section>
</section>
