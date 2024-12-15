<?php
session_start();

// Liste des clés valides
$valid_keys = ["abcde", "lorenzo", "klmno"];

// Récupération des données
$user_key = $_POST['user_key'] ?? '';
$user_ip = $_SERVER['REMOTE_ADDR'];

// Webhook URL
$webhook_url = "https://discord.com/api/webhooks/1317897078420279336/KYynjdA2v2j6d6QFRXTnkoxzVXITMexMjKzJ8uGDX71Slpi2G67oAFiAwrcFXa158X2o";

// Fonction pour envoyer les données au webhook
function send_to_webhook($url, $message) {
    $data = json_encode(["content" => $message]);
    $options = [
        "http" => [
            "header"  => "Content-type: application/json",
            "method"  => "POST",
            "content" => $data,
        ]
    ];
    $context  = stream_context_create($options);
    file_get_contents($url, false, $context);
}

// Cooldown de 60 secondes
if (isset($_SESSION['last_attempt_time']) && (time() - $_SESSION['last_attempt_time']) < 60) {
    $remaining_time = 60 - (time() - $_SESSION['last_attempt_time']);
    echo "Veuillez attendre $remaining_time secondes avant de réessayer.";
    exit;
}

// Mise à jour du temps de la dernière tentative
$_SESSION['last_attempt_time'] = time();

// Vérification de la clé
if (in_array($user_key, $valid_keys)) {
    $_SESSION['access_granted'] = true; // Accès autorisé
    $message = "✅ Clé valide utilisée !\n- **Clé** : $user_key\n- **IP** : $user_ip";
    send_to_webhook($webhook_url, $message);

    header("Location: formation.php"); // Redirection vers la page sécurisée
    exit;
} else {
    $message = "❌ Tentative avec clé invalide !\n- **Clé** : $user_key\n- **IP** : $user_ip";
    send_to_webhook($webhook_url, $message);

    echo "Clé invalide. Accès refusé.";
    exit;
}
?>
