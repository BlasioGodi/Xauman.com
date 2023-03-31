
$(document).ready(function () {
    // Get the offcanvas element
    var offcanvas = $('#offcanvasExample');

    // Get the dismiss button
    var dismissBtn = offcanvas.find('.btn-close');

    // Add click event listener to the dismiss button
    dismissBtn.on('click', function () {
        // Remove the "offcanvas" class from the body element
        $('body').removeClass('offcanvas');
    });
});

console.log('Script loaded successfully');


