<?php
/**
 * Created by PhpStorm.
 * User: nate
 * Date: 10/22/18
 * Time: 10:12 PM
 */

namespace App\Http\Controllers;


use App\Model\Group;
use App\SmallGroup\Response;
use Illuminate\Http\Request;

class GroupsController extends Controller
{
    /** @var Group $group */
    private $group;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index( Request $request )
    {
        return response( )->json( Group::all() , Response::SUCCESS ) ;
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show( $id , Request $request ){
        return response()->json( Group::find( $id ) , Response::SUCCESS ) ;
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update( $id , Request $request ){

        $group = Group::find( $id );
        $this->setGroup( $group );

        if( ! isset( $group ) ) return response()->json( false , Response::SUCCESS ) ;

        return response()->json( $this->upsert() , Response::UPDATED  ) ;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store( Request $request )
    {
        $this->setGroup( new Group() );
        return response()->json( $this->upsert() , Response::UPDATED  ) ;
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function remove( $id ,  Request $request ){

        $group = Group::find( $id );

        if( ! isset( $group ) ) return response()->json( false ) ;

        return response()->json( $group->delete() , Response::SUCCESS  ) ;
    }

    /**
     * @return bool
     */
    public function upsert()
    {

        $this->getGroup()->image       = $this->getRequest()->input( 'image' ) ;
        $this->getGroup()->description = $this->getRequest()->input( 'description' ) ;
        $this->getGroup()->name        = $this->getRequest()->input( 'name' ) ;

        return $this->getGroup()->save();
    }

    /**
     * @return Group
     */
    public function getGroup(): Group
    {
        return $this->group;
    }

    /**
     * @param Group $group
     * @return GroupsController
     */
    public function setGroup(Group $group): GroupsController
    {
        $this->group = $group;
        return $this;
    }


}