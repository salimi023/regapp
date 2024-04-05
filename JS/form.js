$(document).ready(function() {

    /**
     * Adding date input fields to form and checking the validation of dates by disabling the passed ones  
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

    if(event_dates.length > 0) {
        for(var x in event_dates) {
            
            $("div#date_inputs").append(
                '<input type="radio" name="date" class="w3-radio valid" value="' + event_dates[x] + '" />&nbsp;' + event_dates[x] + '<br />'
            );
            
            if(formatted_date >= event_dates[x]) {
                $("input[name='date']").each(function() {               
                    if($(this).val() === event_dates[x]) {
                        $(this).prop("disabled", true);
                    }
                });
            }
        }
        
        $("div#date_inputs").append('<span class="alert"></span>');
    } else {
        $("div#date_inputs").html('<div class="w3-panel w3-red w3-round w3-padding" id="date_input_alert">Jelen pillanatban sajnos nincs választható időpont! Kérlek, nézz vissza legközelebb.</div>');
        $("button#send").prop("disabled", true);
    }    
    
    /**
     * Sending form data
     */
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