<x-app-layout>
    <x-slot name="header">
        <h2>Portfolio Overview</h2>
    </x-slot>

    <div>
        @forelse ($portfolios as $portfolio)
            <div>
                {{ $portfolio->name }}
            </div>
        @empty
            <p>Keine Einträge.</p>
        @endforelse
        <a href="{{ route('portfolio.create') }}">Add new portfolio</a>
    </div>
 </x-app-layout>