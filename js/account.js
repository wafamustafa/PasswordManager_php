window.onload = function () {

    // Get the form handle.
    const accountForm = document.forms.accountForm;

    // Set up an array of form field names. These can be used as keys in objects later.
    const formFieldNames = [ "first_name", "last_name", "user_name", "email", "login_password", "password2" ];

    // Create objects to hold the form input names and the error divs. Use the input names as keys.
    const formFields = {};
    const errorDivs = {};

    // Input element border properties when not highlighted for error.
    let formFieldBorder = "2px inset #EBE9ED"; 

    // Cycle through the form field names array. 
    for( let i = 0; i < formFieldNames.length; i++ ) {
        const fieldName = formFieldNames[i];
        const divName = fieldName + "Error";

        // Get the error div for this input field and add it to the object created above.
        errorDivs[ fieldName ] = document.getElementById( divName );

        // Get the input element and set its on click function.
        const formField = document.getElementById( fieldName );

        if( formField == null ) {
            continue;
        }
        formField.onclick = function() {
            formField.style.border = formFieldBorder;
            const errorDiv = errorDivs[fieldName];
            errorDiv.style.display = "none";
        };

        // Add it to the object created above.
        formFields[ fieldName ] = formField;
    }

    // Create an object to hold error messages that can be accessed by the 
    // corresponding input field name.
    const errorMessages = {
        "first_name" : "Please enter a name that is a least two characters long and has only letters, hyphens, and apostrophes.",
        "last_name" : "Please enter a name that is a least two characters long and has only letters, hyphens, and apostrophes.",
        "email" : "Please enter a valid email address.",
        "user_name": "Please enter a user name at least 2 characters long.",
        "login_password": "Please enter a password at least 8 characters long and contains one upper case letter, a number, and a special character.",
        "password2": "Please enter the same password twice."
    };

    // Syntactic sugar.
    const stringV = v8n().string();
    const length1V = v8n().greaterThan(1);
    const length7V = v8n().greaterThan(7);

    // Create an object to hold validation functions that can be accessed by the 
    // corresponding input field name.
    const validate = {
        "first_name": function( value ) {
            // Verify that value is a string longer than 1 character.
            return stringV.test( value ) && length1V.test( value.length );
        },
        "user_name": function( value ) {
            // Verify that value is a string longer than 7 characters.
            return stringV.test( value ) && length7V.test( value.length );
        },
        "email": function( value ) {
            // Verify that value conforms to the correct email format.
            return  /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test( value );
        },
        "login_password": function( value ) {
            // Verify that value is a string longer than 7 characters and contains
            // at least one number, one uppercase character, and one special character.
            return stringV.test( value ) && length7V.test( value.length )
            && /.*[A-Z].*/.test( value )
            && /.*[0-9].*/.test( value )
            && /.*[^a-zA-Z0-9].*/.test( value );
        },
        "password2": function( value1, value2 ) {
            // Verify that the two values are equal.
            return value1 === value2;
        }
    };

    // Add a form submit listener.
    accountForm.addEventListener( "submit", function ( event ) {

        // Use this to compare to password2 later.
        let login_password = "";
        for( let i = 0; i < formFieldNames.length; i++ ) {
            const fieldName = formFieldNames[i];
            if( !formFields.hasOwnProperty( fieldName ) ) {
                continue;
            }
            const value = formFields[fieldName].value;

            // Set this value for comparison later.
            if( fieldName === "login_password" ) {
                login_password = value;
            }

            // Use the functions declared above to validate each input value.
            let isValid = false;
            if( fieldName === "password2" ) {
                isValid = validate[fieldName]( login_password, value );
            } else if( fieldName === "last_name" ) {
                isValid = validate["first_name"]( value );
            } else {
                isValid = validate[fieldName]( value );
            }

            // If the field is invalid, modify the html to indicate an error.
            if( !isValid ) {
                formFields[fieldName].style.border = "4px solid var( --orange )";
                let errorDiv = errorDivs[fieldName];
                errorDiv.innerHTML = errorMessages[fieldName];
                errorDiv.style.display = "block";

                // Keep the form from refreshing.
                event.preventDefault();
                return false;
            }
        }
        
        // If everything was valid, submit the form.
        accountForm.submit();
        return true;
    } );
};