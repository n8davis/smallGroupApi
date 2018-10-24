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

class PeopleController extends Controller
{
    /** @var Person $person */
    private $person;
    
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index( Request $request )
    {
        return response( )->json( Person::all() ,Response::SUCCESS ) ;
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show( $id , Request $request ){
        return response()->json( Person::find( $id ) , Response::SUCCESS ) ;
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update( $id , Request $request ){

        $person = Person::find( $id );
        $this->setPerson( $person );

        if( ! isset( $person ) ) return response()->json( false , Response::SUCCESS ) ;

        return response()->json( $this->upsert() , Response::UPDATED ) ;
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function remove( $id ,  Request $request ){

        $person = Person::find( $id );

        if( ! isset( $person ) ) return response()->json( false ) ;

        return response()->json( $person->delete() , Response::SUCCESS ) ;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store( Request $request )
    {
        $this->setPerson( new Person() );
        return response()->json( $this->upsert() , Response::SUCCESS ) ;
    }

    /**
     * @return bool
     */
    public function upsert()
    {

        $this->getPerson()->email = $this->getRequest()->input( 'email' ) ;
        $this->getPerson()->phone = $this->getRequest()->input( 'phone' ) ;
        $this->getPerson()->name  = $this->getRequest()->input( 'name' ) ;

        return $this->getPerson()->save();
    }

    /**
     * @return Person
     */
    public function getPerson(): Person
    {
        return $this->person;
    }

    /**
     * @param Person $person
     * @return PeopleController
     */
    public function setPerson(Person $person): PeopleController
    {
        $this->person = $person;
        return $this;
    }
    
    

}