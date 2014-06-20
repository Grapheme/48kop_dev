
            <section id="rec" class="popup rec hidden" data-item="rec"></section>
            <section id="advice" class="popup rec advice hidden" data-item="advice"></section>

            <script id="rec-template" type="text/x-handlebars-template">
                <div class="rec-cont">
                    <header>
                        <div class="popup-close icon icon-cancel"></div>
                        <h3>{{name}}</h3>
                        <div class="popup-desc">
                            {{short}}
                        </div>
                    </header>
                    <div class="column left">
                        <div class="pict" style="background-image:url({{photo}})"></div>
                        <script type="text/javascript" src="http://yandex.st/share/share.js"
charset="utf-8"><{{!}}/script>
<div class="yashare-auto-init" data-yashareL10n="ru"
 data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki" data-yashareTheme="counter"

></div>
                        <div>
                            <div class="send-email-cont">
                                <a class="send-email" id="send-email" href="#">Отправить по email</a>
                                <form class="send-email-form">
                                    <input type="text"><!--
                                 --><button id="sendEmailSubmit" type="submit">Ок</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="column">
                        {{{desc}}}
                    </div>
                </div>
                <footer>
                    Еще лучше дополняет прогулку <a href="#">шоколадный брикет 48 копеек</a>
                </footer>
            </script>
            <script id="event-template" type="text/x-handlebars-template">
                <div class="rec-cont">
                    <header>
                        <div class="popup-close icon icon-cancel"></div>
                        <h3>{{name}}</h3>
                        <div class="popup-desc">
                            {{{short}}}
                        </div>
                    </header>
                    <div class="column left">
                        <div class="pict" style="background-image:url({{photo}})"></div>
                        <script type="text/javascript" src="http://yandex.st/share/share.js"
charset="utf-8"><{{!}}/script>
<div class="yashare-auto-init" data-yashareL10n="ru"
 data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki" data-yashareTheme="counter"

></div>
                        <div class="i-will" data-action-id="{{id}}">Я пойду</div>
                        <span class="people-count">Уже идут <strong>34</strong></span>
                        <div>
                            <div class="send-email-cont">
                                <a class="send-email" id="send-email" href="#">Отправить по email</a>
                                <form class="send-email-form">
                                    <input type="text"><!--
                                 --><button id="sendEmailSubmit" type="submit">Ок</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="column">
                        {{{desc}}}

                        <div>
                            <div class="column-50">
                                <div class="column-head">Когда</div>
                                <strong>{{date}}, {{time}}</strong>
                            </div>

                            <div class="column-50">
                                <div class="column-head">Цена</div>
                                <strong>от {{price}} руб.</strong>
                            </div>

                            <div class="column-50">
                                <div class="column-head">Где</div>
                                <strong>{{where}}</strong>
                            </div>

                            <div class="column-50">
                                <div class="column-head">В сети</div>
                                <div><a href="http://{{web}}">{{web}}</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <footer>
                    Еще лучше дополняет это мероприятие <a href="#">шоколадный брикет 48 копеек</a>
                </footer>
            </script>
            <script id="advice-template" type="text/x-handlebars-template">
                <div class="rec-cont">
                    <header>
                        <div class="popup-close icon icon-cancel"></div>
                        <h3>{{name}}</h3>
                    </header>
                    <div class="column left">
                        {{{desc}}}
                    </div>
                    <div class="column">
                        <script type="text/javascript" src="http://yandex.st/share/share.js"
charset="utf-8"><{{!}}/script>
<div class="yashare-auto-init" data-yashareL10n="ru"
 data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki" data-yashareTheme="counter"

></div>
                        <div>
                            <div class="send-email-cont">
                                <a class="send-email" id="send-email" href="#">Отправить по email</a>
                                <form class="send-email-form">
                                    <input type="text"><!--
                                 --><button id="sendEmailSubmit" type="submit">Ок</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </script>