$(document).ready(function() {
    $('form.ajax-form').submit(function(e) {
        e.preventDefault(); // Prevent the default form submission

        // Get the CSRF token value
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Perform AJAX request
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {
                // Handle success response (e.g., redirect, show a message)
                console.log('Form submitted successfully!', response);
            },
            error: function(error) {
                // Handle error response (e.g., display errors to the user)
                console.error('Error submitting form:', error.responseJSON);
            }
        });
    });
});
