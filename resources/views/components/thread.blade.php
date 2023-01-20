<article class="p-5 bg-white shadow">

    <div class="grid grid-cols-8 gap-2 relative">

        {{-- Avatar --}}
        <div class="col-span-1">
            <x-user.avatar :user="$thread->author()"/>
        </div>

        {{-- Content --}}
        <div class="col-span-6 space-y-4">

            <a href="{{ route('threads.show', [$thread->category->slug(), $thread->slug()]) }}" class="space-y-2">
                <h2 class="text-xl tracking-wide hover:text-blue-400">{{ $thread->title ?? 'Title' }}</h2>
                <p class="text-gray-500">
                    {{ $thread->excerpt() ?? 'Content' }}
                </p>
            </a>

            {{-- Indicators --}}
            <div class="flex space-x-6">
                
                {{-- Likes Count --}}
                <div class="flex items-center space-x-2">
                    <x-heroicon-o-heart class="w-5 h-5 text-red-300" />
                    <span class="text-xs text-gray-500">{{ count($thread->likes()) }}</span>
                </div>

                {{-- Comments Count --}}
                <div class="flex items-center space-x-2">
                   
                    <x-heroicon-o-chat-alt class="w-4 h-4 text-green-400" />
                    <span class="text-xs text-gray-500">{{ $thread->replies()->count() }}</span>
                </div>

                {{-- Views Count --}}
                <div class="flex items-center space-x-2">
                    <x-heroicon-o-eye class="w-4 h-4 text-blue-300" />
                    <span class="text-xs text-gray-500">125</span>
                </div>

                {{-- Thread Date --}}
                <div class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-xs text-gray-500">{{ $thread->diffForHumansCreatedAt() ?? '4 hours ago'}}</span>
                </div>
            </div>
        </div>

        {{-- Tags --}}
        <div class="absolute right-2">
            <div class="flex space-x-2">
                @foreach($thread->tags() as $tag)
                    <a href="{{ route('threads.tags.index', $tag->slug()) }}" class="p-1 text-xs text-white bg-green-400 rounded">
                        {{ $tag->name() }}
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Edit Button --}}
        <div class="absolute right-2 bottom-1">
            <div class="flex space-x-2">
                @can(App\Policies\ThreadPolicy::UPDATE, $thread)
                
                    <x-links.secondary href="{{ route('threads.edit', $thread->slug()) }}">Edit</x-links.secondary>
                
                @endcan

                @can(App\Policies\ThreadPolicy::DELETE, $thread)
                
                    <livewire:thread.delete :thread="$thread" :key="$thread->id()"/>
                
                @endcan
            </div>
        </div>
        
    </div>
</article>
