<?php
require_once '../base/BaseRepository.php';

class RentRepository extends BaseRepository
{

    public function __construct()
    {
        parent::__construct('l7_rent_info');
    }
}