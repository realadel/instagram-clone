<x-app-layout>
    <div class="card p-10">
        {{-- Card Title --}}
        <h1 class="text-3xl mb-10 font-bold">{{ __('Edit post') }}</h1>
        {{-- Errors --}}
        <div class="flex flex-col justify-center items-center w-full">
            @if($errors->any())
                <div class="w-full bg-red-50 text-red-700 p-5 mb-5 rounded-xl">
                    <ul class="list-disc pl-4">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        {{-- Edit Post Form --}}
        <form action="{{ route('post.update', $post->slug) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <x-create-edit-post-form :post="$post"/>
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </form>
    </div>
</x-app-layout>
