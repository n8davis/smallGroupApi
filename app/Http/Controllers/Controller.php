<?php

namespace App\Http\Controllers;

use App\Model\AbstractModel;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @var Request $request
     */
    protected $request ;

    /**
     * @var AbstractModel
     */
    protected $model ;

    /**
     * Errors during Http Request
     * @var array
     */
    protected $errors = [];

    /**
     * API Limit for entities
     *
     * @var int $limit
     */
    protected $limit = 250;

    /**
     * Controller constructor.
     * @param Request $request
     */
    public function __construct( Request $request )
    {
        $this->setRequest( $request );

    }

    public function all()
    {

        if( $this->getRequest()->input( 'orderBy' ) && $this->getRequest()->input('direction' ) ){

            $this->model = $this->model()->orderBy(
                $this->getRequest()->input( 'orderBy' ) ,
                $this->getRequest()->input('direction' )
            );

        }

        return $this->model()->paginate( $this->limit );
    }

    /**
     * @return bool
     */
    public function upsert()
    {
        $columnsFound = false;
        $saveAddress  = false;

        if( empty( $this->getRequest() ) ) {
            $this->addError( "There was a problem with the request." );
            return false;
        }

        foreach( $this->getRequest()->input() as $key => $value ){

            if( strtolower( $key ) === 'address' ) $saveAddress = true;
            else if( $this->model()->getConnection()->getSchemaBuilder()->hasColumn( $this->model()->getTable() , $key ) ) {
                $this->model()->{$key} = $value;
                $columnsFound = true;
            }
        }

        if( ! $columnsFound ) {
            $this->addError( "There was a server error." );
            return false;
        }

        $save = $this->model()->upsert() ? true : false;

        if( $saveAddress ){
            if( ! $this->saveAddress() ){
                $this->addError( 'There was a problem saving the address' );
            }
        }
        return $save;
    }

    /**
     * @return bool
     */
    private function saveAddress()
    {
        $address = null;
        $columnsFound = false;

        if( strpos( strtolower( $this->getRequest()->getRequestUri() ) , 'people' ) !== false ){
            $address = new \App\Model\Person\Address();
            $address->person_id = $this->model()->id;
        }
        else if( strpos( strtolower( $this->getRequest()->getRequestUri() ) , 'group' ) !== false ){
            $address = new \App\Model\Group\Address();
            $address->group_id = $this->model()->id;
        }

        if( is_null( $address ) ) return false;

        if( ! empty( $this->getRequest()->input( 'address' ) ) ){
            foreach( $this->getRequest()->input( 'address' ) as $column => $value ){
                if( $address->getConnection()->getSchemaBuilder()->hasColumn( $address->getTable() , $column ) ) {
                    $address->{$column} = $value;
                    $columnsFound = true;
                }
            }
        }

        if( ! $columnsFound ) {
            $this->addError( "No address columns found." );
            return false;
        }

        return $address->upsert() ? true : false;
    }

    /**
     * @param AbstractModel|null $model
     * @return $this|AbstractModel
     */
    public function model( AbstractModel $model = null )
    {
        if( is_null( $model ) ) return $this->model;

        $this->model = $model ;

        return $this;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param Request $request
     * @return Controller
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     * @return Controller
     */
    public function setErrors(array $errors)
    {
        $this->errors = $errors;
        return $this;
    }

    /**
     * @param $error
     * @return $this
     */
    public function addError( $error )
    {
        $errors = $this->getErrors();
        $errors[] = $error ;
        $this->setErrors( $errors ) ;
        return $this;
    }
}
