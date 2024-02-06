/*jQuery.noConflict();
jQuery(document).ready(function($) {*/
$(document).ready(function() {

    $(document).on("click", ".send", function(e) {
        e.preventDefault();
        var validStatus = [];
        var fileAlert, textAlert, emailAlert, passwordAlert, passwordLengthAlert, passwordConfAlert, selectAlert, textareaAlert, checkBoxRadioAlert;

        var lang = "hu";

        switch (lang) {

            case "hu":
                fileAlert = "Kérem, válasszon ki egy fájlt!";
                textAlert = "Kérem, töltse ki a mezőt!";
                emailAlert = "Kérem, adjon meg egy érvényes e-mail címet!";
                passwordAlert = "Kérem, adjon meg egy jelszót!";
                passwordLengthAlert = "A jelszó minimális hossza 6 karakter!";
                passwordConfAlert = "A megadott jelszavak nem egyeznek meg egymással!";
                selectAlert = "Kérem, válasszon egy lehetőséget!";
                textareaAlert = "Kérem, töltse ki a szövegmezőt!";
                checkBoxRadioAlert = "Kérem, válasszon a lehetőségek közül!";
                break;

            case "en":
                fileAlert = "Please, select a file!";
                textAlert = "Please, provide an answer!";
                emailAlert = "Please, provide a valid e-mail address!";
                passwordAlert = "Please, provide a password!";
                passwordLengthAlert = "The minimal length of password is 6 characters!";
                passwordConfAlert = "The two passwords are not identical!";
                selectAlert = "Please, select and option!";
                textareaAlert = "Please, provide a text!";
                break;
        }

        $(".valid").each(function() {

            switch (true) {

                // Input 
                case $(this).is("input[type='text']"): // Text
                case $(this).is("input[type='date']"): // Date
                case $(this).is("input[type='datetime-local']"): // Date-Time Local
                case $(this).is("input[type='time']"): // Time
                case $(this).is("input[type='month']"): // Month
                case $(this).is("input[type='week']"): // Week
                case $(this).is("input[type='file']"): // File
                case $(this).is("input[type='number']"): // Number

                    var errorMsg = $(this).is("input[type='file']") ? fileAlert : textAlert;

                    if ($(this).val() === '') {
                        $(this).siblings("span.alert").text(errorMsg);
                        validStatus.push($(this).attr("id"));
                    } else {
                        $(this).siblings("span.alert").text("");
                        removeItem($(this).attr("id"), validStatus);
                    }
                    break;

                case $(this).is("input[type='email']"): // Input (e-mail)

                    if ($(this).val() !== '') {
                        $(this).siblings("span.alert").text("");
                        removeItem($(this).attr("id"), validStatus);
                        var rem = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                        var checkEmail = rem.test($(this).val());

                        if (checkEmail == false) {
                            $(this).siblings("span.alert").text(emailAlert);
                            validStatus.push($(this).attr("id"));
                        } else {
                            $(this).siblings("span.alert").text("");
                            removeItem($(this).attr("id"), validStatus);
                        }
                    } else {
                        $(this).siblings("span.alert").text(emailAlert);
                        validStatus.push($(this).attr("id"));
                    }
                    break;

                case $(this).is("input[type='password']"): // Input (password)

                    if ($(this).val() === '') {
                        $(this).siblings("span.alert").text(passwordAlert);
                        validStatus.push($(this).attr("id"));
                    } else {

                        if ($(this).val().length >= 6) { // Minimal length of password: 6 characters 
                            var passwords = [];
                            $(this).siblings("span.alert").text("");
                            removeItem($(this).attr("id"), validStatus);

                            $("div.pass").each(function() { // Checking of passwords' identity
                                var pass = $(this).find("input[type='password']").val();
                                passwords.push(pass);
                            });

                            if (passwords[0] !== passwords[1]) {
                                $(this).siblings("span.pass-check").text(passwordConfAlert);
                                validStatus.push($(this).attr("id"));
                                passwords = [];
                                return;
                            } else {
                                $(this).siblings("span.pass-check").text("");
                                removeItem($(this).attr("id"), validStatus);
                            }
                        } else {
                            $(this).siblings("span.pass-check").text("");
                            $(this).siblings("span.alert").text(passwordLengthAlert);
                            validStatus.push($(this).attr("id"));
                        }
                    }
                    break;

                case $(this).is("select"): // Input (select)

                    if (($(this).val() === '') || ($(this).children(':selected').attr("disabled"))) {
                        $(this).siblings("span.alert").text(selectAlert);
                        validStatus.push($(this).attr("id"));
                    } else {
                        $(this).siblings("span.alert").text("");
                        removeItem($(this).attr("id"), validStatus);
                    }
                    break;

                case $(this).is("textarea.ckeditor"): // CKEditor textarea

                    if (!CKEDITOR.instances['inputTextareaCKEditor'].getData().length) {
                        $(this).siblings("span.alert").text(textareaAlert);
                        validStatus.push($(this).attr("id"));
                    } else {
                        $(this).siblings("span.alert").text("");
                        removeItem($(this).attr("id"), validStatus);
                    }
                    break;

                case $(this).is("textarea"): // Textarea

                    if ($(this).val() === '') {
                        $(this).siblings("span.alert").text(textareaAlert);
                        validStatus.push($(this).attr("id"));
                    } else {
                        $(this).siblings("span.alert").text("");
                        removeItem($(this).attr("id"), validStatus);
                    }
                    break;

                    // Checkbox && Radio button
                case $(this).is("input[type='checkbox']"):
                case $(this).is("input[type='radio']"):

                    var itemName = $(this).attr("name");
                    
                    if(!$("input[name='" + itemName + "']").is(":checked")) {    
                        $(this).siblings("span.alert").text(selectAlert);
                        validStatus.push($(this).attr("name"));
                    } else {
                        $(this).siblings("span.alert").text("");
                        removeItem($(this).attr("name"), validStatus);
                    }
                    break;

                default:
                    validStatus = [];
                    break;
            }
        });

        var checkValidStatus = Array.from(new Set(validStatus));
        checkValidStatus.length > 0 ? $("span#validationStatus").text("Error") : $("span#validationStatus").text("");

        function removeItem(id, array) {
            var index = array.indexOf(id);
            index > -1 ? array.splice(index, 1) : '';
            return array;
        }
    });
});