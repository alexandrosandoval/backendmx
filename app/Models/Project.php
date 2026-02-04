<?php
// Modelo de proyectos.
namespace App\Models;

use PDO;
use Throwable;

class Project extends BaseModel
{
    public function getActive(): array
    {
        try {
            $stmt = $this->connection()->query(
                'SELECT projects.name, projects.status, projects.progress, users.name AS owner
                FROM projects
                LEFT JOIN users ON users.id = projects.owner_id
                WHERE projects.is_deleted = 0
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
            ['name' => 'Portal Cliente A', 'status' => 'En progreso', 'progress' => 65, 'owner' => 'Ana Ruiz'],
            ['name' => 'Ecommerce B2B', 'status' => 'En revisión', 'progress' => 82, 'owner' => 'Luis Torres'],
            ['name' => 'App Mobile', 'status' => 'Planeación', 'progress' => 25, 'owner' => 'Camila Reyes'],
        ];
    }
}
