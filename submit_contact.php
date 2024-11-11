<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $secret_key = "YOUR_SECRET_KEY";  // Replace with your actual reCAPTCHA secret key
    $response_key = $_POST['g-recaptcha-response'];
    $user_ip = $_SERVER['REMOTE_ADDR'];

    // Send verification request to Google reCAPTCHA API
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secret_key&response=$response_key&remoteip=$user_ip";
    $response = file_get_contents($url);
    $response = json_decode($response);

    if ($response->success) {
        // Success! Proceed with form handling
        echo "Thank you for contacting us. Your message has been sent!";
    } else {
        // Verification failed
        echo "reCAPTCHA verification failed. Please try again.";
    }
}
?>
