<?php

namespace App\Repositories;

use App\Models\FlashcardCategoriesQuestion;
use App\Repositories\BaseRepository;

/**
 * Class FlashcardCategoriesQuestionRepository
 * @package App\Repositories
 * @version June 21, 2021, 6:07 am UTC
*/

class FlashcardCategoriesQuestionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'flashcard_questions_id',
        'first_parent_id',
        'second_parent_id',
        'third_parent_id',
        'flashcard_categories_id'
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
        return FlashcardCategoriesQuestion::class;
    }
}
