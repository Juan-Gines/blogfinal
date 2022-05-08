<x-app-layout>
    <div class="container py-8">
        <h1 class="text-4xl font-bold text-gray-700 text-center mb-4">
            Etiqueta: {{ $tag->name }}
        </h1>
        @foreach ($posts as $post)
            <x-card-post :post="$post" />
        @endforeach
        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
