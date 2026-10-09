<x-app-layout>
    <x-slot name="header">
        <h2>Create a new Portfolio</h2>
    </x-slot>

    <div>
        <form method="post" action="{{ route('portfolio.store') }}">
            @csrf

            <x-form-text-input name="name" label="Portfolio Name" required />

            <button type="submit">Create Portfolio</button>
        </form>
        <a href="{{ route('portfolio.index') }}">Back</a>
    </div>
 </x-app-layout>
