@extends(Helper::layout())


@section('style')
@stop

@section('content')

<?
$preferences = array();
$usi = @$_COOKIE["user_social_info"];
$usi = @json_decode($usi, 1);
if (is_array($usi) && isset($usi['profile']) && $usi['profile'] != '') {
    $info = UserSocialInfo::where('profile', $usi['profile'])->first();
    if (is_object($info)) {
        #Helper::dd($info);
        $preferences = json_decode($info->preferences, 1); 
        #Helper::dd($preferences);
    }
}

$cities = Config::get('site.cities'); #array('Москва', 'Санкт-Петербург', 'Воронеж', 'Екатеринбург', 'Краснодар', 'Самара');
$ages = Config::get('site.ages'); #array('0-3', '4-7', '7-10', '10-14', '14+');

$alltags = Tag::select('tag')->distinct()->get();
$temp = array();
foreach ($alltags as $alltag) {
    $tag = trim($alltag->tag);
    if ( !in_array($tag, $cities) && !in_array($tag, $ages) )
        $temp[] = $tag;
}
$alltags = $temp;
#Helper::dd($alltags);

?>

        <main>
            <section class="top">
                <div class="section-cont">


<? if (0) { ?>
                	{{ Form::open(array('url'=>'recomendations', 'role'=>'form', 'class'=>'get-recomendations-form family-form', 'id'=>'get-recomendations-form')) }}
                
                    <section class="col col-12">
                        <div class="well">
                            <header>
                                <h3>Получить рекомендации:</h3>
                                <div class="welcome_msg"></div>
                            </header>
                            <fieldset>
                
                                <section>
                                    <label class="label">Город:</label><br/>
                                    <label class="input">
                                        {{ Form::select('city', array('Ростов-на-Дону'=>'Ростов-на-Дону', 'Москва'=>'Москва'), @$info->city, array('class'=>'template-change', 'autocomplete'=>'off')) }} <i></i>
                                    </label>
                                </section>
                
                                <section>
                                    <label class="label">Интересы (теги, через запятую):</label><br/>
                                    <label class="input">
                                        {{ Form::textarea('tags', @$preferences['tags'], array('class'=>'redactor redactor_150')) }}
                                    </label>
                                </section>
                
                                <hr/>
                
                                <section>
                                    <label class="label">Состав семьи (теги, через запятую):</label><br/>
                                    <label class="input">
                                        {{ Form::textarea('family', @$preferences['family'], array('class'=>'redactor redactor_150')) }}
                                    </label>
                                </section>
                
                                <section>
                                    <label class="label">Вкус мороженного:</label><br/>
                                    <label class="input">
                                        {{ Form::select('taste', array('Клубничное'=>'Клубничное', 'Шоколадное'=>'Шоколадное'), @$preferences['taste'], array('class'=>'template-change', 'autocomplete'=>'off')) }} <i></i>
                                    </label>
                                </section>
                
                                <section>
                                    <label class="label">Дата:</label><br/>
                                    <label class="input">
                                        {{ Form::select('date', array('2014.06.21-2014.06.22'=>'21-22 июня', '2014.07.05-2014.07.06'=>'5-6 июля'), @$preferences['date'], array('class'=>'template-change', 'autocomplete'=>'off')) }} <i></i>
                                    </label>
                                </section>
                
                            </fieldset>
                            <footer>
                        	    <button type="submit">Получить!</button>
                            </footer>
                        </div>
                    </section>
                    
                	{{ Form::close() }}
<? } ?>


                    <form class="family-form" action="/recomendations" method="POST">
                        <div class="form-head">
                            <h2>Спланируйте семейные выходные!</h2>
                            <div class="form-desc">
                                <span class="boup">Заполните анкету</span> и получите рекомендации как провести<br>
                                прекрасные <span class="boup">48 часов вместе</span> с семьей
                            </div>
                        </div>
                        <div class="form-error showed0">
                            <span>К сожалению при отправке формы произошел сбой. Попробуйте позже</span>
                        </div>
                        <fieldset>
                            <section class="family-form-part">
                                <div class="date-part">
                                    <label>
                                        Дата:
                                        <input type="text" name="date">
                                        <span class="cal-icon icon icon-calendar"></span>
                                    </label>
                                    <div class="form-error input-error" data-block="calendar">
                                        <span>Вы не указали дату</span>
                                    </div>
                                    <div class="calendar closed">
                                        <i class="cal-left"></i>
                                        <i class="cal-right"></i>
                                        <div class="calendar-in">
                                            <div data-month="06" data-month-cyr="июня" class="one-month active">
                                                <div class="month">
                                                    Июнь 2014
                                                </div>
                                                <div class="weekdays">
                                                    <span class="weekday">пн</span>
                                                    <span class="weekday">вт</span>
                                                    <span class="weekday">ср</span>
                                                    <span class="weekday">чт</span>
                                                    <span class="weekday">пт</span>
                                                    <span class="weekday weekend">сб-вс</span>
                                                </div>
                                                <div class="days-row">
                                                    <i class="day"></i>
                                                    <i class="day"></i>
                                                    <i class="day"></i>
                                                    <i class="day"></i>
                                                    <i class="day"></i>
                                                    <i class="day click-allow" data-date="1">1</i>
                                                </div>
                                                <div class="days-row">
                                                    <i class="day">2</i>
                                                    <i class="day">3</i>
                                                    <i class="day">4</i>
                                                    <i class="day">5</i>
                                                    <i class="day">6</i>
                                                    <i class="day click-allow" data-date="7">7-8</i>
                                                </div>
                                                <div class="days-row">
                                                    <i class="day">9</i>
                                                    <i class="day">10</i>
                                                    <i class="day">11</i>
                                                    <i class="day">12</i>
                                                    <i class="day">13</i>
                                                    <i class="day click-allow" data-date="14">14-15</i>
                                                </div>
                                                <div class="days-row">
                                                    <i class="day">16</i>
                                                    <i class="day">17</i>
                                                    <i class="day">18</i>
                                                    <i class="day">19</i>
                                                    <i class="day">20</i>
                                                    <i class="day click-allow" data-date="21">21-22</i>
                                                </div>
                                                <div class="days-row">
                                                    <i class="day">23</i>
                                                    <i class="day">24</i>
                                                    <i class="day">25</i>
                                                    <i class="day">26</i>
                                                    <i class="day">27</i>
                                                    <i class="day click-allow" data-date="28">28-29</i>
                                                </div>
                                                <div class="days-row">
                                                    <i class="day">30</i>
                                                    <i class="day">&nbsp;</i>
                                                    <i class="day">&nbsp;</i>
                                                    <i class="day">&nbsp;</i>
                                                    <i class="day">&nbsp;</i>
                                                    <i class="day">&nbsp;</i>
                                                </div>
                                            </div>
                                            <div data-month="07" data-month-cyr="июля" class="one-month">
                                                <div class="month">
                                                    Июль 2014
                                                </div>
                                                <div class="weekdays">
                                                    <span class="weekday">пн</span>
                                                    <span class="weekday">вт</span>
                                                    <span class="weekday">ср</span>
                                                    <span class="weekday">чт</span>
                                                    <span class="weekday">пт</span>
                                                    <span class="weekday weekend">сб-вс</span>
                                                </div>
                                                <div class="days-row">
                                                    <i class="day"></i>
                                                    <i class="day">1</i>
                                                    <i class="day">2</i>
                                                    <i class="day">3</i>
                                                    <i class="day">4</i>
                                                    <i class="day click-allow" data-date="5">5-6</i>
                                                </div>
                                                <div class="days-row">
                                                    <i class="day">7</i>
                                                    <i class="day">8</i>
                                                    <i class="day">9</i>
                                                    <i class="day">10</i>
                                                    <i class="day">11</i>
                                                    <i class="day click-allow" data-date="12">12-13</i>
                                                </div>
                                                <div class="days-row">
                                                    <i class="day">14</i>
                                                    <i class="day">15</i>
                                                    <i class="day">16</i>
                                                    <i class="day">17</i>
                                                    <i class="day">18</i>
                                                    <i class="day click-allow" data-date="19">19-20</i>
                                                </div>
                                                <div class="days-row">
                                                    <i class="day">21</i>
                                                    <i class="day">22</i>
                                                    <i class="day">23</i>
                                                    <i class="day">24</i>
                                                    <i class="day">25</i>
                                                    <i class="day click-allow" data-date="26">26-27</i>
                                                </div>
                                                <div class="days-row">
                                                    <i class="day">28</i>
                                                    <i class="day">29</i>
                                                    <i class="day">30</i>
                                                    <i class="day">31</i>
                                                    <i class="day"></i>
                                                    <i class="day"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                                <div class="city-part">
                                    <label>Ваш город:</label>
                                    <select class="city-select">
                                        <option value="Москва" selected>Москва</option>
                                        <option value="Санкт-Петербург">Санкт-Петербург</option>
                                        <option value="Воронеж">Воронеж</option>
                                        <option value="Екатеринбург">Екатеринбург</option>
                                        <option value="Краснодар">Краснодар</option>
                                        <option value="Самара">Самара</option>
                                    </select>
                                </div>
                            </section><!--
                         --><section class="family-form-part">
                                <label>Укажите состав семьи:</label>
                                <div class="family-cont">
                                    <div class="family">
                                        <div class="family-before">
                                            <a href="#" class="family-item f-step" data-person="father">
                                                <span class="pers-img"></span>
                                                <span class="person">Папа</span>
                                            </a>
                                            <a href="#" class="family-item f-step" data-person="mother">
                                                <span class="pers-img"></span>
                                                <span class="person">Мама</span>
                                            </a>
                                            <a href="#" class="family-item f-step" data-person="boy">
                                                <span class="pers-img"></span>
                                                <span class="person">Сын</span>
                                            </a>
                                            <a href="#" class="family-item f-step" data-person="girl">
                                                <span class="pers-img"></span>
                                                <span class="person">Дочь</span>
                                            </a>
                                        </div>
                                        <i class="family-arrow"></i>
                                        <div class="family-after"></div>
                                    </div>
                                </div>
                                <div class="form-error input-error margin-t40" data-block="family">
                                    <span>Вы не указали состав семьи</span>
                                </div>
                            </section><!--
                         --><section class="family-form-part">
                                <label>Укажите ваши интересны:</label>
                                <div class="inters">
                                    <select class="inters-select">
                                        <option selected value="0">Укажите интересы</option>
                                        @foreach($alltags as $tag)
                                        <option value="{{ $tag }}">{{ $tag }}</option>
                                        @endforeach
                                        <option value="travel">Путешествия</option>
                                    </select>
                                </div>
                                <div class="form-error input-error" data-block="inters">
                                    <span>Вы не указали ни одного интереса</span>
                                </div>
                            </section>
                        </fieldset>
                        <div class="family-btn-cont">
                            <button class="family-btn">Получить рекомендации</button>
                        </div>

                        <input type="hidden" name="line" value="" />

                    </form>



                    <div class="to-bot">
                        <div class="margin-bottom-mid">Найдите любимый вкус мороженого <span class="boup">48 копеек</span>® для себя и Ваших близких!</div>
                        <div class="button"><span class="icon icon-down-open"></span></div>
                    </div>
                </div>
            </section>
            <section class="mid">
                <div class="section-cont">
                    <div class="mid-cont">
                        <a class="show-all-tastes" href="/product">Посмотреть все вкусы</a>
                        <p>
                            <span class="boup">48 копеек</span>® - разнообразие вкусов в лучших семейных<br>
                            традициях! Выходные в кругу родных и близких<br>
                            невозможно представить без теплых улыбок, ярких<br>
                            событий и конечно же вкуснейшего лакомства!
                        </p>
                        <p>
                            Мы создали мороженое <span class="boup">48 копеек</span>®, чтобы ваши<br>
                            <span class="boup">48 часов вместе</span> с семьей стали незабываемыми!
                        </p>
                    </div>
                </div>
            </section>
        </main>
    	{{-- $content --}}

@stop


@section('scripts')
    {{ HTML::script("js/index.js") }}
@stop