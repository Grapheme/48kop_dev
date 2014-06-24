@extends(Helper::layout())


@section('style')
    <link rel="stylesheet" href="css/fotorama.css">
@stop


@section('content')
        <main class="product">
            <section class="section-cont">
                <ul class="rec-filter">
                    @foreach(ProductCategory::all() as $category)
                    <li class="rec-filter-li" data-cat="{{ $category->id }}">
                        <a href="#">{{ $category->title }}</a>
                    @endforeach
                </ul>
                <div class="fotorama" data-auto="false">
                    @foreach(Product::orderBy('category_id', 'ASC')->get() as $product)
                    <?
                    $image = $product->photo();
                    if (is_object($image)) { $image = $image->full(); } else { continue; }
                    ?>
                    <div class="slide" id="{{ $product->category_id }}{{ $product->id }}" data-cat="{{ $product->category_id }}">
                        @if ($image)
                        <img src="{{ $image }}" title="{{ $product->title }}">
                        @endif
                        <h2>{{ $product->title }}</h2>
                        <div class='product-desc'>{{ str_replace("\n", "<br/>\n", $product->short) }}</div>
                    </div>
                    @endforeach
                </div>
            </section>
        </main>
@stop


@section('scripts')
        {{ HTML::script("js/vendor/fotorama.js") }}
        <script>

        $(function(){
            function fotoramaInit(){
                var $fotoramaDiv = $('.fotorama').fotorama({
                    width: '100%',
                    height: '511',
                    nav: false,
                    arrows: 'always',
                    hash: true
                });

                return $fotoramaDiv.data('fotorama');
            }
            function showFilter(){
                var $activeCat = $('.fotorama__active .slide').data("cat");
                var $regFilter = $('.rec-filter-li');

                $regFilter.removeClass('active');
                $regFilter.filter("[data-cat='" + $activeCat + "']").addClass('active');
            } 

            var hash = window.location.hash;
            if(hash) { var $itemHash = $(hash).index(); }

            var $recFilter = $('.rec-filter-li');
            var $group = $('.fotorama .slide');
            var $groupArr = {};

            (function searchSlides() {
                $group.each( function(){
                    if(!$groupArr[$(this).data('cat')] || ($groupArr[$(this).data('cat')] === 0) ) {
                        $groupArr[$(this).data('cat')] = '' + $(this).index();
                    }                    
                });
            })();

            var $fotoramaApi = fotoramaInit();

            if(hash) {
                $fotoramaApi.show($itemHash);
                showFilter();
            }

            $('.fotorama').on(
                'fotorama:show fotorama:showend',
                function (e, fotorama) {
                    showFilter();
                }
            );

            $(document).on('click', '.rec-filter-li', function(){
                var $cat = $(this).data('cat');
                $fotoramaApi.show(+$groupArr[$cat]);
                showFilter();
            });
        });     

        </script>
@stop
