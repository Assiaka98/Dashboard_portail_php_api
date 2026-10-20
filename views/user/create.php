cat > views/user/create.php << 'PHP'
<!DOCTYPE html>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">
        <div class="container mt-5">
            <h2>Ajouter un utilisateur</h2>
            <form method="POST" action="/users/store" class="bg-white p-4 shadow-sm rounded">
                <input name="nom" class="form-control mb-3" placeholder="Nom (ex: Diouf)" required>
                <input name="email" type="email" class="form-control mb-3" placeholder="Email" required>
                <button class="btn btn-primary">Enregistrer</button>
                <a href="/" class="btn btn-secondary">Retour</a>
            </form>
        </div>
    </body>
</html>
