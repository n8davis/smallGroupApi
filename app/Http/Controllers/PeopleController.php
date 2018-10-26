<?php
/**
 * Created by PhpStorm.
 * User: nate
 * Date: 10/22/18
 * Time: 10:13 PM
 */

namespace App\Http\Controllers;


use App\Model\Person;
use App\SmallGroup\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class PeopleController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {

        $this->model( new Person() );

        return response( )->json( $this->all() ,Response::SUCCESS ) ;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show( $id ){

        $this->model( Person::find( $id ) );

        if( is_null( $this->model() ) ) return response()->json( [ 'errors' => 'Not Found' ] , Response::NOT_FOUND );

        return response()->json( $this->model() ) ;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update( $id ){

        $person = Person::find( $id );
        $this->model( $person );

        if( ! isset( $person ) ) return response()->json( [ 'errors' => 'Not Found'] , Response::NOT_FOUND ) ;

        return response()->json( $this->upsert() , Response::UPDATED ) ;
    }

    /**
     * Groups Person has registered for
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function groups( $id )
    {
        /** @var Person  $person */
        $person = Person::find( $id );

        if( ! isset( $person ) ) response()->json( [] , Response::NOT_FOUND ) ;

        return response()->json( $person->groups , Response::SUCCESS ) ;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function remove( $id ){

        $person = Person::find( $id );

        if( ! isset( $person ) ) return response()->json( [] , Response::NOT_FOUND ) ;

        return response()->json( $person->delete() , Response::SUCCESS ) ;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        $this->model( new Person() );
        return response()->json( $this->upsert() , Response::SUCCESS ) ;
    }

}