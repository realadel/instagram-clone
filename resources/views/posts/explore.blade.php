<x-app-layout>
    <div class="grid grid-cols-3 gap-1 md:gap-5 mt-8">
        @foreach($posts as $post)
            <div>
                {{ $post->slug }}
                <a href="/p/{{ $post->slug }}">
                    <img src="/storage/{{ $post->image }}" alt="Post image." class="w-full aspect-square object-cover">
                </a>
            </div>
        @endforeach
    </div>
    <div class="my-2">
        {{ $posts->links() }}
    </div>
</x-app-layout>
