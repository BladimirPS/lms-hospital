<x-guest-layout>

    <h2 class="mb-4 text-lg font-semibold text-center" style="color: #1A3A5C;">
        Activar cuenta
    </h2>

    <p class="mb-6 text-sm text-center text-gray-600">
        Bienvenido/a <strong>{{ $user->first_name }} {{ $user->last_name }}</strong>.
        Establezca su contraseña para activar su cuenta.
    </p>

    @if($errors->any())
        <div class="p-3 mb-4 text-sm rounded-lg" style="background-color: #FEE2E2; color: #E74C3C;">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('invitation.store', $token) }}">
        @csrf

        <div class="mb-4">
            <label for="password" class="block mb-1 text-sm font-medium text-gray-700">
                Nueva contraseña
            </label>
            <input
                id="password"
                type="password"
                name="password"
                required
                placeholder="••••••••"
                class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2"
            >
        </div>

        <div class="mb-6">
            <label for="password_confirmation" class="block mb-1 text-sm font-medium text-gray-700">
                Confirmar contraseña
            </label>
            <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                required
                placeholder="••••••••"
                class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2"
            >
        </div>

        <button
            type="submit"
            class="w-full px-4 py-2 text-sm font-semibold text-white transition-colors duration-200 rounded-lg"
            style="background-color: #1A3A5C;"
            onmouseover="this.style.backgroundColor='#2E74B5'"
            onmouseout="this.style.backgroundColor='#1A3A5C'"
        >
            Activar cuenta
        </button>

    </form>

</x-guest-layout>
