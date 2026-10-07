<x-app-layout>
    <x-slot name="header">
        <h2>{{ $portfolio->name }}</h2>
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
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No entries</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
 </x-app-layout>