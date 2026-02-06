<div>
    <div class="container margin_60_35">
	
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="write_review">
                    <h1>Comentario para el producto "{{ findProducto($productoId)->nombre }}"</h1>
                    <div class="rating_submit">
                        <div class="form-group">
                        <label class="d-block">Rating</label>
                        <span class="rating mb-0">
                            <input type="radio" class="rating-input" id="5_star" name="rating-input" value="5" wire:model="comentario.puntos"><label for="5_star" class="rating-star"></label>
                            <input type="radio" class="rating-input" id="4_star" name="rating-input" value="4" wire:model="comentario.puntos"><label for="4_star" class="rating-star"></label>
                            <input type="radio" class="rating-input" id="3_star" name="rating-input" value="3" wire:model="comentario.puntos"><label for="3_star" class="rating-star"></label>
                            <input type="radio" class="rating-input" id="2_star" name="rating-input" value="2" wire:model="comentario.puntos"><label for="2_star" class="rating-star"></label>
                            <input type="radio" class="rating-input" id="1_star" name="rating-input" value="1" wire:model="comentario.puntos"><label for="1_star" class="rating-star"></label>
                        </span>
                        </div>
                    </div>
                    <!-- /rating_submit -->
                    <div class="form-group">
                        <label>Título</label>
                        <input class="form-control" type="text" placeholder="Título del comentario" wire:model="comentario.titulo">
                    </div>
                    <div class="form-group">
                        <label>Comentario</label>
                        <textarea class="form-control" style="height: 180px;" placeholder="Escriba su comentario" wire:model="comentario.comentario"></textarea>
                    </div>
                    
                    <div class="form-group">
                        @include('includes.mensajes')
                    </div>

                    <a href="#" wire:click.prevent="comentar" class="btn_1">Enviar Comentario</a>
                </div>
            </div>
    </div>
    <!-- /row -->
    </div>
    <!-- /container -->
</div>
