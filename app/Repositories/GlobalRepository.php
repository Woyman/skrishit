<?php

namespace App\Repositories;

use DateTime;
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;
use MongoDB\Operation\FindOneAndUpdate;

abstract class GlobalRepository
{
    protected $_collection;

    public function save($attributes) //can use to update
    {
        $iso_date = new UTCDateTime(new DateTime());

        if (isset($attributes['created_at']))
            unset($attributes['created_at']);

    	if (!isset($attributes['_id'])) {
            $attributes['_id'] = (string) new ObjectId();
            $attributes['created_at'] = $iso_date;
        }

        $attributes['updated_at'] = $iso_date;
        return $this->_collection->raw()
            ->findOneAndUpdate(
                ['_id' => $attributes['_id']],
                ['$set' => $attributes],
                [
                    'upsert' => true,
                    'returnDocument' => FindOneAndUpdate::RETURN_DOCUMENT_AFTER
                ]
            )['_id'];
    }

    public function getOne($filter = [], $select = null, $sort = null)
    {
        $opts = [];

        if($select)
            $opts['projection'] = $select;

        if($sort)
            $opts['sort'] = $sort;

        return $this->_collection->raw()->findOne($filter, $opts);
    }

    public function getId($id, $select = null){
        return ($select) ? $this->_collection->raw()
            ->findOne(['_id' => $id], ['projection' => $select]) :
                $this->_collection->raw()->findOne(['_id' => $id]);
    }

    public function getAll($filter = [], $select = null, $sort = null, $limit = null, $offset = 0)
    {
        $opts = [];
        if($select) $opts['projection'] = $select;
        if($sort) $opts['sort'] = $sort;
        if($limit) {
            $opts['limit'] = intval($limit);
            $opts['skip'] = intval($offset);
        }

        return $this->_collection->raw()
            ->find($filter, $opts)->toArray();
    }

    public function delete($id)
    {
        if(is_array($id)) {
            $delete = $this->_collection->raw()->deleteMany(['_id' => ['$in' => $id]]);
        } else {
            $delete = $this->_collection->raw()->deleteOne(['_id' => $id]);
        }

        return $delete;
    }

    public function updateRaw($id, $params)
    {        
        if(!is_array($id))
        {
            $updateOne = $this->_collection->raw()->updateOne(['_id' => $id ], $params);
            
        }else{
            $updateOne = $this->_collection->raw()->updateOne($id, $params);
        }
        
        return $updateOne->getModifiedCount();
    }

    public function distinct($key, $filter = [], $select = null, $sort = null)
    {
        $opts = [];
        if($select) $opts['projection'] = $select;
        if($sort) $opts['sort'] = $sort;

        return $this->_collection->raw()->distinct($key, $filter);
    }

    public function aggregate($param)
    {
        return $this->_collection->raw()->aggregate($param)->toArray();
    }

    public function filterSearchinArray($res, $searchCols, $search)
    {
      $arrayBaru = array();

      $result = array_filter($res, function($arr) use ($searchCols, $search){

        foreach($searchCols as $cols )
        {
            if(array_key_exists($cols, $arr))
            {
                if(!(stripos($arr[$cols], $search ) === false) ) return true;
            }else{
                return false;
            }
        }
        return false;

      });

      foreach($result as $r)
      {
        $arrayBaru[] = $r;
      }

      return $arrayBaru;
    }

    /*
    *   this function is used only for sorting arrays that do not use sorting from a database
    *   params:
    *   $result = the array will be sorted 
    *   $columns = array containing a list of column names to be sorted
    *   $column = the order of the columns to be sorted. Ex: 0, 2, 1
    *   $dir = direction or sorted, 1 = ASC, -1 = DESC
    */
    public function sortingInArray($results, $columns, $column, $dir)
    {
        $array_sort = [];
        foreach ($results as $key => $row)
        {
            $array_sort[$key] = $row[$columns[$column]];
        }

        array_multisort($array_sort, ($dir == 1) ? SORT_ASC : SORT_DESC, $results);

        return $results;
    }


}
