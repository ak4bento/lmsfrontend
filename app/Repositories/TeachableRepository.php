<?php

namespace App\Repositories;

use App\Models\Teachable;
use App\Repositories\BaseRepository;

/**
 * Class TeachableRepository
 * @package App\Repositories
 * @version April 6, 2021, 3:10 am UTC
*/

class TeachableRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'teachable_id',
        'teachable_type',
        'classroom_id',
        'available_at',
        'expires_at',
        'final_grade_weight',
        'max_attempts_count',
        'order',
        'pass_threshold',
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
        return Teachable::class;
    }
}
