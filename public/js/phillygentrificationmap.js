$( document ).ready( function() {
   
    $(".btn-minimize").click(function(){
        $(this).toggleClass('btn-plus');
        $(".project-description").slideToggle();
    });
    
    $( ".draggable" ).draggable();
    
});