<?php

namespace App\Repositories;

use App\Models\UserTeacher;
use App\Repositories\BaseRepository;

/**
 * Class UserTeacherRepository
 * @package App\Repositories
 * @version March 31, 2021, 6:36 am UTC
*/

class UserTeacherRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token'
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
        return UserTeacher::class;
    }
}
