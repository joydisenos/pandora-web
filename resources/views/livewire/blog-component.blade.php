<div>
    <!--blog-sec-->
    <div class="my-4 blog-posts blogpage-section w-100 float-left">
        <div class="container">
            <div class="row wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                <div id="blog" class="col-xl-12">
                    <div class="row">
                        @foreach($posts as $post)
                            <div class="col-12 col-md-4 mb-4" data-aos="fade-up" data-aos-duration="700">
                                <div class="blog-card">
                                    <div class="blog-card-img-wrap">
                                        <a href="{{ route('blog.detalle', $post->slug) }}">
                                            <img src="{{ $post->imagen() }}" alt="{{ $post->nombre }}" class="blog-card-img">
                                        </a>
                                        <span class="blog-card-badge">
                                            {{ strtoupper($post->categoria() ?? 'CONSEJOS') }}
                                        </span>
                                    </div>
                                    <div class="blog-card-body">
                                        <a href="{{ route('blog.detalle', $post->slug) }}" class="blog-card-title-link">
                                            <h4 class="blog-card-title">{{ Str::limit($post->nombre, 80) }}</h4>
                                        </a>
                                        <p class="mb-3 text-size-14" style="color: #666; font-family: 'Quicksand', sans-serif;">{{ Str::limit($post->descripcion, 120) }}</p>
                                        <a href="{{ route('blog.detalle', $post->slug) }}" class="blog-card-link">LEER MÁS »</a>
                                    </div>
                                    <div class="blog-card-footer">
                                        {{ $post->created_at ? $post->created_at->translatedFormat('d F, Y') : '12 junio, 2022' }} •
                                        2 comentarios
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="col-12 d-flex justify-content-center mt-4 mb-4">
                            {{ $posts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--blog-sec-->
</div>
