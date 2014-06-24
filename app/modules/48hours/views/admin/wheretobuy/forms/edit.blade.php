{{ Form::model($wheretobuy, array('url'=>link::auth($module['rest'].'/update/'.$wheretobuy->id), 'class'=>'smart-form', 'id'=>'wheretobuy-form', 'role'=>'form', 'method'=>'post')) }}

    <!-- Fields -->
	<div class="row margin-top-10">

        <!-- Form -->
        <section class="col col-6">
            <div class="well">
                <header>Изменить место "Где купить?":</header>
                <fieldset>
                    <section>
                        <label class="label">Адрес</label>
                        <label class="input"> <i class="icon-append fa fa-list-alt"></i>
                            {{ Form::text('name', @$wheretobuy->name) }}
                        </label>
                    </section>

                    <section>
                        <label class="label">Описание (адрес)</label>
                        <label class="input">
                            {{ Form::textarea('desc', @$wheretobuy->desc, array('class'=>'redactor redactor_150')) }}
                        </label>
                    </section>

                    @if (Allow::module('tags'))
                    <section>
                        <label class="label">Теги</label>
                        <label class="input">
                            {{ ExtForm::tags('tags', @$wheretobuy->tags($module['modname']), array('data-module' => $module['modname'])) }}
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
        	<a class="btn btn-default no-margin regular-10 uppercase pull-left btn-spinner" href="{{URL::previous()}}">
        		<i class="fa fa-arrow-left hidden"></i> <span class="btn-response-text">Назад</span>
        	</a>
        	<button type="submit" autocomplete="off" class="btn btn-success no-margin regular-10 uppercase btn-form-submit">
        		<i class="fa fa-spinner fa-spin hidden"></i> <span class="btn-response-text">Сохранить</span>
        	</button>
        </footer>
    </section>

{{ Form::close() }}