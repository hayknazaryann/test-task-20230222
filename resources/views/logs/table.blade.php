<div class="table-responsive">
    <table class="table table-striped table-bordered text-center">
        <thead>
        <tr>
            <th scope="col" width="13%">{{ __('Log Name') }}</th>
            <th scope="col" width="13%" class="text-center">{{ __('Description') }}</th>
            <th scope="col" width="30%" class="text-center">{{ __('Old') }}</th>
            <th scope="col" width="30%" class="text-center">{{ __('New') }}</th>
            <th scope="col" width="14%" class="text-center">{{ __('Date') }}</th>
        </tr>
        </thead>
        <tbody>
        @forelse($logs as $log)
            <tr>
                <td>{{ $log->log_name }}</td>
                <td>{{ $log->description }}</td>
                <td>{{ $log->old_value }}</td>
                <td>{{ $log->new_value }}</td>
                <td>{{ $log->created_at }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" align="center">
                    No Data
                </td>
            </tr>
        @endforelse

        </tbody>
    </table>
</div>
{!! $logs->links('json.partials.pagination') !!}
