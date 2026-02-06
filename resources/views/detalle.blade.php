@extends('layouts.principal')
@section('header')
<style>
  @media (max-width: 991px) {
    .product-detail{
      padding-top: 40px !important;
    }  
  }
  @media (min-width: 992px) {
    .product-detail{
      padding-top: 200px !important;
    }  
  }

  .img-thumbnail {
    width: 15%;
    height: 50px;
    object-fit: cover; /* Asegura que la imagen no se deforme y cubra el área */
  }
</style>
@endsection
@section('content')

<div class="hero medium-height jarallax" data-jarallax data-speed="0.2">
    <img class="jarallax-img" src="{{ asset('assets/img/actualidad_riviera_blog.webp') }}" alt="">
    <div class="wrapper opacity-mask d-flex align-items-center justify-content-center text-center animate_hero" data-opacity-mask="rgba(0, 0, 0, 0.5)">
        <div class="container">
            <small class="slide-animated one">Pandora</small>
            <h1 class="slide-animated two">{{ $producto->nombre }}</h1>
        </div>
    </div>
</div>
<!-- /Background Img Parallax -->

@livewire('detalle-component' , ['productoId' => $producto->id])

@if($producto->relacionados()->count() > 0)
  <div class="container mb-4 pb-4">
    <div class="row">
      <div class="col">
        <h2>Productos Relacionados</h2>

        <div class="row">
            @foreach($producto->relacionados() as $productoRelacionado)
                <div class="col-md-6 col-lg-3">
                    @component('includes.producto')
                    @slot('producto' , $productoRelacionado)
                    @endcomponent
                </div>
            @endforeach
        </div>
      </div>
    </div>
  </div>
@endif

@endsection
@section('scripts')
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>

<script>
function changeImage(src) {
    document.getElementById('mainImage').src = src;
    console.log(src);
}

function increaseQuantity() {
    const input = document.getElementById('quantityInput');
    input.value = parseInt(input.value) + 1;
}

function decreaseQuantity() {
    const input = document.getElementById('quantityInput');
    if (parseInt(input.value) > 1) {
        input.value = parseInt(input.value) - 1;
    }
}
</script>

  <script>
    $('.item-nav-car').each(function(index){
      $(this).attr('data-slide' , index);
    })
    

    $('.botones-nav').on('click' , '.item-nav-car' , function(e){
      e.preventDefault()
      slide = $(this).data('slide');
      // console.log(slide)
      $('.prod_pics').trigger('to.owl.carousel', slide)
    })

    $(document).ready(function(){

      var native_width = 0;
      var native_height = 0;

      //Now the mousemove function
      $(".magnify").mousemove(function(e){
        //When the user hovers on the image, the script will first calculate
        //the native dimensions if they don't exist. Only after the native dimensions
        //are available, the script will show the zoomed version.
        if(!native_width && !native_height)
        {
          //This will create a new image object with the same image as that in .small
          //We cannot directly get the dimensions from .small because of the 
          //width specified to 200px in the html. To get the actual dimensions we have
          //created this image object.
          var image_object = new Image();
          image_object.src = $(".small").attr("src");
          
          //This code is wrapped in the .load function which is important.
          //width and height of the object would return 0 if accessed before 
          //the image gets loaded.
          native_width = image_object.width;
          native_height = image_object.height;
        }
        else
        {
          //x/y coordinates of the mouse
          //This is the position of .magnify with respect to the document.
          var magnify_offset = $(this).offset();
          //We will deduct the positions of .magnify from the mouse positions with
          //respect to the document to get the mouse positions with respect to the 
          //container(.magnify)
          var mx = e.pageX - magnify_offset.left;
          var my = e.pageY - magnify_offset.top;
          
          //Finally the code to fade out the glass if the mouse is outside the container
          if(mx < $(this).width() && my < $(this).height() && mx > 0 && my > 0)
          {
            $(".large").fadeIn(100);
          }
          else
          {
            $(".large").fadeOut(100);
          }
          if($(".large").is(":visible"))
          {
            //The background position of .large will be changed according to the position
            //of the mouse over the .small image. So we will get the ratio of the pixel
            //under the mouse pointer with respect to the image and use that to position the 
            //large image inside the magnifying glass
            var rx = Math.round(mx/$(".small").width()*native_width - $(".large").width()/2)*-1;
            var ry = Math.round(my/$(".small").height()*native_height - $(".large").height()/2)*-1;
            var bgp = rx + "px " + ry + "px";
            
            //Time to move the magnifying glass with the mouse
            var px = mx - $(".large").width()/2;
            var py = my - $(".large").height()/2;
            //Now the glass moves with the mouse
            //The logic is to deduct half of the glass's width and height from the 
            //mouse coordinates to place it with its center at the mouse coordinates
            
            //If you hover on the image now, you should see the magnifying glass in action
            $(".large").css({left: px, top: py, backgroundPosition: bgp});
          }
        }
      })
      })

  </script>
@endsection