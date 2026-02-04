<?php
// Modelo de notificaciones.
namespace App\Models;

use PDO;
use Throwable;

class Notification extends BaseModel
{
    public function getPriority(): array
    {
        try {
            $stmt = $this->connection()->prepare(
                'SELECT title, message, category AS type FROM notifications WHERE is_deleted = 0 ORDER BY created_at DESC LIMIT 5'
            );
            $stmt->execute();
            $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $items ?: $this->demoData();
        } catch (Throwable $exception) {
            return $this->demoData();
        }
    }

    private function demoData(): array
    {
        return [
            ['type' => 'danger', 'title' => 'Tareas atrasadas', 'message' => '3 tareas están atrasadas y requieren atención hoy.'],
            ['type' => 'warning', 'title' => 'Pendientes de hoy', 'message' => 'Tienes 5 pendientes programados para hoy.'],
            ['type' => 'info', 'title' => 'Reuniones de la semana', 'message' => '2 juntas programadas para esta semana.'],
            ['type' => 'success', 'title' => 'Pagos pendientes', 'message' => '4 pagos por confirmar esta semana.'],
            ['type' => 'secondary', 'title' => 'Facturas por hacer', 'message' => '1 factura pendiente por emitir.'],
        ];
    }
}
