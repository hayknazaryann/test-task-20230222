@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="table-responsive col-md-8">
                <table class="table table-striped table-primary table-sm">
                    <thead>
                    <tr>
                        <th scope="col">{{ __('Задача') }}</th>
                        <th scope="col">{{ __('Оценка') }}</th>
                        <th scope="col">{{ __('Затрачено') }}</th>
                        <th scope="col">{{ __('Комментарий') }}</th>
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