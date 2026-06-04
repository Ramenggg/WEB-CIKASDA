<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 leading-relaxed">
        Lupa password Anda? Tidak masalah. Masukkan alamat email admin yang terdaftar, dan sistem akan mengirimkan tautan untuk membuat password baru.
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600 bg-green-50 p-3 rounded-lg border border-green-200">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block font-medium text-sm text-gray-700">Email CIKASDA</label>
            <input id="email" class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-gray-900 px-4 py-2" 
                   type="email" name="email" :value="old('email')" required autofocus />
            @error('email')
                <span class="text-sm text-red-600 mt-2 block">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex items-center justify-between mt-4">
            <a href="{{ route('login') }}" class="text-sm text-gray-500 hover:text-gray-800 transition">
                &larr; Kembali ke Login
            </a>
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                Kirim Tautan Reset
            </button>
        </div>
    </form>
</x-guest-layout>
