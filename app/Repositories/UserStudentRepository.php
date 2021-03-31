<?php

namespace App\Repositories;

use App\Models\UserStudent;
use App\Repositories\BaseRepository;

/**
 * Class UserStudentRepository
 * @package App\Repositories
 * @version March 31, 2021, 6:21 am UTC
*/

class UserStudentRepository extends BaseRepository
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
        return UserStudent::class;
    }
}
