<x-app-layout>
    <x-slot name="header">
        <h2>Edit holding in {{$portfolio->name}}</h2>
    </x-slot>

    <div class="max-w-xl bg-surface border border-line rounded-xl p-6 sm:p-8">
        <form method="post" action="{{ route('holding.update', [$portfolio, $holding]) }}">
            @csrf
            @method('PUT')

            <div class="rounded-lg bg-raised border border-line px-4 py-3">
                <p class="font-mono text-xs text-muted">SECURITY</p>
                <p class="mt-1 font-medium">{{ $holding->security->name }} <span class="font-mono text-sm text-muted">({{ $holding->security->ISIN }})</span></p>
            </div>
            <x-form-text-input name="quantity" label="Number of Shares" type="number" step="1" :value="$holding->quantity" required />
            <x-form-text-input name="purchase_price" label="Purchase Price per share" type="number" step="0.01" :value="$holding->purchase_price" required />
            <x-form-text-input name="purchase_date" label="Purchase Date" type="date" :value="$holding->purchase_date->format('Y-m-d')" required />

            <div class="flex items-center gap-4 pt-2">
                <button type="submit">Save</button>
                <a class="text-sm text-muted hover:text-fg transition-colors" href="{{ route('holding.index', $portfolio) }}">Back</a>
            </div>
        </form>
    </div>
 </x-app-layout>
