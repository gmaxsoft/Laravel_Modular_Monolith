@extends('auth::components.layouts.master')

@section('content')
    <div class="min-h-screen flex items-center justify-center p-4 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900">
        <div class="w-full max-w-md">
            <div class="bg-white rounded-2xl shadow-xl shadow-slate-900/20 p-8 border border-slate-200/50">
                <div class="text-center mb-8">
                    <h1 class="text-2xl font-bold text-slate-800 tracking-tight">{{ __('Create account') }}</h1>
                    <p class="mt-2 text-sm text-slate-500">{{ __('Get started with your free account.') }}</p>
                </div>

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-100 rounded-xl">
                        <ul class="text-sm text-red-600 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('auth.register') }}" class="space-y-5">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">{{ __('Name') }}</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                            class="block w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-slate-900 placeholder-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition duration-150">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">{{ __('Email') }}</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                            class="block w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-slate-900 placeholder-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition duration-150">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">{{ __('Password') }}</label>
                        <input type="password" name="password" id="password" required
                            class="block w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-slate-900 placeholder-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition duration-150">
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1.5">{{ __('Confirm password') }}</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            class="block w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-slate-900 placeholder-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition duration-150">
                    </div>
                    <button type="submit"
                        class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-xl shadow-lg shadow-indigo-500/25 hover:shadow-indigo-500/40 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-150">
                        {{ __('Create account') }}
                    </button>
                </form>

                <p class="mt-6 text-center text-sm text-slate-500">
                    {{ __('Already have an account?') }}
                    <a href="{{ route('auth.login') }}" class="font-medium text-indigo-600 hover:text-indigo-500 transition">
                        {{ __('Log in') }}
                    </a>
                </p>
            </div>
        </div>
    </div>
@endsection
