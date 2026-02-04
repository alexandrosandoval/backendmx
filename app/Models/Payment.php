<?php
// Modelo de pagos.
namespace App\Models;

use PDO;
use Throwable;

class Payment extends BaseModel
{
    public function getOpen(): array
    {
        try {
            $stmt = $this->connection()->query(
                'SELECT clients.name AS client, payments.amount, payments.due_date AS due, payments.status
                FROM payments
                LEFT JOIN clients ON clients.id = payments.client_id
                WHERE payments.is_deleted = 0
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
            ['client' => 'Cliente A', 'amount' => '$12,500', 'due' => '2024-04-19', 'status' => 'Pendiente'],
            ['client' => 'Cliente B', 'amount' => '$8,200', 'due' => '2024-04-22', 'status' => 'En validación'],
            ['client' => 'Cliente C', 'amount' => '$15,900', 'due' => '2024-04-27', 'status' => 'Programado'],
        ];
    }
}
