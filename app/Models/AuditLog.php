<?php
// Modelo de bitácora de uso.
namespace App\Models;

use PDO;
use Throwable;

class AuditLog extends BaseModel
{
    public function getRecent(): array
    {
        try {
            $stmt = $this->connection()->query(
                'SELECT users.name AS user, audit_logs.action, audit_logs.created_at AS time
                FROM audit_logs
                LEFT JOIN users ON users.id = audit_logs.user_id
                ORDER BY audit_logs.created_at DESC
                LIMIT 3'
            );
            $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $items ?: $this->demoData();
        } catch (Throwable $exception) {
            return $this->demoData();
        }
    }

    private function demoData(): array
    {
        return [
            ['user' => 'Ana Ruiz', 'action' => 'Actualizó el avance del proyecto Portal Cliente A', 'time' => 'Hace 10 min'],
            ['user' => 'Luis Torres', 'action' => 'Registró un pago de Cliente B', 'time' => 'Hace 25 min'],
            ['user' => 'Camila Reyes', 'action' => 'Creó una nueva tarea de QA', 'time' => 'Hace 45 min'],
        ];
    }
}
