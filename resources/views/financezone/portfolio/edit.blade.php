<x-app-layout>
    <x-slot name="header">
        <h2>Edit Portfolio</h2>
    </x-slot>

    <div class="max-w-xl bg-surface border border-line rounded-xl p-6 sm:p-8">
        <form method="post" action="{{ route('portfolio.update', $portfolio) }}">
            @csrf
            @method('PUT')

            <x-form-text-input name="name" label="Portfolio Name" :value="$portfolio->name" required />

            <div class="flex items-center gap-4 pt-2">
                <button type="submit">Save</button>
                <a class="text-sm text-muted hover:text-fg transition-colors" href="{{ route('portfolio.index') }}">Back</a>
            </div>
        </form>
    </div>
 </x-app-layout>
