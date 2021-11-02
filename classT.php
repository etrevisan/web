<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="favv.png" sizes="32x32">
	<meta charset="utf-8">
	<title>classT</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1.0">	
	<link rel="preconnect" href="https://fonts.gstatic.com"><!--link fonte do site-->
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"><!--bootstrap-->

	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
	<link rel="stylesheet" href="footer-white.css">
</head>

<body>

	<nav class="navbar navbar-expand-lg navbar-light">
		<a class="navbar-brand" href="#">
			<img src="logoclasst.jpg" width="80px" height="auto" alt="">
		</a>

		<button class="navbar navbar-toggler" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><span class="navbar-toggler-icon"></span></button>

		<strong>
		<div class="collapse navbar-collapse" id="collapseExample">
			<ul class="navbar-nav nav-fill mr-auto" align="right">
				<li class="nav-item active">
					<a class="nav-link" href="#QuemSomos">Quem Somos</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#Download">Download</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#Depoimentos">Depoimentos</a>
				</li>

			</ul>
		</div>
	</nav>
</strong>
	<br><br>
	
	<b><p class="titleQuemSomos">Quem<br>Somos</p></b>
	<p class="textos">Amigos que decidiram desenvolver uma plataforma de estudos que auxiliasse pessoas que desejam estudar virtualmente com foco preparatório<br>para exames seletivos de escolas e colégios técnicos (vestibulinhos).<br>
	A ideia surgiu no momento em que percebeu-se que os estudantes apresentam nervosismo pouco antes de fazerem uma prova importante,<br> pelo medo de terem  estudado de forma incorreta ou insuficiente, sem terem aprendido nada.<br> A partir disso, foi criada uma plataforma de estudos onde os próprios usuários podem postar e usufruir do conteúdo postado, mapas mentais,<br> resumos, entre outros.<br> Uma plataforma em que um ajuda o outro no aprendizado e na busca da forma mais fácil da absorção do conteúdo.</p> 


	<a name="Download"><b><p class="titleDownload">Aproveite o melhor<br> que a classT tem a lhe oferecer</p></b></a>
	<p style="margin-left: 15%;text-align: justify">Disponível para Android™ e Windows</p>

	<div class="container">
		<div class="row">
			<div class="col" style="margin-top: 15%">
				<div class="divBotoes">
					<a href="https://play.google.com/store/classt" target="_blank"><p style="font-size: 13px">Disponível na<br>Google Play Store</p></a>
				</div>
				<div class="divBotoes">
					<a href="http://microsoftstore.com/classt" target="_blank"><p style="font-size: 13px">Disponível na<br>Microsoft Store</p></a>
				</div>
			</div>	
			<div class="col">
				<img class="celular" src="ocelular.jpg" align="right">
			</div>
		</div>
	</div>


	<a name="Depoimentos"><b><p class="titleDepoimentos">Sua história faz história</p></b></a>	
	<p class="textos" style="margin-left: 37%">Conte aqui a história da sua aprovação com a classT :)</p>

	<div id="divFormDepoimentos">
		<form method='POST' class="form-inline">
			<fieldset>
				<input class="form-control form-control-sm" type="text" placeholder="Nome" size="30" name="nome">
				<input class="form-control form-control-sm" type="text" placeholder="E-mail" size="30" name="email">
				<br><br>
				Como a classT te ajudou com sua aprovação?<br><br>

				<input class="form-control form-control-sm textarea" style="height: 80px" size="69" type="text" name="depoimento"><br><br>
	
				<!--<textarea rows="5%" cols="70%" spellcheck="false" name="depoimento"></textarea><br><br>-->
				<div class="form-group">
					<div class="form-check">
						<input class="form-check-input" type="checkbox" id="gridCheck">
						<label class="form-check-label" for="gridCheck">
							Autorizo a divulgação do "Depoimento" aqui registrado, incluindo meu nome.
						</label>
					</div>
				</div>
				<br>
				<input type="submit" class="btn btn-outline-dark" value="Enviar depoimento" onclick="alert('O depoimento foi enviado com sucesso.')">
			</fieldset>
		</form>
	</div>
</html>

<?php
	if ($_SERVER["REQUEST_METHOD"] === 'POST') {
		//include("paginaPrincipal.html");
		include("conexaoBD.php");

		try {            
            $nome = $_POST["nome"];
            $email = $_POST["email"];
            $depoimento = $_POST["depoimento"];

            if ((trim($nome) == "") || (trim($email) == "") || (trim($depoimento) == "")) {
                echo "Todos os campos são obrigatórios.";
            } else {
                $comandoSQL = $pdo->prepare("select * from ClassTWeb where email= :email");
                $comandoSQL->bindParam(':email', $email);
                $comandoSQL->execute();

                $rows = $comandoSQL->rowCount();

		        if ($rows <= 0) {
		            $comandoSQL = $pdo->prepare("insert into ClassTWeb (nome, email, depoimento) values(:nome, :email, :depoimento)");
		            $comandoSQL->bindParam(':nome', $nome);
		            $comandoSQL->bindParam(':email', $email);
		            $comandoSQL->bindParam(':depoimento', $depoimento);
		            $comandoSQL->execute();
		        } else {
		            echo "";
		        }
		       } 
		    } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }

        $pdo = null;
	}

	if ($_SERVER["REQUEST_METHOD"] === 'POST') {

         include("conexaoBD.php");

         if (isset($_POST["email"]) && (trim($_POST["email"]) != "")) {
             $filme = $_POST["email"];
             $comandoSQL = $pdo->prepare("select * from ClassTWeb where email= :email");
             $comandoSQL->bindParam(':email', $email);
         } else {
             $comandoSQL = $pdo->prepare("select * from ClassTWeb order by email");
         }

         try {
         	 echo "<div class='estruturaDepoimentos'>";
         	 echo "<div class='caixasDepoimentos'>";
             echo "<form method='post'>";
             echo "<table border='0px' style='width:400px;margin-left:30%'>\n";
             
             echo "</div>";
             echo "</div>";

             $comandoSQL->execute();

             while ($row = $comandoSQL->fetch()) {
                 echo "<tr>";
                 echo "<td><b>" . $row['nome'] . "</b></td>\n";
                 echo "</tr>\n";
                 echo "<tr>\n";
                 echo "<td><b>" . $row['depoimento'] . "</b></td>\n";
                 echo "</tr>\n";
             }
             echo "</table></div>
             </div>";

         } catch (PDOException $e) {
             echo 'Error: ' . $e->getMessage();
         }
         //$pdo = null;
     }
?>

<html>
<div class="content">
	</div>
	<footer id="myFooter">
		<div class="container">
			<ul>
				<li><a href="#">Informações</a></li>
				<li><a href="tel:+55-019-99987-8880">Contato</a></li>
				<li><a href="#">Ajuda</a></li>
			</ul> 
		</div> 

		<div class="footer-social" style="background-color: #00817E">
			<a href="https://instagram.com/@tClasse" class="social-icons"><i class="fa fa-instagram"></i></a>
			<a href="https://facebook.com/tClasse" class="social-icons"><i class="fa fa-facebook"></i></a>
			<a href="https://twitter.com/@tClasse" class="social-icons"><i class="fa fa-twitter"></i></a>
			<a href="https://api.whatsapp.com/send?phone=5519999878880" class="social-icons"><i class="fa fa-whatsapp"></i></a><br>
			<p class="footer-copyright">&copy;2021 Copyright - classT</p>
		</div>  

	</footer>
	<!--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>