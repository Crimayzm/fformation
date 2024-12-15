<?php
// Démarre la session
session_start();

// Vérifie si l'accès a été validé dans `validate_key.php`
if (!isset($_SESSION['access_granted']) || $_SESSION['access_granted'] !== true) {
    // Redirige vers la page login si l'accès n'est pas valide
    header('Location: login.html');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formation</title>
    <style>
        /* Réinitialisation générale */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #121212;
            color: #e0e0e0;
            font-family: 'Arial', sans-serif;
            text-align: center;
            user-select: none; /* Désactive la sélection de texte */
        }

        header {
            background-color: #1f1f1f;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
            margin-bottom: 30px;
        }

        header h1 {
            color: #ff0000;
            font-size: 2.5em;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .gallery {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-top: 20px;
        }

        .gallery img {
            width: 100%;
            height: auto;
            cursor: pointer;
            border: 2px solid #333;
            border-radius: 8px;
            transition: transform 0.3s ease-in-out;
        }

        .gallery img:hover {
            transform: scale(1.05);
            border-color: #ff0000;
        }

        /* Overlay fullscreen */
        #overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10000;
            display: none;
        }

        #overlay img {
            max-width: 90%;
            max-height: 90%;
            border: 3px solid #ff0000;
            border-radius: 10px;
        }

        #close-btn {
            position: absolute;
            top: 20px;
            right: 30px;
            color: white;
            font-size: 40px;
            cursor: pointer;
        }

        /* Désactiver le clic droit */
        body {
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* Anti-capture d'écran */
        .anti-screenshot {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: white;
            z-index: 99999;
            display: none;
        }
    </style>
</head>
<body>
    <!-- En-tête -->
    <header>
        <h1>Formation hacoo & vinted</h1>
    </header>

    <!-- Contenu principal -->
    <div class="container">
        <p>Toute tentative de screenshot seras blacklist. La sécurité est activée.</p>
        <div class="gallery">
            <img src="https://media.discordapp.net/attachments/1229685063613157438/1317639463060508712/IMG_3029.jpg?ex=676013a0&is=675ec220&hm=e45d577df9532f546a3368579e741b39201372982c8966a271c02d766d0244c0&=&format=webp&width=1179&height=663" alt="Image 1" onclick="showImage(this.src)">
            <img src="https://media.discordapp.net/attachments/1229685063613157438/1317639463333003355/IMG_3030.jpg?ex=676013a0&is=675ec220&hm=aad6938ad2d2c49abc5f76ec3e58be748c803ff76d040a9800fbaec68124a633&=&format=webp&width=1179&height=663" alt="Image 2" onclick="showImage(this.src)">
            <img src="https://media.discordapp.net/attachments/1229685063613157438/1317639463786123294/IMG_3031.jpg?ex=676013a0&is=675ec220&hm=9b438cbece62cddea0af638af864554c2a9063448a95d5a31cd5c22576380d7f&=&format=webp&width=1179&height=663" alt="Image 3" onclick="showImage(this.src)">
            <img src="https://media.discordapp.net/attachments/1229685063613157438/1317639464104886374/IMG_3032.jpg?ex=676013a0&is=675ec220&hm=9b094ff0f1b87179d8daae6fb28002e16e64499a32a4032ccfcc516b8faa7dcb&=&format=webp&width=1179&height=663" alt="Image 4" onclick="showImage(this.src)">
            <img src="https://media.discordapp.net/attachments/1229685063613157438/1317639464415268966/IMG_3033.jpg?ex=676013a0&is=675ec220&hm=ceffd22a4383e42bad9229b2dcb79321c3f977bebd63ada0059fc356c2052690&=&format=webp&width=1179&height=663" alt="Image 5" onclick="showImage(this.src)">
            <img src="https://media.discordapp.net/attachments/1229685063613157438/1317639464683700266/IMG_3034.jpg?ex=676013a0&is=675ec220&hm=f59732e5adc5ad6ad52c07951b3319e269e6cc96e3d8733faea6ee503e981c7e&=&format=webp&width=1179&height=663" alt="Image 6" onclick="showImage(this.src)">
            <img src="https://media.discordapp.net/attachments/1229685063613157438/1317639465061318697/IMG_3035.jpg?ex=676013a1&is=675ec221&hm=b7accf36fe2b43a169158caab4c232d5f7bd8f7753f3c6baefd3dd694bb35dac&=&format=webp&width=1179&height=663" alt="Image 7" onclick="showImage(this.src)">
            <img src="https://media.discordapp.net/attachments/1229685063613157438/1317639465371439205/IMG_3036.jpg?ex=676013a1&is=675ec221&hm=bf67631e704b0eba44b83dac650035946809ce5736bd93879397ec143948cadc&=&format=webp&width=1179&height=663" alt="Image 8" onclick="showImage(this.src)">
            <img src="https://media.discordapp.net/attachments/1229685063613157438/1317639465635676180/IMG_3037.jpg?ex=676013a1&is=675ec221&hm=134cb451912867fc8971050271db255abff7acdcc36f8dfce0836f440a79e38e&=&format=webp&width=1179&height=663" alt="Image 9" onclick="showImage(this.src)">
            <img src="https://media.discordapp.net/attachments/1229685063613157438/1317639465870819440/IMG_3038.jpg?ex=676013a1&is=675ec221&hm=0966a9d1f66a625b2635cd741ed99da898f0723165efa348f210510147e89892&=&format=webp&width=1179&height=663" alt="Image 10" onclick="showImage(this.src)">
            <img src="https://media.discordapp.net/attachments/1229685063613157438/1317639495067373679/IMG_3039.jpg?ex=676013a8&is=675ec228&hm=870f3f96cb039984eaf7030ac5aae83e91ed30d1300022bb2a101ee25cd9794d&=&format=webp&width=1179&height=663" alt="Image 11" onclick="showImage(this.src)">
            <img src="https://media.discordapp.net/attachments/1229685063613157438/1317639495319027812/IMG_3040.jpg?ex=676013a8&is=675ec228&hm=3cdfaeea8abac6bbcf1d5649cd4d0068e5c14efa4d37f4434e96ccefdd5e0ae3&=&format=webp&width=1179&height=663" alt="Image 12" onclick="showImage(this.src)">
            <img src="https://media.discordapp.net/attachments/1229685063613157438/1317639495625080843/IMG_3041.jpg?ex=676013a8&is=675ec228&hm=6d80e051bd982b6ec77b8c97e087996f731f3d4088f99018476001b9b51b4ffc&=&format=webp&width=1179&height=663" alt="Image 13" onclick="showImage(this.src)">
        </div>
    </div>

    <!-- Fullscreen Overlay -->
    <div id="overlay" onclick="closeImage()">
        <span id="close-btn">&times;</span>
        <img id="overlay-img" src="" alt="Fullscreen Image">
    </div>

    <!-- Anti-capture Overlay -->
    <div class="anti-screenshot"></div>

    <!-- Script JavaScript -->
    <script>
        // Désactiver clic droit
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
        });

        // Désactiver Print Screen
        window.addEventListener('keydown', function(e) {
            if (e.key === "PrintScreen") {
                alert("Les captures d'écran sont désactivées.");
                navigator.clipboard.writeText("");
                e.preventDefault();
            }
        });

        // Overlay anti-capture d'écran
        const overlay = document.querySelector('.anti-screenshot');
        window.addEventListener('blur', () => {
            overlay.style.display = 'block';
        });
        window.addEventListener('focus', () => {
            overlay.style.display = 'none';
        });

        // Agrandir l'image
        function showImage(src) {
            const overlay = document.getElementById('overlay');
            const overlayImg = document.getElementById('overlay-img');
            overlayImg.src = src;
            overlay.style.display = 'flex';
        }

        function closeImage() {
            document.getElementById('overlay').style.display = 'none';
        }
    </script>
</body>
</html>
