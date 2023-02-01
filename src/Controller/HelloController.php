<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class HelloController {

  public function sayHello() : Response {
    $response = "<html><body><h1 style='text-align: center;'>Hello World!</h1><html><body>";

    return new Response($response);
  }
}