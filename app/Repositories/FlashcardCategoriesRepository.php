<?php

namespace App\Repositories;

use App\Models\FlashcardCategories;
use App\Repositories\BaseRepository;

/**
 * Class FlashcardCategoriesRepository
 * @package App\Repositories
 * @version May 19, 2021, 6:56 am UTC
*/

class FlashcardCategoriesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'parent_id',
        'second_parent_id',
        'third_parent_id',
        'count_question',
        'category'
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
        return FlashcardCategories::class;
    }
}
