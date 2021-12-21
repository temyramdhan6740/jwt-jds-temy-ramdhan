<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ItemController extends Controller
{
    public function itemAuth()
    {
        $json = file_get_contents('https://60c18de74f7e880017dbfd51.mockapi.io/api/v1/jabar-digital-services/product');
        $data_json = json_decode($json, TRUE);
        $data = [];

        if (Auth::user()->level == 'User') {
            foreach ($data_json as $dj) {
                $data[] = array(
                    'id' => $dj['id'],
                    'createdAt' => $dj['createdAt'],
                    //'price' => convertCurrency($dj['price'], 'USD', 'IDR'),
                    //'department' => $dj['department'],
                    'product' => $dj['product']
                );
            }
        } else {
            foreach ($data_json as $dj) {
                $data[] = array(
                    'price' => $dj['price'] * 14342.00,
                    'department' => $dj['department'],
                    'product' => $dj['product']
                );
            }
        }

        return response()->json($data, 200);
    }

    public function itemDetail($item_id)
    {
        if (Auth::user()->level == 'User') {
            $json = file_get_contents('https://60c18de74f7e880017dbfd51.mockapi.io/api/v1/jabar-digital-services/product');
            $data_json = json_decode($json, TRUE);
            //$find_jsons = json_decode(array_search($item_id, $data_json), TRUE);
            $data = [];
            foreach ($data_json as $dj) {
                if ($dj['id'] === $item_id) {
                    $price = array(
                        'usd' => $dj['price'],
                        'idr' => convertCurrency($dj['price'], 'USD', 'IDR')
                    );
                    $data[] = array(
                        'id' => $dj['id'],
                        'createdAt' => $dj['createdAt'],
                        'price' => $price,
                        'department' => $dj['department'],
                        'product' => $dj['product']
                    );
                }
            }
        } else {
            $data = convertCurrency(10, 'USD', 'IDR');
        }

        return response()->json($data, 200);
    }
}
