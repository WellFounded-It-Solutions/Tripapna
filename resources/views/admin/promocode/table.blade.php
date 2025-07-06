@foreach ($promocodes as $promocode)
    <tr>
        <td>{{ $promocode->promo_code }}</td>
        <td>{{ $promocode->discount }}</td>
        <td>
            <button class="btn btn-danger btn-sm" onclick="deleteRecord({{ $promocode->id }})" data-toggle="tooltip" title="Delete">
                <i class="fas fa-trash"></i>
            </button>
        </td>
    </tr>
@endforeach