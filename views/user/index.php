<!DOCTYPE html>
<html>
<head>
    <title>Gestion Utilisateurs V2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Liste des utilisateurs</h2>
        <a href="/users/create" class="btn btn-primary">+ Nouvel utilisateur</a>
    </div>
    
    <table class="table table-striped table-bordered bg-white shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($users as $user): ?>
<tr>
    <td><?= htmlspecialchars($user['nom']) ?></td>
    <td><?= htmlspecialchars($user['email']) ?></td>
    <td>
        <a href="/users/edit/<?= $user['id'] ?>" class="btn btn-sm btn-warning">Modifier</a>
        <a href="/users/delete/<?= $user['id'] ?>" class="btn btn-sm btn-danger">Supprimer</a>
    </td>
</tr>
<?php endforeach; ?>
        </tbody>
    </table>
    <small class="text-muted">Projet PHP / MySQL / MVC - par Issiaka TRAORE</small>
</div>
</body>
</html>