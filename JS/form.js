$(document).ready(function() {
    
    $("button#send").on("click", function() {
        
        /**
         * Ajax
         */
        setTimeout(function() {
            if($("span#validationStatus").text() === "") {
                var name, email, selected_date, consent, captcha, base_url, msg;

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
                            alert('Sikeres mentés! Kérem, ellenőrizze az e-mail fiókját és erősítse meg a regisztrációt!');
                            location.reload();
                        } else {                            
                            switch(response) {
                                case 'duplicate_email':
                                    msg = 'A megadott e-mail már szerepel az adatbázisunkban.';
                                    break;
                                
                                case 'db_error':
                                case 'no_data':
                                    msg = 'Sikertelen mentés. Kérem, próbálja meg újra.';
                                    break;

                                case 'email_error':
                                    msg = 'A megadott e-mail címre nem sikerült üzenetet küldeni. Kérem, ellenőrizze az e-mail címet.';
                                    break;

                                case 'captcha':
                                    msg = 'Kérem, ellenőrizze a megadott napot!';
                                    break;

                                default:
                                    'Ismeretlen hiba. Kérem, próbálja újra.';
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