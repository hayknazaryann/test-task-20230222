<div class="form-content">
    <form method="POST" id="jsonForm" name="jsonForm" class="jsonForm">
        <div class="form-row">
            <div class="form-row-item">
                <input type="text" class="form-control" name="token" id="token" placeholder="Token">
            </div>

            <div class="form-row-item">
                <select class="form-control" name="method" id="method">
                    <option value="post">POST</option>
                    <option value="get">GET</option>
                </select>
            </div>

            @if($action == \App\Enums\Actions::EDIT)
                <div class="form-row-item">
                    <input type="text" class="form-control" name="code" id="code" placeholder="Code">
                </div>
            @endif


            <div class="col-md-12">
                <div class="form-group">
                    <textarea name="message" class="form-control" id="message" cols="30" rows="8" placeholder="JSON"></textarea>
                </div>
            </div>
            <div class="form-row-item">
                <button type="button" class="btn btn-outline-primary text-uppercase">
                    {{ $action }}
                </button>
            </div>
        </div>
    </form>
</div>
