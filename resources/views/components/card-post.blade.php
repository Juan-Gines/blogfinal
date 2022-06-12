@props(['post'])

<article class="mb-8 bg-white rounded-lg shadow-lg overflow-hidden">
    @if ($post->image)
        <img class="w-full h-72 object-cover object-center" src="{{ Storage::url($post->image->url) }}"
            alt="{{ $post->name }}">
    @else
        <img class="w-full h-72 object-cover object-center" src="{{ Storage::url('default/image.jpg') }}"
            alt="{{ $post->name }}">
    @endif
    <div class="px-6 py-4">
        <h2 class="text-2xl font-bold text-gray-600">
            <a href="{{ route('posts.show', $post) }}">{{ $post->name }}</a>
        </h2>
        <div class="text-base text-gray-500 ">
            {!! $post->extract !!}
        </div>
    </div>

    <div class="px-6 pt-4 pb-2">
        @foreach ($post->tags as $tag)
            <a href="{{ route('posts.tag', $tag) }}"
                class="inline-block text-sm text-white
                    @switch($tag->color) @case('blue')
                            bg-blue-600
                            @break
                        @case('orange')
                            bg-orange-600
                            @break
                        @case('pink')
                            bg-pink-600
                            @break
                        @case('green')
                            bg-green-600
                            @break
                        @case('red')
                            bg-red-600
                            @break
                        @case('purple')
                            bg-purple-600
                            @break
                        @case('yellow')
                            bg-yellow-600
                            @break
                        @case('gray')
                            bg-gray-600
                            @break   
                        @case('teal')
                            bg-teal-600
                            @break @endswitch   
                        rounded-full py-1 px-3 mr-2 ">
                {{ $tag->name }}
            </a>
        @endforeach
    </div>
</article>
