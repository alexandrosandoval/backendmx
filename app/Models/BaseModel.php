<?php
// Modelo base con acceso a la base de datos.
namespace App\Models;

use App\Core\Database;
use PDO;

class BaseModel
{
    protected function connection(): PDO
    {
        return Database::getConnection();
    }
}
