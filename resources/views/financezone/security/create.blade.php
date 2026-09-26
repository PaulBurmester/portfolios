<x-app-layout>
    <x-slot name="header">
        <h2>Create a new Security</h2>
    </x-slot>

    <div>
        <form method="post" action="{{ route('security.store') }}">
            @csrf

            <div>
                <label for="name">Security Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="ticker">Ticker</label>
                <input type="text" id="ticker" name="ticker" value="{{ old('ticker') }}" required>
                @error('ticker')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="ISIN">ISIN</label>
                <input type="text" id="ISIN" name="ISIN" value="{{ old('ISIN') }}" required>
                @error('ISIN')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="price">Current Price</label>
                <input type="number" step="0.01" id="price" name="price" value="{{ old('price') }}">
                @error('price')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="type">Security Type</label>
                <input type="text" id="type" name="type" value="{{ old('type') }}">
                @error('type')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <button type="submit">Create Security</button>
        </form>
    </div>
 </x-app-layout>