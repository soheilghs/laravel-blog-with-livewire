<x-guest-layout>

    <div class="ml-4 mr-2 mt-5">
        <h1>
            {{ $post->title }}
        </h1>

        <h3 class="mt-3">
            <img src="{{ asset("uploads/posts/{$post->image}") }}" alt="Post Image"
                 style="min-height: 200px; max-height: 360px;">
        </h3>

        <div class="mt-5">
            {!! $post->body !!}
        </div>

        <div class="mt-5 mb-4">
            Category :
            {{ $post->category->title }} -
            Posted At :
            {{ $post->created_at }}
        </div>
    </div>

</x-guest-layout>
