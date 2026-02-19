@extends('auth::components.layouts.master')

@section('content')
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md">
            <h1 class="text-2xl font-bold mb-6">{{ __('Register') }}</h1>

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('auth.register') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium">{{ __('Name') }}</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium">{{ __('Email') }}</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium">{{ __('Password') }}</label>
                    <input type="password" name="password" id="password" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium">{{ __('Confirm Password') }}</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div>
                    <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>

            <p class="mt-4 text-sm">
                {{ __('Already have an account?') }} <a href="{{ route('auth.login') }}" class="text-blue-600 hover:underline">{{ __('Log in') }}</a>
            </p>
        </div>
    </div>
@endsection
