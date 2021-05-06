<?php

namespace App\Repositories;

use App\Models\Bookmark;
use App\Repositories\BaseRepository;

/**
 * Class BookmarkRepository
 * @package App\Repositories
 * @version May 6, 2021, 6:52 am UTC
*/

class BookmarkRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'teachable_id',
        'user_id'
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
        return Bookmark::class;
    }
}
