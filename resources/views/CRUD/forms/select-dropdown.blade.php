<div class="mb-3">
    <label for="{{ $id }}" class="form-label">{{ $label }}:</label>
    <select class="form-select" id="{{ $id }}" name="{{ $id }}">
        <option value="" selected disabled>Select {{ $label }}</option>
        @foreach($options as $optionValue => $optionLabel)
            <option value="{{ $optionValue }}" {{ (old($name) && old($name) == $optionValue) || ($value && $value == $optionValue) ? 'selected' : '' }}>{{ $optionLabel }}</option>
        @endforeach
    </select>
    <span style="color: red;" class="error-message" id={{$id."-error"}}></span>
</div>
