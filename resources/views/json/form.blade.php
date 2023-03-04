<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="form-content">
            <form method="POST" id="jsonForm" name="jsonForm" class="jsonForm">
                <div class="form-row">
                    <div class="form-row-item form-floating">
                        <input type="text" class="form-control" name="token" id="token" placeholder="Token">
                        <label for="token">Token</label>
                    </div>

                    <div class="form-row-item form-floating">
                        <select class="form-control" name="method" id="method">
                            <option value=""></option>
                            <option value="post">POST</option>
                            <option value="get">GET</option>
                        </select>
                        <label for="method">Method</label>
                    </div>

                    @if($action == \App\Enums\Actions::UPDATE)
                        <div class="form-row-item form-floating">
                            <input type="text" class="form-control" name="uuid" id="uuid" placeholder="UUID">
                            <label for="code">UUID</label>
                        </div>
                    @endif

                    <div class="form-row-item form-floating">
                        <textarea name="{{ $action == \App\Enums\Actions::CREATE ? 'data' : 'code' }}" class="form-control"
                                  id="{{ $action == \App\Enums\Actions::CREATE ? 'data' : 'code' }}"
                                  rows="20" placeholder="{{ $action == \App\Enums\Actions::CREATE ? 'Data' : 'Code' }}"></textarea>
                        <label for="data">{{ $action == \App\Enums\Actions::CREATE ? 'Data' : 'Code' }}</label>
                    </div>
                    <div class="form-row-item">
                        <button type="button" id="save" class="btn btn-outline-primary text-uppercase">
                            {{ $action }}
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>