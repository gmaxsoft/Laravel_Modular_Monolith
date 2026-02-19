@extends('usermanagement::components.layouts.master')

@section('content')
    <div class="min-h-screen p-6">
        <h1 class="text-2xl font-bold mb-6">{{ __('Account Settings') }}</h1>

        @if (session('status') === 'password-updated')
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">{{ __('Password updated successfully.') }}</div>
        @endif

        <div class="max-w-md space-y-8">
            <section>
                <h2 class="text-lg font-semibold mb-4">{{ __('Update Password') }}</h2>

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('user-management.account-settings.password') }}" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="current_password" class="block text-sm font-medium">{{ __('Current Password') }}</label>
                        <input type="password" name="current_password" id="current_password" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium">{{ __('New Password') }}</label>
                        <input type="password" name="password" id="password" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium">{{ __('Confirm Password') }}</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        {{ __('Update Password') }}
                    </button>
                </form>
            </section>

            <div>
                <a href="{{ route('user-management.profile.show') }}" class="text-blue-600 hover:underline">{{ __('Back to Profile') }}</a>
            </div>
        </div>
    </div>
@endsection
