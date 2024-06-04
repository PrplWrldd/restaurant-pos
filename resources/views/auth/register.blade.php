@extends("layouts.app")

@section("content")
    <form
        class="mx-auto flex w-96 flex-col items-center gap-2 rounded-lg border p-3"
        method="POST"
        action="{{ route("register") }}"
    >
        <h1 class="text-2xl font-black">Register</h1>
        @csrf
        <input
            id="name"
            placeholder="Name"
            type="text"
            class="form-control @error("name") is-invalid @enderror w-full rounded-lg border p-2"
            name="name"
            value="{{ old("name") }}"
            required
            autocomplete="name"
            autofocus
        />

        @error("name")
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <input
            placeholder="Email address"
            id="email"
            type="email"
            class="form-control @error("email") is-invalid @enderror w-full rounded-lg border p-2"
            name="email"
            value="{{ old("email") }}"
            required
            autocomplete="email"
        />

        @error("email")
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <input
            id="password"
            placeholder="Password"
            type="password"
            class="form-control @error("password") is-invalid @enderror w-full rounded-lg border p-2"
            name="password"
            required
            autocomplete="new-password"
        />

        @error("password")
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <input
            id="password-confirm"
            placeholder="Confirm Password"
            type="password"
            class="form-control w-full rounded-lg border p-2"
            name="password_confirmation"
            required
            autocomplete="new-password"
        />

        <button
            type="submit"
            class="w-full rounded-lg bg-orange-500 p-3 text-white hover:bg-orange-800/70"
        >
            Create account
        </button>
    </form>
@endsection
