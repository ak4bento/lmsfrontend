<?php

namespace App\Repositories;

use App\Models\Quizzes;
use App\Repositories\BaseRepository;

/**
 * Class QuizzesRepository
 * @package App\Repositories
 * @version April 6, 2021, 1:22 am UTC
*/

class QuizzesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'description',
        'grading_method',
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
        return Quizzes::class;
    }
}
