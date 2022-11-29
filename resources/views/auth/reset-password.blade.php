<form method="POST" action="{{ route('password.store') }}">
    @csrf

    <!-- Password Reset Token -->
    <input type="hidden" name="token" value="{{ $token }}">

    <!-- Email Address -->
    <div>
        <label for="email">{{ __('Email') }}</label>
        <input id="email" type="email" name="email" value="{{ old('email', $email) }}" required autofocus />
        @error('mail')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <!-- Password -->
    <div class="mt-4">
        <label for="password">{{ __('Password') }}</label>
        <input id="password" class="block mt-1 w-full" type="password" name="password" required />
        @error('password')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <!-- Confirm Password -->
    <div class="mt-4">
        <label for="password_confirmation">{{ __('Confirm Password') }}</label>

        <input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required />
        @error('password_confirmation')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div class="flex items-center justify-end mt-4">
        <button type="submit">
            {{ __('Reset Password') }}
        </button>
    </div>
</form>