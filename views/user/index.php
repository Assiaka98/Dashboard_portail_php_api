<h1>Liste des utilisateurs</h1>
<?php foreach ($users as $user): ?>
    <p><?= htmlspecialchars($user['nom']) ?> - <?= $user['email'] ?></p>
<?php endforeach; ?>