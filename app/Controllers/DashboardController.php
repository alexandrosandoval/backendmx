<?php
// Controlador principal del dashboard.
namespace App\Controllers;

use App\Core\Controller;
use App\Models\AuditLog;
use App\Models\Notification;
use App\Models\Project;
use App\Models\Task;
use App\Models\Payment;
use App\Models\Meeting;

class DashboardController extends Controller
{
    public function index(): void
    {
        $this->requireAuth();

        $notifications = (new Notification())->getPriority();
        $projects = (new Project())->getActive();
        $tasks = (new Task())->getPending();
        $payments = (new Payment())->getOpen();
        $meetings = (new Meeting())->getUpcoming();
        $logEntries = (new AuditLog())->getRecent();

        view('dashboard/index', [
            'notifications' => $notifications,
            'projects' => $projects,
            'tasks' => $tasks,
            'payments' => $payments,
            'meetings' => $meetings,
            'logEntries' => $logEntries,
            'user' => $_SESSION['user'],
        ]);
    }
}
