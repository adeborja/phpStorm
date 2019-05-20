<?php

require_once "Controller.php";

class ErrorController extends Controller
{
    public function manage(Request $req, $errorMessage)
    {
        $response = new Response('401', null, $errorMessage, $req->getAccept());
        $response->generate();
    }

}