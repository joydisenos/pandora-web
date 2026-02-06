<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use CodeDredd\Soap\Facades\Soap;

class Facturacion extends Model
{
    public static function consulta()
    {
        $url = 'https://dgi-fepws-test.mef.gob.pa:40010/FepWcfService/feRecepFE.svc';

            $response = Soap::baseWsdl($url)
                                ->withBasicAuth(env('DGI_USER' , '') , env('DGI_PASS' , ''))
                            ->call('FeRecepFE');

        return $response->getBody();
    }
}