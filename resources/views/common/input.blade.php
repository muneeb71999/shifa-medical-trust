@php
$autoFocus = $focus ?? false;
$required = $required ?? true;
$value = $value ?? null;
@endphp
<div class="form-group {{ $col ?? 'col-md-6' }}">
    <label for={{ $name }}>{{ $label }}</label>
    <input type={{ $type }} class="form-control @error($name) is-invalid @enderror" id={{ $name }} name={{ $name }}
        @if($value) value="{{ $value }}" @else value="{{ old($name) }}" @endif {{ $required ? 'required' : '' }}
        {{ $autoFocus ? 'autofocus' : '' }} maxlength={{ $maxlength ?? '255' }} />
    @error($name)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

{{--
    label
    type
    name
    autofocus : boolean default : false
    --}}
