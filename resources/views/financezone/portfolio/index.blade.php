<x-app-layout>
    <x-slot name="header">
        <h2>Portfolio Overview</h2>
    </x-slot>

    <div>
        @forelse ($portfolios as $portfolio)
            <div>
                {{ $portfolio->name }}
                <a href="{{ route('portfolio.edit', $portfolio) }}">Edit</a>
                <a href="{{ route('holding.index', $portfolio) }}">Holdings</a>
                <form method="post" action="{{ route('portfolio.destroy', $portfolio) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </div>
        @empty
            <p>Keine Einträge.</p>
        @endforelse
        <a href="{{ route('portfolio.create') }}">Add new portfolio</a>
    </div>
 </x-app-layout>