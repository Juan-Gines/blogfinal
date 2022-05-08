<x-app-layout>
    <div class="container py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-4">
            @foreach ($posts as $post)
                <article
                    class="w-full h-80 bg-cover bg-center rounded-md shadow-lg shadow-gray-600 @if ($loop->first) md:col-span-2 @endif"
                    style="background-image: url({{ Storage::url($post->image->url) }})">
                    <div class="w-full h-full px-8 flex flex-col justify-center">
                        <div class="mb-4">
                            @foreach ($post->tags as $tag)
                                <a href="{{ route('posts.tag', $tag) }}"
                                    class="inline-block px-3 h-6
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
                                            @break @endswitch   
                                        text-white rounded-full">
                                    {{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                        <h2 class="text-4xl text-white leading-8 font-bold">
                            <a href="{{ route('posts.show', $post) }}">
                                {{ $post->name }}
                            </a>
                        </h2>
                    </div>
                </article>
            @endforeach
        </div>
        <div>
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
