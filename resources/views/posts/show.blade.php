<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $post->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <p class="text-gray-600 mb-2">Posted by {{ $post->user->name }} on {{ $post->created_at->format('M d, Y') }}</p>
                        @if($post->created_at != $post->updated_at)
                            <p class="text-gray-600">Last updated on {{ $post->updated_at->format('M d, Y') }}</p>
                        @endif
                    </div>

                    <div class="prose max-w-none mb-8">
                        {!! nl2br(e($post->content)) !!}
                    </div>

                    @can('update', $post)
                        <div class="flex space-x-4">
                            <a href="{{ route('posts.edit', $post) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('posts.destroy', $post) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to delete this post?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>