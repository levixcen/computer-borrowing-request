<nav class="flex items-center justify-between flex-wrap bg-blue-500 p-6">
    <div class="flex items-center flex-shrink-0 text-white mr-6">
        <a class="flex items-center" href="{{ route('admin.home') }}">
            <img class="mr-2" src="{{ asset('assets/images/logo.png') }}" alt="Logo" width="50px">
            <span class="font-semibold text-xl tracking-tight">Computer Borrowing Request</span>
        </a>
    </div>
    <div class="block lg:hidden">
        <button class="flex items-center px-3 py-2 border rounded text-teal-200 border-teal-400 hover:text-white hover:border-white">
            <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
        </button>
    </div>
    <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
        <div class="text-sm lg:flex-grow">
            @foreach($navGroups as $navGroup)
                @foreach($navGroup->navs as $nav)
                   <a href="{{ route($nav->route) }}" class="block mt-4 lg:inline-block lg:mt-0 text-blue-200 hover:text-white mr-4">
                       {{ $nav->name }}
                   </a>
                @endforeach
            @endforeach
        </div>
        <div>
            <a href="{{ route('auth.logout') }}" class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-white-500 hover:bg-red-500 mt-4 lg:mt-0" data-method="POST" data-form-_token="{{ csrf_token() }}">Logout</a>
        </div>
    </div>
</nav>
