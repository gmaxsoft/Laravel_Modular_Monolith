@extends('usermanagement::components.layouts.master')

@section('content')
    <div class="min-h-screen bg-slate-50">
        <header class="bg-white border-b border-slate-200 shadow-sm">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
                <h1 class="text-lg font-semibold text-slate-800">{{ config('app.name') }}</h1>
                <form method="POST" action="{{ route('auth.logout') }}">
                    @csrf
                    <button type="submit" class="text-sm font-medium text-slate-600 hover:text-red-600 transition">
                        {{ __('Log out') }}
                    </button>
                </form>
            </div>
        </header>

        <main class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="bg-white rounded-2xl shadow-lg shadow-slate-200/50 border border-slate-200/50 overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 bg-gradient-to-r from-slate-50 to-white">
                    <h2 class="text-xl font-bold text-slate-800">{{ __('Profile') }}</h2>
                    <p class="mt-1 text-sm text-slate-500">{{ __('Your account information') }}</p>
                </div>

                @if (session('status') === 'profile-updated')
                    <div class="mx-6 mt-4 p-4 bg-emerald-50 border border-emerald-100 rounded-xl text-sm text-emerald-700">
                        {{ __('Profile updated successfully.') }}
                    </div>
                @endif

                <div class="p-6 space-y-6">
                    <div>
                        <span class="block text-xs font-medium text-slate-400 uppercase tracking-wider mb-1">{{ __('Name') }}</span>
                        <p class="text-lg font-medium text-slate-800">{{ $user->name }}</p>
                    </div>
                    <div>
                        <span class="block text-xs font-medium text-slate-400 uppercase tracking-wider mb-1">{{ __('Email') }}</span>
                        <p class="text-lg font-medium text-slate-800">{{ $user->email }}</p>
                    </div>

                    <div class="flex flex-wrap gap-3 pt-4">
                        <a href="{{ route('user-management.profile.edit') }}"
                            class="inline-flex items-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-xl shadow-md shadow-indigo-500/25 hover:shadow-indigo-500/40 transition duration-150">
                            {{ __('Edit Profile') }}
                        </a>
                        <a href="{{ route('user-management.account-settings.show') }}"
                            class="inline-flex items-center px-5 py-2.5 border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-medium rounded-xl transition duration-150">
                            {{ __('Account Settings') }}
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
