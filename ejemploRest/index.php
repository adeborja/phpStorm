<?php

require_once "Request.php";
require_once "Response.php";
require_once "model/Autenticacion.php";

//Autoload rules
spl_autoload_register('apiAutoload');
function apiAutoload($classname)
{
    $res = false;

    //If the class name ends in "Controller", then try to locate the class in the controller directory to include it (require_once)
    if (preg_match('/[a-zA-Z]+Controller$/', $classname)) {
        if (file_exists(__DIR__ . '/controller/' . $classname . '.php')) {
//            echo "cargamos clase: " . __DIR__ . '/controller/' . $classname . '.php';
            require_once __DIR__ . '/controller/' . $classname . '.php';
            $res = true;
        }
    } elseif (preg_match('/[a-zA-Z]+Model$/', $classname)) {
        if (file_exists(__DIR__ . '/model/' . $classname . '.php')) {
//            echo "<br/>cargamos clase: " . __DIR__ . '/model/' . $classname . '.php';
            require_once __DIR__ . '/model/' . $classname . '.php';
//            echo "clase cargada.......................";
            $res = true;
        }
    }
    //Instead of having Views, like in a Model-View-Controller project,
    //we will have a Response class. So we don't need the following.
    //Although we could have different classes to generate the output,
    //for example: JsonView, XmlView, HtmlView... I think in our case
    //it will be better to have asingle class to generate the output (Response class)
    //elseif (preg_match('/[a-zA-Z]+View$/', $classname)) {
    //    require_once __DIR__ . '/views/' . $classname . '.php';
    //    $res = true;
    //}
    return $res;
}


//Let's retrieve all the information from the request
$verb = $_SERVER['REQUEST_METHOD'];
//IMPORTANT: WITH CGI OR FASTCGI, PATH_INFO WILL NOT BE AVAILABLE!!!
//SO WE NEED FPM OR PHP AS APACHE MODULE (UNSECURE, DEPRECATED) INSTEAD OF CGI OR FASTCGI
$path_info = !empty($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : (!empty($_SERVER['ORIG_PATH_INFO']) ? $_SERVER['ORIG_PATH_INFO'] : '');
$url_elements = explode('/', $path_info);
//$url_elements = explode('/', $_SERVER['PATH_INFO']);
$query_string = null;
if (isset($_SERVER['QUERY_STRING'])) {
    parse_str($_SERVER['QUERY_STRING'], $query_string);
}
$body = file_get_contents("php://input");
if ($body === false) {
    $body = null;
}
$content_type = null;
if (isset($_SERVER['CONTENT_TYPE'])) {
    $content_type = $_SERVER['CONTENT_TYPE'];
}
$accept = null;
if (isset($_SERVER['HTTP_ACCEPT'])) {
    $accept = $_SERVER['HTTP_ACCEPT'];
}

$usuario = null;
$contrasena = null;
/*if(isset($_SERVER['PHP_AUTH_USER']))
{
    $usuario = $_SERVER['PHP_AUTH_USER'];

    $contrasena = $_SERVER['PHP_AUTH_PW'];
}*/

$token_req = null;
if(isset($_SERVER['HTTP_AUTHORIZATION']))
{
    $clave = explode(' ', $_SERVER['HTTP_AUTHORIZATION']);

    switch ($clave[0])
    {
        case "Basic":
            $usuario = $_SERVER['PHP_AUTH_USER'];

            $contrasena = $_SERVER['PHP_AUTH_PW'];
            break;

        case "Bearer":
            $token_req = $clave[1];
            break;
    }


}



//https://stackoverflow.com/questions/40582161/how-to-properly-use-bearer-tokens
//Este objeto tiene todos los datos mandados en la peticion (usuario, cuerpo, etc)
$req = new Request($verb, $url_elements, $query_string, $body, $content_type, $accept, $usuario, $contrasena, $token_req);


// route the request to the right place
//Aqui se puede especificar que objeto (Libro, Capitulo, etc) se acepta y cual no, o en $verb
$controller_name = ucfirst($url_elements[1]) . 'Controller';


//$valido = Autenticacion::validarUsuarioBasico($usuario, $contrasena);
//$valido = Autenticacion::validarUsuario($req);

//if($valido || ($url_elements[1] == "usuario" && $verb == "POST"))
//if($token != null || ($url_elements[1] == "usuario" && $verb == "POST"))


try
{
    $token = Autenticacion::validarUsuarioDevuelveToken($req);

    if(token != null || ($url_elements[1] == "usuario" && $verb == "POST"))
    {
        //Si el usuario es correcto, se hace lo siguiente
        if (class_exists($controller_name)) {
            $controller = new $controller_name();
            $action_name = 'manage' . ucfirst(strtolower($verb)) . 'Verb';
            $controller->$action_name($req, $token);
            //$result = $controller->$action_name($req);
            //print_r($result);
        } //If class does not exist, we will send the request to NotFoundController
        else {
            $controller = new NotFoundController();
            $controller->manage($req); //We don't care about the HTTP verb
        }
    }
//Si no es correcto, mandar error 401
    else {
        $controller = new NotAuthorizedController();
        $controller->manage($req); //We don't care about the HTTP verb
    }
}
catch (Exception $e)
{
    $controller = new ErrorController();
    $controller->manage($req, $e->getMessage());
}




/*$token = Autenticacion::validarUsuarioDevuelveToken($req);

if(!is_numeric($token) || ($url_elements[1] == "usuario" && $verb == "POST"))
{
    //Si el usuario es correcto, se hace lo siguiente
    if (class_exists($controller_name)) {
        $controller = new $controller_name();
        $action_name = 'manage' . ucfirst(strtolower($verb)) . 'Verb';
        $controller->$action_name($req, $token);
        //$result = $controller->$action_name($req);
        //print_r($result);
    } //If class does not exist, we will send the request to NotFoundController
    else {
        $controller = new NotFoundController();
        $controller->manage($req); //We don't care about the HTTP verb
    }
}
//Si no es correcto, mandar error 401
else {
    if(!is_numeric($token))
    {
        $controller = new NotAuthorizedController();
        $controller->manage($req); //We don't care about the HTTP verb
    }
    else
    {
        $mensaje = null;
        switch ($token)
        {
            case 50:
                $mensaje = "El token no esta activo";
                break;
        }
    }
}*/


//DEBUG / TESTING:
//echo "<br/>URL_ELEMENTS:" ;
//print_r ($req->getUrlElements());
//echo "<br/>VERB:" ;
//print_r ($req->getVerb());
//echo "<br/>QUERY_STRING:" ;
//print_r ($req->getQueryString());
//echo "<br/>BODY_PARAMS:" ;
//print_r ($req->getBodyParameters());

