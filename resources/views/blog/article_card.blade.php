<article class="flex flex-col shadow my-4 w-full">
    <!-- Article Image -->
    <a href="{{ route('blog.post', ['slug' => $post->slug]) }}" class="hover:opacity-75">
        <img src="{{ !empty($thumbnail) ? $thumbnail : 'https://via.placeholder.com/1000x300' }}">
    </a>
    <div class="bg-white flex flex-col justify-start p-6">
        <p class="text-blue-700 text-sm font-bold uppercase pb-4">{{ implode(', ', $categories) }}</p>
        <a href="{{ route('blog.post', ['slug' => $post->slug]) }}" class="text-3xl font-bold hover:text-gray-700 pb-4">{{ $post->title }}</a>
        <p class="text-sm pb-3">
            By <a href="#" class="font-semibold hover:text-gray-800">{{ optional($post->author)->name }}</a>, Published on {{ date('F jS, Y', strtotime($post->updated_at)) }}
        </p>
        <p class="pb-6">{{ Str::limit( strip_tags($post->content), 180, '...' ) }}</p>
        <a href="{{ route('blog.post', ['slug' => $post->slug]) }}" class="uppercase text-gray-800 hover:text-black">Continue Reading <i class="fas fa-arrow-right"></i></a>
    </div>
</article>
