<x-app-layout>

    <div class="grid grid-cols-4 pt-7">

        {{-- User Image --}}
        <div class="px-4 col-span-1 order-1">
            <img src="{{ $user->avatar }}" alt="User Avatar." class="rounded-full w-20 md:w-40 border border-neutral-300">
        </div>

        {{-- Username and buttons --}}
        <div class="px-4 col-span-2 md:ml-0 flex flex-col order-2 md:col-span-3">
            <div class="text-3xl mb-3">{{ $user->username }}</div>
            @if($user->id == auth()->id())
                <a href="{{ route('edit.profile', $user->username) }}" class="w-44 text-sm font-bold py-1 rounded-md text-center shadow-sm border">
                    {{ __('Edit Profile') }}
                </a>
            @elseif(auth()->user()->isThisUserInMyFollowing($user))
                <form action="{{ route('unfollow.user', $user->username) }}" method="POST">
                    @csrf
                    <button class="w-30 bg-blue-500 text-white px-6 py-1 rounded text-center self-start">{{ __('Unfollow') }}</button>
                </form>
            @elseif(auth()->user()->isFollowingRequestPending($user))
                <span class="w-30 bg-gray-500 text-white px-6 py-1 rounded text-center self-start">{{ __('Pending') }}</span>
            @else
                <form action="{{ route('follow.user', $user->username) }}" method="POST">
                    @csrf
                    <button class="w-30 bg-blue-500 text-white px-6 py-1 rounded text-center self-start">{{ __('Follow') }}</button>
                </form>
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
                <li class="flex flex-col text-center">
                    <div class="md:mr-1 font-bold md:font-normal">
                        {{ $user->posts->count() }}
                    </div>
                    <span class="text-neutral-500">{{ __('Posts') }}</span>
                </li>

                <li class="flex flex-col text-center">
                    <div class="md:mr-1 font-bold md:font-normal">
                        {{ $user->following()->wherePivot('accepted', '=', true)->count() }}
                    </div>
                    <span class="text-neutral-500">{{ __('Following') }}</span>
                </li>

                <li class="flex flex-col text-center">
                    <div class="md:mr-1 font-bold md:font-normal">
                        {{ $user->followers()->wherePivot('accepted', '=', true)->count() }}
                    </div>
                    <span class="text-neutral-500">{{ __('Followers') }}</span>
                </li>
            </ul>
        </div>

    </div>

    {{-- Bottom --}}
    @if($user->posts->count() > 0 and (!$user->isPrivate or auth()->id() == $user->id or auth()->user()->isThisUserInMyFollowing($user)))
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
