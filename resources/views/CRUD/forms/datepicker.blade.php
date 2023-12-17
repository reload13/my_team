
<div class="mb-3">
    <label for="{{ $id }}" class="form-label">{{ $label }}:</label>
    <input type="datetime-local" class="form-control datepicker" id="{{ $id }}" name="{{ $id }}" value="{{ $value }}">
    <span style="color: red;" class="error-message" id={{$id."-error"}}></span>

</div>

@push('scripts')
    <!-- Include Bootstrap Datepicker JS and CSS files -->
    <!-- Example: -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>

    <!-- Initialize Datepicker -->
    <script>
        $(document).ready(function(){
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd H:i:s',
                autoclose: true,
                todayHighlight: true
            });
        });
    </script>
@endpush
