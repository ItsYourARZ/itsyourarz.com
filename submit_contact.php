<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $secret_key = "6LfDZHsqAAAAACLAlt_aiaxL3vN0TFGyVkW5VEV-";  // Replace with your reCAPTCHA v3 secret key
    $token = $_POST['recaptcha_token'];
    $user_ip = $_SERVER['REMOTE_ADDR'];

    // Send verification request to Google reCAPTCHA API
    $url = "https://www.google.com/recaptcha/api/siteverify";
    $data = [
        'secret' => $secret_key,
        'response' => $token,
        'remoteip' => $user_ip
    ];

    $options = [
        'http' => [
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        ]
    ];
    $context  = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    $response = json_decode($response);

    if ($response->success && $response->score >= 0.5) {
        // Success! Proceed with form handling
        echo "Thank you for contacting us. Your message has been sent!";
    } else {
        // Verification failed
        echo "reCAPTCHA verification failed. Please try again.";
    }
}
?>
