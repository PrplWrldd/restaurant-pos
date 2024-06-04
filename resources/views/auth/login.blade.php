@extends("layouts.app")

@section("content")
    <div class="mx-auto w-96 rounded-lg border p-5">
        <h1 class="text-center text-2xl font-black">
            {{ __("Login") }}
        </h1>

        <form
            class="flex flex-col items-center gap-2 p-2"
            action="{{ route("login") }}"
            method="POST"
        >
            @csrf

            <input
                id="email"
                placeholder="Email address"
                type="email"
                class="form-control @error("email") is-invalid @enderror w-full rounded-lg border p-2"
                name="email"
                value="{{ old("email") }}"
                required
                autocomplete="email"
                autofocus
            />

            @error("email")
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <input
                placeholder="Password"
                id="password"
                type="password"
                class="form-control @error("password") is-invalid @enderror w-full rounded-lg border p-2"
                name="password"
                required
                autocomplete="current-password"
            />

            @error("password")
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <div class="flex items-center justify-between gap-x-10">
                <div class="flex gap-1">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="remember"
                        id="remember"
                        {{ old("remember") ? "checked" : "" }}
                    />

                    <label class="text-start" for="remember">
                        {{ __("Remember Me") }}
                    </label>
                </div>
                @if (Route::has("password.request"))
                    <a
                        class="text-sm italic text-blue-800 underline"
                        href="{{ route("password.request") }}"
                    >
                        {{ __("Forgot Your Password?") }}
                    </a>
                @endif
            </div>

            <button
                type="submit"
                class="w-full rounded-lg bg-orange-500 p-2 text-white hover:bg-orange-500/70"
            >
                {{ __("Login") }}
            </button>

            @if (Route::has("register"))
                <div class="flex items-center gap-1">
                    <p>Don't have an account?</p>
                    <a
                        class="italic text-blue-800 underline"
                        href="{{ route("register") }}"
                    >
                        {{ __("Register") }}
                    </a>
                </div>
            @endif
        </form>
    </div>
@endsection
