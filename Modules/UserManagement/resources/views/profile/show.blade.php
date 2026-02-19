@extends('usermanagement::components.layouts.master')

@section('content')
    <div class="min-h-screen p-6">
        <h1 class="text-2xl font-bold mb-6">{{ __('Profile') }}</h1>

        @if (session('status') === 'profile-updated')
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">{{ __('Profile updated successfully.') }}</div>
        @endif

        <div class="space-y-4 max-w-md">
            <div>
                <span class="text-sm font-medium text-gray-500">{{ __('Name') }}</span>
                <p class="text-lg">{{ $user->name }}</p>
            </div>
            <div>
                <span class="text-sm font-medium text-gray-500">{{ __('Email') }}</span>
                <p class="text-lg">{{ $user->email }}</p>
            </div>
            <div class="flex gap-4 mt-6">
                <a href="{{ route('user-management.profile.edit') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    {{ __('Edit Profile') }}
                </a>
                <a href="{{ route('user-management.account-settings.show') }}" class="px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-50">
                    {{ __('Account Settings') }}
                </a>
                <form method="POST" action="{{ route('auth.logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 text-red-600 hover:underline">{{ __('Log out') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
