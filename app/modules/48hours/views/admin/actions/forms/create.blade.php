{{ Form::open(array('url'=>link::auth($module['rest'].'/store'), 'role'=>'form', 'class'=>'smart-form', 'id'=>'action-form', 'method'=>'post')) }}

	<div class="row margin-top-10">
        <!-- Form -->
        <section class="col col-6">
            <div class="well">
                <header>Новое мероприятие:</header>
                <fieldset>
                    <section>
                        <label class="label">Название</label>
                        <label class="input"> <i class="icon-append fa fa-list-alt"></i>
                            {{ Form::text('name', '') }}
                        </label>
                    </section>

                    <section>
                        <label class="label">Дата/время проведения</label>
                        <label class="input col-6">
                            <input type="text" name="date_time" value="<?=date("d.m.Y")?>" class="datepicker text-center pull-left" style="width:50%" />
                            <input type="text" name="time" value="12:00" placeholder="12:00" class="text-center" style="width:50%" />
                       </label>
                    </section>

                    <section>
                        <label class="label">Место проведения</label>
                        <label class="input"> <i class="icon-append fa fa-list-alt"></i>
                            {{ Form::text('where', '') }}
                        </label>
                    </section>

                    <section>
                        <label class="label">Цена</label>
                        <label class="input col-3"> <i class="icon-append fa fa-list-alt"></i>
                            {{ Form::text('price', '0') }}
                        </label>
                    </section>

                    <section>
                        <label class="label">Адрес в сети Интернет</label>
                        <label class="input"> <i class="icon-append fa fa-list-alt"></i>
                            {{ Form::text('web', '', array('placeholder' => 'http://')) }}
                        </label>
                    </section>

                    @if (Allow::module('production'))
                    <section>
                        <label class="label">Связаный продукт</label>
                        <label class="select">
                            {{ ExtForm::production_product('product') }}
                        </label>
                    </section>
                    @endif

                    <section>
                        <label class="label">Описание</label>
                        <label class="input">
                            {{ Form::textarea('desc', '', array('class'=>'redactor redactor_150')) }}
                        </label>
                    </section>

                    @if (Allow::module('tags'))
                    <section>
                        <label class="label">Теги</label>
                        <label class="input">
                            {{ ExtForm::tags('tags', '', array('data-module' => $module['modname'])) }}
                        </label>
                    </section>
                    @endif

                    @if (Allow::module('galleries'))
                    <section>
                        <label class="label">Изображение</label>
                        <label class="input">
                            {{ ExtForm::image('image', '') }}
                        </label>
                    </section>
                    @endif

                </fieldset>
    		</div>
    	</section>
    	<!-- /Form -->
   	</div>

	<div style="float:none; clear:both;"></div>

    <section class="col-6">
        <footer>
        	<a class="btn btn-default no-margin regular-10 uppercase pull-left btn-spinner" href="{{ URL::previous() }}">
        		<i class="fa fa-arrow-left hidden"></i> <span class="btn-response-text">Назад</span>
        	</a>
        	<button type="submit" autocomplete="off" class="btn btn-success no-margin regular-10 uppercase btn-form-submit">
        		<i class="fa fa-spinner fa-spin hidden"></i> <span class="btn-response-text">Создать</span>
        	</button>
        </footer>
    </section>

{{ Form::close() }}
