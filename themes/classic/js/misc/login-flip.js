$(function(){

    // Checking for CSS 3D transformation support
    $.support.css3d = supportsCSS3D();

    var formContainer = $('.loginWrapper');
    // Listening for clicks on the ribbon links
    $('.flip').click(function(e){

        // Flipping the forms
        formContainer.toggleClass('flipped');

        // If there is no CSS3 3D support, simply
        // hide the login form (exposing the recover one)
        if(!$.support.css3d){
            $('#login').toggle();
        }
        $('#login_heading').toggle('slow');
        $('#forgotpw_heading').toggle('slow');
        e.preventDefault();
    });

    formContainer.find('form').submit(function(e){
        // Preventing form submissions. If you implement
        // a backend, you might want to remove this code
        //e.preventDefault();
    });


    // A helper function that checks for the
    // support of the 3D CSS3 transformations.
    function supportsCSS3D() {
        var props = [
            'perspectiveProperty', 'WebkitPerspective', 'MozPerspective'
        ], testDom = document.createElement('a');

        for(var i=0; i<props.length; i++){
            if(props[i] in testDom.style){
                return true;
            }
        }

        return false;
    }
    //checkbox
    $('.checker').click(function(e){
        $(this).children('span').toggleClass('checked');
    });

    $('.logright').click(function(){
        $(".loginWrapper :input[type=text], .loginWrapper :input[type=email], .loginWrapper :input[type=password]").each(function(){
            var input = $(this); // This is the jquery object of the input, do what you will
            $(this).val('');
            $(this).text('');
        });
    });
});