<x-app-layout>
    <x-slot name="header">
        <h2>Add Security to {{$portfolio->name}}</h2>
    </x-slot>

    <div>
        <form method="post" action="{{ route('holding.store', $portfolio) }}">
            @csrf

            <div>
                <label for="security_id">Security</label>

                <select name="security_id" id="security_id" required>
                    <option value="">Choose a Security</option>

                    @foreach ($securities as $security)
                        <option value="{{ $security->id }}"
                            @selected(old('security_id') == $security->id)>
                            {{ $security->name }} ({{ $security->ISIN }})
                        </option>
                    @endforeach
                </select>

                @error('security_id')
                    <p class="text-red-600 text-sm"> {{ $message }} </p>
                @enderror
            </div>
            <x-form-text-input name="quantity" label="Number of Shares" type="number" step="1" required />
            <x-form-text-input name="purchase_price" label="Purchase Price per share" type="number" step="0.01" required />
            <x-form-text-input name="purchase_date" label="Purchase Date" type="date" required />
            
            <button type="submit">Add to {{$portfolio->name}}</button>
        </form>
    </div>
 </x-app-layout>
