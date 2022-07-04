@extends('layouts.auth')

@section('content')
    <section class="h-screen">
        <div class="container mx-auto px-6 py-12 h-full flex flex-col items-center justify-center">
            <h1 class="text-5xl text-bold text-center mb-10">
                Registration
            </h1>
            <div class="md:w-8/12 lg:w-5/12 mx-auto">
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <!-- Username input -->
                    <div class="mb-6">
                        <input
                            type="text"
                            name="name"
                            class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            placeholder="Username"
                            value="{{ old('name') }}"
                            required
                        />
                        @if ($errors->has('name'))
                            <span class="text-red-600 text-left">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <!-- Email input -->
                    <div class="mb-6">
                        <input
                            type="email"
                            name="email"
                            class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            placeholder="Email address"
                            value="{{ old('email') }}"
                            required
                        />
                        @if ($errors->has('email'))
                            <span class="text-red-600 text-left">{{ $errors->first('email') }}</span>
                        @endif
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
                        @if ($errors->has('password'))
                            <span class="text-red-600 text-left">{{ $errors->first('password') }}</span>
                        @endif
                    </div>

                    <!-- Password Confirmation input -->
                    <div class="mb-6">
                        <input
                            type="password"
                            name="password_confirmation"
                            class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            placeholder="Repeat Password"
                            required
                        />
                        @if ($errors->has('password_confirmation'))
                            <span class="text-red-600 text-left">{{ $errors->first('password_confirmation') }}</span>
                        @endif
                    </div>

                    @if ($errors->has('error'))
                        <div class="flex justify-between items-center px-3 py-3 mb-6 border-2 border-red-600 rounded">
                            <span class="text-red-600 text-left">{{ $errors->first('error') }}</span>
                        </div>
                    @endif

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
