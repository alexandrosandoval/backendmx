<?php
// Funciones auxiliares reutilizables.

function view(string $view, array $data = []): void
{
    extract($data);
    require __DIR__ . '/../Views/' . $view . '.php';
}

function redirect(string $path): void
{
    header('Location: ' . $path);
    exit;
}

function isLoggedIn(): bool
{
    return isset($_SESSION['user']);
}

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
