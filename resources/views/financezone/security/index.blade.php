<x-app-layout>
    <x-slot name="header">
        <h2>Securities Overview</h2>
    </x-slot>

    <div>
        @forelse ($securities as $security)
            <p>{{ $security->name }}</p>
        @empty
            <p>Keine Einträge.</p>
        @endforelse
    </div>
 </x-app-layout>