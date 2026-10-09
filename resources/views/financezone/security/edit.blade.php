<x-app-layout>
    <x-slot name="header">
        <h2>Edit Security</h2>
    </x-slot>

    <div class="max-w-xl bg-surface border border-line rounded-xl p-6 sm:p-8">
        <form method="post" action="{{ route('security.update', $security) }}">
            @csrf
            @method('PUT')

            <x-form-text-input name="name" label="Security Name" :value="$security->name" required />
            <x-form-text-input name="ticker" label="Ticker" :value="$security->ticker" required />
            <x-form-text-input name="ISIN" label="ISIN" :value="$security->ISIN" required />
            <x-form-text-input name="price" label="Current Price" type="number" step="0.01" :value="$security->price"/>
            <x-form-text-input name="type" label="Security Type" :value="$security->type"/>

            <div class="flex items-center gap-4 pt-2">
                <button type="submit">Save</button>
                <a class="text-sm text-muted hover:text-fg transition-colors" href="{{ route('security.index') }}">Back</a>
            </div>
        </form>
    </div>
 </x-app-layout>