<footer> 
    <p class="center">Isobel Lennox &copy; 2015 isobellennox.com</p>
</footer>

<!-- STICKY NAME -->

<script>
    // Create a clone of the menu, right next to original.
    $('.menu').addClass('original').clone().insertAfter('.menu').addClass('cloned').css('position', 'fixed').css('top', '0').css('margin-top', '0').css('z-index', '500').removeClass('original').hide();



    scrollIntervalID = setInterval(stickIt, 10);


    function stickIt() {

        var orgElementPos = $('.original').offset();
        orgElementTop = orgElementPos.top;

        if ($(window).scrollTop() >= (orgElementTop)) {
            // scrolled past the original position; now only show the cloned, sticky element.

            // Cloned element should always have same left position and width as original element.     
            orgElement = $('.original');
            coordsOrgElement = orgElement.offset();
            leftOrgElement = coordsOrgElement.left;
            widthOrgElement = orgElement.css('width');

            $('.cloned').css('left', leftOrgElement + 'px').css('top', 0).css('width', widthOrgElement + 'px').show();
            $('.original').css('visibility', 'hidden');
            $('.hiddenemail').css('visibility', 'visible');
        } else {
            // not scrolled past the menu; only show the original menu.
            $('.cloned').hide();
            $('.original').css('visibility', 'visible');

            $('.hiddenemail').css('visibility', 'hidden');
        }
    }


    // END STICKY NAV

    /*jQuery ACCORDIAN*/
    $(document).ready(function() {
            $(".accordian h3").click(function() {
                //slide up all the link lists
                $(".accordian ul ul").slideUp();
                //slide down the link list below the h3 clicked - only if its closed
                if (!$(this).next().is(":visible")) {
                    $(this).next().slideDown();
                }
            })
        })
        // END ACCORDIAN
</script>
</body>

</html>