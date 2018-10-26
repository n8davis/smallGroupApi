<?php
/**
 * Created by PhpStorm.
 * User: nate
 * Date: 10/22/18
 * Time: 8:59 PM
 */

namespace App\Model\Person;

use App\Model\AbstractAddress;

/**
 * Class Address
 * @package App\Model\Person
 * @property int $person_id
 */
class Address extends AbstractAddress
{

    protected $table = 'person_addresses';

    protected $fillable = [ 'line1' , 'people_id' ];

}