<div>
    <div class="hero medium-height jarallax" data-jarallax data-speed="0.2" wire:ignore>
        <img class="jarallax-img" src="{{ asset('assets/img/actualidad_riviera_blog.webp') }}" alt="">
        <div class="wrapper opacity-mask d-flex align-items-center justify-content-center text-center animate_hero"
            data-opacity-mask="rgba(0, 0, 0, 0.5)">
            <div class="container">
                <small class="slide-animated one">Pandora</small>
                <h1 class="slide-animated two">Tienda</h1>
            </div>
        </div>
    </div>
    <!-- /Background Img Parallax -->

    <div class="container margin_120_95">

        <div class="row">

            <div class="col-lg-3">
                <aside class="sidebar ltn__shop-sidebar ltn__right-sidebar">
                    <!-- Search Widget -->
                    <div class="widget ltn__search-widget">
                        <form action="#">
                            <input type="text" name="search" placeholder="Buscar..." class="form-control"
                                wire:model.live="buscar">
                            <!-- <button type="submit"><i class="icon-magnifier"></i></button> -->
                        </form>
                    </div>
                    <!-- Price Filter Widget -->
                    <!-- <div class="widget ltn__price-filter-widget">
                            <h4 class="ltn__widget-title">Price</h4>
                            <div class="price_filter">
                                <div class="price_slider_amount">
                                    <input type="submit"  value="Your range:"/> 
                                    <input type="text" class="amount" name="price"  placeholder="Add Your Price" /> 
                                </div>
                                <div class="slider-range"></div>
                            </div>
                        </div> -->

                    <!-- Category Widget -->
                    <div class="widget ltn__menu-widget mt-4">
                        <div class="d-flex flex-column gap-3">
                            <!-- <a href="#" wire:click.prevent="$set('categoriaId' , null )"
                                class="btn text-center {{ $categoriaId == null ? 'active-cat' : 'inactive-cat' }}">Todas</a> -->
                            @foreach(categoriasPublicas() as $categoria)
                                <a href="#" wire:click.prevent="$set('categoriaId' , {{ $categoria->id }})"
                                    class="btn text-center {{ $categoriaId == $categoria->id ? 'active-cat' : 'inactive-cat' }}">{{ $categoria->nombre }}</a>
                            @endforeach
                        </div>
                    </div>


                </aside>
            </div>

            <div class="col-lg-9">
                <div class="isotope-wrapper">
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <!-- @if(!$categoriaId && ! $subcategoriaId)
                                @foreach (categoriasPublicas() as $categoria)
                                    <div class="mb-4" wire:click.prevent="$set('categoriaId' , {{ $categoria->id }})" wire:key="cat-{{ $categoria->id }}">
                                            
                                                <span class="btn_1 mb-4 btn-cats">
                                                    {{ $categoria->nombre }}
                                                </span>
                                            
                                    </div>
                                @endforeach
                            @endif -->

                        @if($categoriaId)
                            @foreach (findCategoria($categoriaId)->subcategorias as $subcategoria)
                                <div wire:click.prevent="$set('subcategoriaId' , {{ $subcategoria->id }})"
                                    wire:key="subcat-{{ $subcategoria->id }}">
                                    <span style="cursor: pointer;"
                                        class="btn text-center {{ $subcategoriaId && $subcategoriaId == $subcategoria->id ? 'active-cat' : 'inactive-cat' }}">
                                        {{ $subcategoria->nombre }}
                                    </span>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="row">
                        @foreach ($productos as $producto)
                            <div class="item col-xl-4 col-lg-6 mb-4">
                                @include('includes.producto')
                            </div>
                        @endforeach
                    </div>
                    <!--/row -->
                </div>
                <!--/isotope-wrapper -->
                @if($subcategoriaId)
                    <div class="d-flex justify-content-center">
                        {{ $productos->links('includes.pagination') }}
                    </div>
                @endif
            </div>

        </div>


        <!-- <div class="pagination__wrapper">
                <ul class="pagination">
                    <li><a href="#0" class="prev"><i class="bi bi-arrow-left-short"></i></a></li>
                    <li>
                        <a href="#0" class="active">1</a>
                    </li>
                    <li>
                        <a href="#0">2</a>
                    </li>
                    <li>
                        <a href="#0">3</a>
                    </li>
                    <li>
                        <a href="#0">4</a>
                    </li>
                    <li><a href="#0" class="next"><i class="bi bi-arrow-right-short"></i></a></li>
                </ul>
            </div> -->
        <!-- /pagination -->

    </div>
    <!--/container -->
</div>