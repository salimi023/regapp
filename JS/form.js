$(document).ready(function() {

    /**
     * Checking date and disable the passed ones
     */
    var date = new Date();
    var day = String(date.getDay());
    var month = String(date.getMonth() + 1);
    var year = date.getFullYear();
    var formatted_month = month.length < 2 ? '0' + month : month;
    var formatted_day = day.length < 2 ? '0' + day : day;    

    var formatted_date = year + '-' + formatted_month + '-' + formatted_day;    

    // Date format: YYYY-mm-dd
    var event_dates = [
        '2024-03-23',
        '2024-04-06'
    ];

    for(var x in event_dates) {       
        
        if(formatted_date >= event_dates[x]) {
            $("input[name='date']").each(function() {               
                if($(this).val() === event_dates[x]) {
                    $(this).prop("disabled", true);
                }
            });
        }
    }                          
    
    $("button#send").on("click", function() {
        
        /**
         * Ajax
         */
        setTimeout(function() {
            if($("span#validationStatus").text() === "") {
                var name, email, selected_date, consent, captcha, base_url, msg, date, formatted_date;

                base_url = $("span#validationStatus").data("url");
                name = $("input#name").val();
                email = $("input#email").val();
                selected_date = $("input[name='date']:checked").val();
                consent = $("input#consent").is(":checked") ? 1 : 2;
                captcha = $("input#captcha").val();                     

                $.ajax({                                        
                    url: base_url + 'ajax',
                    type: "POST",
                    data: {name: name, email: email, selected_date: selected_date, consent: consent, captcha: captcha},
                    dataType: "html",
                    success: function(response) {                                                                                                                        
                        if(response === 'okay') {
                            alert('Sikeres mentés! Kérlek, ellenőrizd az e-mail fiókod és erősítsd meg a regisztrációt!');
                            location.reload();
                        } else {                            
                            switch(response) {
                                case 'duplicate_email':
                                    msg = 'A megadott e-mail már szerepel az adatbázisunkban.';
                                    break;
                                
                                case 'db_error':
                                case 'no_data':
                                    msg = 'Sikertelen mentés. Kérlek, próbáld meg újra.';
                                    break;

                                case 'email_error':
                                    msg = 'A megadott e-mail címre nem sikerült üzenetet küldeni. Kérlek, ellenőrizd az e-mail címet.';
                                    break;

                                case 'captcha':
                                    msg = 'Kérlek, ellenőrizd a megadott napot!';
                                    break;

                                default:
                                    'Ismeretlen hiba. Kérlek, próbáld meg újra.';
                                    break;
                            }

                            alert(msg);
                            return false;
                        }
                    }                    
                });
            } 
        }, 100);
    });
});