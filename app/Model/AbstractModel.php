<?php
/**
 * Created by PhpStorm.
 * User: nate
 * Date: 10/22/18
 * Time: 8:55 PM
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AbstractModel
 * @package App\Model
 */
abstract class AbstractModel extends Model
{
    /**
     * Columns to check for each table
     *
     * @return array
     */
    private function whereColumns()
    {
        return [
            'people' => [ 'email' ],
            'groups'  => [],
            'person_addresses' => [ 'person_id' , 'line1' ],
            'group_addresses' => [ 'group_id' , 'line1' ] ,
            'registrations' => [ 'person_id' , 'group_id' ]
        ];
    }

    /**
     * Update or insert model
     *
     * @return bool
     */
    public function upsert()
    {
        $where = [];
        if( ! array_key_exists( $this->getTable() , $this->whereColumns() ) ) return false;

        $whereColumns = $this->whereColumns()[ $this->getTable() ];

        foreach( $this->getAttributes() as $column => $value ){
            if( in_array( $column , $whereColumns ) ) $where[] = [ $column , '=' , $value ];
        }

        $found  = $this->where( $where )->first();
        $entity = $this;

        if( isset( $found ) ) $entity = $found;

        $saved = $entity->save();

        if( $saved ){
            foreach( $entity->getAttributes() as $col => $attribute ){
                $this->{ $col } = $attribute ;
            }
        }

        return $saved ;
    }
}