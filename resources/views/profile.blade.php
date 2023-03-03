<div class="card p-4 profile">
    <div class="d-flex flex-column justify-content-center align-items-center">
        <span class="name mt-3">{{ current_user()->name }}</span>
        <span class="username">{{ current_user()->username }}</span>
        <div class=" d-flex mt-2">
            <button class="btn1 btn-dark" id="logout-btn">{{ __('Logout') }}</button>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        <div class="d-flex">
            <form id="generate-token-form" class="mt-3" action="{{ route('generate.token') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
                <div class="form-group mt-2 text-center">
                    <button type="button" class="btn1 btn-dark" id="generate-token">{{ __('Generate Token') }}</button>
                </div>

            </form>

        </div>
        <div class="mt-2 text-success" id="output">
        </div>
    </div>
</div>