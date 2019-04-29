<?php

require_once "Controller.php";

class NotAuthorizedController extends Controller
{
    public function manage(Request $req)
    {
        $response = new Response('401', null, null, $req->getAccept());
        $response->generate();
    }

}