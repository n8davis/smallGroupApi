<?php
/**
 * Created by PhpStorm.
 * User: nate
 * Date: 10/22/18
 * Time: 8:58 PM
 */

namespace App\Model\Group;

use App\Model\AbstractAddress;

/**
 * Class Address
 * @package App\Model\Group
 * @property int $group_id
 */
class Address extends AbstractAddress
{
    protected $table = 'group_addresses';

    protected $fillable = [ 'line1' , 'group_id' ];

}