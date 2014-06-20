@extends('templates.'.AuthAccount::getStartPage())


@section('style')
<link rel="stylesheet" href="{{ link::path('css/redactor.css') }}" />
@stop


@section('content')
	@include($module['tpl'].'forms.create')
@stop


@section('scripts')
    <script>
    var essence = 'place';
    var essence_name = 'место';
	var validation_rules = {
		name: { required: true }
	};
	var validation_messages = {
		name: { required: 'Укажите название' }
	};
    </script>

    {{ HTML::script('js/modules/48hours.js') }}

    {{ HTML::script('js/plugin/bootstrap-tags/bootstrap-tagsinput.min.js') }}
    {{ HTML::script('js/modules/gallery.js') }}
    {{ HTML::script('js/vendor/jquery.ui.datepicker-ru.js') }}

	<script type="text/javascript">
		if(typeof pageSetUp === 'function'){pageSetUp();}
		if(typeof runFormValidation === 'function'){
			loadScript("{{ asset('js/vendor/jquery-form.min.js'); }}",runFormValidation);
		}else{
			loadScript("{{ asset('js/vendor/jquery-form.min.js'); }}");
		}
	</script>

    {{ HTML::script('js/vendor/redactor.min.js') }}
    {{ HTML::script('js/system/redactor-config.js') }}

@stop
