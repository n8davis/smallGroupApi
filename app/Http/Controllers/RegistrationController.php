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

    /** @var Registration $registration */
    protected $registration ;

    /**
     * Save Registration
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        $this->registration( new Registration() );
        return response()->json( $this->upsert() , Response::SUCCESS ) ;
    }

    /**
     * Getter and Setter for Registration Model
     *
     * @param Registration|null $registration
     * @return Registration
     */
    public function registration( Registration $registration = null )
    {
        if( is_null( $registration ) ) return $this->registration;
        else return $this->registration = $registration;
    }

    /**
     * @return bool
     */
    public function upsert()
    {
        foreach( $this->getRequest()->input() as $key => $value ){
            if( \Illuminate\Database\Schema\Builder::hasColumn( $this->registration()->getTable() , $key ) ) {
                $this->registration()->{$key} = $value;
            }
        }
        return $this->registration()->save() ? true : false;
    }

}