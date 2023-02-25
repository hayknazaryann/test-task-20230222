<div class="table-responsiv">
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th scope="col">{{ __('Code') }}</th>
            <th scope="col">{{ __('Data') }}</th>
            <th scope="col">{{ __('Actions') }}</th>
        </tr>
        </thead>
        <tbody>
        @forelse($jsonData as $jsonItem)
            <tr>
                <td>{{ $jsonItem->code }}</td>
                <td>{{ $jsonItem->data }}</td>
                <td>
                    <form method="post" action="{{ route('json-data.destroy', $item->id) }}" class="d-inline-block">
                        @method('DELETE')
                        @csrf
                        <a type="button" class="btn btn-sm btn-outline-danger delete btn-delete"
                           title="{{ __('Delete') }}"
                        >
                            <i class="bi bi-trash"></i>
                        </a>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" align="center">
                    No Data
                </td>
            </tr>
        @endforelse

        </tbody>
    </table>
</div>