<?php
// Modelo de reuniones.
namespace App\Models;

use PDO;
use Throwable;

class Meeting extends BaseModel
{
    public function getUpcoming(): array
    {
        try {
            $stmt = $this->connection()->query(
                'SELECT meetings.title, meetings.meeting_date AS date, meetings.meeting_time AS time, users.name AS owner
                FROM meetings
                LEFT JOIN users ON users.id = meetings.organizer_id
                WHERE meetings.is_deleted = 0
                LIMIT 2'
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
            ['title' => 'Kickoff Cliente A', 'date' => '2024-04-18', 'time' => '10:00', 'owner' => 'Ana Ruiz'],
            ['title' => 'Seguimiento Ecommerce', 'date' => '2024-04-20', 'time' => '15:30', 'owner' => 'Luis Torres'],
        ];
    }
}
