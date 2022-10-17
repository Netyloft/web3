<?php
require_once '../base/BaseRepository.php';

class RentTypeRepository extends BaseRepository
{

    public function __construct()
    {
        parent::__construct('l7_rent_type');
    }
}