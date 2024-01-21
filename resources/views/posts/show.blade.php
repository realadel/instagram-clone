<x-app-layout>

    <div class="h-screen md:flex md:flex-row">

    {{--Left Side--}}
        <div class="h-full md:w-7/12 bg-black flex items-center">
            <img src="/storage/{{ $post->image }}" alt="{{ $post->description }}" class="max-h-screen object-cover mx-auto">
        </div>

    {{--Right Side--}}
        <div class="flex w-full flex-col bg-white md:w-5/12">
            {{-- Top --}}
            <div class="border-b-2">
                <div class="flex items-center p-5">
                    <img src="{{ $post->owner->avatar }}" class="mr-5 h-10 w-10 rounded-full" alt="User avatar">
                    <div class="grow">
                        <a href="/{{ $post->owner->username }}" class="font-bold">{{ $post->owner->username }}</a>
                        {{ $post->description }}
                    </div>
                    @if($post->owner->id === auth()->id())
                        <a href="{{ route('post.edit', $post->slug) }}">
                            <i class='bx bx-message-square-edit text-xl mx-1'></i>
                        </a>
                        <form action="{{ route('post.destroy', $post->slug) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure? the post will be deleted forever.')">
                                <i class='bx bx-trash text-xl mx-1 text-red-500'></i>
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            {{-- Comments --}}
            <div class="grow">
                @foreach($post->comments as $comment)
                    <div class="flex items-start px-5 py-2">
                        <img src="{{ $comment->owner->avatar }}" class="h-10 mr-5 w-10 rounded-full" alt="Comment owner avatar">
                        <div class="flex flex-col">
                            <div>
                                <a href="/{{ $comment->owner->username }}" class="font-bold">{{ $comment->owner->username }}</a>
                                {{ $comment->body }}
                            </div>
                            <div class="mt-1 text-sm font-bold text-gray-400">
                                {{ $comment->created_at->shortAbsoluteDiffForHumans() }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="border-t-2 p-5">
                <form action="{{ route('comment.store', $post->slug) }}" method="POST">
                    @csrf
                    <div class="flex flex-row">
                        <textarea name="body" placeholder="Add a comment" class="h-5 grow resize-none overflow-hidden border-none bg-none p-0 placeholder-gray-400 outline-0 focus:ring-0"></textarea>
                        <button type="submit" class="ml-5 border-none bg-white text-blue-500">{{ __('POST') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
