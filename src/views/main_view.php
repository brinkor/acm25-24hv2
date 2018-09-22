<!DOCTYPE html>

<html lang="pl" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>ACM25/24h</title>
    <meta name="description" content="Strona o mojej pasji do piłki nożnej i drużyny A.C. Milan" />
    <meta name="keywords" content="Milan, ac milan, pasja, hobby, piłka nożna, football, drużyna" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" type="text/css" />
    <link rel="stylesheet" href="fontello/css/fontello.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet">
    <script type="text/javascript" src="java.js"></script>
</head>

<body onload="czas();">
    <div id="container">
        <a href="index.html">
            <div id="logo">
                <img class="lewe" alt="fb1" src="football1.png" />
                <img class="logo" alt="acm" src="acm2524h.png" />
                <img class="prawe" alt="fb2" src="football2.png" />
            </div>
        </a>

        <div class="row">
            <div class="col-2">
                <div id="menu">
                    <h3>MENU</h3>
                    <ul>
                        <li><a class="zwykle" href="index.html"><h4 class="ramka">Strona Główna<i class="demo-icon icon-home"></i></h4></a></li>
                        <li class="wysuwane">
                            <a class="zwykle" href="javascript:void(0)"><h4 class="ramka">O klubie <i class="demo-icon icon-th-list"></i></h4></a>
                            <div class="wysuniete">
                                <a href="sklad.html">Skład</a>
                                <a href="historia.html">Historia</a>
                                <a href="hymn.html">Hymn</a>
                            </div>
                        </li>
                        <li><a class="zwykle" href="tabela.html"><h4 class="ramka">Tabela <i class="demo-icon icon-clock"></i></h4></a></li>
                        <li><a class="zwykle" href="konkurs.html"><h4 class="ramka">Konkurs <i class="demo-icon icon-award"></i></h4></a></li>
                        <li><a class="zwykle" href="kontakt.html"><h4 class="ramka">Kontakt <i class="demo-icon icon-mail"></i></h4></a></li>
                    </ul>
                </div>
				</br></br>
				</br></br>
				<?php include 'login_view.php'; ?>
            </div>

            <div class="col-7">
                <div id="content">
					<?php if (isset($registered) && $registered == 0) include 'register_view.php'; 
					else if (isset($search)) include 'search_view.php';
					else
					{
						if (isset($registered) && $registered == 1) echo '<h3 class="centered">Zostałeś zarejstrowany</h3>'; ?>
						<?php include 'upload_view.php'; ?>
						<h1>Galeria</h1>
						<?php 
						if (isset($wybrane))
							include 'remember_view.php';
						else
							include 'gallery_view.php';
						?>
						<div class="logNoFill"><a href="search"><button class="logowanie">Wyszukiwarka</button></a></div>
			   <?php } ?>
                </div>
            </div>

            <div class="col-3">
                <div id="next_match">
                    <h1 id="zegar">Tu powinien być zegar, jeśli go nie ma, włącz obsługę JavaScript</h1>
                    <h1>------------------</h1>
                    <h3>Następny mecz:</h3>
                    <h4>A.C. Milan - AEK Ateny </h4>
                    <h5>Data:</h5>
                    <i class="demo-icon icon-calendar"></i>02.11.2017r.
                    <br /><h5>Godzina:</h5>
                    <i class="demo-icon icon-clock"></i>20:45
                </div>
            </div>

            <div id="footer">
                Najlepsze w sieci centrum informacji o klubie A.C. Milan - ACM25/24h.pl &copy; Wszelkie prawa zastrzeżone.
            </div>
        </div>
    </div>

</body>
</html> 