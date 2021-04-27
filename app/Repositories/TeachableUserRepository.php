<?php

namespace App\Repositories;

use App\Models\TeachableUser;
use App\Repositories\BaseRepository;

/**
 * Class TeachableUserRepository
 * @package App\Repositories
 * @version April 19, 2021, 1:07 am UTC
*/

class TeachableUserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'classroom_user_id',
        'teachable_id',
        'completed_at'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return TeachableUser::class;
    }
}
