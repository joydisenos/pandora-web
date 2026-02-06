<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facturacion;

class FacturacionController extends Controller
{
    public function consulta()
    {
        return Facturacion::consulta();
    }
}
