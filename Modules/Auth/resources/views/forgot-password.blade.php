@extends('auth::components.layouts.master')

@section('content')
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md">
            <h1 class="text-2xl font-bold mb-6">{{ __('Forgot Password') }}</h1>

            @if (session('status'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('auth.password.email') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium">{{ __('Email') }}</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div>
                    <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        {{ __('Email Password Reset Link') }}
                    </button>
                </div>
            </form>

            <p class="mt-4 text-sm">
                <a href="{{ route('auth.login') }}" class="text-blue-600 hover:underline">{{ __('Back to login') }}</a>
            </p>
        </div>
    </div>
@endsection
