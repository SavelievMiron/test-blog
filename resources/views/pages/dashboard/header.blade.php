<header>
    <!-- Top Nav Bar -->
    <nav class="w-full py-4 bg-blue-800 shadow">
        <div class="w-full container mx-auto flex flex-wrap items-center justify-between">
            <nav>
                <ul class="flex items-center justify-between font-bold text-sm text-white uppercase no-underline">
                    <li><a class="hover:text-gray-200 hover:underline px-4" href="/">Home</a></li>
                </ul>
            </nav>

            <div class="flex items-center text-lg no-underline text-white pr-6">
                @if(auth()->check())
                    <a class="px-3" href="/dashboard" title="Dashboard">Dashboard</a>
                    <a class="px-3" href="/logout" title="Dashboard">Log Out</a>
                @else
                    <a class="px-3" href="/login" title="Login">Login</a>
                    <a class="px-3" href="/register" title="Register">Register</a>
                @endif
            </div>
        </div>
    </nav>
</header>
