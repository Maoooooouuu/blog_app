<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-gray-900 leading-tight animate-fade-in-down">
            {{ __('Blog Posts') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen flex items-center justify-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            @auth
                <div class="mb-8 flex justify-end">
                    <a href="{{ route('posts.create') }}" 
                       class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-3 px-6 rounded-full shadow-lg transform hover:scale-105 transition-all duration-300">
                        Create New Post
                    </a>
                </div>
            @endauth

            <div class="bg-white/80 backdrop-blur-lg overflow-hidden shadow-xl rounded-2xl border border-gray-100">
                <div class="p-8">
                    @foreach ($posts as $post)
                        <div class="mb-10 pb-8 border-b border-gray-200 animate-fade-in-up" style="animation-delay: {{ $loop->index * 0.1 }}s">
                            <h2 class="text-2xl font-bold mb-3">
                                <a href="{{ route('posts.show', $post) }}" 
                                   class="text-indigo-600 hover:text-indigo-800 transition-colors duration-200">
                                    {{ $post->title }}
                                </a>
                            </h2>
                            <p class="text-gray-600 mb-4 text-sm">
                                Posted by {{ $post->user->name }} on {{ $post->created_at->format('M d, Y') }}
                            </p>
                            <p class="text-gray-700 mb-6 leading-relaxed">{{ Str::limit($post->content, 200) }}</p>
                            <a href="{{ route('posts.show', $post) }}" 
                               class="inline-flex items-center text-indigo-600 hover:text-indigo-800 font-medium group">
                                Read more
                                <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    @endforeach

                    <div class="mt-8">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    @keyframes fade-in-down {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fade-in-up {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in-down {
        animation: fade-in-down 0.6s ease-out forwards;
    }

    .animate-fade-in-up {
        animation: fade-in-up 0.6s ease-out forwards;
    }
</style>