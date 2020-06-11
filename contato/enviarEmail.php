<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Programando a Web</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
  <link rel=stylesheet href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!--Google Fonts-->
  <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">

  <!-- Bootstrap core CSS -->
  <link href="../css/bootstrap.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="../css/mdb.min.css" rel="stylesheet">


  <!-- Your custom styles (optional) -->
  <link href="../css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />


  <style>
    @media (min-width: 800px) and (max-width: 850px) {
      .navbar:not(.top-nav-collapse) {
        background: rgba(0, 0, 0, 0.5) !important;
      }
    }
  </style>

</head>

<body>

  <nav class="navbar navbar-dark bg-transparent navbar-expand-xs text-center  align-content-center">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="fa fa-chevron-down"></span>
    </button>
    <div id="menu" class="collapse navbar-collapse">
      <a class="navbar-brand " href="/">
        <img class="img img-fluid" src="../img/logo/cesarlogo.png" height="120" width="120">
      </a>
      <ul class="nav justify-content-center align-content-center" style="font-family: 'Montserrat', sans-serif;">
        <li class="">
          <a class="nav-link" href="hospedagem/"><i class="fa fa-server"></i> Hospedagem</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="servicos/index.html"> <i class="fa fa-code"></i> Desenvolvimento web</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="servicos/index.html"><i class="fas fa-eye"></i> Web Design</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="wordpress/index.html"><i class="fab fa-wordpress"></i> Wordpress</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.html"><i class="fa fa-envelope"></i> Contato</a>
        </li>

      </ul>
  </nav>
  <main>
    <div class="container py-3">
      <div class="row">
        <div class="col-sm-12 text-center">
          <?php
      function processText($text) {
        $text = strip_tags($text);
        $text = trim($text);
        $text = htmlspecialchars($text);
        return $text;
      };
      // Variáveis do POST
      $pnome = processText( $_POST['pnome']);
      $snome =processText( $_POST['snome']);
      $cel  = processText( $_POST['cel']);
      $email = processText( $_POST['email']);
      $msg = processText($_POST['msg']);
      $assunto = processText( $_POST['assunto']);
      $wpp = processText( $_POST['wpp']);

use PHPMailer\PHPMailer\PHPMailer; // Invoca o PHPMailer
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recaptcha_response'])) { // Checa se o formulário foi enviado

  //Requisição POST:
  $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
  $recaptcha_secret = 'fakesecretcaptcha';
  $recaptcha_response = $_POST['recaptcha_response'];

  // Decodifica o JSON da resposta:
  $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
  $recaptcha = json_decode($recaptcha);

// Toma a ação baseado no score
  if ($recaptcha->score >= 0.7) {
//função para processar o texto recebido e evitar ataques de script
require '../phpmailer/SMTP.php';
require '../phpmailer/phpMailer.php';
require '../phpmailer/Exception.php';
$mail = new PHPMailer();
$mail->Charset='UTF-8';
$mail->isSMTP();
$mail->Encoding = 'base64';
$mail->Host = 'smtp-relay.sendinblue.com';
$mail->SMTPAuth = true;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Username = 'DUMMYUSER'; 
$mail->Password = 'DUMMYPASS';
$mail->Port = 587;
$mail->setFrom('info@sendinblue.com', 'Cesar Augusto');
$mail->addAddress($email,$pnome); 
$mail->Subject = 'Novo e-mail de '.$pnome.' '.$snome.' - '.$assunto;
$mail->Body = '<br> Email: '.$email.'<br> Telefone: '.$cel.'<br> Whatsapp: '.$wpp.'<br> Mensagem: '.$msg;
if($mail->send()){
  echo("<i class = 'fa fa-smile-beam fa-4x py-3'></i>");
  echo "<h1 class='text-center'> Sua Mensagem foi enviada!</h1>";
  echo "<p class='text-center'> Voltando para a página inicial...</p>";
  header( "refresh:7;url=index.html" );
}else{
  echo("<i class = 'fa fa-robot fa-4x py-3'></i>");
  echo "<h1> Ops! Algo deu errado</h1>";
  echo "<h2>Sua mensagem não foi enviada</h2>";
  echo "<a href='index.html'><button class='btn btn-outline-primary'> Tentar novamente </button></a>";
};
} else {
  echo("<i class = 'fa fa-robot fa-4x py-3'></i>");
  echo "<h1> Ops! Algo deu errado</h1>";
  echo "<h2>Sua mensagem não foi enviada</h2>";
  echo "<a href='index.html'><button class='btn btn-outline-primary'> Tentar novamente </button></a>";
}};
?>
          <div class="my-auto mr-auto py-5">
            <h4 class="text-center">Contato pelas Redes Sociais</h4>
            <div class="justify-content-center text-center">
              <a href="https://www.facebook.com/cesarsantos250"><i
                  class="fab fa-whatsapp fa-3x px-2 text-center"></i></a>
              <a href="https:www.//facebook.com/cesarsantos250"> <i
                  class="fab fa-facebook-f fa-3x px-2 text-center"></i></a>
              <a href="https://www.instagram.com/cesarthedeveloper"><i
                  class="fab fa-instagram fa-3x px-2 text-center"></i></a>
              <a href="malito:csantos3600@gmail.com"><i class="fa fa-envelope fa-3x px-2 text-center"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    </section>
  </main>

  <footer class=" text-center font-small mt-4">

    <!--Copyright-->
    <div class="footer-copyright fixed-bottom">
      Powered by Love and Open Source Resources </div>
    <!--/.Copyright-->
  </footer>
  </main>

  <!-- SCRIPTS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"> </script>
  <!-- JQuery -->
  <script src="../js/jquery-3.4.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script src="../js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script src="../js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script src="../js/mdb.min.js"></script>
  <!-- Initializations -->
  <script src="../js/custom.js"> </script>
</body>

</html>
