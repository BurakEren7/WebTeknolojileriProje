<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İletişim Sonuç | Proje Ödevi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white text-center">
                        <h3 class="mb-0">Form Başarıyla Gönderildi!</h3>
                    </div>
                    <div class="card-body p-4">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <?php
                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    // XSS saldırılarına karşı verileri filtreleyerek alıyoruz
                                    $adSoyad = htmlspecialchars($_POST['adSoyad'] ?? '-');
                                    $email = htmlspecialchars($_POST['email'] ?? '-');
                                    $telefon = htmlspecialchars($_POST['telefon'] ?? '-');
                                    $sehir = htmlspecialchars($_POST['sehir'] ?? '-');
                                    $cinsiyet = htmlspecialchars($_POST['cinsiyet'] ?? '-');
                                    
                                    // Checkbox array olarak gelir, onu string'e çeviriyoruz
                                    $nedenler = isset($_POST['neden']) ? implode(", ", $_POST['neden']) : 'Belirtilmedi';
                                    $nedenler = htmlspecialchars($nedenler);
                                    
                                    $mesaj = htmlspecialchars($_POST['mesaj'] ?? '-');

                                    echo "<tr><th style='width: 30%;'>Ad Soyad</th><td>$adSoyad</td></tr>";
                                    echo "<tr><th>E-Posta</th><td>$email</td></tr>";
                                    echo "<tr><th>Telefon</th><td>$telefon</td></tr>";
                                    echo "<tr><th>Şehir</th><td>$sehir</td></tr>";
                                    echo "<tr><th>Cinsiyet</th><td>$cinsiyet</td></tr>";
                                    echo "<tr><th>İletişim Nedeni</th><td>$nedenler</td></tr>";
                                    echo "<tr><th>Mesaj</th><td>" . nl2br($mesaj) . "</td></tr>";
                                } else {
                                    echo "<tr><td colspan='2' class='text-danger text-center'>Geçersiz istek. Lütfen formu doldurarak geliniz.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <div class="text-center mt-4">
                            <a href="iletisim.html" class="btn btn-primary">Geri Dön</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>