<form method="POST" action="{{ route('profile.update.password') }}">
    @csrf
    @method('PUT')

    <div class="card">
        <div class="card-header" id="auth_password">
            <h3 class="card-title">
                Password
            </h3>
        </div>
        <div class="card-body grid gap-5">
            <!-- Current Password -->
            <div class="w-full">
                <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                    <label class="form-label max-w-56">
                        Current Password
                    </label>
                    <input class="input" placeholder="Your current password" type="password" name="current_password" value="" required>
                    @error('current_password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- New Password -->
            <div class="w-full">
                <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                    <label class="form-label max-w-56">
                        New Password
                    </label>
                    <input class="input" placeholder="New password" type="password" name="new_password" value="" required>
                    @error('new_password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Confirm New Password -->
            <div class="w-full">
                <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                    <label class="form-label max-w-56">
                        Confirm New Password
                    </label>
                    <input class="input" placeholder="Confirm new password" type="password" name="new_password_confirmation" value="" required>
                    @error('new_password_confirmation')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Submit button -->
            <div class="flex justify-end pt-2.5">
                <button type="submit" class="btn btn-primary">
                    Reset Password
                </button>
            </div>
        </div>
    </div>
</form>
