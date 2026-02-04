<?php
// Modelo de usuarios.
namespace App\Models;

use PDO;

class User extends BaseModel
{
    public function findByEmail(string $email): ?array
    {
        $stmt = $this->connection()->prepare('SELECT * FROM users WHERE email = :email AND is_deleted = 0 LIMIT 1');
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ?: null;
    }
}
