<?php

namespace App\Repositories;

use App\Models\QuestionQuizzes;
use App\Repositories\BaseRepository;

/**
 * Class QuestionQuizzesRepository
 * @package App\Repositories
 * @version April 6, 2021, 2:22 am UTC
*/

class QuestionQuizzesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'quizzes_id',
        'question_id'
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
        return QuestionQuizzes::class;
    }
}
