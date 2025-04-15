<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blog Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @auth
                <div class="mb-6">
                    <a href="{{ route('posts.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Create New Post
                    </a>
                </div>
            @endauth

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @foreach ($posts as $post)
                        <div class="mb-8 pb-6 border-b border-gray-200">
                            <h2 class="text-2xl font-bold mb-2">
                                <a href="{{ route('posts.show', $post) }}" class="text-blue-600 hover:text-blue-800">
                                    {{ $post->title }}
                                </a>
                            </h2>
                            <p class="text-gray-600 mb-4">Posted by {{ $post->user->name }} on {{ $post->created_at->format('M d, Y') }}</p>
                            <p class="text-gray-800 mb-4">{{ Str::limit($post->content, 200) }}</p>
                            <a href="{{ route('posts.show', $post) }}" class="text-blue-600 hover:text-blue-800">Read more...</a>
                        </div>
                    @endforeach

                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>