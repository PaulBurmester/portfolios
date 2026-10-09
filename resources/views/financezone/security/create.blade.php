<x-app-layout>
    <x-slot name="header">
        <h2>Create a new Security</h2>
    </x-slot>

    <div class="max-w-xl bg-surface border border-line rounded-xl p-6 sm:p-8">
        <form method="post" action="{{ route('security.store') }}">
            @csrf

            <x-form-text-input name="name" label="Security Name" required />
            <x-form-text-input name="ticker" label="Ticker" required />
            <x-form-text-input name="ISIN" label="ISIN" required />
            <x-form-text-input name="price" label="Current Price" type="number" step="0.01" />
            <x-form-text-input name="type" label="Security Type" />

            <div class="flex items-center gap-4 pt-2">
                <button type="submit">Create Security</button>
                <a class="text-sm text-muted hover:text-fg transition-colors" href="{{ route('security.index') }}">Back</a>
            </div>
        </form>
    </div>
 </x-app-layout>