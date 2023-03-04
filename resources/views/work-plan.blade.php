@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="table-responsive col-md-8">
                <table class="table table-striped table-bordered table-light">
                    <thead>
                    <tr>
                        <th scope="col">{{ __('Task') }}</th>
                        <th scope="col">{{ __('Estimate') }}</th>
                        <th scope="col">{{ __('Logged') }}</th>
                        <th scope="col">{{ __('Comments') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($tasks as $task)
                        <tr>
                            <td>{{ $task['task'] }}</td>
                            <td>{{ $task['estimate'] }}</td>
                            <td>{{ $task['logged'] }}</td>
                            <td>{{ $task['comments'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" align="center">
                                No Data
                            </td>
                        </tr>
                    @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection