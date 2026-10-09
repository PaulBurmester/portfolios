<x-app-layout>
    <x-slot name="header">
        <h2>Edit Portfolio</h2>
    </x-slot>

    <div>
        <form method="post" action="{{ route('portfolio.update', $portfolio) }}">
            @csrf
            @method('PUT')

            <x-form-text-input name="name" label="Portfolio Name" :value="$portfolio->name" required />

            <button type="submit">Save</button>
        </form>
        <a href="{{ route('portfolio.index') }}">Back</a>
    </div>
 </x-app-layout>
