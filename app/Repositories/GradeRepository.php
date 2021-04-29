<?php

namespace App\Repositories;

use App\Models\Grade;
use App\Repositories\BaseRepository;

/**
 * Class GradeRepository
 * @package App\Repositories
 * @version April 29, 2021, 1:37 am UTC
*/

class GradeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'gradeable_id',
        'gradeable_type',
        'grading_method',
        'comments',
        'grade',
        'completed_at',
        'graded_by'
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
        return Grade::class;
    }
}
