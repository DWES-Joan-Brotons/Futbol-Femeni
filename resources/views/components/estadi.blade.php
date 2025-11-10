@props(['estadi'])

<tr>
    <td>{{ $estadi['nom'] }}</td>
    <td>{{ $estadi['ciutat'] }}</td>
    <td>{{ number_format($estadi['capacitat'], 0, ',', '.') }}</td>
    <td>{{ $estadi['equip_principal'] }}</td>
</tr>