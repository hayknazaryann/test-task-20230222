@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div id="tabs">
                <h1></h1>
                <div class="tabs-content">
                    <input id="tab-data" class="tabCheckbox" type="radio" name="tabs" value="data" data-url="{{ route('json.index') }}" {{ request()->segment(1) == '' ? 'checked' : '' }}>
                    <label for="tab-data">Home</label>

                    <input id="tab-view" class="tabCheckbox" type="radio" name="tabs" value="view" disabled>
                    <label for="tab-view">View</label>

                    <input id="tab-create" class="tabCheckbox" type="radio" name="tabs" value="create" data-url="{{ route('json.create') }}" {{ request()->segment(1) == \App\Enums\Actions::CREATE ? 'checked' : '' }}>
                    <label for="tab-create">Create</label>

                    <input id="tab-update" class="tabCheckbox" type="radio" name="tabs" value="update" data-url="{{ route('json.edit') }}" {{ request()->segment(1) == \App\Enums\Actions::EDIT ? 'checked' : '' }}>
                    <label for="tab-update">Update</label>

                    <div id="content">
                        {!! $view !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection