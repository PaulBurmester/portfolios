<x-app-layout>
    <x-slot name="header">
        <h2>Securities Overview</h2>
    </x-slot>

    <div>
        @if (session('error'))
            <p class="text-red-600 text-sm">{{ session('error') }}</p>
        @endif
        @forelse ($securities as $security)
            <div>
                {{ $security->name }}
                <a href="{{ route('security.edit', $security) }}">Edit</a>
                <form method="post" action="{{ route('security.destroy', $security) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </div>
        @empty
            <p>Keine Einträge.</p>
        @endforelse
    </div>
 </x-app-layout>