<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class PagesController extends Controller {

    //
    public function webhook2(Request $request) {
        $my_file = 'file.txt';
        $handle = fopen($my_file, 'w') or die('Cannot open file:  ' . $my_file);

        $my_file = 'file.txt';
        $handle = fopen($my_file, 'w') or die('Cannot open file:  ' . $my_file);
        $data = 'This is the data';
        fwrite($handle, json_encode($request->all()));
    }

    public function webhook(Request $request) {

        $my_file = 'file.txt';
        $handle = fopen($my_file, 'w') or die('Cannot open file:  ' . $my_file);
        $data = 'This is the dataaaaaaaaaaaaaaaaaaaaa';
        fwrite($handle, json_encode($request->all()));
        
        DB::table('coinbase_webhook_calls')->insert(
                ['type' => 'test', 'payload' => $request->input()]
        );
        DB::table('coinbase_webhook_calls')->insert(
                ['type' => 'test', 'payload' => $request->all()]
        );

//        $my_file = 'file.txt';
//        $handle = fopen($my_file, 'w') or die('Cannot open file:  ' . $my_file);

        
    }

}
