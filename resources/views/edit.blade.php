@if (Auth::check() && Auth::user()->admin)
    @if (isset($group))
        data-editable data-key="{{ $key }}" data-group="{{ $group }}"
    @else
        data-editable data-key="{{ $key }}"
    @endif
@endif
