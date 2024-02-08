$(document).ready(function() {
    
    // Show Modal
    $("button#reg_btn").on("click", function() {        
        $("div#reg_modal").css("display", "block");
    });

    // Hide Modal
    $("span#close_modal").on("click", function() {
        $("div#reg_modal").css("display", "none");
        location.reload();
    })
});