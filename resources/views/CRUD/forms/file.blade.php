<div class="mb-1">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    @if($value == false)
        <img width="30px" src={{$value}} alt={{$name}}/>
    @endif
    <br>
    <input type="file" class="form-control" value="{{ $value }}" id="{{ $name }}" name="{{ $name }}" accept="image/*">
    <span style="color: red;" class="error-message" id={{$id."-error"}}></span>

</div>
