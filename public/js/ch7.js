$(document).ready(function() {
    
    
    $('#gallery img').each(
        function(){
            var imgFile = $(this).attr('src');
            var preloadImage = new Image();
            var imgExt = /(\.\w{3,4}$)/;
            preloadImage.src = imgFile.replace(imgExt,'_h$1');
            $(this).hover{
                //on mouseover
                function(){
                    $(this).attr('src',preloadImage.src);
                },
                    //on mouseout
                    function(){
                        $(this).attr('src',imgFile);
                    }
            };//end hover
        }//end function 1
    ); //end each

}); // end ready