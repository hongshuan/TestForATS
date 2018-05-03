<?php

namespace App\Models;

use App\Common\Database;

class Model
{
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }
}
