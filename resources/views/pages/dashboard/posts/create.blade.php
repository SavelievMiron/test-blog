@extends('layouts.dashboard')

@section('content')
    <section class="h-screen">
        <div class="container mx-auto px-6 py-12 h-full flex flex-col items-center justify-center">
            <h1 class="text-5xl text-bold text-center mb-10">
                Create Post
            </h1>
            <div class="md:w-8/12 lg:w-5/12 mx-auto">
                <form action="{{ route('dashboard.posts.create') }}" method="POST">
                    @csrf
                    <!-- Title input -->
                    <div class="mb-6">
                        <input
                            type="text"
                            name="title"
                            class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            placeholder="Title"
                            required
                        />
                    </div>

                    <!-- Slug input -->
                    <div class="mb-6">
                        <input
                            type="text"
                            name="slug"
                            class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            placeholder="Slug"
                            required
                        />
                    </div>

                    <!-- Content input -->
                    <div class="mb-6">
                        <textarea
                            id="quill-editor"
                            name="content"
                            class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            placeholder="Content"
                            required></textarea>
                    </div>

                    <!-- Categories select -->
                    <div class="mb-6">
                        <select name="categories[]" id="categories" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">None</option>
                            @foreach(\App\Models\Category::all(['id', 'name']) as $category)
                                <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-6">
                        <input class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="file_input" type="file">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG or GIF (MAX. 800x400px).</p>
                    </div>

                    <!-- Submit button -->
                    <button
                        type="submit"
                        class="inline-block px-7 py-3 bg-blue-600 text-white font-medium text-sm leading-snug uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out w-full"
                        data-mdb-ripple="true"
                        data-mdb-ripple-color="light"
                    >
                        Create
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection
