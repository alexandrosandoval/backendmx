<?php
// Modelo de tareas.
namespace App\Models;

use PDO;
use Throwable;

class Task extends BaseModel
{
    public function getPending(): array
    {
        try {
            $stmt = $this->connection()->query(
                'SELECT tasks.title, projects.name AS project, tasks.due_date AS due, tasks.priority, tasks.status
                FROM tasks
                LEFT JOIN projects ON projects.id = tasks.project_id
                WHERE tasks.is_deleted = 0
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
            ['title' => 'Definir alcance', 'project' => 'Portal Cliente A', 'due' => '2024-04-18', 'priority' => 'Alta', 'status' => 'Atrasada'],
            ['title' => 'Diseño UI', 'project' => 'Ecommerce B2B', 'due' => '2024-04-21', 'priority' => 'Media', 'status' => 'En curso'],
            ['title' => 'QA módulo pagos', 'project' => 'App Mobile', 'due' => '2024-04-25', 'priority' => 'Alta', 'status' => 'Pendiente'],
        ];
    }
}
