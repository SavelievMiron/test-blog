<article class="flex items-start shadow my-4 h-64" data-post-id="{{ $post->id }}">
    <!-- Article Image -->
    <a href="{{ route('blog.post', ['slug' => $post->slug]) }}" class="w-2/5 h-full hover:opacity-75">
        <img class="object-cover h-full w-full" src="{{ ! empty( $thumbnail ) ? $thumbnail : 'https://via.placeholder.com/300' }}">
    </a>
    <div class="bg-white flex flex-col justify-start p-6 w-3/5 h-full relative">
        <p class="text-blue-700 text-sm font-bold uppercase pb-4">{{ implode(', ', $categories) }}</p>
        <a href="{{ route('blog.post', ['slug' => $post->slug]) }}" class="text-3xl font-bold hover:text-gray-700 pb-4">{{ $post->title }}</a>
        <p class="text-sm pb-3">
            By <a href="#" class="font-semibold hover:text-gray-800">{{ optional($post->author)->name }}</a>, Published on {{ date('F jS, Y', strtotime($post->updated_at)) }}
        </p>
        <p class="pb-6">{{ Str::limit( strip_tags($post->content), 180, '...' ) }}</p>
        <a href="{{ route('blog.post', ['slug' => $post->slug]) }}" class="uppercase text-gray-800 hover:text-black mt-auto">Continue Reading <i class="fas fa-arrow-right"></i></a>
        <div class="actions absolute top-0 right-0" data-post-id="{{ $post->id }}">
            <a href="{{ route('dashboard.posts.edit', ['post' => $post->id]) }}" class="py-2 px-3">
                <i class="fa-solid fa-pen-to-square"></i>
            </a>
            <button class="delete-post-btn py-2 px-3">
                <i class="fa-solid fa-trash-can"></i>
            </button>
        </div>
    </div>
</article>
