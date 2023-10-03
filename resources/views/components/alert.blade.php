@if (session()->has($name))
<div class="alert alert-{{ $type }}">
    {{ session()->get($name) }}
</div>
@endif