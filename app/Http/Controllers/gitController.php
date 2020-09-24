<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class gitController extends Controller {

    public function index() {

        return view('index');

    }

    public function search(Request $request) {

        $search = $request -> input('search');

        $url = 'https://api.github.com/';

        $entity = 'users';
        $query =  'search/' . $entity . '?q=' . $search . '&sort=stars&order=desc';

        $response = json_decode(Http::get($url . $query) -> getBody());

        $users = $response -> items;

        return view('result', compact('users'));
    }

}


