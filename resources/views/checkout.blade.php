@extends('layouts.principal')
@section('header')
<script src="https://secure.paguelofacil.com/HostedFields/vendor/scripts/WALLET/PFScript.js"></script>
<style>
  @media (max-width: 991px) {
    .container-pri{
      padding-top: 40px !important;
    }  
  }
  @media (min-width: 992px) {
    .container-pri{
      padding-top: 200px !important;
    }  
  }
</style>
@endsection
@section('content')
<div class="hero medium-height jarallax" data-jarallax data-speed="0.2">
    <img class="jarallax-img" src="{{ asset('assets/img/actualidad_riviera_blog.webp') }}" alt="">
    <div class="wrapper opacity-mask d-flex align-items-center justify-content-center text-center animate_hero" data-opacity-mask="rgba(0, 0, 0, 0.5)">
        <div class="container">
            <small class="slide-animated one">Pandora</small>
            <h1 class="slide-animated two">Checkout</h1>
        </div>
    </div>
</div>
<!-- /Background Img Parallax -->
 
  @livewire('checkout-component')
  
@endsection

@section('scripts')
        @php
          $subtotal = Cart::getSubtotal();
          $impuesto = (opcionSlug('impuesto') / 100) * $subtotal;
          $total = $subtotal + $impuesto;
        @endphp
<script>

    const getUrlParam = (key) => new URLSearchParams(window.location.search).get(key);

    pfWallet = pfWallet || {};
    let apiKey = "";
    let cclw = "";
    let totalCompra = '{{ $total }}';

    Livewire.on('mostrar-modal' , modal => {
      $('#container-form').html('');
      totalCompra = $('#total-compra').val();
      console.log(totalCompra)
      pfWallet.openService({
          apiKey: apiKey,
          cclw: cclw
      }).then(function (merchantSetup) {
          startMerchantForm(merchantSetup);
      }, function (error) {
          // console.log(error);
      });
      $('#paguelo_facil').modal('show');
    })
    
    apiKey = "{{ opcionSlug('pf_apiKey') }}"; // AccessTokenApi que encuentras en Mi Empresas-> Llaves
    cclw = "{{ opcionSlug('pf_cclw') }}"; //Código Web
    pfWallet.useAsSandbox(false);
            
    
    let sdk;
    function startMerchantForm(merchantSetup) {
        let paymentInfo = {
            amount: parseFloat(totalCompra),
            discount: 0.0,
            taxAmount: 0.0,
            description: 'Orden de venta web ' . env('APP_NAME')
        };
        // console.log("merchantSetup", merchantSetup);
        let setup = {
            lang: 'es',
            embedded: (true),
            // type: 'lk',
            // code: 'LK-MAIMLMD1FKSQKCHU',
            container: 'container-form',
            onError: function (data) {
                console.error("errors", data);
            },
            onTxSuccess: function (data) {
                // console.log("onTxSuccess", data);
                Livewire.emit( 'ordenar' ,  2);
                // window.location.href = pfWallet.pfHostViews + `/pf/default-receipt/${data?.Oper}`;
            },
            onTxError: function (data) {
                console.error("when the onTxError, in other process", data);
                alert("Hubo un error en la operación");
            },
            onClose: function () {
                // console.log("onClose called");
            }
        };
        sdk = merchantSetup.init(
            merchantSetup.dataMerchant,
            paymentInfo,
            setup
        );
    }

</script>
@endsection

@section('modales')
<div class="modal fade" id="payments_transferencia" tabindex="-1" role="dialog" aria-labelledby="payments_method_title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title" id="payments_method_title">Transferencia ACH</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
    <p>{!! nl2br(opcionSlug('datos_transferencia')) !!}</p>
    </div>
  </div>
  </div>
</div>

<div class="modal fade" id="paguelo_facil" tabindex="-1" role="dialog" aria-labelledby="payments_method_title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title" id="paguelo_facil_title">PagueloFacil</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
      <div align="center">
          <div id="container-form" style="width: 100%;"></div>
      </div>
    </div>
  </div>
  </div>
</div>
@endsection