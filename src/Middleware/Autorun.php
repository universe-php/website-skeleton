<?php
/**
 * This file is part of the Universe package.
 *
 * @author Volkan Şengül <iletisim@volkansengul.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Middleware;

use Universe\Asteroids\Asteroids;
use Universe\Routing\Router;
use Universe\Shield\Auth;
use Universe\Signalling\Signal;
use Universe\Starship\Middleware;
use App\Middleware\Request;

class Autorun extends Middleware {

    private $input;
    private $auth;
    private $destination;

    public function __construct($destination) {
        parent::__construct();
        // Allow from any origin
       $this->cors();
       $this->destination = $destination;

        if (isset($_SERVER['HTTP_ORIGIN'])) {
            // should do a check here to match $_SERVER['HTTP_ORIGIN'] to a
            // whitelist of safe domains
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');    // cache for 1 day
        }

        $this->input = new Signal();
        $this->auth = new Auth();
        $token = $this->input->getHeader('authorization');
        //$routePermission = Router::getPermission();

        try {
            if (isset($this->destination->permission) && !in_array('public',$this->destination->permission)){
                $isValid = $this->auth->jwt()->tokenVerify($token);
                if (!$isValid) {
                    throw new Asteroids('Yetkisiz erişim');
                }
            }


        } catch (Asteroids $e){
            $e->fail();
        }


    }

    private function cors(){
            // Allow from any origin
            if (isset($_SERVER['HTTP_ORIGIN'])) {
                // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
                // you want to allow, and if so:
                header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
                header('Access-Control-Allow-Credentials: true');
                header('Access-Control-Max-Age: 86400');    // cache for 1 day
            }

            // Access-Control headers are received during OPTIONS requests
            if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

                if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                    // may also be using PUT, PATCH, HEAD etc
                    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

                if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                    header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

                exit(0);
            }
    }
}

?>
