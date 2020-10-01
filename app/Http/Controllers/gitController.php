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

        if(is_null($search)) {
            $message = 'Please do not play around with HTML. Thank you !';
            return view('error', compact('message'));

        }

        if (strpos($entity, 'users') !== false) {
            $entity = 'users';
        } else {
            $entity = 'repositories';
        }

        return redirect() -> route('results', [$entity, $search, 1]);
    }

    public function results($entity, $search, $page = 1) {

        //Latter gonna add sorting and ordering.
        $sort = 'stars';
        $order = 'desc';

        $result = $this -> makeGitHubAPIRequest($entity, $search, $page, $sort, $order);

        if(isset($result->message)) {

            $message = $result->message;
            return view('error', compact('message'));

        }

        elseif(is_null($result->total_count) || $result->total_count == 0) {

            $message = 'Sorry, no results found';
            return view('error', compact('message'));

        }

        elseif ($page < 1 || $page > ceil($result->total_count/30)) {

            $message = 'Sorry, this page does not exists';
            return view('error', compact('message'));

        };

        $items = $result->items;
        $total_items = $result->total_count;

        return view('result', compact('items', 'total_items' , 'entity', 'search', 'page', 'sort', 'order'));
    }



}


