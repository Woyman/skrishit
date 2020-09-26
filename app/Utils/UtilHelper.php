<?php
namespace App\Utils;

use App\Constants\ItemConst;
use App\Constants\MerchantConst;
use App\Utils\Objects\Response;
use MongoDB\BSON\UTCDateTime;

class UtilHelper
{
    public static function makeResponse($message = '', $data = [])
    {
        $response = new Response($message, $data);
        return $response->toArray();
    }    
}
