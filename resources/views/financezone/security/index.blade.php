<x-app-layout>
    <x-slot name="header">
        <h2>Securities Overview</h2>
    </x-slot>

    <div>
        @if (session('error'))
            <p class="mb-6 rounded-lg border border-red-400/40 bg-red-400/10 px-4 py-3 text-sm text-red-400">{{ session('error') }}</p>
        @endif

        <div class="mb-8 flex justify-end">
            <a class="inline-flex items-center rounded-lg bg-accent px-4 py-2 text-sm font-semibold text-ink hover:brightness-110 transition" href="{{ route('security.create') }}">Add new security</a>
        </div>

        <div class="bg-surface border border-line rounded-xl overflow-x-auto">
            <table class="!mb-0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Ticker</th>
                        <th>ISIN</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($securities as $security)
                        <tr>
                            <td class="font-medium">{{ $security->name }}</td>
                            <td class="font-mono text-sm">{{ $security->ticker }}</td>
                            <td class="font-mono text-sm text-muted">{{ $security->ISIN }}</td>
                            <td class="text-muted">{{ $security->type ?? '–' }}</td>
                            <td>
                                <form method="post" action="{{ route('security.destroy', $security) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                                <a href="{{ route('security.edit', $security) }}">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-muted">No securities yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
