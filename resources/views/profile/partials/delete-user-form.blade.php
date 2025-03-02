<section class="card">
    <div class="card-header">
        <h2 class="card-title">
            {{ __('Delete Account') }}
        </h2>
        <div class="card-description text-muted">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </div>
    </div>
    <div class="card-body">
        <button class="btn btn-danger" x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">{{ __('Delete Account') }}</button>

        <div class="modal modal-blur fade" id="confirm-user-deletion" tabindex="-1" role="dialog" aria-hidden="true"
            x-show="$errors->userDeletion->isNotEmpty()">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form method="post" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('delete')

                        <div class="modal-header">
                            <h5 class="modal-title">{{ __('Are you sure you want to delete your account?') }}</h5>
                            <button type="button" class="btn-close" x-on:click="$dispatch('close')"></button>
                        </div>

                        <div class="modal-body">
                            <p class="text-muted">
                                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                            </p>

                            <div class="mb-3">
                                <label class="form-label visually-hidden" for="password">{{ __('Password') }}</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="{{ __('Password') }}">
                                @error('password', 'userDeletion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-link link-secondary" x-on:click="$dispatch('close')">
                                {{ __('Cancel') }}
                            </button>
                            <button type="submit" class="btn btn-danger ms-auto">
                                {{ __('Delete Account') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
