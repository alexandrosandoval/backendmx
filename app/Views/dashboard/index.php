<?php
// Vista principal del dashboard.
ob_start();
?>
<div class="app-shell">
    <aside class="sidebar">
        <div class="brand">
            <i class="fa-solid fa-layer-group"></i>
            <div>
                <h1>ProjectFlow</h1>
                <p>Sistema inteligente</p>
            </div>
        </div>
        <nav class="nav flex-column">
            <a class="nav-link active" href="#dashboard"><i class="fa-solid fa-chart-line"></i> Dashboard</a>
            <a class="nav-link" href="#projects"><i class="fa-solid fa-diagram-project"></i> Proyectos</a>
            <a class="nav-link" href="#tasks"><i class="fa-solid fa-list-check"></i> Tareas</a>
            <a class="nav-link" href="#payments"><i class="fa-solid fa-wallet"></i> Pagos</a>
            <a class="nav-link" href="#calendar"><i class="fa-solid fa-calendar"></i> Calendario</a>
            <a class="nav-link" href="#clients"><i class="fa-solid fa-users"></i> Clientes</a>
            <a class="nav-link" href="#audit"><i class="fa-solid fa-clipboard-list"></i> Bitácora</a>
        </nav>
        <div class="sidebar-footer">
            <a class="btn btn-outline-light btn-sm w-100" href="/?route=logout"><i class="fa-solid fa-right-from-bracket"></i> Salir</a>
        </div>
    </aside>
    <main class="content">
        <header class="topbar">
            <div>
                <h2>Bienvenido, <?php echo e($user['name']); ?></h2>
                <p>Resumen operativo de proyectos, pendientes y pagos.</p>
            </div>
            <div class="topbar-actions">
                <button class="btn btn-light" id="notifyBtn"><i class="fa-solid fa-bell"></i> Avisos</button>
                <button class="btn btn-primary"><i class="fa-solid fa-plus"></i> Nuevo registro</button>
            </div>
        </header>

        <section id="dashboard" class="panel">
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="card summary-card">
                        <div>
                            <p>Proyectos activos</p>
                            <h3>12</h3>
                        </div>
                        <span class="badge bg-success">+3%</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card summary-card">
                        <div>
                            <p>Tareas pendientes</p>
                            <h3>48</h3>
                        </div>
                        <span class="badge bg-warning">12 urgentes</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card summary-card">
                        <div>
                            <p>Pagos en proceso</p>
                            <h3>$78k</h3>
                        </div>
                        <span class="badge bg-info">4 por vencer</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card summary-card">
                        <div>
                            <p>Reuniones</p>
                            <h3>6</h3>
                        </div>
                        <span class="badge bg-secondary">2 esta semana</span>
                    </div>
                </div>
            </div>

            <div class="row mt-4 g-4">
                <div class="col-lg-7">
                    <div class="card chart-card">
                        <div class="card-header">
                            <h5>Avance general</h5>
                            <span class="text-muted">Actualizado hoy</span>
                        </div>
                        <canvas id="progressChart" height="160"></canvas>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="card notification-card">
                        <div class="card-header">
                            <h5>Avisos prioritarios</h5>
                            <span class="text-muted">Automáticos</span>
                        </div>
                        <div class="card-body">
                            <?php foreach ($notifications as $notification): ?>
                                <div class="alert alert-<?php echo e($notification['type']); ?> d-flex gap-3 align-items-start shadow-sm" role="alert">
                                    <i class="fa-solid fa-circle-info"></i>
                                    <div>
                                        <h6><?php echo e($notification['title']); ?></h6>
                                        <p><?php echo e($notification['message']); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="projects" class="panel">
            <div class="panel-header">
                <div>
                    <h4>Proyectos</h4>
                    <p>Seguimiento de avances y responsables.</p>
                </div>
                <button class="btn btn-outline-primary">Nuevo proyecto</button>
            </div>
            <div class="card">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Proyecto</th>
                                <th>Responsable</th>
                                <th>Estado</th>
                                <th>Avance</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($projects as $project): ?>
                                <tr data-item>
                                    <td><?php echo e($project['name']); ?></td>
                                    <td><?php echo e($project['owner'] ?? 'Sin asignar'); ?></td>
                                    <td><span class="badge bg-primary"><?php echo e($project['status']); ?></span></td>
                                    <td>
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar" role="progressbar" style="width: <?php echo e((string) $project['progress']); ?>%"></div>
                                        </div>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-light">Editar</button>
                                        <button class="btn btn-sm btn-outline-danger soft-delete">Eliminar</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <section id="tasks" class="panel">
            <div class="panel-header">
                <div>
                    <h4>Tareas y pendientes</h4>
                    <p>Control diario de actividades por proyecto.</p>
                </div>
                <button class="btn btn-outline-primary">Nueva tarea</button>
            </div>
            <div class="card">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Tarea</th>
                                <th>Proyecto</th>
                                <th>Fecha límite</th>
                                <th>Prioridad</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tasks as $task): ?>
                                <tr data-item>
                                    <td><?php echo e($task['title']); ?></td>
                                    <td><?php echo e($task['project'] ?? 'Sin proyecto'); ?></td>
                                    <td><?php echo e($task['due']); ?></td>
                                    <td><span class="badge bg-warning text-dark"><?php echo e($task['priority']); ?></span></td>
                                    <td>
                                        <span class="badge bg-<?php echo $task['status'] === 'Atrasada' ? 'danger' : 'success'; ?>">
                                            <?php echo e($task['status']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-light">Actualizar</button>
                                        <button class="btn btn-sm btn-outline-danger soft-delete">Finalizar</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <section id="payments" class="panel">
            <div class="panel-header">
                <div>
                    <h4>Pagos y facturación</h4>
                    <p>Monitoreo de cobros, facturas y fechas clave.</p>
                </div>
                <button class="btn btn-outline-primary">Nuevo pago</button>
            </div>
            <div class="card">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Monto</th>
                                <th>Fecha límite</th>
                                <th>Estatus</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($payments as $payment): ?>
                                <tr data-item>
                                    <td><?php echo e($payment['client'] ?? 'Sin cliente'); ?></td>
                                    <td><?php echo e((string) $payment['amount']); ?></td>
                                    <td><?php echo e($payment['due']); ?></td>
                                    <td><span class="badge bg-info text-dark"><?php echo e($payment['status']); ?></span></td>
                                    <td>
                                        <button class="btn btn-sm btn-light">Detalle</button>
                                        <button class="btn btn-sm btn-outline-danger soft-delete">Marcar como eliminado</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <section id="calendar" class="panel">
            <div class="panel-header">
                <div>
                    <h4>Calendario de reuniones</h4>
                    <p>Agenda de juntas y recordatorios.</p>
                </div>
                <button class="btn btn-outline-primary">Agendar reunión</button>
            </div>
            <div class="row g-4">
                <?php foreach ($meetings as $meeting): ?>
                    <div class="col-md-6">
                        <div class="card meeting-card">
                            <div>
                                <h5><?php echo e($meeting['title']); ?></h5>
                                <p><i class="fa-regular fa-calendar"></i> <?php echo e($meeting['date']); ?></p>
                                <p><i class="fa-regular fa-clock"></i> <?php echo e($meeting['time']); ?></p>
                                <p><i class="fa-regular fa-user"></i> Responsable: <?php echo e($meeting['owner'] ?? 'Sin asignar'); ?></p>
                            </div>
                            <button class="btn btn-sm btn-outline-danger soft-delete">Cancelar</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section id="clients" class="panel">
            <div class="panel-header">
                <div>
                    <h4>Clientes y usuarios</h4>
                    <p>Alta de clientes, usuarios y roles.</p>
                </div>
                <button class="btn btn-outline-primary">Nuevo cliente</button>
            </div>
            <div class="card">
                <div class="row g-4 p-4">
                    <div class="col-lg-6">
                        <div class="info-card">
                            <h5>Clientes activos</h5>
                            <p>45 clientes registrados</p>
                            <ul>
                                <li><i class="fa-solid fa-circle-check"></i> Contratos vigentes</li>
                                <li><i class="fa-solid fa-circle-check"></i> Facturación automática</li>
                                <li><i class="fa-solid fa-circle-check"></i> Contactos centralizados</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="info-card">
                            <h5>Roles principales</h5>
                            <p>Administrador, PM, Finanzas, Operativo</p>
                            <div class="badge-group">
                                <span class="badge bg-primary">Administrador</span>
                                <span class="badge bg-info text-dark">PM</span>
                                <span class="badge bg-warning text-dark">Finanzas</span>
                                <span class="badge bg-secondary">Operativo</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="audit" class="panel">
            <div class="panel-header">
                <div>
                    <h4>Bitácora de uso</h4>
                    <p>Registro de actividad del sistema.</p>
                </div>
                <button class="btn btn-outline-primary">Exportar</button>
            </div>
            <div class="card">
                <ul class="list-group list-group-flush">
                    <?php foreach ($logEntries as $entry): ?>
                        <li class="list-group-item d-flex justify-content-between">
                            <div>
                                <strong><?php echo e($entry['user'] ?? 'Sin usuario'); ?></strong>
                                <span><?php echo e($entry['action']); ?></span>
                            </div>
                            <span class="text-muted"><?php echo e((string) $entry['time']); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </section>
    </main>
</div>

<div class="notification-tray" id="notificationTray">
    <div class="tray-header">
        <h5><i class="fa-solid fa-bell"></i> Avisos en tiempo real</h5>
        <button class="btn btn-sm btn-light" id="closeTray">Cerrar</button>
    </div>
    <div class="tray-body">
        <?php foreach ($notifications as $notification): ?>
            <div class="tray-item">
                <span class="badge bg-<?php echo e($notification['type']); ?>">&nbsp;</span>
                <div>
                    <h6><?php echo e($notification['title']); ?></h6>
                    <p><?php echo e($notification['message']); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php
$content = ob_get_clean();
$title = 'Dashboard | ProjectFlow';
require __DIR__ . '/../layouts/base.php';
