<?php


namespace App\Repositories;

use App\Models\User;
// use App\Repositories\V1\BaseRepository;
use MongoDB\BSON\ObjectId;

class AdminRepositories
{

    /**
     * UserRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->_collection = $user;
    }

    //Use ObjectID as user's _id. DO NOT USE STRING.
    public function save($attributes)
    {
        if (isset($attributes['_id']))
        {
            $this->_collection->find($attributes['_id'])->update((array) $attributes);
            return (string) $attributes['_id'];
        } else {
            return (string) $this->_collection->raw()->insertOne($attributes)->getInsertedId();
        }
    }

}
