<div class="form-group {{ $col ?? 'col-md-4' }}">
    <label for={{ $name }}>{{ $label }}</label>
    <select id={{ $name }} class="form-control text-capitalize @error($name)
    is-invalid @enderror" name={{ $name }}>
        @foreach ($options as $option)
        <option value={{ $option['value'] }} {{ ($option['selected'] ?? '') ? 'selected' : '' }}>{{ $option['name'] }}
        </option>
        @endforeach
    </select>
</div>
