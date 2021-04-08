<?php

namespace App\Repositories;

use App\Models\QuestionChoiceItem;
use App\Repositories\BaseRepository;

/**
 * Class QuestionChoiceItemRepository
 * @package App\Repositories
 * @version April 8, 2021, 2:33 am UTC
*/

class QuestionChoiceItemRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'question_id',
        'choice_text',
        'is_correct'
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
        return QuestionChoiceItem::class;
    }
}
