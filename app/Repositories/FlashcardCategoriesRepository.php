<?php

namespace App\Repositories;

use App\Models\FlashcardCategories;
use App\Repositories\BaseRepository;

/**
 * Class FlashcardCategoriesRepository
 * @package App\Repositories
 * @version June 21, 2021, 6:06 am UTC
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
        'level',
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
