<?php

namespace App\Repositories;

use App\Models\Classroom;
use App\Repositories\BaseRepository;

/**
 * Class ClassroomRepository
 * @package App\Repositories
 * @version March 31, 2021, 6:41 am UTC
*/

class ClassroomRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'subject_id',
        'teaching_period_id',
        'slug',
        'code',
        'title',
        'description',
        'start_at',
        'end_at',
        'created_by'
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
        return Classroom::class;
    }
}
