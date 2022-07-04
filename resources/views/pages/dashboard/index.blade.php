@extends('layouts.dashboard')

@section('content')
    <section class="h-screen">
        <div class="container mx-auto flex justify-end items-center py-3 px-6">
            <a href="{{ route('dashboard.posts.create') }}" class="text-gray-900 rounded bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Post</a>
        </div>
        <div class="container mx-auto px-6 py-12 h-full">
            @forelse($posts as $post)
                @include('blog.card', ['post' => $post])
            @empty
                <p class="text-bold text-center">No posts.</p>
            @endforelse

            <!-- Pagination -->
            {{ $posts->links('pagination::tailwind') }}
        </div>
    </section>
@endsection
