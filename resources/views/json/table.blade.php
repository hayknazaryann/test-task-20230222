<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th scope="col" width="70%">{{ __('Code') }}</th>
            <th scope="col" width="30%" class="text-center">{{ __('Actions') }}</th>
        </tr>
        </thead>
        <tbody>
        @forelse($jsonData as $jsonItem)
            <tr>
                <td>{{ $jsonItem->code }}</td>
                <td align="center">
                    <a class="btn btn-sm btn-outline-success view-data"
                       data-url="{{route('json.show', $jsonItem->code)}}"
                       title="{{__('View')}}"
                       type="button"
                    >
                        <i class="bi bi-eye"></i>
                    </a>

                    <form method="post" action="{{ route('json.destroy', $jsonItem->code) }}" class="d-inline-block">
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
    {!! $jsonData->links('json.partials.pagination') !!}
</div>