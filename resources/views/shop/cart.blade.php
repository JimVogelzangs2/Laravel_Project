<x-layouts.app :title="'Winkelwagen'">
    <h1>Winkelwagen</h1>
    @php
        $lines = [];
        $total = 0;
        foreach ($cart as $productId => $qty) {
            $p = $products->find($productId);
            if (!$p) continue;
            $lineTotal = $p->price * $qty;
            $total += $lineTotal;
            $lines[] = ['p' => $p, 'qty' => $qty, 'line' => $lineTotal];
        }
    @endphp

    @if (empty($lines))
        <p>Je winkelwagen is leeg.</p>
        <p><a href="{{ route('shop.index') }}" class="btn">Verder winkelen</a></p>
    @else
        <table>
            <thead>
            <tr>
                <th>Product</th>
                <th class="right">Prijs</th>
                <th class="right">Aantal</th>
                <th class="right">Totaal</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($lines as $row)
                <tr>
                    <td>{{ $row['p']->name }}</td>
                    <td class="right">€ {{ number_format($row['p']->price, 2, ',', '.') }}</td>
                    <td class="right">{{ $row['qty'] }}</td>
                    <td class="right">€ {{ number_format($row['line'], 2, ',', '.') }}</td>
                    <td>
                        <form method="post" action="{{ route('shop.cart.remove', $row['p']->id) }}">
                            @csrf
                            <button class="btn secondary" type="submit">Verwijderen</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th colspan="3" class="right">Totaal</th>
                <th class="right">€ {{ number_format($total, 2, ',', '.') }}</th>
                <th></th>
            </tr>
            </tfoot>
        </table>
        <form method="post" action="{{ route('shop.checkout') }}" style="margin-top: 12px;">
            @csrf
            <button class="btn" type="submit">Afrekenen</button>
        </form>
    @endif
</x-layouts.app>


