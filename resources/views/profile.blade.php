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
    </div>
</div>