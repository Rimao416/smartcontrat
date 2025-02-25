<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue sur Mon Application</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #f0f2f5, #d9e2ec);
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            text-align: center;
        }

        .container {
            background: white;
            padding: 50px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            max-width: 600px;
            transition: all 0.3s ease-in-out;
        }

        .container:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
        }

        h1 {
            font-size: 36px;
            font-weight: bold;
            color: #333;
        }

        p {
            font-size: 18px;
            color: #555;
            margin-bottom: 30px;
        }

        .btn-custom {
            background: linear-gradient(135deg, #007bff, #0056b3);
            border: none;
            padding: 12px 24px;
            font-size: 18px;
            color: white;
            border-radius: 8px;
            transition: all 0.3s ease-in-out;
            text-decoration: none;
            display: inline-block;
        }

        .btn-custom:hover {
            background: linear-gradient(135deg, #0056b3, #003580);
            transform: translateY(-3px);
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Bienvenue sur Mon Application</h1>
        <p>Découvrez et gérez vos articles en toute simplicité.</p>
        <a href="{{ route('articles.index') }}" class="btn btn-custom">Voir les Articles</a>
    </div>

</body>
</html>
