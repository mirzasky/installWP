<?php
// Fungsi untuk mengunduh file dari URL dan menyimpannya ke lokasi tujuan
function downloadFile($url, $destination)
{
    $file = file_get_contents($url);
    file_put_contents($destination, $file);
}

// Fungsi untuk mengekstrak file zip
function extractZip($zipFile, $destination)
{
    $zip = new ZipArchive;
    if ($zip->open($zipFile) === true) {
        $zip->extractTo($destination);
        $zip->close();
        return true;
    }
    return false;
}

// URL file instalasi WordPress
$wordpressFileURL = 'https://raw.githubusercontent.com/mirzasky/installWP/main/wordpress-6.2.2.zip';
// Lokasi penyimpanan file setelah diunduh
$downloadDestination = 'wp.zip';
// Lokasi direktori ekstraksi
$extractDestination = './';

// Mengunduh file instalasi WordPress
downloadFile($wordpressFileURL, $downloadDestination);

// Mengekstrak file zip
$extractionResult = extractZip($downloadDestination, $extractDestination);

// Redirect ke halaman instalasi bawaan WordPress jika ekstraksi berhasil
if ($extractionResult) {
    header('Location: ' . $extractDestination . 'wp-admin/install.php');
    exit;
} else {
    echo 'Gagal mengekstrak file instalasi WordPress.';
}
?>
