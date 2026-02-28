<style>

    .frame-producto {
        position: relative;
        overflow: hidden;
    }

    .descripcion-prod {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        background: linear-gradient(to top, rgba(255, 255, 255, 0.9) 0%, rgba(255, 255, 255, 0.7) 100%);
        padding: 25px;
        transform: translateY(-100%);
        opacity: 0;
        transition: transform 0.4s ease-in-out, opacity 0.4s ease-in-out;
        z-index: 10;
    }

    .frame-producto:hover .descripcion-prod {
        transform: translateY(0);
        opacity: 1;
    }

    .descripcion-prod h5 {
        color: #000000 !important;
    }

    .img-prod-principal{
        height: 300px;
        width:100%;
        object-fit: cover;
        display: block;
    }

    .img-producto-tienda{
        height: 200px;
        object-fit: cover;
    }

    .text-primary{
        color: #D48A1F !important;
    }

    .bg-blue-pri{
        background-color: #D48A1F;
        color: #ffffff !important;
    }

    .titulo-interno{
        color: #D48A1F;
        font-weight: 600;
        font-size: 20px;
    }

    .autor-testimonio{
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        color: #ffffff;
        margin-bottom: 30px;
    }

    .autor-testimonio img{
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 50%;
    }

    .testimonios .slick-track {
        display: flex;
        gap: 1rem;
    }

    .text-bubble{
        background: rgba(255, 255, 255, 0.8);
        padding: 20px;
        border-radius: 3px;
        margin-bottom: 25px;
        text-align: center;
        position: relative;
    }

    .text-bubble::after {
        content: '';
        position: absolute;
        bottom: -10px; /* Posición del pico hacia abajo */
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 0;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        border-top: 10px solid rgba(255, 255, 255, 0.8);
    }

    .frame-producto{
        border: solid thin transparent;
        transition: all ease 0.7s;
        padding:20px;
    }

    .frame-producto:hover{
        border: solid thin #D48A1F;
    }

    .size-price{
        font-size: 20px;
    }

    .precio-antes{
        text-decoration: line-through;
        opacity: 0.7;
    }

    .cantidad-carrito{
        height:45px;
        width: 40px;
        text-align: center;
    }

    .card-nosotros{
        height: 400px;
        background: #ffffff;
        display: flex;
        align-items: center;
        width: 100%;
        margin-bottom: 20px;
    }

    .card-nosotros .card-content{
        width: 100%;
    }

    .card-nosotros .titulo-card{
        font-size: 28px;
        color: #D48A1F;
        font-weight: 600;
    }

    .card-nosotros .descripcion-card{
        font-size: 18px;
    }

    @media screen and (min-width: 1200px) {
        .cv-menu>ul>li {
            display: inline-block;
            margin-right: 10px;
            padding: 22px 0;
            position: relative;
        }
    }

    .btn-cats{
        padding: 15px 30px;
        border: solid thin #D48A1F;
        color: #D48A1F;
        border-radius: 0px;
    }

    .btn-cats.active{
        border: solid thin #000000;
        color: #ffffff;
        background: #000000;
    }

    .list-group-item.active{
        background-color: #000000;
        color: #ffffff;
        border-color: #000000;
    }

    .cursor-pointer{
        cursor: pointer;
    }
    .btn-pri-claro{
        border: dashed 3px #D48A1F;
        color: #D48A1F;
        text-transform: uppercase;
        background: transparent;
        outline: none;
        cursor: pointer;
        display: inline-flex;
        text-decoration: none;
        padding: 14px 25px 14px 25px;
        font-weight: 600;
        transition: all 0.3s ease-in-out;
        border-radius: 5px;
        align-items: center;
        justify-content: center;
        line-height: 1;
    }

    .btn-pri-claro:hover{
        background-color: #D48A1F;
        text-decoration: none;
        color: #ffffff;
    }
    
    .btn-pri-oscuro{
        color: #FFFFFF;
        background-color: #D48A1F;
        font-size: 14px;
        margin-bottom: 0;
        border-radius: 30px;
        padding: 10px 20px;
        text-transform: uppercase;
        margin-top: 15px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn-pri-oscuro:hover{
        background-color: #D48A1F;
        text-decoration: none;
        color: #ffffff;
    }
    
    .btn-pri-blanco{
        color: #6c757d;
        background-color: #ffffff;
        border: 1px solid #6c757d;
        font-size: 14px;
        margin-bottom: 0;
        border-radius: 30px;
        padding: 10px 20px;
        text-transform: uppercase;
        margin-top: 15px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn-pri-blanco:hover{
        background-color: #fafafaff;
        text-decoration: none;
        color: #6c757d;
    }
    
    .btn-pri-rojo{
        color: #FFFFFF;
        background-color: #FF4C4C;
        font-size: 14px;
        margin-bottom: 0;
        border-radius: 30px;
        padding: 10px 20px;
        text-transform: uppercase;
        margin-top: 15px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn-pri-rojo:hover{
        background-color: #FF4C4C;
        text-decoration: none;
        color: #ffffff;
    }

    .card-categoria-home{
        background-color: #F5F7FA;
        padding: 10px;
        border-radius: 10px;
    }
    .card-categoria-home a{
        text-decoration: none;
    }
    .card-categoria-home img{
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-radius: 10px;
        margin-bottom: 15px;
    }
    .card-categoria-home h3{
        color: #000D44;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 10px;
    }

    /* Carrito Boton */

    .cart-bt{
        position: relative;
        align-items: center;
        color: #FFFFFF;
        font-size: 16px;
        text-decoration: none;
        display: inline-block;
        /* padding: 10px; */
        /* height: 40px; */
        /* width: 40px; */
        border-radius: 50%;
        /* border: solid 1px #FFFFFF; */
        transition: all 0.3s ease;
    }
    .cart-bt:hover{
        background-color: rgba(255, 255, 255, 0.8);
        color: #D48A1F;
    }
    .cart-bt svg{
        margin-right: 5px;
    }   
    .cart-bt .cart-cantidad{
        background-color: #04CE78;
        color: #ffffff;
        font-size: 12px;
        font-weight: 600;
        border-radius: 50%;
        width: 18px;
        height: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: absolute;
        top: -4px;
        right: -8px;
    }

    /* Productos home */
    .card-producto-home{
        background-color: #F5F7FA;
        padding: 25px;
        border-radius: 10px;
        display: flex;
    }
    .card-producto-home-content{
        width: 70%;
    }
    .card-producto-home-img{
        width: 30%;
    }
    .card-producto-home-content h3{
        color: #0099D5;
        font-size: 14px;
        font-weight: 400;
        text-transform: uppercase;
        margin-bottom: 5px;
        line-height: 1.2;
    }
    .card-producto-home-content h2{
        color: #000D44;
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 5px;
        line-height: 1.2;
    }
    .card-producto-home-content p{
        color: #788094;
        font-size: 14px;
        margin-bottom: 15px;
    }
    .card-producto-home-content a{
        color: #ffffff;
        background-color: #D48A1F;
        font-size: 14px;
        margin-bottom: 0;
        border-radius: 30px;
        padding: 10px 20px;
        text-transform: uppercase;
        margin-top: 30px;
        text-decoration: none;
    }
    .imagen-card-home{
        height: 100% !important;
        width: 100%;
        object-fit: cover;
        border-radius: 10px;
    }
    .imagen-card-home-prod{
        height: 300px !important;
        width: 100%;
        object-fit: cover;
        border-radius: 10px;
    }
    /* header */
    .search-pri-container{
        position: relative;
    }
    .search-pri-container .search-pri{
        padding-right: 40px;
        border-radius: 30px;
        height: 40px;
        font-size: 14px;
        width: 250px;
        border: 1px solid #CED4DA;
        box-shadow: none;
        transition: all 0.3s ease;
        background-color: #e9e9e9ff;
    }
    .search-pri-container .search-pri-btn{
        position: absolute;
        top: 0;
        right: 0; 
        height: 40px;
        width: 40px;
        padding: 10px;
        border: none;
        background-color: #D48A1F;
        border-radius: 50%;
        color: #ffffff;
    }
    .widget-header h6{
        color: #788094;
        font-size: 16px;
    }
    .widget-header h5{
        color: #000D44;
        font-size: 20px;
    }
    @media (max-width: 991.98px) {
        .hero-style1 .banner-btn{
            margin: 0 auto;
        }
        .hero-titulo{
            font-size: 24px !important;
        }
        .hero-title{
            font-size: 20px !important;
        }
    }

    /* productos Destacados */
    .producto-destacado-1{
        width: 65%;
        display: flex;
        align-items: center;
        justify-content: end;
        /* background-color: #000D44; */
        background-image: url('{{ asset("assets/images/fondo-prod-1.webp") }}');
        background-size: cover;
        background-position: center;
        margin-top: 20px;
        margin-bottom: 20px;
        padding: 30px;
        border-radius: 0 20px 20px 0;
        position: relative;
    }

    .producto-destacado-1::before{
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 13, 68, 0.9);
        border-radius: 0 20px 20px 0;
        z-index: 0;
    }

    .producto-destacado-2{
        width: 30%;
        display: flex;
        align-items: center;
        justify-content: start;
        /* background-color: #0099D5; */
        background-image: url('{{ asset("assets/images/fondo-prod-2.webp") }}');
        background-size: cover;
        background-position: center;
        margin-top: 20px;
        margin-bottom: 20px;
        padding: 30px;
        border-radius: 20px 0 0 20px;
        position: relative;
    }

    .producto-destacado-2::before{
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 153, 213, 0.9);
        border-radius: 20px 0 0 20px;
        z-index: 0;
    }

    .img-destacado-uno{
        height: 520px;
        width: 100%;
        object-fit: cover;
        border-radius: 15px;
    }

    .img-destacado-dos{
        height: 300px;
        width: auto;
        object-fit: cover;
        border-radius: 15px;
        margin-bottom: 15px;
    }

    .producto-destacado-1 h2{
        color: #FFFFFF;
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 15px;
    }
    .producto-destacado-2 h2{
        color: #FFFFFF;
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 15px;
    }
    .producto-destacado-1 p{
        color: #FFFFFF;
    }
    .producto-destacado-2 p{
        color: #FFFFFF;
    }

    @media (max-width: 991.98px) {
        .producto-destacado-1, .producto-destacado-2{
            padding: 20px;
            width: 100%;
            display : block;
            border-radius: 0 0 0 0;
        }
        .producto-destacado-1::before, .producto-destacado-2::before{
            border-radius: 0 0 0 0;
        }
    }

</style>