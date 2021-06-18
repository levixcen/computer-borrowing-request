<div class="w-52 p-2">
    <div class="text-lg font-medium mb-2">
        Good day,
        <br />
        {{ Auth::user()->name }}
    </div>
    <div class="mt-8 mr-6">
        @unless ($title === 'Home' || $title === 'Schedules')
            <a class="border-gray-300 border-t-2 p-2 rounded hover:bg-blue-500 hover:text-white" href="{{ route('home') }}">
                <button class="w-full appearance-none">
                    <x-heroicon-o-home style="width: 20px; display: inline-block" /> Home
                </button>
            </a>
        @endunless
        @unless ($title === 'Borrowing Requests')
            <a class="border-gray-300 border-t-2 p-2 rounded hover:bg-blue-500 hover:text-white" href="{{ route('borrowing-requests.index') }}">
                <button class="w-full appearance-none">
                    <x-heroicon-o-pencil-alt style="width: 20px; display: inline-block" /> Request Computer
                </button>
            </a>
        @endunless
        <a class="border-gray-300 border-t-2 border-b-2 p-2 rounded hover:bg-red-500 hover:text-white" href="{{ route('auth.logout') }}" data-method="POST" data-form-_token="{{ csrf_token() }}">
            <button class="w-full appearance-none">
                Logout
            </button>
        </a>
    </div>
</div>
