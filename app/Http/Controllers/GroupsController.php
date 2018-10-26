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

    /**
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $this->model( new Group() );

        return response( )->json( $this->all() ,Response::SUCCESS ) ;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show( $id ){

        $this->model( Group::find( $id ) );

        if( is_null( $this->model() ) ) return response()->json( [ 'errors' => 'Not Found' ] , Response::NOT_FOUND );

        return response()->json( $this->model() ) ;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update( $id ){

        $group = Group::find( $id );
        $this->model( $group );

        if( ! isset( $group ) ) return response()->json( [] , Response::NOT_FOUND ) ;

        return response()->json( $this->upsert() , Response::UPDATED  ) ;
    }

    /**
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        $this->model( new Group() );
        return response()->json( $this->upsert() , Response::UPDATED  ) ;
    }

    /**
     * People in Group
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function people( $id )
    {
        /** @var Group $group */
        $group = Group::find( $id ) ;

        if( ! isset( $group ) ) return response()->json( [] , Response::NOT_FOUND ) ;

        return response()->json( $group->people , Response::SUCCESS ) ;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function remove( $id ){

        $group = Group::find( $id );

        if( ! isset( $group ) ) return response()->json( [] , Response::NOT_FOUND ) ;

        return response()->json( $group->delete() , Response::SUCCESS  ) ;
    }

}