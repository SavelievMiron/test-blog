@extends('layouts.auth')

@section('content')
    <section class="h-screen">
        <div class="container mx-auto px-6 py-12 h-full flex flex-col items-center justify-center">
            <h1 class="text-5xl text-bold text-center mb-10">
                Reset Password
            </h1>
            <div class="md:w-8/12 lg:w-5/12 mx-auto">
                <form action="{{ url('forgot-password') }}" method="POST">
                    @csrf
                    <!-- Password input -->
                    <div class="mb-6">
                        <input
                            type="email"
                            name="email"
                            class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            placeholder="Email"
                            required
                        />
                    </div>

                    <!-- Submit button -->
                    <button
                        type="submit"
                        class="inline-block px-7 py-3 bg-blue-600 text-white font-medium text-sm leading-snug uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out w-full"
                        data-mdb-ripple="true"
                        data-mdb-ripple-color="light"
                    >
                        Reset
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection
