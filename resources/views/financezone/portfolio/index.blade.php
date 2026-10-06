<x-app-layout>
    <x-slot name="header">
        <h2>Portfolio Overview</h2>
    </x-slot>

    <div>
        @forelse ($portfolios as $portfolio)
            <div>
                {{ $portfolio->name }}
                    @csrf
                </form>
            </div>
        @empty
            <p>Keine Einträge.</p>
        @endforelse
    </div>
 </x-app-layout>