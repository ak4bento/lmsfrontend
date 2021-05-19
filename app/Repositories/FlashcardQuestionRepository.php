<?php

namespace App\Repositories;

use App\Models\FlashcardQuestion;
use App\Repositories\BaseRepository;

/**
 * Class FlashcardQuestionRepository
 * @package App\Repositories
 * @version May 19, 2021, 6:57 am UTC
*/

class FlashcardQuestionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'flashcard_categories_id',
        'question',
        'images',
        'explanation',
        'images_explanation'
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
        return FlashcardQuestion::class;
    }
}
