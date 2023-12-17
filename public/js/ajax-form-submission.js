
$(document).ready(function() {
    $('form.ajax-form').submit(function(e) {
        e.preventDefault(); // Prevent the default form submission

        // Get the CSRF token value
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        var resource_id = $('#resource_id').val()
console.log("jere",$(this).attr('action'),$(this).attr('method'),$(this).serialize(),resource_id)
        // Perform AJAX request
        if(resource_id){
            $.ajax({
                url: "/" + $(this).attr('action')+"/"+resource_id,
                type: $(this).attr('method'),
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function (response) {
                    // Handle success response (e.g., redirect, show a message)
                    console.log('Form submitted successfully!', response);
                    toastr.options =
                        {
                            // "closeButton" : true,
                            // "progressBar" : true
                        }
                    console.log(response.message, 'Miracle Max Says');
                    toastr.success(response.message);
                },
                error: function (error) {
                    // Handle error response (e.g., display errors to the user)
                    console.error('Error submitting form:', error.responseJSON);

                    $('.error-message').text('');

                    // Display validation errors in the form
                    if (error.responseJSON.errors) {
                        $.each(error.responseJSON.errors, function (field, errors) {
                            // Display the first error for each field
                            console.log(field, errors)
                            $('#' + field + '-error').text(errors[0]);
                        });
                    }
                }
            });
        }else {
            $.ajax({
                url: "/" + $(this).attr('action'),
                type: $(this).attr('method'),
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function (response) {
                    // Handle success response (e.g., redirect, show a message)
                    console.log('Form submitted successfully!', response);
                    toastr.options =
                        {
                            // "closeButton" : true,
                            // "progressBar" : true
                        }
                    console.log(response.message, 'Miracle Max Says');
                    toastr.success(response.message);
                },
                error: function (error) {
                    // Handle error response (e.g., display errors to the user)
                    console.error('Error submitting form:', error.responseJSON);

                    $('.error-message').text('');

                    // Display validation errors in the form
                    if (error.responseJSON.errors) {
                        $.each(error.responseJSON.errors, function (field, errors) {
                            // Display the first error for each field
                            console.log(field, errors)
                            $('#' + field + '-error').text(errors[0]);
                        });
                    }
                }
            });
        }
    });
});

