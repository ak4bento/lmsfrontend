<?php

namespace App\Repositories;

use App\Models\QuizAttempt;
use App\Repositories\BaseRepository;

/**
 * Class QuizAttemptRepository
 * @package App\Repositories
 * @version April 19, 2021, 1:05 am UTC
*/

class QuizAttemptRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'teachable_user_id',
        'attempt',
        'questions',
        'answers',
        'completed_at',
        'grading_method'
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
        return QuizAttempt::class;
    }
}
