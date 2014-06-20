    <div class="outer-wrapper">
        <header class="header">
            <h1 class="logo">
                <a href="/">48 копеек</a>
            </h1>

{{-- Helper::d($_SERVER['REQUEST_URI']) --}}

            <nav>
                <ul class="nav-ul">
                    <li class="nav-li<?=($_SERVER['REQUEST_URI'] == '/' ? ' active' : '')?>">
                        <a href="/">О проекте</a>
                    <li class="nav-li<?=($_SERVER['REQUEST_URI'] == '/product' ? ' active' : '')?>">
                        <a href="/product">Продукция</a>
                    <li class="nav-li">
                        <a id="feedback" href="#">Обратная связь</a>
                    <li class="nav-li">
                        <a id="login" href="#">Войти</a>
                </ul>
            </nav>
        </header>