@extends("layouts.app")

@section("content")
    @if (session("status"))
        <div class="alert alert-success" role="alert">
            {{ session("status") }}
        </div>
    @endif

    <form
        method="POST"
        class="mx-auto flex w-96 flex-col gap-1 rounded-lg border p-5"
        action="{{ route("password.email") }}"
    >
        <h1 class="text-center text-2xl font-black">Reset Password</h1>
        @csrf

        <div class="row mb-3">
            <div class="col-md-6">
                <input
                    placeholder="Email Address"
                    id="email"
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
            </div>
        </div>

        <button
            type="submit"
            class="rounded-lg bg-orange-500 p-2 font-medium text-white hover:bg-orange-500/90"
        >
            Reset
        </button>
    </form>
@endsection
