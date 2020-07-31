// Wait for the DOM to be ready
$(function() {
    // Initialize form validation on the registration form.
    $("form[name='form']").validate({
      // Specify validation rules
      rules: {
        // The key name on the left side is the name attribute
        // of an input field. Validation rules are defined
        // on the right side
        name: {
            required: true,
        },
        category_id: {
            required: true,
        },
        reference_number: {
          required: true,
        },
        buy_date: {
          required: true,
          dateISO: true
        },
        price: {
            required: true,
            number: true
          },
        source_type: {
            required: true,
          },
        source: {
            required: true,
          },
        end_warranty: {
            required: true,
            dateISO: true
          },
      },
      // Specify validation error messages
      messages: {
        name: "Please enter a name for the product",
        category_id: "Please select a category",
        reference_number: "Please enter a reference number",
        buy_date: "Please select a valid date",
        price: "Please enter a price",
        source_type: "Please select between offline / online",
        source: "Please enter the location",
        end_warranty:  "Please enter a valid end of warranty date",
        },

      // Make sure the form is submitted to the destination defined
      // in the "action" attribute of the form when valid
      submitHandler: function(form) {
        form.submit();
      }
    });
  });