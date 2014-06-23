
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{{(isset($page_title))?$page_title:Config::get('app.default_page_title')}}}</title>
        <meta name="description" content="{{{(isset($page_description))?$page_description:''}}}">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">

        {{ HTML::style('css/fonts.css') }}
        {{ HTML::style('css/normalize.css') }}
        {{ HTML::style('css/main.css') }}
        {{ HTML::style('css/jquery.selectbox.css') }}
        {{ HTML::script('js/vendor/modernizr-2.6.2.min.js') }}
