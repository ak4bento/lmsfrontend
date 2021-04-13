<?php

namespace App\Repositories;

use App\Models\Resource;
use App\Repositories\BaseRepository;

/**
 * Class ResourceRepository
 * @package App\Repositories
 * @version April 13, 2021, 2:36 am UTC
*/

class ResourceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'type',
        'title',
        'data',
        'description',
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
        return Resource::class;
    }
}
