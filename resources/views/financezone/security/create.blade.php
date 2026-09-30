<x-app-layout>
    <x-slot name="header">
        <h2>Create a new Security</h2>
    </x-slot>

    <div>
        <form method="post" action="{{ route('security.store') }}">
            @csrf

            <x-form-text-input name="name" label="Security Name" required />
            <x-form-text-input name="ticker" label="Ticker" required />
            <x-form-text-input name="ISIN" label="ISIN" required />
            <x-form-text-input name="price" label="Current Price" type="number" step="0.01" />
            <x-form-text-input name="type" label="Security Type" />

            <button type="submit">Create Security</button>
        </form>
    </div>
 </x-app-layout>