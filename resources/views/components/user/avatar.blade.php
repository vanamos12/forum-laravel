{{-- @if (Laravel\Jetstream\Jetstream::managesProfilePhotos()) --}}
@isset($user)
<a  href="{{ route('profile', $user) }}" class="flex flex-col items-center text-sm transition border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300">
    <img class="object-cover w-8 h-8 rounded-full" src="{{ $user->profile_photo_url }}" alt="{{ $user->name() }}" />
    {{-- <img class="object-cover w-16 h-16 rounded" src="{{ asset('img/avatars/person1.jpg') }}" alt="Person One" /> --}}
    <span class="text-xs text-gray-500">{{ $user->name() }}</span>
</a>

@else
<span class="inline-flex rounded-md">
    <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none">
        {{ Auth::user()->name }}
    </button>
</span>
@endisset
