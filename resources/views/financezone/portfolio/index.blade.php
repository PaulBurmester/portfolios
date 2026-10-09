<x-app-layout>
    <x-slot name="header">
        <h2>Portfolio Overview</h2>
    </x-slot>

    <div>
        <div class="mb-8 flex justify-end">
            <a class="inline-flex items-center rounded-lg bg-accent px-4 py-2 text-sm font-semibold text-ink hover:brightness-110 transition" href="{{ route('portfolio.create') }}">Add new portfolio</a>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($portfolios as $portfolio)
                <div class="flex flex-col justify-between bg-surface border border-line rounded-xl p-6 hover:border-accent-dim transition-colors">
                    <div>
                        <p class="font-mono text-xs text-muted">PORTFOLIO</p>
                        <p class="mt-2 text-xl font-semibold">{{ $portfolio->name }}</p>
                    </div>

                    <div class="mt-8 flex items-center gap-4 text-sm">
                        <a href="{{ route('holding.index', $portfolio) }}">Holdings →</a>
                        <a class="text-muted hover:text-fg transition-colors" href="{{ route('portfolio.edit', $portfolio) }}">Edit</a>
                        <form class="ms-auto" method="post" action="{{ route('portfolio.destroy', $portfolio) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-muted sm:col-span-2 lg:col-span-3">No portfolios yet.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
