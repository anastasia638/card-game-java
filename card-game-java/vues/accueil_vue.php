<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galerie d'images</title>
    <!-- Lien vers votre fichier CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="gallery-container">
        <button class="prev-button" onclick="prevImage()">⟵</button>
        <div class="image-container">
            <img src="img/img1.jpg'," alt="Image 1" id="gallery-image">
        </div>
        <button class="next-button" onclick="nextImage()">⟶</button>
    </div>

    <!-- Script JavaScript pour gérer la navigation entre les images -->
    <script>
        // Tableau des chemins d'accès aux images
        const images = [
            'img/img1.jpg',
            'img/img2.jpg',
            'img/img3.jpg',
        ];

        let currentIndex = 0;

        // Fonction pour passer à l'image précédente
        function prevImage() {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            document.getElementById('gallery-image').src = images[currentIndex];
        }

        // Fonction pour passer à l'image suivante
        function nextImage() {
            currentIndex = (currentIndex + 1) % images.length;
            document.getElementById('gallery-image').src = images[currentIndex];
        }
    </script>
</body>
</html>
