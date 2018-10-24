<?php
/**
 * Created by PhpStorm.
 * User: nate
 * Date: 10/22/18
 * Time: 8:57 PM
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Carbon;

/**
 * Class Group
 * @package App\Model
 * @property HasManyThrough|Person $people
 * @property integer $id;
 * @property string $name
 * @property string $text
 * @property string $image
 * @property string $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Group extends AbstractModel
{

    /**
     * @return HasManyThrough
     */
    public function people()
    {
        return $this->hasManyThrough(
            'App\Model\Person', // people
            'App\Model\Registration', // registration
            'groups_id', // Foreign key on registration table...
            'people_id', // Foreign key on people table...
            'id', // Local key on groups table...
            'id' // Local key on registration table...
        );
    }
}