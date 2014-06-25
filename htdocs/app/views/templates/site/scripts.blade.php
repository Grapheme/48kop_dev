
        @if(Config::get('app.use_scripts_local'))
        	{{ HTML::script('js/vendor/jquery.min.js') }}
        @else
            {{ HTML::script("//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js") }}
            <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
        @endif
        {{ HTML::script("js/vendor/jquery.selectbox.js") }}

        {{ HTML::script("js/plugins.js") }}
        {{ HTML::script("js/main.js") }}
        {{ HTML::script("//ulogin.ru/js/ulogin.js") }}
        {{ HTML::script("js/system/48hours.js") }}
        
