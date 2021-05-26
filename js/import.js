class FileHelper 
{
    constructor()
    {
        this.submitName = 'fileSubmit';
        this.fileInputName = 'fileInput';
        this.fileInputDiv = 'fileInputDiv';
        this.fileFormName = 'fileForm';
        this.errorDivName = 'fileInputError';

        this.errorMessages = [
            "Please choose a file.",
            "Please select a file with a .csv extension.",
        ];
    }
}


window.onload = function () {

    let fileHelper = new FileHelper();
    let fileForm = document.forms[ fileHelper.fileFormName ];
    if( fileForm ) {

        let fileInput = document.getElementById( fileHelper.fileInputName );
        let fileNameDiv = document.getElementById( fileHelper.fileInputDiv );
        fileInput.addEventListener( "change", function ( e ) {
            console.log( "change fired" );
            if( fileInput.value ) {
                fileNameDiv.innerHTML = fileInput.value.replace(/^.*[\\\/]/, '');
            }            
        } );


        fileForm.addEventListener( "submit", function( e ) {

            let fullPath = fileInput.value;
            let errorMessage = null;
            if( !fullPath ) {
                errorMessage = fileHelper.errorMessages[0];
            
            } else if( ! /.*\.csv$/i.test( fullPath ) ) {
                errorMessage = fileHelper.errorMessages[0];
            }
    
            if( errorMessage ) {
                e.preventDefault();
                let errorDiv = document.getElementById( fileHelper.errorDivName );
                errorDiv.innerHTML = errorMessage;
                return false;
            }

            fileForm.submit();
            return true;
        } );
    }
}