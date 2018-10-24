<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @var Request $request
     */
    protected $request ;

    public function __construct( Request $request )
    {
        $this->setRequest( $request );

    }

    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * @param Request $request
     * @return Controller
     */
    public function setRequest(Request $request): Controller
    {
        $this->request = $request;
        return $this;
    }


}
