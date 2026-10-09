<x-app-layout>
    <x-slot name="header">
        <h2>{{$portfolio->name}}</h2>
    </x-slot>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Security</th>
                        <th>Shares</th>
                        <th>Purchase Date</th>
                        <th>Purchase Price</th>
                        <th>Current Price</th>
                        <th>Profit</th>
                        <th>Actions</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @forelse ($holdings as $holding)
                        <tr>
                            <td>{{$holding->security->name}}</td>
                            <td>{{$holding->quantity}}</td>
                            <td>{{$holding->purchase_date->format('d.m.Y')}}</td>
                            <td>{{$holding->purchase_price}}</td>
                            <td>{{$holding->security->price}}</td>
                            <td>@if ($holding->profit === null)
                                    –
                                @else
                                    {{ number_format($holding->profit, 2, ',', '.') }}
                                @endif
                            </td>
                            <td>
                                <form method="post" action="{{ route('holding.destroy', [$portfolio, $holding]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                                <a href="{{ route('holding.edit', [$portfolio, $holding]) }}">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">No entries</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <a href="{{ route('holding.create', [$portfolio]) }}">Add new Holding</a>
        </div>
 </x-app-layout>