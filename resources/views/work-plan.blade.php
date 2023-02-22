@extends('layouts.app')
@section('content')
    <div class="table-responsive col-md-6">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th scope="col">Задача</th>
                <th scope="col">Оценка</th>
                <th scope="col">Затрачено</th>
                <th scope="col">Комментарий</th>
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
@endsection