<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class gitController extends Controller {

    private function makeGitHubAPIRequest($entity, $search, $sort, $order) {

        $url = 'https://api.github.com/';

        $query =  'search/' . $entity . '?q=' . $search . '&sort=' . $sort . '&order=' . $order;

        return json_decode(Http::get($url . $query) -> getBody()) -> items;

    }

    public function index() {

        return view('index');

    }


    public function search(Request $request) {

        $search = $request -> input('search');

        $sort = 'stars';
        $order = 'desc';

        $users = $this -> makeGitHubAPIRequest('users', $search, $sort, $order);
        $repos = $this -> makeGitHubAPIRequest('repositories', $search, $sort, $order);

        return view('result', compact('users', 'repos'));
    }

}


