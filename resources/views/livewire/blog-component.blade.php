<div>
    <!--blog-sec-->
    <div class="my-4 blog-posts blogpage-section w-100 float-left">
        <div class="container">
            <div class="row wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                <div id="blog" class="col-xl-12">
                    <div class="row">
                        @foreach($posts as $post)
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="blog-box twocolumn-blog float-left w-100 post-item mb-4" data-aos="fade-up"
                                    data-aos-duration="700">
                                    <div class="post-item-wrap position-relative">
                                        <div class="post-image">
                                            <a href="{{ route('blog.detalle' , $post->slug) }}">
                                                <img alt="" src="{{ $post->imagen() }}" class="img-fluid">
                                            </a>
                                        </div>
                                        <div class="lower-portion">
                                            <i class="fas fa-user"></i>
                                            <span class="text-size-14 text-mr">Autor : {{ $post->autor }}</span>
                                            <i class="fas fa-tag"></i>
                                            <span class="text-size-14">{{ $post->categoria() }}</span>
                                            <h3>{{ $post->nombre }}</h3>
                                            <p class="mb-0 text-size-16">{{ Str::limit($post->descripcion , 400) }}</p>
                                        </div>
                                        <div class="button-portion loadone_twocol">
                                            <div class="date">
                                                <i class="fas fa-calendar-alt"></i>
                                                <span class="mb-0 text-size-14">{{ $post->created_at->format('M d,Y') }}</span>
                                            </div>
                                            <div class="button">
                                                <a class="mb-0 read_more text-decoration-none"
                                                    href="{{ route('blog.detalle' , $post->slug) }}">Ver</a>
                                            </div>
                                        </div>
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
