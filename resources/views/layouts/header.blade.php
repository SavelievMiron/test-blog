<!-- Top Bar Nav -->
<nav class="w-full py-4 bg-blue-800 shadow">
    <div class="w-full container mx-auto flex flex-wrap items-center justify-between">

        <nav>
            <ul class="flex items-center justify-between font-bold text-sm text-white uppercase no-underline">
                <li><a class="hover:text-gray-200 hover:underline px-4" href="/">Home</a></li>
            </ul>
        </nav>

        <div class="flex items-center text-lg no-underline text-white pr-6">
            @if(auth()->check())
                <a class="px-3" href="{{ route('dashboard') }}" title="Dashboard">Dashboard</a>
                <a class="px-3" href="{{ route('logout') }}" title="Dashboard">Log Out</a>
            @else
                <a class="px-3" href="{{ route('login') }}" title="Login">Login</a>
                <a class="px-3" href="{{ route('register') }}" title="Register">Register</a>
            @endif
        </div>
    </div>
</nav>

<!-- Text Header -->
<header class="w-full container mx-auto">
    <div class="flex flex-col items-center py-12">
        <a class="font-bold text-gray-800 uppercase hover:text-gray-700 text-5xl" href="#">
            Minimal Blog
        </a>
        <p class="text-lg text-gray-600">
            Lorem Ipsum Dolor Sit Amet
        </p>
    </div>
</header>

<!-- Topic Nav -->
@php
    use App\Models\Category;
    $categories = Category::all(['name', 'slug'])->take(8);
@endphp
<nav class="w-full py-4 border-t border-b bg-gray-100" x-data="{ open: false }">
    <div class="block sm:hidden">
        <a
            href="#"
            class="block md:hidden text-base font-bold uppercase text-center flex justify-center items-center"
            @click="open = !open"
        >
            Topics <i :class="open ? 'fa-chevron-down': 'fa-chevron-up'" class="fas ml-2"></i>
        </a>
    </div>
    <div :class="open ? 'block': 'hidden'" class="w-full flex-grow sm:flex sm:items-center sm:w-auto">
        <div class="w-full container mx-auto flex flex-col sm:flex-row items-center justify-center text-sm font-bold uppercase mt-0 px-6 py-2">
            @foreach($categories as $category)
                <a href="{{ url('/') }}" class="hover:bg-gray-400 rounded py-2 px-4 mx-2">{{ $category->name }}</a>
            @endforeach
        </div>
    </div>
</nav>
