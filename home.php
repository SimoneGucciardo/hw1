<?php 
require_once 'auth.php';
if (!$userid = checkAuth()) {
    header("Location: login.php");
    exit;
}

$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
if (!$conn) {
    die("Connessione fallita: " . mysqli_connect_error());
}

$userid = mysqli_real_escape_string($conn, $userid);
$query = "SELECT * FROM users WHERE id = $userid";
$res_1 = mysqli_query($conn, $query);
$userinfo = mysqli_fetch_assoc($res_1);

$sql = "SELECT * FROM prodotti_in_vendita LIMIT 4";
$result = mysqli_query($conn, $sql);

$prodotti = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $prodotti[] = $row;
    }
} else {
    die('Nessun prodotto trovato.');
}

mysqli_close($conn);
?>

<html>


  <head>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />    
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="mhw3.css" />
    <script src="mhw3.js"></script>
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC--MkdsPAqLmzk4M4sgjkq4pJYC0KuKM8&libraries=maps,marker&v=beta">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="uploadprodotto.js" defer></script>
    <script src="aggiuntarimozione.js" defer></script>
    <title>Document</title>
  </head>

  <body>
  <!--INIZIO HEADER-->
  <?php require_once 'header.php';?>
  <!--FINE HEADER-->


  <!--IMMAGINE SOTTO HEADER DA MODIFICARE CON JS-->
    <section id="background-1">
      <button id="button-background">
        <a href="https://amabilejewels.it/collezioni/collezione-spring/"
          >SCOPRI DI PIÙ</a
        >
      </button>
      <button id="button-background2"><</button>
      <button id="button-background3">></button>
      <div id="img-sottobackground1"></div>
      <div id="img-sottobackground2"></div>

      <div id="background-donna">
        <div class="overlay"></div>
        <a id="scritta-background1">COLLEZIONE GARDENIA</a>
        <a id="scritta-background2">Fai il pieno di vitamina c(hic)</a>
      </div>
    </section>
  <!-- FINE IMMAGINE SOTTO HEADER DA MODIFICARE CON JS-->



  <!--INIZIO ARTICOLI SOTTO IMMAGINE DONNA-->
    <section id="sotto-background">
      <div id="sotto-background-flex">
        <div class="row-background-flex">
          <a href="https://amabilejewels.it/categoria-prodotto/lovli">
            <img src="images/image-lovli.jpg" />
          </a>
        </div>
        <div class="row-background-flex">
          <a href="https://amabilejewels.it/categoria-prodotto/orecchini">
            <img src="images/image-orecchini.jpg" />
          </a>
        </div>
        <div class="row-background-flex">
          <a href="https://amabilejewels.it/categoria-prodotto/anelli">
            <img src="images/image-anelli.jpg" />
          </a>
        </div>
        <div class="row-background-flex">
          <a href="https://amabilejewels.it/categoria-prodotto/collane">
            <img src="images/image-collane.jpg" />
          </a>
        </div>
        <div class="row-background-flex">
          <a href="https://amabilejewels.it/categoria-prodotto/braccialetti">
            <img src="images/image-bracciali.jpg" />
          </a>
        </div>
      </div>
      <span class="row-background-flex-1">Lovli </span>
      <span class="row-background-flex-1">Orecchini </span>
      <span class="row-background-flex-1">Anelli </span>
      <span class="row-background-flex-1">Collane </span>
      <span class="row-background-flex-1">Bracciali </span>
      <button id="row-button-background">
        <a href="https://amabilejewels.it/categoria-prodotto/tutti-i-gioielli"
          >SCOPRI TUTTI I GIOIELLI</a
        >
      </button>
    </section>
  <!--FINE ARTICOLI SOTTO IMMAGINE DONNA-->




  <!--INIZIO SEZIONE ABBELLIMENTO SITO-->
    <div class="separator"></div>
    <button id="scrollToTopButton">▲</button>
  <!--FINE SEZIONE ABBELLIMENTO SITO-->



  <!--INZIO ARTICOLI IN VENDITA-->
    <section id="articoli-vendita">
      <h1 id="scritta-vendita">I PIÙ AMATI</h1>
        
      
      <div id="main-container">
        <?php foreach ($prodotti as $prodotto): ?>
        <div class="container-vendita">
          <a href="dettagli_prodotto.php?id=<?php echo $prodotto['id']; ?>">
                      <img src="<?php echo htmlspecialchars($prodotto['image']); ?>" alt="<?php echo htmlspecialchars($prodotto['prodotto']); ?>">
                  </a>
                  <div>
                      <a href="dettagli_prodotto.php?id=<?php echo ($prodotto['id']); ?>"><?php echo htmlspecialchars($prodotto['prodotto']); ?></a>
                  </div>
                  <p>
                      <strong><span><?php echo number_format($prodotto['prezzo'], 2); ?> €</span></strong>                      
                  </p>
                  <div>
                    <button class="preferiti" data-id="<?php echo $prodotto['id']; ?>">
                    <a href="aggiungipreferiti.php?id=<?php echo $prodotto['id']; ?>">
                            <img src="images/preferiti-removebg-preview.png" />
                          </a>
                    </div>
              </div>
          <?php endforeach; ?> 
         </div>
       
           
      </div>
      
    </section>
  <!--FINE ARTICOLI IN VENDITA-->


  <!--INIZIO STORIA AMABILE-->
    <article id="main-storia">
      <div id="immagine-donne"><div></div></div>
      <div id="storia-amabile">
        <h1>LA STORIA DI AMABILE</h1>
        <p>
          <br />Quella di Amabile e di Martina Strazzer, CEO e Founder, è una
          bellissima storia di <br />determinazione, che ci insegna che non
          sempre la strada già tracciata è quella giusta, e <br />
          che per raggiungere i propri obiettivi bisogna avere il coraggio di
          mettersi in gioco.
          <button id="button-storia">
            <a href="https://amabilejewels.it/chi-siamo">SCOPRI DI PIÙ</a>
          </button>
        </p>
      </div>
    </article>

 <!--FINE STORIA AMABILE-->



  <!--INIZIO SEZIONE MAPS-->
      <article id="container-map">
      <h2>DOVE TROVARCI</h2>
      <div id="map-flex">
          <div id="map">
            <gmp-map center="44.6350135,10.9031586" zoom="14" map-id="DEMO_MAP_ID">
              <gmp-advanced-marker position="44.6350135,10.9031586" title="My location"></gmp-advanced-marker>
            </gmp-map>
           </div>
      </article>      
  <!--FINE SEZIONE MAPS-->



  <!--INIZIO SEZIONE NEWS-->
    <section id="new">
    </section>
  <!--FINE SEZIONE NEWS-->

  <!--INIZIO SEZIONE MUSICA-->

  <section id="album-container">
    <h1>Album musicali</h1>
    <form id="form-album">
      <input type='text' id='album'>
      <input type='submit' id='submit' value='Cerca'>
    </form>

    <section id="album-view">
  </section>
</section>
  <!--FINE SEZIONE MUSICA-->



    <!--INIZIO FOOTER-->
    <?php require_once 'footer.php';?>
    <!--FINE FOOTER-->
  </body>
</html>

