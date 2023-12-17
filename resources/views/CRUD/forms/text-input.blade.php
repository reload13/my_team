<div class="mb-3">
    <label for="{{ $id }}" class="form-label">{{ $label }}:</label>
    <input type="text" class="form-control" id="{{ $id }}" name="{{ $name }}" value="{{ $value }}">
    <span style="color: red;" class="error-message" id={{$id."-error"}}></span>

</div>
