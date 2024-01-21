<x-app-layout>

    <div class="grid grid-cols-4">

        {{-- User Image --}}
        <div class="px-4 col-span-1 order-1">
            <img src="{{ $user->avatar }}" alt="User Avatar." class="rounded-full w-20 md:w-40 border border-neutral-300">
        </div>

        {{-- Username and buttons --}}
        <div class="px-4 col-span-2 md:ml-0 flex flex-col order-2 md:col-span-3">
            <div class="text-3xl mb-3">{{ $user->username }}</div>
            @if($user->id == auth()->id())
                <a href="{{ route('edit.profile', $user->username) }}" class="w-44 text-sm font-bold py-1 rounded-md text-center bg-white shadow-sm">
                    {{ __('Edit Profile') }}
                </a>
            @endif
        </div>

        {{-- User Info --}}
        <div class="text-md mt-8 px-4 col-span-3 col-start-1 order-3 md:col-start-2 md:order-4 md:mt-0">
            <p class="font-bold">{{ $user->name }}</p>
            {!! nl2br(e($user->bio)) !!}
        </div>

        {{-- User stats --}}
        <div class="col-span-4 my-5 py-2 border-y border-y-neutral-200 order-3 md:border-none md:px-4 md:col-start-2">
            <ul class="text-md flex flex-row justify-around md:justify-start md:space-x-10 md:text-xl">
                <li class="flex flex-col md:flex-row text-center">
                    <div class="md:mr-1 font-bold md:font-normal">
                        {{ $user->posts->count() }}
                    </div>
                    <span class="text-neutral-500 md:text-black">{{ __('Posts') }}</span>
                </li>
            </ul>
        </div>

    </div>

    {{-- Bottom --}}
    @if($user->posts->count() > 0 and (!$user->isPrivate or auth()->id() == $user->id))
        <div class="grid grid-cols-3 gap-1 my-5">
            @foreach($user->posts as $post)
                <a href="{{ route('post.show', $post->slug) }}" class="aspect-square block w-full">
                    <img src="/storage/{{ $post->image }}" alt="The Post Image.">
                </a>
            @endforeach
        </div>
    @else
        <div class="w-full text-center mt-20">
            @if($user->isPrivate and $user->id != auth()->id())
                {{ __('This Account is Private. Follow to see their posts.') }}
            @else
                {{ __('This user does not have any posts.') }}
            @endif
        </div>
    @endif


</x-app-layout>
