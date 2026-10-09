<x-app-layout>
    <x-slot name="header">
        <div class="flex items-baseline gap-4">
            <h2>{{ $portfolio->name }}</h2>
            <a class="text-sm text-muted hover:text-fg transition-colors" href="{{ route('portfolio.index') }}">← All portfolios</a>
        </div>
    </x-slot>

    <div>
        <div class="mb-8 flex justify-end">
            <a class="inline-flex items-center rounded-lg bg-accent px-4 py-2 text-sm font-semibold text-ink hover:brightness-110 transition" href="{{ route('holding.create', [$portfolio]) }}">Add new Holding</a>
        </div>

        <div class="bg-surface border border-line rounded-xl overflow-x-auto">
            <table class="!mb-0">
                <thead>
                    <tr>
                        <th>Security</th>
                        <th class="!text-right">Shares</th>
                        <th>Purchase Date</th>
                        <th class="!text-right">Purchase Price</th>
                        <th class="!text-right">Current Price</th>
                        <th class="!text-right">Profit</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($holdings as $holding)
                        <tr>
                            <td class="font-medium">{{ $holding->security->name }}</td>
                            <td class="text-right">{{ $holding->quantity }}</td>
                            <td class="text-muted">{{ $holding->purchase_date->format('d.m.Y') }}</td>
                            <td class="text-right">{{ number_format($holding->purchase_price, 2, ',', '.') }}</td>
                            <td class="text-right">
                                @if ($holding->security->price === null)
                                    <span class="text-muted">–</span>
                                @else
                                    {{ number_format($holding->security->price, 2, ',', '.') }}
                                @endif
                            </td>
                            <td class="text-right font-medium">
                                @if ($holding->profit === null)
                                    <span class="text-muted">–</span>
                                @else
                                    <span class="{{ $holding->profit < 0 ? 'text-red-400' : 'text-accent' }}">
                                        {{ number_format($holding->profit, 2, ',', '.') }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                <form method="post" action="{{ route('holding.destroy', [$portfolio, $holding]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                                <a href="{{ route('holding.edit', [$portfolio, $holding]) }}">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-muted">No entries</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
