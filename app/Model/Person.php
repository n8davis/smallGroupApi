<?php
/**
 * Created by PhpStorm.
 * User: nate
 * Date: 10/22/18
 * Time: 8:54 PM
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Carbon;

/**
 * Class Person
 * @package App\Model
 * @property HasManyThrough|Group[] $groups
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Person extends AbstractModel
{

    protected $fillable = [ 'email' ];

    /**
     * @return HasManyThrough
     */
    public function groups()
    {
        return $this->hasManyThrough(
            'App\Model\Group', // groups
            'App\Model\Registration', // registration
            'person_id', // Foreign key on registration table...
            'id', // Foreign key on groups table...
            'id', // Local key on people table...
            'group_id' // Local key on registration table...
        );
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $person = parent::toArray();

        $person[ 'groups' ] = $this->groups;

        return $person;
    }

}