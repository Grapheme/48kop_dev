    <div class="outer-wrapper">
        <header class="header">
            <h1 class="logo">
                <a href="/">48 копеек</a>
            </h1>

{{-- Helper::d($_SERVER['REQUEST_URI']) --}}
<?
### LOGIN / LOGOUT ###
$link_text = "Войти";
$link_id = "login";
$user_data = array();
$user_social_info = @json_decode($_COOKIE['user_social_info'], 1);
Config::set('user.user_social_info', $user_social_info);
#Helper::d($user_social_info);
if (is_array($user_social_info) && @$user_social_info['profile'] != '') {
    $link_text = "Выйти";
    $link_id = "logout";
    $user_data = UserSocialInfo::where('profile', $user_social_info['profile'])->first()->toArray();
    Config::set('user.user_data', $user_data);
    #Helper::d(Config::get('user.user_data'));
}
?>

            <nav>
                <ul class="nav-ul">
                    <li class="nav-li<?=($_SERVER['REQUEST_URI'] == '/' ? ' active' : '')?>">
                        <a href="/">О проекте</a>
                    <li class="nav-li<?=($_SERVER['REQUEST_URI'] == '/product' ? ' active' : '')?>">
                        <a href="/product">Продукция</a>
                    <li class="nav-li">
                        <a id="feedback" href="#">Обратная связь</a>
                    <li class="nav-li">
                        <a id="{{ $link_id }}" href="#">{{ $link_text }}</a>
                </ul>
            </nav>
        </header>