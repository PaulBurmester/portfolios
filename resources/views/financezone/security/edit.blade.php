<x-app-layout>
    <x-slot name="header">
        <h2>Edit Security</h2>
    </x-slot>

    <div>
        <form method="post" action="{{ route('security.update', $security) }}">
            @csrf
            @method('PUT')

            <x-form-text-input name="name" label="Security Name" :value="$security->name" required />
            <x-form-text-input name="ticker" label="Ticker" :value="$security->ticker" required />
            <x-form-text-input name="ISIN" label="ISIN" :value="$security->ISIN" required />
            <x-form-text-input name="price" label="Current Price" type="number" step="0.01" :value="$security->price"/>
            <x-form-text-input name="type" label="Security Type" :value="$security->type"/>

            <button type="submit">Edit Security</button>
        </form>
    </div>
 </x-app-layout>