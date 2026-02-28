<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\ContactoMail;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\FacturacionController;
use Illuminate\Http\Response;
use App\Services\ProductImportService;


// 
// CARGA DE PRODUCTOS INICIO
// Route::get('/cargar-productos', function (Request $request) {
    
//     // Array de productos procesados del CSV
//     $productos = [
//         [
//             'id_producto' => '988506',
//             'id_padre' => null,
//             'sku_producto' => '',
//             'nombre' => 'Almohada Full Body',
//             'talla' => null,
//             'color' => null,
//             'existencia' => 10,
//             'precio' => 69.99,
//             'descripcion' => 'Nuestra almohada full body de descanso abarca toda la longitud del cuerpo, diseñada para brindar soporte y comodidad al dormir.',
//             'imagen' => 'full-body-copy-copia.jpg',
//             'categoria' => 'Almohadas'
//         ],
//         [
//             'id_producto' => '988518',
//             'id_padre' => null,
//             'sku_producto' => '',
//             'nombre' => 'Protector de colchón acolchonado Impermeable',
//             'talla' => null,
//             'color' => null,
//             'existencia' => 0,
//             'precio' => 0,
//             'descripcion' => 'Diseñado para proteger el colchón de manchas, derrames, sudor y líquidos.',
//             'imagen' => 'Acolchado-copy-copia.jpg',
//             'categoria' => 'Protectores',
//             'variaciones' => [
//                 [
//                     'id_producto' => '988519',
//                     'id_padre' => '988518',
//                     'nombre' => 'Protector de colchón acolchonado Impermeable - Full',
//                     'talla' => 'Full',
//                     'existencia' => 0,
//                     'precio' => 26.99,
//                     'peso' => 200,
//                     'medida' => '36x140'
//                 ],
//                 [
//                     'id_producto' => '988520',
//                     'id_padre' => '988518',
//                     'nombre' => 'Protector de colchón acolchonado Impermeable - King',
//                     'talla' => 'King',
//                     'existencia' => 20,
//                     'precio' => 35.99,
//                     'peso' => 200,
//                     'medida' => '36x200'
//                 ],
//                 [
//                     'id_producto' => '988521',
//                     'id_padre' => '988518',
//                     'nombre' => 'Protector de colchón acolchonado Impermeable - Queen',
//                     'talla' => 'Queen',
//                     'existencia' => 0,
//                     'precio' => 30.99,
//                     'peso' => 120,
//                     'medida' => '36x100'
//                 ],
//                 [
//                     'id_producto' => '988522',
//                     'id_padre' => '988518',
//                     'nombre' => 'Protector de colchón acolchonado Impermeable - Twin',
//                     'talla' => 'Twin',
//                     'existencia' => 0,
//                     'precio' => 23.99,
//                     'peso' => 190,
//                     'medida' => '36x100'
//                 ]
//             ]
//         ],
//         [
//             'id_producto' => '988527',
//             'id_padre' => null,
//             'sku_producto' => '',
//             'nombre' => 'Protector de colchón Deluxe Impermeable',
//             'talla' => null,
//             'color' => null,
//             'existencia' => 0,
//             'precio' => 0,
//             'descripcion' => 'Protector de colchón deluxe diseñado para proteger el colchón de derrames, manchas y líquidos.',
//             'imagen' => 'deluxe-empaque-copy-copia.jpg',
//             'categoria' => 'Protectores',
//             'variaciones' => [
//                 [
//                     'id_producto' => '988528',
//                     'id_padre' => '988527',
//                     'nombre' => 'Protector de colchón Deluxe Impermeable - Twin',
//                     'talla' => 'Twin',
//                     'existencia' => 30,
//                     'precio' => 15.99,
//                     'peso' => 190,
//                     'medida' => '36x100'
//                 ],
//                 [
//                     'id_producto' => '988529',
//                     'id_padre' => '988527',
//                     'nombre' => 'Protector de colchón Deluxe Impermeable - Full',
//                     'talla' => 'Full',
//                     'existencia' => 30,
//                     'precio' => 18.99,
//                     'peso' => 200,
//                     'medida' => '36x140'
//                 ],
//                 [
//                     'id_producto' => '988530',
//                     'id_padre' => '988527',
//                     'nombre' => 'Protector de colchón Deluxe Impermeable - King',
//                     'talla' => 'King',
//                     'existencia' => 50,
//                     'precio' => 22.99,
//                     'peso' => 200,
//                     'medida' => '36x200'
//                 ],
//                 [
//                     'id_producto' => '988531',
//                     'id_padre' => '988527',
//                     'nombre' => 'Protector de colchón Deluxe Impermeable - Queen',
//                     'talla' => 'Queen',
//                     'existencia' => 29,
//                     'precio' => 19.99,
//                     'peso' => 200,
//                     'medida' => '36x150'
//                 ]
//             ]
//         ],
//         [
//             'id_producto' => '988534',
//             'id_padre' => null,
//             'sku_producto' => '',
//             'nombre' => 'Protector de colchón Impermeable',
//             'talla' => null,
//             'color' => null,
//             'existencia' => 0,
//             'precio' => 0,
//             'descripcion' => 'Protector de colchón diseñado para proteger el colchón de derrames, manchas y líquidos.',
//             'imagen' => 'Pandora-044-copia.jpg',
//             'categoria' => 'Protectores',
//             'variaciones' => [
//                 [
//                     'id_producto' => '988535',
//                     'id_padre' => '988534',
//                     'nombre' => 'Protector de colchón Impermeable - Twin',
//                     'talla' => 'Twin',
//                     'existencia' => 0,
//                     'precio' => 12.99,
//                     'peso' => 190,
//                     'medida' => '36x100'
//                 ],
//                 [
//                     'id_producto' => '988536',
//                     'id_padre' => '988534',
//                     'nombre' => 'Protector de colchón Impermeable - Full',
//                     'talla' => 'Full',
//                     'existencia' => 19,
//                     'precio' => 14.99,
//                     'peso' => 200,
//                     'medida' => '36x140'
//                 ],
//                 [
//                     'id_producto' => '988537',
//                     'id_padre' => '988534',
//                     'nombre' => 'Protector de colchón Impermeable - King',
//                     'talla' => 'King',
//                     'existencia' => 0,
//                     'precio' => 18.99,
//                     'peso' => 200,
//                     'medida' => '36x200'
//                 ],
//                 [
//                     'id_producto' => '988538',
//                     'id_padre' => '988534',
//                     'nombre' => 'Protector de colchón Impermeable - Queen',
//                     'talla' => 'Queen',
//                     'existencia' => 20,
//                     'precio' => 16.99,
//                     'peso' => 200,
//                     'medida' => '36x150'
//                 ]
//             ]
//         ],
//         [
//             'id_producto' => '988543',
//             'id_padre' => null,
//             'sku_producto' => '',
//             'nombre' => 'Protector de colchón impermeable para cuna',
//             'talla' => null,
//             'color' => null,
//             'existencia' => 29,
//             'precio' => 9.99,
//             'descripcion' => 'Protector de colchón de cuna diseñado para brindar protección al colchón de la cuna del bebé.',
//             'imagen' => 'Bebe-empaque-copy-copia.jpg',
//             'categoria' => 'Protectores'
//         ],
//         [
//             'id_producto' => '988550',
//             'id_padre' => null,
//             'sku_producto' => '',
//             'nombre' => 'Protector de almohada impermeable',
//             'talla' => null,
//             'color' => null,
//             'existencia' => 0,
//             'precio' => 0,
//             'descripcion' => 'Protector de almohada con cierre de velcro e impermeable para proporcionar una barrera eficaz contra la humedad.',
//             'imagen' => 'Velcro-copy-copia.jpg',
//             'categoria' => 'Protectores',
//             'variaciones' => [
//                 [
//                     'id_producto' => '988553',
//                     'id_padre' => '988550',
//                     'nombre' => 'Protector de almohada impermeable - King',
//                     'talla' => 'King',
//                     'existencia' => 30,
//                     'precio' => 6.99,
//                     'peso' => 51,
//                     'medida' => '94'
//                 ],
//                 [
//                     'id_producto' => '988554',
//                     'id_padre' => '988550',
//                     'nombre' => 'Protector de almohada impermeable - Queen',
//                     'talla' => 'Queen',
//                     'existencia' => 30,
//                     'precio' => 5.99,
//                     'peso' => 51,
//                     'medida' => '74'
//                 ]
//             ]
//         ],
//         [
//             'id_producto' => '988558',
//             'id_padre' => null,
//             'sku_producto' => '',
//             'nombre' => 'Frazadas Fannel Hoteleras Blanco',
//             'talla' => null,
//             'color' => null,
//             'existencia' => 0,
//             'precio' => 0,
//             'descripcion' => 'Frazadas de ropa de cama para proporcionar calidez y comodidad.',
//             'imagen' => 'ZED_4046-copia.jpg',
//             'categoria' => 'Frazadas',
//             'variaciones' => [
//                 [
//                     'id_producto' => '988559',
//                     'id_padre' => '988558',
//                     'nombre' => 'Frazadas Fannel Hoteleras Blanco - Twin',
//                     'talla' => 'Twin',
//                     'existencia' => 30,
//                     'precio' => 19.99,
//                     'peso' => 167,
//                     'medida' => '228'
//                 ],
//                 [
//                     'id_producto' => '988561',
//                     'id_padre' => '988558',
//                     'nombre' => 'Frazadas Fannel Hoteleras Blanco - King',
//                     'talla' => 'King',
//                     'existencia' => 0,
//                     'precio' => 24.99,
//                     'peso' => 260,
//                     'medida' => '228'
//                 ],
//                 [
//                     'id_producto' => '988562',
//                     'id_padre' => '988558',
//                     'nombre' => 'Frazadas Fannel Hoteleras Blanco - Full/Queen',
//                     'talla' => 'Full/Queen',
//                     'existencia' => 30,
//                     'precio' => 21.99,
//                     'peso' => 203,
//                     'medida' => '228'
//                 ]
//             ]
//         ],
//         [
//             'id_producto' => '988564',
//             'id_padre' => null,
//             'sku_producto' => '',
//             'nombre' => 'Duvet Algodón',
//             'talla' => null,
//             'color' => null,
//             'existencia' => 0,
//             'precio' => 0,
//             'descripcion' => 'Duvet hotelero de algodón para proporcionar comodidad y estilo.',
//             'imagen' => 'Duvet-Alg-Empaque-copy-copia.jpg',
//             'categoria' => 'Sobrecamas y Colchas',
//             'variaciones' => [
//                 [
//                     'id_producto' => '988566',
//                     'id_padre' => '988564',
//                     'nombre' => 'Duvet Algodón - Full',
//                     'talla' => 'Full',
//                     'existencia' => 20,
//                     'precio' => 57.99,
//                     'peso' => 208,
//                     'medida' => '229'
//                 ],
//                 [
//                     'id_producto' => '988567',
//                     'id_padre' => '988564',
//                     'nombre' => 'Duvet Algodón - King',
//                     'talla' => 'King',
//                     'existencia' => 20,
//                     'precio' => 69.99,
//                     'peso' => 267,
//                     'medida' => '229'
//                 ],
//                 [
//                     'id_producto' => '988568',
//                     'id_padre' => '988564',
//                     'nombre' => 'Duvet Algodón - Queen',
//                     'talla' => 'Queen',
//                     'existencia' => 20,
//                     'precio' => 64.99,
//                     'peso' => 229,
//                     'medida' => '229'
//                 ]
//             ]
//         ],
//         [
//             'id_producto' => '988581',
//             'id_padre' => null,
//             'sku_producto' => '',
//             'nombre' => 'Topper',
//             'talla' => null,
//             'color' => null,
//             'existencia' => 0,
//             'precio' => 0,
//             'descripcion' => 'Topper diseñado para colocarse sobre el colchón principal para añadir comodidad.',
//             'imagen' => 'Topper-Empaque-copy-copia.jpg',
//             'categoria' => 'Sobrecamas y Colchas',
//             'variaciones' => [
//                 [
//                     'id_producto' => '988582',
//                     'id_padre' => '988581',
//                     'nombre' => 'Topper - Full',
//                     'talla' => 'Full',
//                     'existencia' => 40,
//                     'precio' => 46.99,
//                     'peso' => 200,
//                     'medida' => '5x140'
//                 ],
//                 [
//                     'id_producto' => '988583',
//                     'id_padre' => '988581',
//                     'nombre' => 'Topper - King',
//                     'talla' => 'King',
//                     'existencia' => 40,
//                     'precio' => 57.99,
//                     'peso' => 200,
//                     'medida' => '5x200'
//                 ],
//                 [
//                     'id_producto' => '988584',
//                     'id_padre' => '988581',
//                     'nombre' => 'Topper - Queen',
//                     'talla' => 'Queen',
//                     'existencia' => 40,
//                     'precio' => 52.99,
//                     'peso' => 200,
//                     'medida' => '5x150'
//                 ],
//                 [
//                     'id_producto' => '988585',
//                     'id_padre' => '988581',
//                     'nombre' => 'Topper - Twin',
//                     'talla' => 'Twin',
//                     'existencia' => 40,
//                     'precio' => 42.99,
//                     'peso' => 200,
//                     'medida' => '5x100'
//                 ]
//             ]
//         ],
//         [
//             'id_producto' => '988604',
//             'id_padre' => null,
//             'sku_producto' => '',
//             'nombre' => 'Duvet microfibra',
//             'talla' => null,
//             'color' => null,
//             'existencia' => 0,
//             'precio' => 0,
//             'descripcion' => 'Duvet hotelero de microfibra para proporcionar comodidad y estilo.',
//             'imagen' => 'Duvet-Microfibra-Empaque-copy-copia.jpg',
//             'categoria' => 'Sobrecamas y Colchas',
//             'variaciones' => [
//                 [
//                     'id_producto' => '988605',
//                     'id_padre' => '988604',
//                     'nombre' => 'Duvet microfibra - Twin',
//                     'talla' => 'Twin',
//                     'existencia' => 30,
//                     'precio' => 42.99,
//                     'peso' => 173,
//                     'medida' => '224'
//                 ],
//                 [
//                     'id_producto' => '988606',
//                     'id_padre' => '988604',
//                     'nombre' => 'Duvet microfibra - Full/Queen',
//                     'talla' => 'Full/Queen',
//                     'existencia' => 40,
//                     'precio' => 52.99,
//                     'peso' => 270,
//                     'medida' => '224'
//                 ],
//                 [
//                     'id_producto' => '988607',
//                     'id_padre' => '988604',
//                     'nombre' => 'Duvet microfibra - King',
//                     'talla' => 'King',
//                     'existencia' => 40,
//                     'precio' => 57.99,
//                     'peso' => 224,
//                     'medida' => '224'
//                 ]
//             ]
//         ],
//         [
//             'id_producto' => '988642',
//             'id_padre' => null,
//             'sku_producto' => '',
//             'nombre' => 'Frazadas Fannel Hoteleras Crema',
//             'talla' => null,
//             'color' => null,
//             'existencia' => 0,
//             'precio' => 0,
//             'descripcion' => 'Frazadas de ropa de cama para proporcionar calidez y comodidad.',
//             'imagen' => 'Frazada-Crema-copy-copia.jpg',
//             'categoria' => 'Frazadas',
//             'variaciones' => [
//                 [
//                     'id_producto' => '988643',
//                     'id_padre' => '988642',
//                     'nombre' => 'Frazadas Fannel Hoteleras Crema - Twin',
//                     'talla' => 'Twin',
//                     'existencia' => 50,
//                     'precio' => 19.99,
//                     'peso' => 167,
//                     'medida' => '228'
//                 ],
//                 [
//                     'id_producto' => '988644',
//                     'id_padre' => '988642',
//                     'nombre' => 'Frazadas Fannel Hoteleras Crema - King',
//                     'talla' => 'King',
//                     'existencia' => 30,
//                     'precio' => 24.99,
//                     'peso' => 260,
//                     'medida' => '228'
//                 ],
//                 [
//                     'id_producto' => '988645',
//                     'id_padre' => '988642',
//                     'nombre' => 'Frazadas Fannel Hoteleras Crema - Full/Queen',
//                     'talla' => 'Full/Queen',
//                     'existencia' => 30,
//                     'precio' => 21.99,
//                     'peso' => 203,
//                     'medida' => '228'
//                 ]
//             ]
//         ],
//         [
//             'id_producto' => '988646',
//             'id_padre' => null,
//             'sku_producto' => '',
//             'nombre' => 'Frazadas Fannel Hoteleras Azul',
//             'talla' => null,
//             'color' => null,
//             'existencia' => 0,
//             'precio' => 0,
//             'descripcion' => 'Frazadas de ropa de cama para proporcionar calidez y comodidad.',
//             'imagen' => 'ZED_4051-copia.jpg',
//             'categoria' => 'Frazadas',
//             'variaciones' => [
//                 [
//                     'id_producto' => '988647',
//                     'id_padre' => '988646',
//                     'nombre' => 'Frazadas Fannel Hoteleras Azul - Twin',
//                     'talla' => 'Twin',
//                     'existencia' => 30,
//                     'precio' => 19.99,
//                     'peso' => 167,
//                     'medida' => '228'
//                 ],
//                 [
//                     'id_producto' => '988648',
//                     'id_padre' => '988646',
//                     'nombre' => 'Frazadas Fannel Hoteleras Azul - King',
//                     'talla' => 'King',
//                     'existencia' => 29,
//                     'precio' => 24.99,
//                     'peso' => 260,
//                     'medida' => '228'
//                 ],
//                 [
//                     'id_producto' => '988649',
//                     'id_padre' => '988646',
//                     'nombre' => 'Frazadas Fannel Hoteleras Azul - Full/Queen',
//                     'talla' => 'Full/Queen',
//                     'existencia' => 30,
//                     'precio' => 21.99,
//                     'peso' => 203,
//                     'medida' => '228'
//                 ]
//             ]
//         ],
//         [
//             'id_producto' => '988650',
//             'id_padre' => null,
//             'sku_producto' => '',
//             'nombre' => 'Frazadas Fannel Hoteleras Gris',
//             'talla' => null,
//             'color' => null,
//             'existencia' => 0,
//             'precio' => 0,
//             'descripcion' => 'Frazadas de ropa de cama para proporcionar calidez y comodidad.',
//             'imagen' => 'ZED_4049-copia.jpg',
//             'categoria' => 'Frazadas',
//             'variaciones' => [
//                 [
//                     'id_producto' => '988651',
//                     'id_padre' => '988650',
//                     'nombre' => 'Frazadas Fannel Hoteleras Gris - Twin',
//                     'talla' => 'Twin',
//                     'existencia' => 30,
//                     'precio' => 19.99,
//                     'peso' => 167,
//                     'medida' => '228'
//                 ],
//                 [
//                     'id_producto' => '988652',
//                     'id_padre' => '988650',
//                     'nombre' => 'Frazadas Fannel Hoteleras Gris - King',
//                     'talla' => 'King',
//                     'existencia' => 30,
//                     'precio' => 24.99,
//                     'peso' => 260,
//                     'medida' => '228'
//                 ],
//                 [
//                     'id_producto' => '988653',
//                     'id_padre' => '988650',
//                     'nombre' => 'Frazadas Fannel Hoteleras Gris - Full/Queen',
//                     'talla' => 'Full/Queen',
//                     'existencia' => 30,
//                     'precio' => 21.99,
//                     'peso' => 203,
//                     'medida' => '228'
//                 ]
//             ]
//         ],
//         [
//             'id_producto' => '988660',
//             'id_padre' => null,
//             'sku_producto' => '',
//             'nombre' => 'Sabanas Blancas',
//             'talla' => null,
//             'color' => null,
//             'existencia' => 0,
//             'precio' => 0,
//             'descripcion' => 'Sábanas suaves al tacto de microfibra de alta calidad.',
//             'imagen' => 'Set-de-Sabana-Empaque.jpg',
//             'categoria' => 'Sabanas y Fundas',
//             'variaciones' => [
//                 [
//                     'id_producto' => '988661',
//                     'id_padre' => '988660',
//                     'nombre' => 'Sabanas Blancas - Twin',
//                     'talla' => 'Twin',
//                     'existencia' => 0,
//                     'precio' => 19.99
//                 ],
//                 [
//                     'id_producto' => '988662',
//                     'id_padre' => '988660',
//                     'nombre' => 'Sabanas Blancas - King',
//                     'talla' => 'King',
//                     'existencia' => 30,
//                     'precio' => 29.99
//                 ],
//                 [
//                     'id_producto' => '988663',
//                     'id_padre' => '988660',
//                     'nombre' => 'Sabanas Blancas - Queen',
//                     'talla' => 'Queen',
//                     'existencia' => 29,
//                     'precio' => 24.99
//                 ],
//                 [
//                     'id_producto' => '988664',
//                     'id_padre' => '988660',
//                     'nombre' => 'Sabanas Blancas - Full',
//                     'talla' => 'Full',
//                     'existencia' => 29,
//                     'precio' => 21.99
//                 ]
//             ]
//         ],
//         [
//             'id_producto' => '988667',
//             'id_padre' => null,
//             'sku_producto' => '',
//             'nombre' => 'Set Fundas de micro fibra',
//             'talla' => null,
//             'color' => null,
//             'existencia' => 0,
//             'precio' => 0,
//             'descripcion' => 'Fundas de microfibra de alta calidad.',
//             'imagen' => 'Set-de-Fundas.jpg',
//             'categoria' => 'Sabanas y Fundas',
//             'variaciones' => [
//                 [
//                     'id_producto' => '988670',
//                     'id_padre' => '988667',
//                     'nombre' => 'Set Fundas de micro fibra - Standard/Queen',
//                     'talla' => 'Standard/Queen',
//                     'existencia' => 0,
//                     'precio' => 5.99
//                 ],
//                 [
//                     'id_producto' => '988671',
//                     'id_padre' => '988667',
//                     'nombre' => 'Set Fundas de micro fibra - King',
//                     'talla' => 'King',
//                     'existencia' => 50,
//                     'precio' => 6.99
//                 ]
//             ]
//         ],
//         [
//             'id_producto' => '988674',
//             'id_padre' => null,
//             'sku_producto' => '',
//             'nombre' => 'Funda de almohada de bebe',
//             'talla' => null,
//             'color' => null,
//             'existencia' => 46,
//             'precio' => 3.99,
//             'descripcion' => 'Funda de almohada para bebé, suave y delicada.',
//             'imagen' => 'woocommerce-placeholder.png',
//             'categoria' => 'Sabanas y Fundas'
//         ],
//         [
//             'id_producto' => '988681',
//             'id_padre' => null,
//             'sku_producto' => '',
//             'nombre' => 'Toallas de cuerpo',
//             'talla' => null,
//             'color' => null,
//             'existencia' => 0,
//             'precio' => 0,
//             'descripcion' => 'Toallas hoteleras de alta calidad 100% algodón.',
//             'imagen' => 'Toalla-cuerpo-copy.png',
//             'categoria' => 'Toallas',
//             'variaciones' => [
//                 [
//                     'id_producto' => '988682',
//                     'id_padre' => '988681',
//                     'nombre' => 'Toallas de cuerpo - 27x54',
//                     'talla' => '27x54',
//                     'existencia' => 0,
//                     'precio' => 12.99
//                 ],
//                 [
//                     'id_producto' => '988683',
//                     'id_padre' => '988681',
//                     'nombre' => 'Toallas de cuerpo - 27x50',
//                     'talla' => '27x50',
//                     'existencia' => 0,
//                     'precio' => 9.99
//                 ],
//                 [
//                     'id_producto' => '988684',
//                     'id_padre' => '988681',
//                     'nombre' => 'Toallas de cuerpo - 30x60',
//                     'talla' => '30x60',
//                     'existencia' => 0,
//                     'precio' => 14.99
//                 ]
//             ]
//         ],
//         [
//             'id_producto' => '988688',
//             'id_padre' => null,
//             'sku_producto' => '',
//             'nombre' => 'Toallas de mano',
//             'talla' => null,
//             'color' => null,
//             'existencia' => 0,
//             'precio' => 0,
//             'descripcion' => 'Toallas de mano 100% algodón.',
//             'imagen' => 'Toalla-mano-copy.png',
//             'categoria' => 'Toallas',
//             'variaciones' => [
//                 [
//                     'id_producto' => '988690',
//                     'id_padre' => '988688',
//                     'nombre' => 'Toallas de mano - 16x30',
//                     'talla' => '16x30',
//                     'existencia' => 80,
//                     'precio' => 3.99
//                 ]
//             ]
//         ],
//         [
//             'id_producto' => '988694',
//             'id_padre' => null,
//             'sku_producto' => '',
//             'nombre' => 'Toallas de piso',
//             'talla' => null,
//             'color' => null,
//             'existencia' => 0,
//             'precio' => 0,
//             'descripcion' => 'Toallas de piso 100% algodón para absorber humedad.',
//             'imagen' => 'Toalla-piso-copy.png',
//             'categoria' => 'Toallas',
//             'variaciones' => [
//                 [
//                     'id_producto' => '988695',
//                     'id_padre' => '988694',
//                     'nombre' => 'Toallas de piso - 20x30',
//                     'talla' => '20x30',
//                     'existencia' => 30,
//                     'precio' => 7.99
//                 ],
//                 [
//                     'id_producto' => '989125',
//                     'id_padre' => '988694',
//                     'nombre' => 'Toallas de piso - 20x25',
//                     'talla' => '20x25',
//                     'existencia' => 31,
//                     'precio' => 5.99
//                 ]
//             ]
//         ],
//         [
//             'id_producto' => '988698',
//             'id_padre' => null,
//             'sku_producto' => '',
//             'nombre' => 'Toallas de cara',
//             'talla' => null,
//             'color' => null,
//             'existencia' => 0,
//             'precio' => 0,
//             'descripcion' => 'Toallas de cara absorbentes y cómodas.',
//             'imagen' => 'Toalla-cara-copy.png',
//             'categoria' => 'Toallas',
//             'variaciones' => [
//                 [
//                     'id_producto' => '988699',
//                     'id_padre' => '988698',
//                     'nombre' => 'Toallas de cara - 13x13',
//                     'talla' => '13x13',
//                     'existencia' => 100,
//                     'precio' => 1.49
//                 ],
//                 [
//                     'id_producto' => '989124',
//                     'id_padre' => '988698',
//                     'nombre' => 'Toallas de cara - 12x12',
//                     'talla' => '12x12',
//                     'existencia' => 100,
//                     'precio' => 1.20
//                 ]
//             ]
//         ],
//         [
//             'id_producto' => '988702',
//             'id_padre' => null,
//             'sku_producto' => '',
//             'nombre' => 'Almohada Down Alternative',
//             'talla' => null,
//             'color' => null,
//             'existencia' => 0,
//             'precio' => 0,
//             'descripcion' => 'Almohada con sensación acolchada suave y de soporte.',
//             'imagen' => 'almohada-lujo-EMP-copy-copia.jpg',
//             'categoria' => 'Almohadas',
//             'variaciones' => [
//                 [
//                     'id_producto' => '988703',
//                     'id_padre' => '988702',
//                     'nombre' => 'Almohada Down Alternative - Estándar',
//                     'talla' => 'Estándar',
//                     'existencia' => 30,
//                     'precio' => 19.99,
//                     'peso' => 45,
//                     'medida' => '65'
//                 ],
//                 [
//                     'id_producto' => '988704',
//                     'id_padre' => '988702',
//                     'nombre' => 'Almohada Down Alternative - Queen',
//                     'talla' => 'Queen',
//                     'existencia' => 50,
//                     'precio' => 21.99,
//                     'peso' => 50,
//                     'medida' => '70'
//                 ],
//                 [
//                     'id_producto' => '988705',
//                     'id_padre' => '988702',
//                     'nombre' => 'Almohada Down Alternative - King',
//                     'talla' => 'King',
//                     'existencia' => 57,
//                     'precio' => 24.99,
//                     'peso' => 50,
//                     'medida' => '90'
//                 ]
//             ]
//         ],
//         [
//             'id_producto' => '988707',
//             'id_padre' => null,
//             'sku_producto' => '',
//             'nombre' => 'Almohada Extra Suave',
//             'talla' => null,
//             'color' => null,
//             'existencia' => 0,
//             'precio' => 0,
//             'descripcion' => 'Almohada con sensación extra suave para una experiencia de descanso cómoda.',
//             'imagen' => 'extra-suave-EMP-copy-copia.jpg',
//             'categoria' => 'Almohadas',
//             'variaciones' => [
//                 [
//                     'id_producto' => '988712',
//                     'id_padre' => '988707',
//                     'nombre' => 'Almohada Extra Suave - Estándar',
//                     'talla' => 'Estándar',
//                     'existencia' => 40,
//                     'precio' => 19.99,
//                     'peso' => 45,
//                     'medida' => '65'
//                 ],
//                 [
//                     'id_producto' => '988713',
//                     'id_padre' => '988707',
//                     'nombre' => 'Almohada Extra Suave - King',
//                     'talla' => 'King',
//                     'existencia' => 59,
//                     'precio' => 24.99,
//                     'peso' => 50,
//                     'medida' => '90'
//                 ],
//                 [
//                     'id_producto' => '988714',
//                     'id_padre' => '988707',
//                     'nombre' => 'Almohada Extra Suave - Queen',
//                     'talla' => 'Queen',
//                     'existencia' => 30,
//                     'precio' => 21.99,
//                     'peso' => 50,
//                     'medida' => '70'
//                 ]
//             ]
//         ],
//         [
//             'id_producto' => '988716',
//             'id_padre' => null,
//             'sku_producto' => '',
//             'nombre' => 'Almohada de lujo mixta con pluma de ganso y fibra',
//             'talla' => null,
//             'color' => null,
//             'existencia' => 0,
//             'precio' => 0,
//             'descripcion' => 'Almohada con relleno de 50% fibra y 50% plumas de ganso.',
//             'imagen' => 'alm-MIX-pluma-empaque-copy-copia.jpg',
//             'categoria' => 'Almohadas',
//             'variaciones' => [
//                 [
//                     'id_producto' => '988720',
//                     'id_padre' => '988716',
//                     'nombre' => 'Almohada de lujo mixta - Estándar',
//                     'talla' => 'Estándar',
//                     'existencia' => 60,
//                     'precio' => 19.99,
//                     'peso' => 45,
//                     'medida' => '65'
//                 ],
//                 [
//                     'id_producto' => '988721',
//                     'id_padre' => '988716',
//                     'nombre' => 'Almohada de lujo mixta - King',
//                     'talla' => 'King',
//                     'existencia' => 0,
//                     'precio' => 24.99,
//                     'peso' => 50,
//                     'medida' => '90'
//                 ],
//                 [
//                     'id_producto' => '988722',
//                     'id_padre' => '988716',
//                     'nombre' => 'Almohada de lujo mixta - Queen',
//                     'talla' => 'Queen',
//                     'existencia' => 60,
//                     'precio' => 21.99,
//                     'peso' => 50,
//                     'medida' => '70'
//                 ]
//             ]
//         ],
//         [
//             'id_producto' => '988724',
//             'id_padre' => null,
//             'sku_producto' => '',
//             'nombre' => 'Almohada Natural Fibra MemoryFoam',
//             'talla' => null,
//             'color' => null,
//             'existencia' => 0,
//             'precio' => 0,
//             'descripcion' => 'Almohada con memory foam que se adapta a la forma única de la cabeza y el cuello.',
//             'imagen' => 'natural-queen-copy-copia.jpg',
//             'categoria' => 'Almohadas',
//             'variaciones' => [
//                 [
//                     'id_producto' => '988725',
//                     'id_padre' => '988724',
//                     'nombre' => 'Almohada Natural Fibra MemoryFoam - King',
//                     'talla' => 'King',
//                     'existencia' => 20,
//                     'precio' => 24.99,
//                     'peso' => 50,
//                     'medida' => '90'
//                 ],
//                 [
//                     'id_producto' => '988726',
//                     'id_padre' => '988724',
//                     'nombre' => 'Almohada Natural Fibra MemoryFoam - Queen',
//                     'talla' => 'Queen',
//                     'existencia' => 20,
//                     'precio' => 21.99,
//                     'peso' => 50,
//                     'medida' => '70'
//                 ]
//             ]
//         ],
//         [
//             'id_producto' => '988735',
//             'id_padre' => null,
//             'sku_producto' => '',
//             'nombre' => 'Almohada Cool',
//             'talla' => null,
//             'color' => null,
//             'existencia' => 0,
//             'precio' => 0,
//             'descripcion' => 'Almohada con tela fría para una sensación fresca y refrescante.',
//             'imagen' => 'almohada-cool-empa-copy-copia.jpg',
//             'categoria' => 'Almohadas',
//             'variaciones' => [
//                 [
//                     'id_producto' => '988736',
//                     'id_padre' => '988735',
//                     'nombre' => 'Almohada Cool - King',
//                     'talla' => 'King',
//                     'existencia' => 16,
//                     'precio' => 24.99,
//                     'peso' => 50,
//                     'medida' => '90'
//                 ],
//                 [
//                     'id_producto' => '988737',
//                     'id_padre' => '988735',
//                     'nombre' => 'Almohada Cool - Queen',
//                     'talla' => 'Queen',
//                     'existencia' => 20,
//                     'precio' => 21.99,
//                     'peso' => 50,
//                     'medida' => '70'
//                 ]
//             ]
//         ],
//         [
//             'id_producto' => '988742',
//             'id_padre' => null,
//             'sku_producto' => '',
//             'nombre' => 'Almohada Microgel Cubica',
//             'talla' => null,
//             'color' => null,
//             'existencia' => 0,
//             'precio' => 0,
//             'descripcion' => 'Almohada de micro gel con sensación suave.',
//             'imagen' => 'cubica-de-micro-gel-queen-copy-copia.jpg',
//             'categoria' => 'Almohadas',
//             'variaciones' => [
//                 [
//                     'id_producto' => '988743',
//                     'id_padre' => '988742',
//                     'nombre' => 'Almohada Microgel Cubica - King',
//                     'talla' => 'King',
//                     'existencia' => 50,
//                     'precio' => 34.99,
//                     'peso' => 50,
//                     'medida' => '90'
//                 ],
//                 [
//                     'id_producto' => '988744',
//                     'id_padre' => '988742',
//                     'nombre' => 'Almohada Microgel Cubica - Queen',
//                     'talla' => 'Queen',
//                     'existencia' => 48,
//                     'precio' => 29.99,
//                     'peso' => 50,
//                     'medida' => '70'
//                 ]
//             ]
//         ],
//         [
//             'id_producto' => '988749',
//             'id_padre' => null,
//             'sku_producto' => '',
//             'nombre' => 'Almohada Microgel Sencilla',
//             'talla' => null,
//             'color' => null,
//             'existencia' => 0,
//             'precio' => 0,
//             'descripcion' => 'Almohada de micro gel sensación extra suave.',
//             'imagen' => 'almohada-de-micro-gel-empa-copy-copia.jpg',
//             'categoria' => 'Almohadas',
//             'variaciones' => [
//                 [
//                     'id_producto' => '988750',
//                     'id_padre' => '988749',
//                     'nombre' => 'Almohada Microgel Sencilla - King',
//                     'talla' => 'King',
//                     'existencia' => 50,
//                     'precio' => 29.99,
//                     'peso' => 50,
//                     'medida' => '90'
//                 ],
//                 [
//                     'id_producto' => '988751',
//                     'id_padre' => '988749',
//                     'nombre' => 'Almohada Microgel Sencilla - Queen',
//                     'talla' => 'Queen',
//                     'existencia' => 44,
//                     'precio' => 24.99,
//                     'peso' => 50,
//                     'medida' => '70'
//                 ]
//             ]
//         ],
//         [
//             'id_producto' => '988755',
//             'id_padre' => null,
//             'sku_producto' => '',
//             'nombre' => 'Almohada Clásica',
//             'talla' => null,
//             'color' => null,
//             'existencia' => 0,
//             'precio' => 0,
//             'descripcion' => 'Almohada clásica suave y confortable.',
//             'imagen' => 'almohada-clasica-copy-copia.jpg',
//             'categoria' => 'Almohadas',
//             'variaciones' => [
//                 [
//                     'id_producto' => '988756',
//                     'id_padre' => '988755',
//                     'nombre' => 'Almohada Clásica - Estándar',
//                     'talla' => 'Estándar',
//                     'existencia' => 50,
//                     'precio' => 8.99,
//                     'peso' => 45,
//                     'medida' => '65'
//                 ],
//                 [
//                     'id_producto' => '988757',
//                     'id_padre' => '988755',
//                     'nombre' => 'Almohada Clásica - King',
//                     'talla' => 'King',
//                     'existencia' => 50,
//                     'precio' => 12.99,
//                     'peso' => 50,
//                     'medida' => '90'
//                 ],
//                 [
//                     'id_producto' => '988758',
//                     'id_padre' => '988755',
//                     'nombre' => 'Almohada Clásica - Queen',
//                     'talla' => 'Queen',
//                     'existencia' => 20,
//                     'precio' => 9.99,
//                     'peso' => 50,
//                     'medida' => '70'
//                 ]
//             ]
//         ],
//         [
//             'id_producto' => '988763',
//             'id_padre' => null,
//             'sku_producto' => '',
//             'nombre' => 'Almohada Premium',
//             'talla' => null,
//             'color' => null,
//             'existencia' => 0,
//             'precio' => 0,
//             'descripcion' => 'Almohada premium de alta calidad.',
//             'imagen' => 'almohada-premium-emp-copy-copia.jpg',
//             'categoria' => 'Almohadas',
//             'variaciones' => [
//                 [
//                     'id_producto' => '988764',
//                     'id_padre' => '988763',
//                     'nombre' => 'Almohada Premium - Estándar',
//                     'talla' => 'Estándar',
//                     'existencia' => 50,
//                     'precio' => 9.99,
//                     'peso' => 45,
//                     'medida' => '65'
//                 ],
//                 [
//                     'id_producto' => '988765',
//                     'id_padre' => '988763',
//                     'nombre' => 'Almohada Premium - King',
//                     'talla' => 'King',
//                     'existencia' => 50,
//                     'precio' => 13.99,
//                     'peso' => 50,
//                     'medida' => '90'
//                 ],
//                 [
//                     'id_producto' => '988766',
//                     'id_padre' => '988763',
//                     'nombre' => 'Almohada Premium - Queen',
//                     'talla' => 'Queen',
//                     'existencia' => 20,
//                     'precio' => 10.99,
//                     'peso' => 50,
//                     'medida' => '70'
//                 ]
//             ]
//         ],
//         [
//             'id_producto' => '988771',
//             'id_padre' => null,
//             'sku_producto' => '',
//             'nombre' => 'Almohada Junior',
//             'talla' => null,
//             'color' => null,
//             'existencia' => 100,
//             'precio' => 5.99,
//             'descripcion' => 'Almohada diseñada específicamente para niños.',
//             'imagen' => 'almohada-junior-copy-copia.jpg',
//             'categoria' => 'Almohadas'
//         ],
//         [
//             'id_producto' => '988775',
//             'id_padre' => null,
//             'sku_producto' => '',
//             'nombre' => 'Almohada de lactancia colores lisos',
//             'talla' => null,
//             'color' => null,
//             'existencia' => 50,
//             'precio' => 21.99,
//             'descripcion' => 'Almohada de lactancia suave y acogedora.',
//             'imagen' => 'ZED_4023-copia.jpg',
//             'categoria' => 'Almohadas'
//         ],
//         [
//             'id_producto' => '988779',
//             'id_padre' => null,
//             'sku_producto' => '',
//             'nombre' => 'Almohada para amamantar estampado',
//             'talla' => null,
//             'color' => null,
//             'existencia' => 50,
//             'precio' => 24.99,
//             'descripcion' => 'Almohada de lactancia con estampado.',
//             'imagen' => 'ZED_4033-copia.jpg',
//             'categoria' => 'Almohadas'
//         ],
//         [
//             'id_producto' => '988782',
//             'id_padre' => null,
//             'sku_producto' => '',
//             'nombre' => 'Almohada de Bebé',
//             'talla' => null,
//             'color' => null,
//             'existencia' => 0,
//             'precio' => 0,
//             'descripcion' => 'Almohada de bebé suave para brindar apoyo y comodidad.',
//             'imagen' => 'alm-de-bebe-copy-copia.jpg',
//             'categoria' => 'Almohadas',
//             'variaciones' => [
//                 [
//                     'id_producto' => '988783',
//                     'id_padre' => '988782',
//                     'nombre' => 'Almohada de Bebé - Blanco',
//                     'color' => 'Blanco',
//                     'existencia' => 99,
//                     'precio' => 2.99,
//                     'peso' => 25,
//                     'medida' => '35'
//                 ],
//                 [
//                     'id_producto' => '988784',
//                     'id_padre' => '988782',
//                     'nombre' => 'Almohada de Bebé - Fucsia',
//                     'color' => 'Fucsia',
//                     'existencia' => 0,
//                     'precio' => 2.99,
//                     'peso' => 25,
//                     'medida' => '35'
//                 ],
//                 [
//                     'id_producto' => '988785',
//                     'id_padre' => '988782',
//                     'nombre' => 'Almohada de Bebé - Turquesa',
//                     'color' => 'Turquesa',
//                     'existencia' => 0,
//                     'precio' => 2.99,
//                     'peso' => 25,
//                     'medida' => '35'
//                 ]
//             ]
//         ],
//         [
//             'id_producto' => '988789',
//             'id_padre' => null,
//             'sku_producto' => '',
//             'nombre' => 'Relleno de cojín',
//             'talla' => null,
//             'color' => null,
//             'existencia' => 46,
//             'precio' => 3.49,
//             'descripcion' => 'Relleno de cojín suave y elegante.',
//             'imagen' => 'cojin-copy-copia.jpg',
//             'categoria' => 'Almohadas'
//         ],
//         [
//             'id_producto' => '988794',
//             'id_padre' => null,
//             'sku_producto' => '',
//             'nombre' => 'Almohada Euro',
//             'talla' => null,
//             'color' => null,
//             'existencia' => 0,
//             'precio' => 14.99,
//             'descripcion' => 'Almohada grande y cuadrada para decorar.',
//             'imagen' => 'Euro-copy-copia.jpg',
//             'categoria' => 'Almohadas'
//         ],
//         [
//             'id_producto' => '988797',
//             'id_padre' => null,
//             'sku_producto' => '',
//             'nombre' => 'Almohada ortopédica',
//             'talla' => null,
//             'color' => null,
//             'existencia' => 0,
//             'precio' => 14.99,
//             'descripcion' => 'Almohada ortopédica para soporte adicional.',
//             'imagen' => 'Ortopedica.jpg',
//             'categoria' => 'Almohadas'
//         ],
//         [
//             'id_producto' => '988961',
//             'id_padre' => null,
//             'sku_producto' => '',
//             'nombre' => 'Sobrecama Blanco',
//             'talla' => null,
//             'color' => null,
//             'existencia' => 0,
//             'precio' => 0,
//             'descripcion' => 'Sobrecama hotelero de lujo y comodidad.',
//             'imagen' => 'Pandora-001-copia.jpg',
//             'categoria' => 'Sobrecamas y Colchas',
//             'variaciones' => [
//                 [
//                     'id_producto' => '988964',
//                     'id_padre' => '988961',
//                     'nombre' => 'Sobrecama Blanco - Twin',
//                     'talla' => 'Twin',
//                     'existencia' => 0,
//                     'precio' => 39.99,
//                     'peso' => 172,
//                     'medida' => '228'
//                 ],
//                 [
//                     'id_producto' => '988965',
//                     'id_padre' => '988961',
//                     'nombre' => 'Sobrecama Blanco - Full/Queen',
//                     'talla' => 'Full/Queen',
//                     'existencia' => 48,
//                     'precio' => 49.99,
//                     'peso' => 231,
//                     'medida' => '248'
//                 ],
//                 [
//                     'id_producto' => '988966',
//                     'id_padre' => '988961',
//                     'nombre' => 'Sobrecama Blanco - King',
//                     'talla' => 'King',
//                     'existencia' => 39,
//                     'precio' => 59.99,
//                     'peso' => 259,
//                     'medida' => '259'
//                 ]
//             ]
//         ],
//         [
//             'id_producto' => '988968',
//             'id_padre' => null,
//             'sku_producto' => '',
//             'nombre' => 'Sobrecama Crema',
//             'talla' => null,
//             'color' => null,
//             'existencia' => 0,
//             'precio' => 0,
//             'descripcion' => 'Sobrecama hotelero de lujo y comodidad color crema.',
//             'imagen' => 'Pandora-018-copia.jpg',
//             'categoria' => 'Sobrecamas y Colchas',
//             'variaciones' => [
//                 [
//                     'id_producto' => '988969',
//                     'id_padre' => '988968',
//                     'nombre' => 'Sobrecama Crema - Twin',
//                     'talla' => 'Twin',
//                     'existencia' => 30,
//                     'precio' => 39.99,
//                     'peso' => 172,
//                     'medida' => '228'
//                 ],
//                 [
//                     'id_producto' => '988970',
//                     'id_padre' => '988968',
//                     'nombre' => 'Sobrecama Crema - Full/Queen',
//                     'talla' => 'Full/Queen',
//                     'existencia' => 0,
//                     'precio' => 49.99,
//                     'peso' => 231,
//                     'medida' => '248'
//                 ],
//                 [
//                     'id_producto' => '988971',
//                     'id_padre' => '988968',
//                     'nombre' => 'Sobrecama Crema - King',
//                     'talla' => 'King',
//                     'existencia' => 40,
//                     'precio' => 59.99,
//                     'peso' => 259,
//                     'medida' => '259'
//                 ]
//             ]
//         ],
//         [
//             'id_producto' => '988975',
//             'id_padre' => null,
//             'sku_producto' => '',
//             'nombre' => 'Sobrecama Azul',
//             'talla' => null,
//             'color' => null,
//             'existencia' => 0,
//             'precio' => 0,
//             'descripcion' => 'Sobrecama hotelero de lujo y comodidad color azul.',
//             'imagen' => 'Pandora-004-copia.jpg',
//             'categoria' => 'Sobrecamas y Colchas',
//             'variaciones' => [
//                 [
//                     'id_producto' => '988976',
//                     'id_padre' => '988975',
//                     'nombre' => 'Sobrecama Azul - Twin',
//                     'talla' => 'Twin',
//                     'existencia' => 10,
//                     'precio' => 39.99,
//                     'peso' => 172,
//                     'medida' => '228'
//                 ],
//                 [
//                     'id_producto' => '988977',
//                     'id_padre' => '988975',
//                     'nombre' => 'Sobrecama Azul - Full/Queen',
//                     'talla' => 'Full/Queen',
//                     'existencia' => 0,
//                     'precio' => 49.99,
//                     'peso' => 231,
//                     'medida' => '248'
//                 ],
//                 [
//                     'id_producto' => '988978',
//                     'id_padre' => '988975',
//                     'nombre' => 'Sobrecama Azul - King',
//                     'talla' => 'King',
//                     'existencia' => 40,
//                     'precio' => 59.99,
//                     'peso' => 259,
//                     'medida' => '259'
//                 ]
//             ]
//         ],
//         [
//             'id_producto' => '988983',
//             'id_padre' => null,
//             'sku_producto' => '',
//             'nombre' => 'Sobrecama Gris',
//             'talla' => null,
//             'color' => null,
//             'existencia' => 0,
//             'precio' => 0,
//             'descripcion' => 'Sobrecama hotelero de lujo y comodidad color gris.',
//             'imagen' => 'sobrecama-gris-Sobrecama-Azul-Empaque-copy-copia.jpg',
//             'categoria' => 'Sobrecamas y Colchas',
//             'variaciones' => [
//                 [
//                     'id_producto' => '988984',
//                     'id_padre' => '988983',
//                     'nombre' => 'Sobrecama Gris - Twin',
//                     'talla' => 'Twin',
//                     'existencia' => 0,
//                     'precio' => 39.99,
//                     'peso' => 172,
//                     'medida' => '228'
//                 ],
//                 [
//                     'id_producto' => '988985',
//                     'id_padre' => '988983',
//                     'nombre' => 'Sobrecama Gris - Full/Queen',
//                     'talla' => 'Full/Queen',
//                     'existencia' => 0,
//                     'precio' => 49.99,
//                     'peso' => 231,
//                     'medida' => '248'
//                 ],
//                 [
//                     'id_producto' => '988986',
//                     'id_padre' => '988983',
//                     'nombre' => 'Sobrecama Gris - King',
//                     'talla' => 'King',
//                     'existencia' => 20,
//                     'precio' => 59.99,
//                     'peso' => 259,
//                     'medida' => '259'
//                 ]
//             ]
//         ],
//         [
//             'id_producto' => '989007',
//             'id_padre' => null,
//             'sku_producto' => '',
//             'nombre' => 'Toalla de piscina',
//             'talla' => null,
//             'color' => null,
//             'existencia' => 0,
//             'precio' => 0,
//             'descripcion' => 'Toallas de piscina de alta calidad 100% algodón.',
//             'imagen' => 'Toalla-piscina-royal-blue-2-copy.png',
//             'categoria' => 'Toallas',
//             'variaciones' => [
//                 [
//                     'id_producto' => '989011',
//                     'id_padre' => '989007',
//                     'nombre' => 'Toalla de piscina - Azul',
//                     'color' => 'Azul',
//                     'existencia' => 0,
//                     'precio' => 14.99,
//                     'peso' => 35,
//                     'medida' => '70'
//                 ],
//                 [
//                     'id_producto' => '989012',
//                     'id_padre' => '989007',
//                     'nombre' => 'Toalla de piscina - Blanco',
//                     'color' => 'Blanco',
//                     'existencia' => 0,
//                     'precio' => 14.99,
//                     'peso' => 30,
//                     'medida' => '60'
//                 ],
//                 [
//                     'id_producto' => '989013',
//                     'id_padre' => '989007',
//                     'nombre' => 'Toalla de piscina - Navy',
//                     'color' => 'Navy',
//                     'existencia' => 0,
//                     'precio' => 14.99,
//                     'peso' => 35,
//                     'medida' => '70'
//                 ],
//                 [
//                     'id_producto' => '989122',
//                     'id_padre' => '989007',
//                     'nombre' => 'Toalla de piscina - Arena',
//                     'color' => 'Arena',
//                     'existencia' => 100,
//                     'precio' => 14.99
//                 ]
//             ]
//         ],
//         [
//             'id_producto' => '989015',
//             'id_padre' => null,
//             'sku_producto' => '',
//             'nombre' => 'Batas',
//             'talla' => null,
//             'color' => null,
//             'existencia' => 0,
//             'precio' => 0,
//             'descripcion' => 'Batas de alta calidad para hoteles y spas.',
//             'imagen' => 'WhatsApp-Image-2024-03-22-at-7.51.08-AM.jpeg',
//             'categoria' => 'Toallas',
//             'variaciones' => [
//                 [
//                     'id_producto' => '989016',
//                     'id_padre' => '989015',
//                     'nombre' => 'Batas - S/M',
//                     'talla' => 'S/M',
//                     'existencia' => 28,
//                     'precio' => 40.00
//                 ],
//                 [
//                     'id_producto' => '989018',
//                     'id_padre' => '989015',
//                     'nombre' => 'Batas - L/XL',
//                     'talla' => 'L/XL',
//                     'existencia' => 0,
//                     'precio' => 43.33
//                 ]
//             ]
//         ]
//     ];

//     // Función para guardar productos en la base de datos
//     function guardarProductos($productos) {
//         foreach ($productos as $producto) {
//             // Guardar producto principal
//             $nuevoProducto = [
//                 'id_producto' => $producto['id_producto'],
//                 'id_padre' => $producto['id_padre'],
//                 'sku_producto' => $producto['sku_producto'] ?? '',
//                 'nombre' => $producto['nombre'],
//                 'talla' => $producto['talla'] ?? null,
//                 'color' => $producto['color'] ?? null,
//                 'existencia' => $producto['existencia'] ?? 0,
//                 'precio' => $producto['precio'] ?? 0,
//                 'descripcion' => $producto['descripcion'] ?? '',
//                 'imagen' => $producto['imagen'] ? $producto['imagen'] : null,
//                 'created_at' => now(),
//                 'updated_at' => now(),
//                 'peso' => $producto['peso'] ?? 0,
//                 'medida' => $producto['medida'] ?? null,
//                 'flag_activo' => 1,
//                 'disponible' => $producto['existencia'] > 0 ? 1 : 0
//             ];

//             // Aquí iría la lógica para insertar en la base de datos
//             DB::table('productos')->insert($nuevoProducto);
            
//             // Guardar variaciones si existen
//             if (isset($producto['variaciones'])) {
//                 foreach ($producto['variaciones'] as $variacion) {
//                     $nuevaVariacion = [
//                         'id_producto' => $variacion['id_producto'],
//                         'id_padre' => $variacion['id_padre'],
//                         'sku_producto' => $variacion['sku_producto'] ?? '',
//                         'nombre' => $variacion['nombre'],
//                         'talla' => $variacion['talla'] ?? null,
//                         'color' => $variacion['color'] ?? null,
//                         'existencia' => $variacion['existencia'] ?? 0,
//                         'precio' => $variacion['precio'] ?? 0,
//                         'descripcion' => $variacion['descripcion'] ?? $producto['descripcion'] ?? '',
//                         'imagen' => $producto['imagen'] ? '/storage/productos/' . $producto['imagen'] : null,
//                         'created_at' => now(),
//                         'updated_at' => now(),
//                         'peso' => $variacion['peso'] ?? 0,
//                         'medida' => $variacion['medida'] ?? null,
//                         'flag_activo' => 1,
//                         'disponible' => ($variacion['existencia'] ?? 0) > 0 ? 1 : 0
//                     ];
                    
//                     // Aquí iría la lógica para insertar variaciones
//                     DB::table('productos')->insert($nuevaVariacion);
//                 }
//             }
//         }
        
//         return "Productos procesados correctamente";
//     }

//     // Ejecutar la función
//     $resultado = guardarProductos($productos);
    
//     return response()->json([
//         'mensaje' => $resultado,
//         'total_productos' => count($productos),
//         'productos' => $productos
//     ]);
// });

// 
// CARGA FIN


// Route::post('/api/actualizar-inventario', [ApiController::class , 'actualizarInventario']);
Route::post('/api/actualizar-inventario-producto', [ApiController::class , 'actualizarInventarioProducto']);
// Route::get('/api/import-excel', [ApiController::class , 'importExcel']);
Route::post('/api/ordenes', [ApiController::class , 'ordenes']);
Route::post('/api/crear-orden', [ApiController::class , 'crearOrden']);
Route::get('/api/ordenes', [ApiController::class , 'ordenes']);

// Route::get('/facturacion/consulta', [FacturacionController::class , 'consulta']);

Route::get('/', function () {
    
    return view('welcome');
})->name('home');

Route::get('/nosotros', function () {
   return view('nosotros');
   
})->name('nosotros');

Route::get('/nuestra-marca', function () {
   return view('nuestra-marca');
   
})->name('nuestra.marca');

// Route::get('/organizar-productos', function () {
//     $data = [
//         'Toalla de Piscina' => ['7453073733338', '7453073732331', '7453073731976', '7453073733321'],
//         'Batas' => ['7453073733055', '7453073733062', '7453073733048', '7453073732263'],
//         'Pantuflas' => ['7453073732256'],
//         'Servilletas' => ['7453073733079', '7453073733505'],
//         'Protector de Almohada' => ['7453073731723', '7453073731730'],
//         'Protector de Colchon' => ['7453073728679', '7453073728686', '7453073728693', '7453073728709', '7453073731013', '7453073731020', '7453073731037', '7453073731044'],
//         'Sobre Cama Crema Sin Fundas' => ['7453073733444', '7453073733451', '7453073733468'],
//         'Sobre Cama Con Fundas Decorativa' => ['7453073731990', '300584', '7453073732010', '7453073733147', '7453073732782', '7453073732799', '7453073732805'],
//         'Almohadas Firme' => ['7453073733406', '7453073733413'],
//         'Almohadas Suave Medio' => ['7453073733420', '7453073733437'],
//         'Almohadas Luxury' => ['7591630000162', '7591630000179', '7591630000186'],
//         'Almohadas Suaves' => ['1', '2'],
//         'Almohadas Mix' => ['7453073729331', '7453073729348', '7453073729355'],
//         'Almohadas de Micro gel' => ['7591934004583', '7591934004576'],
//         'Almohadas Premium' => ['7591529039112', '7591529039327', '7591630000100'],
//         'Topper' => ['7453073729287', '7453073729294', '7453073729300', '7453073729317'],
//         'Duvet Insert' => ['7453073731914', '7453073731921', '7453073731938', '7453073728648', '7453073728655', '7453073728662']
//     ];
//     $n = 0;
//     foreach ($data as $nombre => $skus) {
//         $children = \App\Models\Producto::whereIn('sku_producto', $skus)->get();
        
//         if ($children->count() > 0) {
//             $parent = \App\Models\Producto::firstOrCreate(
//                 ['nombre' => $nombre],
//                 ['estatus' => 1]
//             );
//             $childrenFirst = $children->first();
//             // dd($children->first()->imagen);
//             // Assign image from first child if parent has no image
//             if (!$parent->getAttribute('imagen') && $childrenFirst && $childrenFirst->getAttribute('imagen')) {
//                 $parent->update([
//                     'imagen' => $childrenFirst->getAttribute('imagen'),
//                     // 'imagen_web' => $childrenFirst->getAttribute('imagen_web')
//                 ]);
//             }

//             // Update children to link to parent
//             \App\Models\Producto::whereIn('sku_producto', $skus)->update(['id_padre' => $parent->id]);
//         }
//         echo $n++;
//     }

//     return "Productos organizados correctamente.";
// });

Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

Route::post('/enviar-contacto', function (Request $request) {

    $request->validate([
        'nombre' => 'required',
        'email' => 'required|email:rfc,dns',
        'asunto' => 'required',
        'telefono' => 'required',
        'mensaje' => 'required',
    ]);

    $datos = $request->all();
    Mail::to(mailsVentas())->send(new ContactoMail($datos));
    
    return redirect()->back()->with('status' , 'Mensaje enviado');
})->name('enviar.contacto');

Route::get('/tienda', function () {
    return view('tienda');
})->name('tienda');

Route::get('/blog', function () {
    return view('blog');
})->name('blog');

Route::get('/blog/{slug}', function ($slug) {
    $post = App\Models\Post::where('slug' , $slug)->first();

    return view('blog-detalle' , compact('post'));
    
})->name('blog.detalle');

Route::get('/cambiar-tienda/{tienda}', function ($tienda) {

    $tienda = App\Models\Tienda::where('slug' , $tienda)->first();
    if(!$tienda)
    {
        $tiendaInt = 0;
    }
    $tiendaInt = $tienda->id;

    if(auth()->user())
    {
        $user = auth()->user();
        $user->tienda = $tiendaInt;
        $user->save();
        
        \Cart::session($user->id);
    }

    session(['tienda' => $tiendaInt]);
    \Cart::clear();

    return redirect()->back();

})->name('cambiar.tienda');

Route::get('/politicas-de-privacidad', function () {
    $contenido = opcionSlug('politica_privacidad');
    $titulo = 'Políticas de privacidad';
    
    return view('secciones' , compact('contenido' , 'titulo'));
})->name('politicas.privacidad');

Route::get('/terminos-y-condiciones', function () {
    $contenido = opcionSlug('terminos_condiciones');
    $titulo = 'Términos y condiciones';

    return view('secciones' , compact('contenido' , 'titulo'));
})->name('terminos.condiciones');

Route::get('/preguntas-frecuentes', function () {
    $contenido = opcionSlug('preguntas_frecuentes');
    $titulo = 'Preguntas Frecuentes';

    return view('secciones' , compact('contenido' , 'titulo'));
})->name('preguntas.frecuentes');

Route::get('/politica-de-cambios-y-garantia', function () {
    $contenido = opcionSlug('politica_cambios');
    $titulo = 'Política de Cambios y Garantía';

    return view('secciones' , compact('contenido' , 'titulo'));
})->name('politica.cambios');

Route::get('/tutorial-de-compra', function () {
    $contenido = opcionSlug('tutorial_compra');
    $titulo = 'Tutorial de Compra';

    return view('secciones' , compact('contenido' , 'titulo'));
})->name('tutorial.compra');

Route::get('/venta-mayoristas', function () {
    $contenido = opcionSlug('venta_mayorista');
    $titulo = 'Venta Mayoristas';

    return view('secciones' , compact('contenido' , 'titulo'));
})->name('venta.mayoristas');

Route::get('/carrito', function () {
    return view('carrito');
})->name('carrito');

Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');

Route::middleware(['auth:sanctum'])->get('/panel', function () {
    return view('panel');
})->name('panel');

Route::middleware(['auth:sanctum'])->get('/favoritos', function () {
    return view('favoritos');
})->name('favoritos');

Route::get('/completado', function () {
    return view('confirm');
})->name('confirm');

Route::middleware(['auth:sanctum'])->get('/comentar/{productoId}', function ($productoId) {
    return view('comentar' , compact('productoId'));
})->name('comentar');

Route::get('/producto/{id}', function ($id) {
    
    $productoId = ElfSundae\Laravel\Hashid\Facades\Hashid::decode($id);
    $producto = App\Models\Producto::find($productoId);

    return view('detalle' , compact('producto'));
})->name('producto');

Route::middleware(['auth:sanctum'])->get('/dashboard', function () {
    if(auth()->user()->hasRole('admin'))
    {
        return view('dashboard');
    }
    return redirect()->route('panel');
})->name('dashboard');

Route::middleware([
    'auth:sanctum',
    'role:admin',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::post('admin/upload', [App\Http\Controllers\PostController::class , 'uploadImage'])->name('admin.upload.image');
    // Route::get('/check-inventario', function () {
        
    //     return (new App\Mail\InventarioMail())->render();
    // });
    Route::get('/usuarios', function () {
        return view('users');
    })->name('users');
    Route::get('/clientes', function () {
        return view('clientes');
    })->name('clientes');
    Route::get('/categorias', function () {
        return view('categorias');
    })->name('categorias');
    Route::get('/colecciones', function () {
        return view('colecciones');
    })->name('colecciones');
    Route::get('admin/posts', function () {
        return view('admin.posts');
    })->name('admin.posts');
    Route::get('/productos', function () {
        return view('productos');
    })->name('productos');
    Route::get('/ordenes', function () {
        return view('ordenes');
    })->name('ordenes');
    Route::get('/pedidos', function () {
        return view('pedidos');
    })->name('pedidos');
    Route::get('/facturacion', function () {
        $view = view('facturacion');
        $response = new Response($view);
       
        $response->header('Set-Cookie', 'session='. session('usersid') .'; SameSite=None; Secure');

        return $response;
    })->name('facturacion');
    Route::get('/sliders', function () {
        return view('sliders');
    })->name('sliders');
    Route::get('/comentarios', function () {
        return view('comentarios');
    })->name('comentarios');
    Route::get('/configuraciones', function () {
        return view('configuraciones');
    })->name('configuraciones');
    Route::get('/ubicaciones', function () {
        return view('ubicaciones');
    })->name('ubicaciones');
    Route::get('/api-log', function () {
        return view('api-log');
    })->name('api.log');
});
