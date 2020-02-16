@if (session('status'))
    <div
        class="alert @if (session('color')) alert-{{ session('color') }} @else alert-success @endif"
        role="alert"
    >
        {{ session('status') }}
    </div>
@endif
