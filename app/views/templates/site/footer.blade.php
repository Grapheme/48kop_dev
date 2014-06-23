        <footer class="footer">
            <div class="section-cont">
                {{--
                <div>Телефон горячей линии:</div>
                <div>
                    <a class="tel" href="tel:+78002007200">8 800 200 72 00</a>
                </div>
                --}}
                <div>
                    <a class="politics" href="#">Политика конфиденциальности</a>
                </div>
                <ul class="social">
                    <li class="social-li">
                        <a href="http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st._surl=48kopeek.ru" target="_blank"><span class="icon icon-odnokl"></span></a>
                    <li class="social-li">
                        <a href="http://vkontakte.ru/share.php?url=http://48kopeek.ru&title=48 копеек" target="_blank"><span class="icon icon-vk"></span></a>
                    <li class="social-li">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=48kopeek.ru" target="_blank"><span class="icon icon-fb"></span></a>
                </ul>
                <div class="copy">
                    <span class="copy-text">© 2014. Проект «48 часов вместе»</span> <a href="http://48kopeek.ru">48kopeek.ru</a>
                </div>
            </div>
        </footer>
    </div>

        <div class="overlay hidden">

            <section class="popup auth hidden" data-item="auth">
                <header>
                    <div class="popup-close icon icon-cancel"></div>
                    <h3>Вход</h3>
                    <div class="popup-desc">
                        Чтобы система запомнила ваши предпочтения нужна<br>
                        авторизация через аккаунты социальных сетей.
                    </div>
                </header>

                <ul class="auth-ul" id="uLogin" data-ulogin="display=buttons;fields=first_name,city;optional=last_name,email,phone;redirect_uri=http%3A%2F%2F{{ $_SERVER['SERVER_NAME'] }}%2Fxd_custom.html;callback=uloginauth">
                    <li class="auth-li">
                        <a class="odnokl" href="#" data-uloginbutton="odnoklassniki"><span class="icon icon-odnokl"></span></a>
                    <li class="auth-li">
                        <a class="vk" href="#" data-uloginbutton="vkontakte"><span class="icon icon-vk"></span></a>
                    <li class="auth-li">
                        <a class="fb" href="#" data-uloginbutton="facebook"><span class="icon icon-fb"></span></a>
                </ul>

                {{--
                <div id="uLogin" data-ulogin="display=buttons;fields=first_name,last_name;redirect_uri=http%3A%2F%2Flocalhost%2Fxd_custom.html;callback=uloginauth">
                        <img src="vkontakte.png" data-uloginbutton = "vkontakte"/>
                        <img src="odnoklassniki.png" data-uloginbutton = "odnoklassniki"/>
                        <img src="facebook.png" data-uloginbutton = "facebook"/>
                </div>
                --}}

            </section>

            <section class="popup feedback hidden" data-item="feedback">
                <header>
                    <div class="popup-close icon icon-cancel"></div>
                    <h3>Обратная связь</h3>
                    <div class="popup-desc">
                        Нам очень важно ваше мнение
                    </div>
                </header> 
                <div class="form-error showed0">
                    <span>К сожалению при отправке формы произошел сбой. Попробуйте позже</span>
                </div>               
                <form class="feedback-form" action="/feedback/send" method="POST">
                    <fieldset>
                        <section>
                            <label>Представьтесь</label><!--
                         --><input type="text" name="name" value="" placeholder="Коля Иванов">
                            <div class="inp-error"><span>Не заполнено обязательное поле</span></div>
                        </section>
                        <section>
                            <label>Ваш email</label><!--
                         --><input type="text" name="email" value="" placeholder="kolya@ivanov.com">
                            <div class="inp-error"><span>Не заполнено обязательное поле</span></div>
                        </section>
                        <section class="with-textarea">
                            <label>Сообщение</label><!--
                         --><textarea name="message"></textarea>
                            <div class="inp-error"><span>Не заполнено обязательное поле</span></div>
                        </section>
                        <footer>
                            <button type="submit">Отправить</button>
                        </footer>
                    </fieldset>
                </form>
            </section>

            <? include(Helper::inclayout('handlebars')); ?>


        </div>

