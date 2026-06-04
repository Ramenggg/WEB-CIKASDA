<x-guest-layout>
    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block font-medium text-sm text-gray-700">Email CIKASDA</label>
            <input id="email" class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-gray-900 px-4 py-2" 
                   type="email" name="email" :value="old('email')" required autofocus autocomplete="username" 
                   placeholder="admin@cikasdasulteng.go.id" />
            @error('email')
                <span class="text-sm text-red-600 mt-2 block">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block font-medium text-sm text-gray-700">Kata Sandi</label>
            <input id="password" class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-gray-900 px-4 py-2"
                   type="password" name="password" required autocomplete="current-password" 
                   placeholder="••••••••" />
            @error('password')
                <span class="text-sm text-red-600 mt-2 block">{{ $message }}</span>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">Ingat Saya</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-blue-600 hover:text-blue-800 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 hover:underline transition" href="{{ route('password.request') }}">
                    Lupa sandi?
                </a>
            @endif
        </div>

        <div>
            <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                Masuk Sistem
            </button>
        </div>
    </form>
</x-guest-layout>
