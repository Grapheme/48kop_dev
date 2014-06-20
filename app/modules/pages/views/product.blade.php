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
                    <div class="slide" data-cat="{{ $product->category_id }}">
                        @if ($image)
                        <img src="{{ $image }}" title="{{ $product->title }}">
                        @endif
                        <h2>{{ $product->title }}</h2>
                        <div class='product-desc'>{{ $product->short }}</div>
                    </div>
                    @endforeach
                </div>
            </section>
        </main>
@stop


@section('scripts')
        {{ HTML::script("js/vendor/fotorama.js") }}
        <script>
                var $fotoramaDiv = $('.fotorama').fotorama({
                    width: '100%',
                    height: '511',
                    nav: false,
                    arrows: 'always',
                    hash: true
                });              

                $(document).on('click', '.rec-filter-li > a', function(e){
                    e.preventDefault();
                    var $cat = $(this).parent().data('cat');
                    $('.rec-filter-li').removeClass('active');
                    $(this).parent().addClass('active');
                    $('.fotorama').removeClass('hidden');
                    $('.fotorama').not('[data-cat="' + $cat + '"]').addClass('hidden');
                });

                var hashOne = window.location.hash.slice(1,2);
                console.log(hashOne);
                $('.fotorama').each( function(){
                    console.log($(this).data('cat'));
                    if($(this).data('cat') == hashOne) {
                        console.log(hashOne);
                        console.log( $(this).data('cat') );
                        $('.fotorama').addClass('hidden');
                        $(this).removeClass('hidden');
                        return false;
                    }
                });
        </script>
@stop
