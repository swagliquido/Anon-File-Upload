<?php

$jsFilePaths = [
    './js/languageSwitcher.js'
];

$cssFilePaths = [
    './styles/privacy-policy.css'
];

// Initialize an array to hold the hashes
$js_quoted_hashes = [];
$js_unquoted_hashes = [];

$css_unquoted_hashes = [];

function generateHash($filePath)
{
    $fileContent = file_get_contents($filePath);
    return "sha256-" . base64_encode(hash('sha256', $fileContent, true));
}

// Generate hashes for JavaScript files
foreach ($jsFilePaths as $jsFilePath) {
    $js_quoted_hashes[] = "'" . generateHash($jsFilePath) . "'";
    $js_unquoted_hashes[] = generateHash($jsFilePath);
}

// Generate hashes for CSS files
foreach ($cssFilePaths as $cssFilePath) {
    $css_unquoted_hashes[] = generateHash($cssFilePath);
}

// Convert the hashes array to a string for the CSP header
$jsHashesStr = implode(' ', $js_quoted_hashes);

header("Content-Security-Policy: default-src 'none'; script-src 'self' $jsHashesStr; style-src-elem 'self'; img-src 'self'; font-src 'self'; connect-src 'self'; manifest-src 'self'; frame-ancestors 'none'; base-uri 'none'; require-trusted-types-for 'script'; trusted-types 'none'");
header("Cross-Origin-Embedder-Policy: require-corp");
header("Cross-Origin-Opener-Policy: same-origin");
header("Cross-Origin-Resource-Policy: same-origin");
header("Permissions-Policy: accelerometer=(), ambient-light-sensor=(), autoplay=(), battery=(), bluetooth=(), camera=(), clipboard-read=(), clipboard-write=(), display-capture=(), document-domain=(), encrypted-media=(), fullscreen=(), gamepad=(), geolocation=(), gyroscope=(), hid=(), idle-detection=(), interest-cohort=(), keyboard-map=(), local-fonts=(), magnetometer=(), microphone=(), midi=(), payment=(), picture-in-picture=(), publickey-credentials-get=(), screen-wake-lock=(), serial=(), speaker-selection=(), sync-xhr=(), usb=(), xr-spatial-tracking=()");
header("Referrer-Policy: no-referrer");
header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: DENY");
header("X-XSS-Protection: 0");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy</title>
    <link rel="stylesheet" href="/styles/privacy-policy.css" integrity="<?php echo $css_unquoted_hashes[0]; ?>">
    <script defer type="text/javascript" src="/js/languageSwitcher.js" integrity="<?php echo $js_unquoted_hashes[0]; ?>"></script>


</head>

<body>
    <div class="container">
        <div class="language-switcher">
        <button id="lang-en-btn">English</button> 
        <button id="lang-tr-btn">Türkçe</button>
        </div>
        <div id="lang-en" class="block">
            <h1>Privacy Policy</h1>
            <p>This website does not collect
                any personally identifiable information (PII) from its users.</p>
            <p>Last
                updated: <time datetime="2024-06-24">June 24, 2024</time></p>
        </div>
        <div id="lang-tr" class="hidden">
            <h1>Gizlilik Politikası</h1>
            <p>Bu web sitesi, kullanıcılarından herhangi bir kişisel olarak tanımlanabilir
                bilgi toplamaz.</p>
            <p>Son güncelleme: <time datetime="2024-06-24">24 Haziran
                    2024</time></p>
        </div>
    </div>
</body>

</html>