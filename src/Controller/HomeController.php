<?php

namespace App\Controller;

use Universe\Starship\Controller;

/**
 * @Route("/")
 */
class HomeController extends Controller {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @Route("", methods={"GET"}, name="home page")
     */
    public function homepage(){
        return $this->render('pages/home.twig',[
            'title'=>'Welcome to Universe'
        ]);
    }

}