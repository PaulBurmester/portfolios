<x-app-layout>
    <x-slot name="header">
        <h2>{{ __('Dashboard') }}</h2>
    </x-slot>

    <section class="py-8">
        <p class="font-mono text-sm text-accent">$ portfolio --summary</p>
        <h1 class="mt-4 text-4xl sm:text-6xl font-bold tracking-tight">
            Your wealth, <span class="text-accent">at a glance.</span>
        </h1>

        <div class="mt-12 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <div class="bg-surface border border-line rounded-xl p-6">
                <p class="font-mono text-xs text-muted">#1 TOTAL PROFIT</p>
                <p class="mt-3 text-3xl font-semibold tabular-nums {{ $totalProfit < 0 ? 'text-red-400' : 'text-accent' }}">
                    {{ number_format($totalProfit, 2, ',', '.') }}
                </p>
                <p class="mt-2 text-sm text-muted">Across all your portfolios</p>
            </div>

            <a href="{{ route('portfolio.index') }}" class="bg-surface border border-line rounded-xl p-6 hover:border-accent transition-colors">
                <p class="font-mono text-xs text-muted">#2 PORTFOLIOS</p>
                <p class="mt-3 text-xl font-semibold">Manage portfolios</p>
                <p class="mt-2 text-sm text-muted">Holdings, purchases and performance</p>
            </a>

            <a href="{{ route('security.index') }}" class="bg-surface border border-line rounded-xl p-6 hover:border-accent transition-colors">
                <p class="font-mono text-xs text-muted">#3 SECURITIES</p>
                <p class="mt-3 text-xl font-semibold">Browse securities</p>
                <p class="mt-2 text-sm text-muted">Shared master data for all users</p>
            </a>
        </div>
    </section>
</x-app-layout>
