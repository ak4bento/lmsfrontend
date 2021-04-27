<?php

namespace App\Repositories;

use App\Models\TeachingPeriod;
use App\Repositories\BaseRepository;

/**
 * Class TeachingPeriodRepository
 * @package App\Repositories
 * @version March 31, 2021, 6:40 am UTC
*/

class TeachingPeriodRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'start_at',
        'end_at'
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
        return TeachingPeriod::class;
    }
}
