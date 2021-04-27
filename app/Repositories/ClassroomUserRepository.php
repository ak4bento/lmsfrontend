<?php

namespace App\Repositories;

use App\Models\ClassroomUser;
use App\Repositories\BaseRepository;

/**
 * Class ClassroomUserRepository
 * @package App\Repositories
 * @version April 1, 2021, 12:42 am UTC
*/

class ClassroomUserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'classroom_id',
        'user_id',
        'last_accesed_at'
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
        return ClassroomUser::class;
    }
}
