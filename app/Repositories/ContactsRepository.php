<?php

namespace App\Repositories;

use App\Models\Contacts;
use App\Repositories\BaseRepository;

/**
 * Class ContactsRepository
 * @package App\Repositories
 * @version September 6, 2021, 8:36 pm UTC
*/

class ContactsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'phone',
        'message',
        'file'
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
        return Contacts::class;
    }
}
