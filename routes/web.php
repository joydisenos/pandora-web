<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\ContactoMail;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\FacturacionController;
use Illuminate\Http\Response;
use App\Services\ProductImportService;

// Route::get("/carga-inicial", function () {
    
//     $productos = [
//                     [
//                         "product" => "Linea T-200 Hilos 60% Algodón y 40% Polyester - Percale",
//                         "type" => "simple",
//                         "sku_producto" => "7453073732959",
//                         "nombre" => "T200 Flat Sheet Twin 70x115”",
//                         "estatus" => "1",
//                         "visibility" => "visible",
//                         "descripcion" => "",
//                         "detalles" => "",
//                         "stock_av" => "1",
//                         "stock" => "",
//                         "reviews" => "1",
//                         "categoria" => "Sabanas de Algodon",
//                         "sub_categoria" => "200 Hilos Algodon",
//                         "tags" => "flat sheet"
//                                 ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073733536",
//                             "nombre" => "T200 Flat Sheet Full   81X115\"",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Sabanas de Algodon",
//                             "sub_categoria" => "200 Hilos Algodon",
//                             "tags" => "flat sheet"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073732980",
//                             "nombre" => "T200 Flat Sheet Queen 94x115”",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Sabanas de Algodon",
//                             "sub_categoria" => "200 Hilos Algodon",
//                             "tags" => "flat sheet"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073733000",
//                             "nombre" => "T200 Flat Sheet King 115x115”",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Sabanas de Algodon",
//                             "sub_categoria" => "200 Hilos Algodon",
//                             "tags" => "flat sheet"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073732966",
//                             "nombre" => "T200 Fitted Sheet Twin 39x80+13\"",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Sabanas de Algodon",
//                             "sub_categoria" => "200 Hilos Algodon",
//                             "tags" => "fitted sheet"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073732973",
//                             "nombre" => "T200 Fitted Sheet Full 54x80+13\"",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Sabanas de Algodon",
//                             "sub_categoria" => "200 Hilos Algodon",
//                             "tags" => "fitted sheet"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073732997",
//                             "nombre" => "T200 Fitted Sheet Queen 60x80+13\"",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Sabanas de Algodon",
//                             "sub_categoria" => "200 Hilos Algodon",
//                             "tags" => "fitted sheet"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073733017",
//                             "nombre" => "T200 Fitted Sheet King 80x80+13\"",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Sabanas de Algodon",
//                             "sub_categoria" => "200 Hilos Algodon",
//                             "tags" => "fitted sheet"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073733024",
//                             "nombre" => "T200 Percale  Pillowcase  Estándar 20x31\"",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Funda de Algodon",
//                             "sub_categoria" => "200 Hilos Algodon",
//                             "tags" => "Pillowcase"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073733031",
//                             "nombre" => "T200 Percale  Pillowcase  King 20x40\"",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Funda de Algodon",
//                             "sub_categoria" => "200 Hilos Algodon",
//                             "tags" => "Pillowcase"
//                         ],
//                         [
//                             "product" => "Linea T-  250 Hilos 60% Algodón y 40% Polyester - Percale",
//                             "type" => "simple",
//                             "sku_producto" => "7453073732119",
//                             "nombre" => "T250 Flat Sheet Twin 66X115\"",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Sabanas de Algodon",
//                             "sub_categoria" => "250 Hilos Algodon",
//                             "tags" => "flat sheet"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073732126",
//                             "nombre" => "T250 Flat Sheet Full   81X115\"",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Sabanas de Algodon",
//                             "sub_categoria" => "250 Hilos Algodon",
//                             "tags" => "flat sheet"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073732133",
//                             "nombre" => "T250 Flat Sheet Queen  90X120\"",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Sabanas de Algodon",
//                             "sub_categoria" => "250 Hilos Algodon",
//                             "tags" => "flat sheet"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073732140",
//                             "nombre" => "T250 Flat Sheet King    114X120\"",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Sabanas de Algodon",
//                             "sub_categoria" => "250 Hilos Algodon",
//                             "tags" => "flat sheet"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073732157",
//                             "nombre" => "T250 Fitted Sheet Twin 39X80X14\"",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Sabanas de Algodon",
//                             "sub_categoria" => "250 Hilos Algodon",
//                             "tags" => "fitted sheet"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073732164",
//                             "nombre" => "T250 Fitted Sheet Full  54X80X14\"",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Sabanas de Algodon",
//                             "sub_categoria" => "250 Hilos Algodon",
//                             "tags" => "fitted sheet"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073732171",
//                             "nombre" => "T250 Fitted Sheet Queen  60X80X14\"",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Sabanas de Algodon",
//                             "sub_categoria" => "250 Hilos Algodon",
//                             "tags" => "fitted sheet"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073732188",
//                             "nombre" => "T250 Fitted Sheet King   78X80X14\"",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Sabanas de Algodon",
//                             "sub_categoria" => "250 Hilos Algodon",
//                             "tags" => "Pillowcase"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073732195",
//                             "nombre" => "T250 Pillowcase Std  21X30\"",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Funda de Algodon",
//                             "sub_categoria" => "250 Hilos Algodon",
//                             "tags" => "Pillowcase"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073732201",
//                             "nombre" => "T250 Pillowcase Queen  21X35\"",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Funda de Algodon",
//                             "sub_categoria" => "250 Hilos Algodon",
//                             "tags" => "Pillowcase"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073732218",
//                             "nombre" => "T250 Pillowcase King 21X42\"",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Funda de Algodon",
//                             "sub_categoria" => "250 Hilos Algodon",
//                             "tags" => "Pillowcase"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073732225",
//                             "nombre" => "T250 Duvet Cover Twin   69x89\"",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Duvet Cover de Algodon",
//                             "sub_categoria" => "250 Hilos Algodon",
//                             "tags" => "Duvet cover"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073733543",
//                             "nombre" => "T250 Duvet Cover Full, 83X91\"",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Duvet Cover de Algodon",
//                             "sub_categoria" => "250 Hilos Algodon",
//                             "tags" => "Duvet cover"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073732232",
//                             "nombre" => "T250 Duvet Cover Queen 91X91\"",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Duvet Cover de Algodon",
//                             "sub_categoria" => "250 Hilos Algodon",
//                             "tags" => "Duvet cover"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073732249",
//                             "nombre" => "T250 Duvet Cover King 107X91\"",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Duvet Cover de Algodon",
//                             "sub_categoria" => "250 Hilos Algodon",
//                             "tags" => "Duvet cover"
//                         ],
//                         [
//                             "product" => "Linea T-  300 Hilos 100%  Algodón - Sateen",
//                             "type" => "simple",
//                             "sku_producto" => "7453073733185",
//                             "nombre" => "T300 Flat Sheet Twin, Sateen, 66x120\"",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Sabanas de Algodon",
//                             "sub_categoria" => "300 Hilos Algodon",
//                             "tags" => "flat sheet"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073733178",
//                             "nombre" => "T300 Flat Sheet Full, Sateen,84x120\"",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Sabanas de Algodon",
//                             "sub_categoria" => "300 Hilos Algodon",
//                             "tags" => "flat sheet"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073732928",
//                             "nombre" => "T300 Sateen Flat Sheet Queen 98x120\"",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Sabanas de Algodon",
//                             "sub_categoria" => "300 Hilos Algodon",
//                             "tags" => "flat sheet"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073732935",
//                             "nombre" => "T300 Sateen Flat Sheet King 118x120\"",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Sabanas de Algodon",
//                             "sub_categoria" => "300 Hilos Algodon",
//                             "tags" => "flat sheet"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073733222",
//                             "nombre" => "T300 Fitted Sheet Twin, Sateen, 39x80+14\"",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Sabanas de Algodon",
//                             "sub_categoria" => "300 Hilos Algodon",
//                             "tags" => "fitted sheet"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073733215",
//                             "nombre" => "T300 Fitted Sheet Full, Sateen, 54x80+14\"",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Sabanas de Algodon",
//                             "sub_categoria" => "300 Hilos Algodon",
//                             "tags" => "fitted sheet"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073733208",
//                             "nombre" => "T300 Fitted Sheet Queen, Sateen,60x80+14\"",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Sabanas de Algodon",
//                             "sub_categoria" => "300 Hilos Algodon",
//                             "tags" => "fitted sheet"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073733192",
//                             "nombre" => "T300 Fitted Sheet King, Sateen, 78x80+14\"",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Sabanas de Algodon",
//                             "sub_categoria" => "300 Hilos Algodon",
//                             "tags" => "fitted sheet"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073732904",
//                             "nombre" => "T300  Sateen Pillowcase Queen 21x34\"",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Funda de Algodon",
//                             "sub_categoria" => "300 Hilos Algodon",
//                             "tags" => "Pillowcase"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073732911",
//                             "nombre" => "T300  Sateen Pillowcase King 21x41\"",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Funda de Algodon",
//                             "sub_categoria" => "300 Hilos Algodon",
//                             "tags" => "Pillowcase"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073733260",
//                             "nombre" => "T300  Duvet Cover Twin, Sateen, 66x86\"  - 68x86\"",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Duvet Cover de Algodon",
//                             "sub_categoria" => "300 Hilos Algodon",
//                             "tags" => "Duvet cover"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073733253",
//                             "nombre" => "T300  Duvet Cover Full, Sateen, 88x90\"  - 83x91\"",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Duvet Cover de Algodon",
//                             "sub_categoria" => "300 Hilos Algodon",
//                             "tags" => "Duvet cover"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073733246",
//                             "nombre" => "T300  Duvet Cover Queen, Sateen, 93x98\"",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Duvet Cover de Algodon",
//                             "sub_categoria" => "300 Hilos Algodon",
//                             "tags" => "Duvet cover"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073733246",
//                             "nombre" => "T300  Duvet Cover Queen, Sateen,  -  91X91\"",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Duvet Cover de Algodon",
//                             "sub_categoria" => "300 Hilos Algodon",
//                             "tags" => "Duvet cover"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073733239",
//                             "nombre" => "T300  Duvet Cover King, Sateen, 105x90\" - 106x91\"",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Duvet Cover de Algodon",
//                             "sub_categoria" => "300 Hilos Algodon",
//                             "tags" => "Duvet cover"
//                         ],
//                         [
//                             "product" => "Linea T-  250 Hilos 60% Algodón y 40% Polyester - Satten Stripe",
//                             "type" => "simple",
//                             "sku_producto" => "7453073733277",
//                             "nombre" => "T250 Duvet Cover Full, Sateen, Stripe 10mm, 88x90\" - 83x91\"",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Duvet Cover de Algodon",
//                             "sub_categoria" => "250 Hilos Algodon",
//                             "tags" => "Duvet cover"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073733284",
//                             "nombre" => "T250 Duvet Cover Queen,, Sateen, Stripe 10mm, 93x98\" - 91x91\"",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Duvet Cover de Algodon",
//                             "sub_categoria" => "250 Hilos Algodon",
//                             "tags" => "Duvet cover"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073733291",
//                             "nombre" => "T250 Duvet Cover King, Sateen, Stripe, 10mm, 105x90\" x 106x91\"",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Duvet Cover de Algodon",
//                             "sub_categoria" => "250 Hilos Algodon",
//                             "tags" => "Duvet cover"
//                         ],
//                         [
//                             "product" => "Toallas de cara",
//                             "type" => "simple",
//                             "sku_producto" => "7453073733376",
//                             "nombre" => "Toalla De Cara 12x12\" 50g, Black Color",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Toallas 100% Algodon",
//                             "sub_categoria" => "Toalla de Cara",
//                             "tags" => "Toallas"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073733307",
//                             "nombre" => "Toallas de Cara 12x12\" 40g - White Color",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Toallas 100% Algodon",
//                             "sub_categoria" => "Toalla de Cara",
//                             "tags" => "Toallas"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073730054",
//                             "nombre" => "Toalla De Cara 13X13\" 57g - White Color",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Toallas 100% Algodon",
//                             "sub_categoria" => "Toalla de Cara",
//                             "tags" => "Toallas"
//                         ],
//                         [
//                             "product" => "Toalla de Mano",
//                             "type" => "simple",
//                             "sku_producto" => "7453073730047",
//                             "nombre" => "Toalla De Mano 16X30\" 170g  white Color",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Toallas 100% Algodon",
//                             "sub_categoria" => "Toalla de Mano",
//                             "tags" => "Toallas"
//                         ],
//                         [
//                             "product" => "Toalla de Piso",
//                             "type" => "simple",
//                             "sku_producto" => "7453073733314",
//                             "nombre" => "Toalla de piso 20X26\"  260g - White Color",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Toallas 100% Algodon",
//                             "sub_categoria" => "Toalla de Piso",
//                             "tags" => "Toallas"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073732317",
//                             "nombre" => "Toalla de piso 20x30\"  310g - White Color",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Toallas 100% Algodon",
//                             "sub_categoria" => "Toalla de Piso",
//                             "tags" => "Toallas"
//                         ],
//                         [
//                             "product" => "Toalla de Cuerpo",
//                             "type" => "simple",
//                             "sku_producto" => "7453073730030",
//                             "nombre" => "Toalla De Cuerpo 27X50\" 500g White Color",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Toallas 100% Algodon",
//                             "sub_categoria" => "Toalla de Cuerpo",
//                             "tags" => "Toallas"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073730023",
//                             "nombre" => "Toalla De Cuerpo 27X54\" 580g  White Color",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Toallas 100% Algodon",
//                             "sub_categoria" => "Toalla de Cuerpo",
//                             "tags" => "Toallas"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073731969",
//                             "nombre" => "Toalla de Cuerpo 30X60\" 690g - White Color",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Toallas 100% Algodon",
//                             "sub_categoria" => "Toalla de Cuerpo",
//                             "tags" => "Toallas"
//                         ],
//                         [
//                             "product" => "Toalla de Piscina",
//                             "type" => "simple",
//                             "sku_producto" => "7453073733338",
//                             "nombre" => "Toalla de piscina 35x70\" 570g - Sand Brown Color",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Toallas 100% Algodon",
//                             "sub_categoria" => "Toalla de piscina",
//                             "tags" => "Toallas"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073732331",
//                             "nombre" => "Toalla de piscina 35x75\" Stripe White/Blue, 900g",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Toallas 100% Algodon",
//                             "sub_categoria" => "Toalla de piscina",
//                             "tags" => "Toallas"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073731976",
//                             "nombre" => "Toalla de Piscina Azul  35X70\" 570g",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Toallas 100% Algodon",
//                             "sub_categoria" => "Toalla de piscina",
//                             "tags" => "Toallas"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073733321",
//                             "nombre" => "Pool Chair cover with 17\" flap - White",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Toallas 100% Algodon",
//                             "sub_categoria" => "Forro de Silla",
//                             "tags" => "Toallas"
//                         ],
//                         [
//                             "product" => "Batas",
//                             "type" => "simple",
//                             "sku_producto" => "7453073733055",
//                             "nombre" => "Bathrobe, 100% Cotton Terry Velour - Cream S-M",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Batas 100% Algodon",
//                             "sub_categoria" => "",
//                             "tags" => "Batas"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073733062",
//                             "nombre" => "Bathrobe, 100% Cotton Terry Velour - Light Pink S-M",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Batas 100% Algodon",
//                             "sub_categoria" => "",
//                             "tags" => "Batas"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073733048",
//                             "nombre" => "Bathrobe, 100% Cotton Terry Velour - White S-M",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Batas 100% Algodon",
//                             "sub_categoria" => "",
//                             "tags" => "Batas"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073732263",
//                             "nombre" => "Bathrobe, 100% Cotton Terry Velour -  L-XL",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Batas 100% Algodon",
//                             "sub_categoria" => "",
//                             "tags" => "Batas"
//                         ],
//                         [
//                             "product" => "Pantuflas",
//                             "type" => "simple",
//                             "sku_producto" => "7453073732256",
//                             "nombre" => "Slippers,100% Poly Terry Velour – Pantufla",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Pantuflas 100% Algodon",
//                             "sub_categoria" => "",
//                             "tags" => "Pantuflas"
//                         ],
//                         [
//                             "product" => "Servilletas",
//                             "type" => "simple",
//                             "sku_producto" => "7453073733079",
//                             "nombre" => "Servilletas  20x20\" Tela Spun - Flament",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Servilletas",
//                             "sub_categoria" => "",
//                             "tags" => "Servilletas"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073733505",
//                             "nombre" => "Servilletas  20x20\" Tela Spun - Flament",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Servilletas",
//                             "sub_categoria" => "",
//                             "tags" => "Servilletas"
//                         ],
//                         [
//                             "product" => "Protector de Almohada",
//                             "type" => "simple",
//                             "sku_producto" => "7453073731723",
//                             "nombre" => "Hotel Protector De Almohada Microfibra BL/STD/Q",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "Están diseñado para proporcionar una barrera eficaz contra la humedad, protegiendo la almohada de derrames, líquidos y manchas",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Protector Impermeable",
//                             "sub_categoria" => "Protector de Almohada",
//                             "tags" => "Protectores"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073731730",
//                             "nombre" => "Hotel Protector De Almohada Microfibra BL/KING",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Protector Impermeable",
//                             "sub_categoria" => "Protector de Almohada",
//                             "tags" => "Protectores"
//                         ],
//                         [
//                             "product" => "Protector de Colchon",
//                             "type" => "simple",
//                             "sku_producto" => "7453073728679",
//                             "nombre" => "Protector De Colchon Acolchonado Impermeable BL/TWIN/6",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "Estan diseñado para proteger el colchón de manchas, derrames, sudor y líquidos, al tiempo que brinda una capa adicional de comodidad. Está confeccionado con materiales suaves y transpirables que ofrecen una sensación agradable al tacto.",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Protector Impermeable",
//                             "sub_categoria" => "Protector de Colchon",
//                             "tags" => "Protectores"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073728686",
//                             "nombre" => "Protector De Colchon Acolchonado Impermeable BL/FULL/6",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Protector Impermeable",
//                             "sub_categoria" => "Protector de Colchon",
//                             "tags" => "Protectores"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073728693",
//                             "nombre" => "Protector De Colchon Acolchonado Impermeable BL/QUEEN/4",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Protector Impermeable",
//                             "sub_categoria" => "Protector de Colchon",
//                             "tags" => "Protectores"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073728709",
//                             "nombre" => "Protector De Colchon Acolchonado Impermeable B/KING/4",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Protector Impermeable",
//                             "sub_categoria" => "Protector de Colchon",
//                             "tags" => "Protectores"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073731013",
//                             "nombre" => "Protector de Colchon Deluxe  TWIN",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "Está diseñado para proteger el colchón de derrames, manchas y líquidos, proporcionando una barrera efectiva contra la humedad. Está fabricado con materiales resistentes al agua que evitan la penetración de líquidos, preservando la limpieza y la integridad del colchón.",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Protector Impermeable",
//                             "sub_categoria" => "Protector de Colchon",
//                             "tags" => "Protectores"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073731020",
//                             "nombre" => "Protector de Colchon Deluxe FULL",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Protector Impermeable",
//                             "sub_categoria" => "Protector de Colchon",
//                             "tags" => "Protectores"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073731037",
//                             "nombre" => "Protector de Colchon Deluxe QUEEN",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Protector Impermeable",
//                             "sub_categoria" => "Protector de Colchon",
//                             "tags" => "Protectores"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073731044",
//                             "nombre" => "Protector de Colchon Deluxe  KING",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Protector Impermeable",
//                             "sub_categoria" => "Protector de Colchon",
//                             "tags" => "Protectores"
//                         ],
//                         [
//                             "product" => "SOBRECAMA CREMA SIN FUNDAS",
//                             "type" => "simple",
//                             "sku_producto" => "7453073733444",
//                             "nombre" => "Quilt Twin, Beige, bulk, 68x90\"",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Sobrecamas",
//                             "sub_categoria" => "Sobrecamas Beige",
//                             "tags" => "Sobrecamas"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073733451",
//                             "nombre" => "Quilt Fulll/Queen, Beige, bulk, 90x90\"",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Sobrecamas",
//                             "sub_categoria" => "Sobrecamas Beige",
//                             "tags" => "Sobrecamas"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073733468",
//                             "nombre" => "Quilt King, Beige, bulk, 105x90\"",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Sobrecamas",
//                             "sub_categoria" => "Sobrecamas Beige",
//                             "tags" => "Sobrecamas"
//                         ],
//                         [
//                             "product" => "SOBRECAMA CON FUNDAS DECORATIVA",
//                             "type" => "simple",
//                             "sku_producto" => "7453073731990",
//                             "nombre" => "Sobrecama Twin Blanco 68x90''/20x30''x1",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Sobrecamas",
//                             "sub_categoria" => "Sobrecamas Blancos",
//                             "tags" => "Sobrecamas"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "300584",
//                             "nombre" => "Sobrecama Full/Queen Blanco 91x98''/20x30''x2 -Bulk",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Sobrecamas",
//                             "sub_categoria" => "Sobrecamas Blancos",
//                             "tags" => "Sobrecamas"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073732010",
//                             "nombre" => "Sobrecama  King  Blanco 102x102''/20x40''x2",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Sobrecamas",
//                             "sub_categoria" => "Sobrecamas Blancos",
//                             "tags" => "Sobrecamas"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073733147",
//                             "nombre" => "Sobrecama  King  Blanco  XL (110\"X102\") -Bulk",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Sobrecamas",
//                             "sub_categoria" => "Sobrecamas Blancos",
//                             "tags" => "Sobrecamas"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073732782",
//                             "nombre" => "Sobrecama Twin Camel 68x90''/20x30''x1",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Sobrecamas",
//                             "sub_categoria" => "Sobrecamas Camel",
//                             "tags" => "Sobrecamas"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073732799",
//                             "nombre" => "Sobrecama Full/Queen Camel 91x98''/20x30''x2",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Sobrecamas",
//                             "sub_categoria" => "Sobrecamas Camel",
//                             "tags" => "Sobrecamas"
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073732805",
//                             "nombre" => "Sobrecama  King  Camel 102x102''/20x40''x2",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Sobrecamas",
//                             "sub_categoria" => "Sobrecamas Camel",
//                             "tags" => "Sobrecamas"
//                         ],
//                         [
//                             "product" => "Almohadas Firme",
//                             "type" => "simple",
//                             "sku_producto" => "7453073733406",
//                             "nombre" => "Bulk Almohada Hotelera Queen  - 100% Algodón 300 Hilos - Sensación Firme",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Almohadas Hoteleras",
//                             "sub_categoria" => "Linea Hotelera",
//                             "tags" => ""
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073733413",
//                             "nombre" => "Bulk Almohada Hotelera King - 100% Algodón 300 Hilos - Sensación Firme",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Almohadas Hoteleras",
//                             "sub_categoria" => "",
//                             "tags" => ""
//                         ],
//                         [
//                             "product" => "Almohadas Suave Medio",
//                             "type" => "simple",
//                             "sku_producto" => "7453073733420",
//                             "nombre" => "Bulk Almohada Hotelera Queen  - 100% Algodón 300 Hilos - Sensación suave medio",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Almohadas Hoteleras",
//                             "sub_categoria" => "",
//                             "tags" => ""
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073733437",
//                             "nombre" => "Bulk Almohada Hotelera King- 100% Algodón 300 Hilos - Sensación suave medio",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Almohadas Hoteleras",
//                             "sub_categoria" => "",
//                             "tags" => ""
//                         ],
//                         [
//                             "product" => "Almohadas Luxury",
//                             "type" => "simple",
//                             "sku_producto" => "7591630000162",
//                             "nombre" => "Almohada Luxury 100% Algodon 300 Hilos - Down Alternative BL/STD/15",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Almohadas Hoteleras",
//                             "sub_categoria" => "Linea Especial",
//                             "tags" => ""
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7591630000179",
//                             "nombre" => "Almohada Luxury 100% Algodon 300 Hilos - Down Alternative BL/QUEEN/12",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Almohadas Hoteleras",
//                             "sub_categoria" => "",
//                             "tags" => ""
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7591630000186",
//                             "nombre" => "Almohada Luxury 100% Algodon 300 Hilos - Down Alternative BL/KING/10",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Almohadas Hoteleras",
//                             "sub_categoria" => "",
//                             "tags" => ""
//                         ],
//                         [
//                             "product" => "Almohadas Suaves",
//                             "type" => "simple",
//                             "sku_producto" => "1",
//                             "nombre" => "Bulk Almohada Hotelera Queen  - 100% Algodón 300 Hilos - Sensación suave",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Almohadas Hoteleras",
//                             "sub_categoria" => "Linea Hotelera",
//                             "tags" => ""
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "2",
//                             "nombre" => "Bulk Almohada Hotelera King - 100% Algodón 300 Hilos - Sensación Suave",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Almohadas Hoteleras",
//                             "sub_categoria" => "",
//                             "tags" => ""
//                         ],
//                         [
//                             "product" => "Almohadas Mix",
//                             "type" => "simple",
//                             "sku_producto" => "7453073729331",
//                             "nombre" => "Almohada Hotelera Mix 100% Algodon 300 Hilos - Estandar",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Almohadas Hoteleras",
//                             "sub_categoria" => "Linea Especial",
//                             "tags" => ""
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073729348",
//                             "nombre" => "Almohada Hotelera Mix 100% Algodon 300 Hilos - Queen",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Almohadas Hoteleras",
//                             "sub_categoria" => "",
//                             "tags" => ""
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073729355",
//                             "nombre" => "Almohada Hotelera Mix 100% Algodon 300 Hilos - King",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Almohadas Hoteleras",
//                             "sub_categoria" => "",
//                             "tags" => ""
//                         ],
//                         [
//                             "product" => "Almohadas de Micro gel",
//                             "type" => "simple",
//                             "sku_producto" => "7591934004583",
//                             "nombre" => "Almohada Hotelera de Fibra Micro Gel/Queen",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Almohadas Hoteleras",
//                             "sub_categoria" => "",
//                             "tags" => ""
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7591934004576",
//                             "nombre" => "Almohada Hotelera de Fibra Micro Gel/King",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Almohadas Hoteleras",
//                             "sub_categoria" => "",
//                             "tags" => ""
//                         ],
//                         [
//                             "product" => "Almohadas Premium",
//                             "type" => "simple",
//                             "sku_producto" => "7591529039112",
//                             "nombre" => "Almohada Pch Premium BL/STD/15",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Almohadas Hoteleras",
//                             "sub_categoria" => "Linea Clasica",
//                             "tags" => ""
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7591529039327",
//                             "nombre" => "Almohada Pch Premium BL/QUEEN/12",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Almohadas Hoteleras",
//                             "sub_categoria" => "",
//                             "tags" => ""
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7591630000100",
//                             "nombre" => "Almohada Pch Premium BL/KING/10",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Almohadas Hoteleras",
//                             "sub_categoria" => "",
//                             "tags" => ""
//                         ],
//                         [
//                             "product" => "Topper",
//                             "type" => "simple",
//                             "sku_producto" => "7453073729287",
//                             "nombre" => "Topper Twin",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Topper",
//                             "sub_categoria" => "",
//                             "tags" => ""
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073729294",
//                             "nombre" => "Topper Full",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Topper",
//                             "sub_categoria" => "",
//                             "tags" => ""
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073729300",
//                             "nombre" => "Topper Queen",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Topper",
//                             "sub_categoria" => "",
//                             "tags" => ""
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073729317",
//                             "nombre" => "Topper King",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Topper",
//                             "sub_categoria" => "",
//                             "tags" => ""
//                         ],
//                         [
//                             "product" => "Duvet Insert",
//                             "type" => "simple",
//                             "sku_producto" => "7453073731914",
//                             "nombre" => "Duvet Insert Blanco T200 Algodon Full BL",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Duvet Insert",
//                             "sub_categoria" => "",
//                             "tags" => ""
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073731921",
//                             "nombre" => "Duvet Insert Blanco T200 Algodon Queen BL",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Duvet Insert",
//                             "sub_categoria" => "",
//                             "tags" => ""
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073731938",
//                             "nombre" => "Duvet Insert Blanco T200 Algodon King BL",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Duvet Insert",
//                             "sub_categoria" => "",
//                             "tags" => ""
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073728648",
//                             "nombre" => "Duvet Insert Microfibra 85GSM Blanco TWIN",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Duvet Insert",
//                             "sub_categoria" => "",
//                             "tags" => ""
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073728655",
//                             "nombre" => "Duvet  Insert Microfibra 85gsm FULL/QUEEN",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Duvet Insert",
//                             "sub_categoria" => "",
//                             "tags" => ""
//                         ],
//                         [
//                             "product" => "",
//                             "type" => "simple",
//                             "sku_producto" => "7453073728662",
//                             "nombre" => "Duvet Insert Microfibra 85gsm Blanco KING",
//                             "estatus" => "1",
//                             "visibility" => "visible",
//                             "descripcion" => "",
//                             "detalles" => "",
//                             "stock_av" => "1",
//                             "stock" => "",
//                             "reviews" => "1",
//                             "categoria" => "Duvet Insert",
//                             "sub_categoria" => "",
//                             "tags" => ""
//                         ]
//                     ];
//         $serv = new ProductImportService();
//         $serv->import($productos);

//     return 'listo';
// })->name('carga.inicial');

// Route::get('/listar', function () {
//     $productos = App\Models\Producto::all();

//     foreach($productos as $producto)
//     {
//         $idPri = $producto->id_producto;
//         $idArr = explode('-' , $idPri);

//         if(count($idArr) > 1)
//         {
//             $producto->id_padre = $idArr[0];
//             $producto->save();
//         }
//     }

//     return 'listo';
// });

// Route::get('/mailable', function () {
//     // return new App\Mail\RegistroMail(App\Models\User::find(2));
//     return new App\Mail\OrderMail(3);
// });

// Route::get('/testing', function () {
//     return App\Models\Orden::with('items')->find(3);
// });

// Route::get('/artisan', function () {
//     Artisan::call('migrate');
//     return 'listo';
// });

// Route::get('/mailable', function () {
    
//     return (new App\Mail\InventarioMail())->render();
// });

// Route::get('/api/cargar-productos', [ApiController::class , 'cargarProductos']);
Route::post('/api/cargar-productos', [ApiController::class , 'cargarProductos']);
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
