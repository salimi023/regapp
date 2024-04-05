        <div id="intro" class="w3-row">
            <div id="promo">
                <img id="promo_img" src="<?php echo $_SERVER['BASE_URL']; ?>images/noi_onvedelem2.jpg"
                    alt="Nyílt Nap" />
            </div>
            <div id="reg_btn_container" class="w3-row w3-padding w3-center"><button id="reg_btn"
                    class="w3-btn w3-round w3-xxlarge">REGISZTRÁCIÓ</button>
            </div>
        </div>

        <!-- The Modal -->
        <div id="reg_modal" class="w3-modal">
            <div class="w3-modal-content">
                <div class="w3-container">
                    <span id="close_modal" class="w3-button w3-display-topright">&times;</span>
                    <h2><strong>Regisztráció</strong></h2>
                    <p>Minden mező kitöltése <strong>kötelező</strong>!<br />
                        A regisztráció után kérlek, ellenőrizd a <strong>megadott e-mail címet</strong>.<br />
                        A regisztráció megerősítésére <strong>2 nap</strong> áll rendelkezésedre.</p>
                    <div id="form" class="w3-row">
                        <div class="w3-margin-bottom">
                            <label for="name"><strong>Név:</strong></label>
                            <input type="text" name="name" id="name" class="w3-input w3-border valid" />
                            <span class="alert"></span>
                        </div>

                        <div class="w3-margin-bottom">
                            <label for="name"><strong>E-mail:</strong></label>
                            <input type="email" name="email" id="email" class="w3-input w3-border valid" />
                            <span class="alert"></span>
                        </div>

                        <div class="w3-margin-bottom">
                            <label for="date"><strong>Dátumok:</strong></label><br />
                            <div id="date_inputs"></div>                            
                        </div>

                        <div class="w3-margin-bottom">
                            <input type="checkbox" name="consent" id="consent" class="w3-check valid"
                                value="" />&nbsp;Elolvastam és
                            elfogadom az
                            <strong><a href="<?php echo $_SERVER['BASE_URL']; ?>adatvedelmi-nyilatkozat" target="_blank">Adatvédelmi Tájékoztatóban</a></strong> foglaltakat!<br />
                            <span class="alert"></span>
                        </div>

                        <div class="w3-margin-bottom">
                            <label for="captcha">Kérlek, írd be <strong>milyen nap van ma</strong>:</label>
                            <input type="text" name="captcha" id="captcha" class="w3-input w3-border valid"
                                placeholder="pl. hétfő" value="" />
                            <span class="alert"></span>
                        </div>
                        <div class="w3-margin-bottom">
                            <button class="w3-btn w3-red w3-round send" id="send">Küldés</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>