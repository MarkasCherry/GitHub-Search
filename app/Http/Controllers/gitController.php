<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class gitController extends Controller {

    private function makeGitHubAPIRequest($entity, $search, $page, $sort, $order) {

        $url = 'https://api.github.com/';

        $query =  'search/' . $entity . '?q=' . $search . '&sort=' . $sort . '&order=' . $order . '&page=' . $page;

        return json_decode(Http::get($url . $query) -> getBody());

    }

    public function index() {

        return view('index');

    }


    public function search(Request $request) {

        $search = $request -> input('search');
        $entity = $request -> input('entity');

        if (strpos($entity, 'users') !== false) {
            $entity = 'users';
        } else {
            $entity = 'repositories';
        }

        return redirect() -> route('results', [$entity, $search, 1]);
    }

    public function results($entity, $search, $page = 1, $sort = 'stars', $order = 'desc') {

        $result = $this -> makeGitHubAPIRequest($entity, $search, $page, $sort, $order);

        $items = $result->items;
        $total_items = $result->total_count;


        return view('result', compact('items', 'entity', 'total_items', 'page'));
    }

}


