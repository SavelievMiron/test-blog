@extends('layouts.dashboard')

@section('content')
    <section class="h-screen">
        <div class="container mx-auto px-6 py-12 h-full">
            @foreach($posts as $post)
                @include('blog.card', ['post' => $post])
            @endforeach

            <!-- Pagination -->
            <div class="py-8 flex items-center justify-center">
                <a href="#" class="h-10 w-10 bg-blue-800 hover:bg-blue-600 font-semibold text-white text-sm flex items-center justify-center">1</a>
                <a href="#" class="h-10 w-10 font-semibold text-gray-800 hover:bg-blue-600 hover:text-white text-sm flex items-center justify-center">2</a>
                <a href="#" class="h-10 w-10 font-semibold text-gray-800 hover:text-gray-900 text-sm flex items-center justify-center ml-3">Next <i class="fas fa-arrow-right ml-2"></i></a>
            </div>
        </div>
    </section>
@endsection
