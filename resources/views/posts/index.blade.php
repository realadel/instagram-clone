<x-app-layout>
    <div class="flex flex-row max-w-3xl gap-8 mx-auto">
    {{-- Left Side --}}
        <div class="w-[30rem] mx-auto lg:w-[95rem]">
            @forelse($posts as $post)
                <x-post :post="$post"/>
            @empty
                <div class="max-w-2xl gap-8 mx-auto">
                    {{ __('Start follow your friends and enjoy.') }}
                </div>
            @endforelse
        </div>
    {{-- Right Side --}}
        <div class="hidden w-[60rem] lg:flex lg:flex-col pt-4">
            <div class="flex flex-row text-sm">
                <div class="mr-5">
                    <a href="{{ auth()->user()->username }}">
                        <img src="{{ auth()->user()->avatar }}" alt="User avatar." class="border border-gray-300 rounded-full h-12 w-12">
                    </a>
                </div>
                <div class="flex flex-col">
                    <a href="/{{ auth()->user()->username }}" class="font-bold">{{ auth()->user()->username }}</a>
                    <p class="text-gray-500 text-sm">{{ auth()->user()->name }}</p>
                </div>
            </div>
            <div class="mt-5">
                <hr>
                <h3 class="text-gray-500 font-bold pt-2">Suggestions For You</h3>
                <ul>
                    @foreach($suggested_users as $suggested_user)
                        <li class="flex flex-row my-5 text-sm justify-items-center">
                            <div class="mr-5">
                                <a href="/{{ $suggested_user->username }}">
                                    <img src="{{ $suggested_user->avatar }}" alt="Suggested User Avatar." class="rounded-full h-9 w-9 border border-gray-300">
                                </a>
                            </div>
                            <div class="flex flex-col grow">
                                <a href="/{{ $suggested_user->username }}" class="font-bold">{{ $suggested_user->username }}</a>
                                <p class="text-gray-500 text-sm">{{ $suggested_user->name }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
