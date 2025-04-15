<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-gray-900 leading-tight animate-fade-in-down">
            {{ $post->title }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen flex items-center justify-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="bg-white/80 backdrop-blur-lg overflow-hidden shadow-xl rounded-2xl border border-gray-100 animate-fade-in-up">
                <div class="p-8">
                    <div class="mb-8">
                        <p class="text-gray-600 text-sm mb-2 font-medium">
                            Posted by {{ $post->user->name }} on {{ $post->created_at->format('M d, Y') }}
                        </p>
                        @if($post->created_at != $post->updated_at)
                            <p class="text-gray-600 text-sm font-medium">
                                Last updated on {{ $post->updated_at->format('M d, Y') }}
                            </p>
                        @endif
                    </div>

                    <div class="prose prose-lg max-w-none mb-12 leading-relaxed text-gray-800 font-serif">
                        {!! nl2br(e($post->content)) !!}
                    </div>

                    @can('update', $post)
                        <div class="flex space-x-4">
                            <a href="{{ route('posts.edit', $post) }}" 
                               class="bg-gradient-to-r from-yellow-500 to-amber-500 hover:from-yellow-600 hover:to-amber-600 text-white font-semibold py-3 px-6 rounded-full shadow-lg transform hover:scale-105 transition-all duration-300">
                                Edit
                            </a>
                            <form id="delete-post-form-{{ $post->id }}" method="POST" action="{{ route('posts.destroy', $post) }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" 
                                        class="bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white font-semibold py-3 px-6 rounded-full shadow-lg transform hover:scale-105 transition-all duration-300"
                                        onclick="showDeleteConfirmation('delete-post-form-{{ $post->id }}')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="delete-modal" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50 animate-fade-in">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 p-6 transform animate-scale-in">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Confirm Deletion</h3>
            <p class="text-gray-600 mb-6">Are you sure you want to delete this post? This action cannot be undone.</p>
            <div class="flex justify-end space-x-3">
                <button id="cancel-delete" 
                        class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg transition-colors duration-200">
                    Cancel
                </button>
                <button id="confirm-delete" 
                        class="px-4 py-2 bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white font-semibold rounded-lg transition-all duration-200">
                    Delete
                </button>
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

    @keyframes scale-in {
        from {
            transform: scale(0.8);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    .animate-fade-in-down {
        animation: fade-in-down 0.6s ease-out forwards;
    }

    .animate-fade-in-up {
        animation: fade-in-up 0.6s ease-out forwards;
    }

    .animate-scale-in {
        animation: scale-in 0.3s ease-out forwards;
    }

    .animate-fade-in {
        animation: fade-in 0.3s ease-out forwards;
    }

    .prose {
        font-family: 'Merriweather', serif;
    }

    .prose h1, .prose h2, .prose h3, .prose h4, .prose h5, .prose h6 {
        font-family: 'Inter', sans-serif;
        color: #1f2937;
    }

    .prose p {
        margin-bottom: 1.25rem;
    }

    .prose a {
        color: #4f46e5;
        text-decoration: underline;
        transition: color 0.2s ease;
    }

    .prose a:hover {
        color: #6366f1;
    }
</style>

<script>
    function showDeleteConfirmation(formId) {
        const modal = document.getElementById('delete-modal');
        const confirmButton = document.getElementById('confirm-delete');
        const cancelButton = document.getElementById('cancel-delete');
        const form = document.getElementById(formId);

        modal.classList.remove('hidden');

        confirmButton.onclick = () => {
            form.submit();
        };

        cancelButton.onclick = () => {
            modal.classList.add('hidden');
        };

        modal.onclick = (e) => {
            if (e.target === modal) {
                modal.classList.add('hidden');
            }
        };
    }
</script>