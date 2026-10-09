<x-app-layout>
    <x-slot name="header">
        <h2>Edit holding in {{$portfolio->name}}</h2>
    </x-slot>

    <div>
        <form method="post" action="{{ route('holding.update', [$portfolio, $holding]) }}">
            @csrf
            @method('PUT')

            <p> {{ $holding->security->name }} ({{ $holding->security->ISIN }}) </p>
            <x-form-text-input name="quantity" label="Number of Shares" type="number" step="1" :value="$holding->quantity" required />
            <x-form-text-input name="purchase_price" label="Purchase Price per share" type="number" step="0.01" :value="$holding->purchase_price" required />
            <x-form-text-input name="purchase_date" label="Purchase Date" type="date" :value="$holding->purchase_date->format('Y-m-d')" required />
            
            <button type="submit">Save</button>
        </form>
    </div>
 </x-app-layout>
