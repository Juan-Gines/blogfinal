@props(['post'])

<article class="mb-8 bg-white rounded-lg shadow-lg overflow-hidden">
    <img class="w-full h-72 object-cover object-center" src="{{ Storage::url($post->image->url) }}"
        alt="{{ $post->name }}">
    <div class="px-6 py-4">
        <h2 class="text-2xl font-bold text-gray-600">
            <a href="{{ route('posts.show', $post) }}">{{ $post->name }}</a>
        </h2>
        <div class="text-base text-gray-500 ">
            {{ $post->extract }}
        </div>
    </div>

    <div class="px-6 pt-4 pb-2">
        @foreach ($post->tags as $tag)
            <a href="{{ route('posts.tag', $tag) }}"
                class="inline-block text-sm text-gray-500 bg-yellow-500 rounded-full py-1 px-3 mr-2 ">
                {{ $tag->name }}
            </a>
        @endforeach
    </div>
</article>
