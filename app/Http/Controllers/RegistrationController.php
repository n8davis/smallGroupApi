<?php
/**
 * Created by PhpStorm.
 * User: nate
 * Date: 10/23/18
 * Time: 7:12 PM
 */

namespace App\Http\Controllers;

use App\Model\Registration;
use App\SmallGroup\Response;

class RegistrationController extends Controller
{

    public function index()
    {
        $this->model( new Registration() );

        return response( )->json( $this->all() ,Response::SUCCESS ) ;

    }

    /**
     * Save Registration
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        $this->model( new Registration() )->upsert();

        $results = empty( $this->getErrors() ) ? true : $this->getErrors() ;

        return response()->json( $results , Response::SUCCESS ) ;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show( $id )
    {

        $this->model( Registration::find( $id ) );

        if( is_null( $this->model() ) ) return response()->json( [ 'errors' => 'Not Found' ] , Response::NOT_FOUND );

        return response()->json( $this->model() ) ;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update( $id )
    {
        $this->model( Registration::find( $id ) );

        if( is_null( $this->model() ) ) return response()->json( [ 'errors' => 'Not Found' ] , Response::NOT_FOUND );

        $this->upsert();

        $results = empty( $this->getErrors() ) ? true : $this->getErrors() ;

        return response()->json( $results , Response::UPDATED ) ;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function remove( $id )
    {
        $this->model( Registration::find( $id ) ) ;

        if( is_null( $this->model() ) ) return response()->json( [ 'errors' => 'Not Found' ] , Response::NOT_FOUND );

        return response()->json( $this->model()->delete() ) ;
    }

}