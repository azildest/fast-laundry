<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Fast Laundry</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Karla:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Karla', sans-serif;
      background: linear-gradient(to right, #e0f7fa, #b2ebf2);
      color: #333;
    }

    .about-section {
      display: flex;
      /* justify-content: space-between ; */
      align-items: center;
      padding: 60px 60px;
      gap: 20px;
      flex-wrap: wrap;
    }

    .about-text {
      flex: 1;
      min-width: 300px;
      max-width: 600px;
    }

    .about-text h1 {
      font-size: 30px;
      margin-bottom: 10px;
    }

    .about-text p {
      font-size: 16px;
      line-height: 1.7;
    }

    .about-logo {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
    
      max-width: 300px;
      min-width: 500px;
    }

    .about-logo img {
      width: 100px;
      height: auto;
    }

    .about-logo-text {
    display: flex;
    flex-direction: column;
    font-size: 34px;
    font-weight: bold;
    color: #007c91;
    line-height: 1;

    }

    .divider {
      height: 80px;
    }

    .main-content {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      align-items: flex-start;
     
      padding: 0 80px 80px;
    }

    .map-container iframe {
      border: none;
      border-radius: 12px;
      width: 500px;
      height: 350px;
      max-width: 100%;
    }

    .contact-info {
      padding-top: 40px;
      max-width: 350px;
      font-size: 18px;
    }

    .contact-info h1 {
      font-size: 22px;
      margin-bottom: 15px;
      color: #007c91;
    }

    .contact-info p {
      margin: 10px 0;
      display: flex;
      align-items: center;
    }

    .contact-info i {
      margin-right: 12px;
      color: #007c91;
      min-width: 20px;
      text-align: center;
    }

    @media (max-width: 768px) {
      .about-section {
        flex-direction: column;
        text-align: center;
      }

      .about-logo {
        justify-content: center;
        flex-direction: column;
      }

      .about-logo-text {
        margin-top: 10px;
      }

      .main-content {
        flex-direction: column;
        align-items: center;
      }

      .contact-info {
        text-align: center;
      }
    }
  </style>
</head>
<body>

 <!-- Bagian Tentang Kami -->
 <div class="about-section">
    <div class="about-text">
      <h1>Tentang Kami</h1>
      <p>
        Fast Laundry adalah layanan laundry terpercaya yang telah melayani masyarakat dengan sistem profesional dan teknologi modern. Kami hadir untuk memberikan solusi praktis, cepat, dan berkualitas untuk kebutuhan kebersihan pakaian Anda.
      </p>
    </div>
    <div class="about-logo">
        <img src="Logonobackground.png" alt="Logo Fast Laundry" />
        <div class="about-logo-text">
          <span>FAST</span>
          <span>LAUNDRY</span>
        </div>
      </div>
  </div>

  <!-- Spacer -->
  <div class="divider"></div>

  <!-- Peta dan Kontak -->
  <div class="main-content">
    <div class="map-container">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15861.111885145591!2d107.6229432!3d-6.9024681!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e8c7ec93a815%3A0xf0ca0261d75ed396!2sSukapada%2C%20Cibeunying%20Kidul%2C%20Bandung%2C%20Jawa%20Barat!5e0!3m2!1sen!2sid!4v1639386000555!5m2!1sen!2sid"
        allowfullscreen=""
        loading="lazy">
      </iframe>
    </div>

    <div class="contact-info">
      <h1>Hubungi Kami</h1>
      <p><i class="fas fa-map-marker-alt"></i> Sukapada, Cibeunying Kidul, Bandung, Jawa Barat</p>
      <p><i class="fas fa-phone"></i> 08XXXXXXXXXXXX</p>
      <p><i class="fas fa-envelope"></i> fastlaundry@gmail.com</p>
    </div>
  </div>

</body>
</html>
