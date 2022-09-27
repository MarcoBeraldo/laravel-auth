@if (session('message'))
    <div class="text-center alert alert-{{ session('type') ?? 'info' }}">
        {{ session('message') }}
    </div>
@endif
