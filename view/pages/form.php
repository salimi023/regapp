        <div id="intro" class="w3-row">Intro</div>
        <div id="form" class="w3-row">
            <div class="w3-margin-bottom">
                <label for="name">Név:</label>
                <input type="text" name="name" id="name" class="w3-input w3-border valid" />
                <span class="alert"></span>
            </div>

            <div class="w3-margin-bottom">
                <label for="name">E-mail:</label>
                <input type="email" name="email" id="email" class="w3-input w3-border valid" />
                <span class="alert"></span>
            </div>

            <div class="w3-margin-bottom">
                <label for="date">Dátumok:</label><br />
                <input type="radio" name="date" id="date1" class="w3-radio valid" value="2024-03-23" />&nbsp;2024. március 23.<br />
                <input type="radio" name="date" id="date2" class="w3-radio valid" value="2024-04-06" />&nbsp;2024. április 06.<br />
                <span class="alert"></span>
            </div>

            <div class="w3-margin-bottom">
                <input type="checkbox" name="consent" id="consent" class="w3-check valid" value="" />&nbsp;Elolvastam és elfogadom az
                Adatvédelmi Tájékoztatóban foglaltakat!<br />
                <span class="alert"></span>
            </div>

            <div class="w3-margin-bottom">
                <label for="captcha">Kérem, írja be milyen nap van ma:</label>
                <input type="text" name="captcha" id="captcha" class="w3-input w3-border valid" placeholder="pl. hétfő" />
                <span class="alert"></span>
            </div>
            <div class="w3-margin-bottom">
                <button class="w3-btn w3-red w3-round send" id="send">Küldés</button>
            </div>
        </div>