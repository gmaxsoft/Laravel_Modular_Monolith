@extends('usermanagement::components.layouts.master')

@section('content')
    <div class="min-h-screen p-6">
        <h1 class="text-2xl font-bold mb-6">{{ __('Edit Profile') }}</h1>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('user-management.profile.update') }}" class="max-w-md space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label for="name" class="block text-sm font-medium">{{ __('Name') }}</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div>
                <label for="email" class="block text-sm font-medium">{{ __('Email') }}</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div class="flex gap-4">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    {{ __('Save') }}
                </button>
                <a href="{{ route('user-management.profile.show') }}" class="px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-50">
                    {{ __('Cancel') }}
                </a>
            </div>
        </form>
    </div>
@endsection
