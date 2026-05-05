<?php
// Form gönderildiğinde çalışacak PHP bloğu
$mesaj = "";
$girisBasarili = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $sifre = $_POST['sifre'];

    // Öğrenci numarasını mail adresinden ayrıştırma (örn: b2412100001)
    $ogrenciNo = explode('@', $email)[0];

    // PHP tarafında da basit bir güvenlik kontrolü
    if (empty($email) || empty($sifre)) {
        $mesaj = "<div class='alert alert-danger'>Alanlar boş bırakılamaz! Tekrar deneyin.</div>";
    } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false || strpos($email, '@sakarya.edu.tr') === false) {
        $mesaj = "<div class='alert alert-danger'>Lütfen geçerli bir öğrenci mail adresi giriniz.</div>";
    } elseif ($sifre === $ogrenciNo) {
        $mesaj = "<div class='alert alert-success text-center'><h2 class='display-6'>Hoşgeldiniz $ogrenciNo</h2><p>Giriş işlemi başarıyla tamamlandı.</p></div>";
        $girisBasarili = true;
    } else {
        $mesaj = "<div class='alert alert-danger'>Hatalı şifre veya kullanıcı adı! Lütfen tekrar deneyin.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap | Proje Ödevi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="custom-header">
        <div class="container nav-container">
            <a class="logo" href="index.html"><i> <mark>Benim Siteme Hoşgeldiniz</mark></i></a>
            <nav>
                <ul class="nav-list">
                    <li><a class="nav-link" href="index.html">Hakkında</a></li>
                    <li><a class="nav-link" href="cv.html">Özgeçmiş</a></li>
                    <li><a class="nav-link" href="sehrim.html">Şehrim</a></li>
                    <li><a class="nav-link" href="ilgi_alanlarim.html">İlgi Alanlarım</a></li>
                    <li><a class="nav-link" href="iletisim.html">İletişim</a></li>
                    <li><a class="btn-login" href="login.php">Giriş Yap</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- PHP'den gelen hata veya başarı mesajı burada gösterilecek -->
                <?= $mesaj ?>

                <?php if(!$girisBasarili): ?>
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h2 class="text-center mb-4">Öğrenci Girişi</h2>
                        <form action="login.php" method="POST" onsubmit="return jsKontrol(event)">
                            <div class="mb-3">
                                <label for="email" class="form-label">Öğrenci Mail Adresi</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="b2412100001@sakarya.edu.tr">
                            </div>
                            <div class="mb-3">
                                <label for="sifre" class="form-label">Şifre (Öğrenci No)</label>
                                <input type="password" class="form-control" id="sifre" name="sifre" placeholder="Şifrenizi giriniz">
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mt-3">Giriş Yap</button>
                        </form>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <footer class="bg-dark text-white text-center py-3 mt-auto custom-footer">
        <p class="mb-0">&copy; 2026 Burak Eren - Web Teknolojileri Proje Ödevi</p>
    </footer>

    <script>
        // İstenen: Boş alan ve mail formatı kontrolü JavaScript ile sağlanmalıdır.
        function jsKontrol(event) {
            let email = document.getElementById('email').value.trim();
            let sifre = document.getElementById('sifre').value.trim();
            let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (email === "" || sifre === "") {
                alert("Lütfen mail adresi ve şifre alanlarını boş bırakmayınız!");
                event.preventDefault(); // Formun gitmesini engeller
                return false;
            }

            if (!emailRegex.test(email)) {
                alert("Lütfen geçerli bir mail formatı giriniz!");
                event.preventDefault();
                return false;
            }

            return true;
        }
    </script>
</body>
</html>