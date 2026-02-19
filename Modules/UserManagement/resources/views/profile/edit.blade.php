@extends('usermanagement::components.layouts.master')

@section('content')
    <div class="min-h-screen bg-slate-50">
        <header class="bg-white border-b border-slate-200 shadow-sm">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
                <h1 class="text-lg font-semibold text-slate-800">{{ config('app.name') }}</h1>
                <a href="{{ route('user-management.profile.show') }}" class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition">
                    ← {{ __('Back') }}
                </a>
            </div>
        </header>

        <main class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="bg-white rounded-2xl shadow-lg shadow-slate-200/50 border border-slate-200/50 overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 bg-gradient-to-r from-slate-50 to-white">
                    <h2 class="text-xl font-bold text-slate-800">{{ __('Edit Profile') }}</h2>
                    <p class="mt-1 text-sm text-slate-500">{{ __('Update your account information') }}</p>
                </div>

                @if ($errors->any())
                    <div class="mx-6 mt-4 p-4 bg-red-50 border border-red-100 rounded-xl">
                        <ul class="text-sm text-red-600 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('user-management.profile.update') }}" class="p-6 space-y-5">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">{{ __('Name') }}</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                            class="block w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-slate-900 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition duration-150">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">{{ __('Email') }}</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                            class="block w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-slate-900 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition duration-150">
                    </div>
                    <div class="flex gap-3 pt-2">
                        <button type="submit"
                            class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-xl shadow-md shadow-indigo-500/25 transition duration-150">
                            {{ __('Save') }}
                        </button>
                        <a href="{{ route('user-management.profile.show') }}"
                            class="px-5 py-2.5 border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-medium rounded-xl transition duration-150">
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </form>
            </div>
        </main>
    </div>
@endsection
