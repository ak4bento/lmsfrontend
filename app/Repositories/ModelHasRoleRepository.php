<?php

namespace App\Repositories;

use App\Models\ModelHasRole;
use App\Repositories\BaseRepository;

/**
 * Class ModelHasRoleRepository
 * @package App\Repositories
 * @version April 29, 2021, 6:10 am UTC
*/

class ModelHasRoleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'model_type',
        'model_id'
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
        return ModelHasRole::class;
    }
}
