<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <label for="email" class="block font-medium text-sm text-gray-700">Email CIKASDA</label>
            <input id="email" class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-gray-900 px-4 py-2 bg-gray-50" 
                   type="email" name="email" :value="old('email', $request->email)" required readonly />
            @error('email')
                <span class="text-sm text-red-600 mt-2 block">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block font-medium text-sm text-gray-700">Password Baru</label>
            <input id="password" class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-gray-900 px-4 py-2" 
                   type="password" name="password" required autocomplete="new-password" />
            @error('password')
                <span class="text-sm text-red-600 mt-2 block">{{ $message }}</span>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block font-medium text-sm text-gray-700">Konfirmasi Password Baru</label>
            <input id="password_confirmation" class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-gray-900 px-4 py-2"
                   type="password" name="password_confirmation" required autocomplete="new-password" />
            @error('password_confirmation')
                <span class="text-sm text-red-600 mt-2 block">{{ $message }}</span>
            @enderror
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                Simpan Password Baru
            </button>
        </div>
    </form>
</x-guest-layout>
