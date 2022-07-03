@extends('layouts.app')

@section('content')
    <section class="h-screen">
        <div class="container mx-auto px-6 py-12 h-full">
            <h1 class="text-5xl text-bold text-center mb-10">
                Registration
            </h1>
            <div class="md:w-8/12 lg:w-5/12 mx-auto">
                <form action="{{ url('/register') }}" method="POST">
                    @csrf
                    <!-- Username input -->
                    <div class="mb-6">
                        <input
                            type="text"
                            name="name"
                            class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            placeholder="Username"
                            required
                        />
                    </div>

                    <!-- Email input -->
                    <div class="mb-6">
                        <input
                            type="email"
                            name="email"
                            class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            placeholder="Email address"
                            required
                        />
                    </div>

                    <!-- Password input -->
                    <div class="mb-6">
                        <input
                            type="password"
                            name="password"
                            class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            placeholder="Password"
                            required
                        />
                    </div>

                    <!-- Password Confirmation input -->
                    <div class="mb-6">
                        <input
                            type="password"
                            name="password_confirmation"
                            class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            placeholder="Password"
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
                        Register
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection
