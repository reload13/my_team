<div class="mb-3">
    <label for="{{ $id }}" class="form-label">{{ $label }}:</label>
    <textarea class="form-control" id="{{ $id }}" name="{{ $name }}" rows="{{ $rows }}" >{{ $value }}</textarea>
    <span style="color: red;" class="error-message" id={{$id."-error"}}></span>

</div>
