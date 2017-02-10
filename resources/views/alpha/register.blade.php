<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="description" content="">
  		<meta name="author" content="">

		<title>DeepNerd - Alpha</title>

		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link href='//fonts.googleapis.com/css?family=Raleway:400,300,600' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="/css/normalize.css">
		<link rel="stylesheet" href="/css/skeleton.css">
		<link rel="stylesheet" href="/css/alpha.css">

	</head>
	<body>
		<div class="container">
    <section class="header">
      <h2 class="title">Skynerd está de volta. E muito melhor.</h2>
      <a class="button button-primary" href="#registerform">Cadastre-se para o Alpha Testing</a>
      <div class="value-props row">
        <div class="four columns value-prop">
          <img class="value-img" src="{{ URL::to('/') }}/images/content.png">
          Foco no conteúdo: imagens, vídeos, músicas &amp; textos.
        </div>
        <div class="four columns value-prop">
          <img class="value-img" src="{{ URL::to('/') }}/images/hub.png">
          Hubs: grupos que categorizam e avaliam todo o conteúdo publicado.
        </div>
        <div class="four columns value-prop">
          <img class="value-img" src="{{ URL::to('/') }}/images/medal.png">
          Gamification: Medalhas, experiência, nível, pontos.
        </div>
      </div>
    </section>

    <div class="docs-section" id="intro">
      <h6 class="docs-header">O que é a Deep Nerd?</h6>
      <p>Um grupo de usuários da finada Skynerd passou os últimos 2 anos trabalhando num novo código para uma nova rede: mais rápida, mais simples, mais moderna e mais divertida. O resultado você pode testemunhar agora, como um dos 250 Alpha Testers ou como um dos 2.500 Beta Testers.</p>
    </div>

    <div class="docs-section" id="alpha">
      <h6 class="docs-header">Alpha Testing</h6>
      <p>Para ser um Alpha Tester basta escolher um <u>handler</u> (como os @ do Twitter) e registrar um endereço de e-mail. O handler <strong>não</strong> poderá ser mudado. O e-mail pode ser trocado após o lançamento da versão final.</p>
      <p>Usuários Alpha se comprometem a testar as funcionalidades do sistema através do uso da rede social. Usuários Alpha inativos por mais de 5 dias serão punidos com o desligamento da conta. Todos os bugs encontrados devem ser reportados. No lançamento da versão estável da rede, todos os Alpha Testers receberão uma badge (medalha) exclusiva e permanente, além de terem seus pontos, experiência e nível preservados. Caso o conteúdo do banco de dados necessite ser apagado, usuários Alpha terão preferência na recriação de seus Hubs.</p>

 
    </div>

    <div class="docs-section" id="beta">
      <h6 class="docs-header">Beta Testing</h6>
      <p>Usuários cadastrados que não puderam participar do Alpha serão imediatamente escolhidos para participar do Beta Testing. As mesmas condições aplicadas aos usuários Alpha são válidas para os participantes do Beta Testing. É necessário testar, participar e reportar todos os bugs e comportamentos estranhos encontrados no site. No lançamento da versão estável da rede, Beta Testers receberão sua própria badge (medalha) exclusiva e permanente, além de também terem preferência na recriação de Hubs que possam ser apagados na transição, e manterão seus pontos, experiência e nível.</p>

    </div>

    <div class="docs-section" id="registerform">
      <h6 class="docs-header">Cadastro de Alpha &amp; Beta Testers</h6>
      <p>Lembramos que é necessário escolher um handler (letras, números e traços apenas) <strong>que não poderá ser mudado</strong>, e um e-mail válido. Usuários que cadastrarem handlers ofensivos perderão sua chance de participarem no teste e terão seu e-mail bloqueado para cadastro futuro.</p>
	  
	  @if ($errors)
	  	<p style="color: red;">
	  		@if ($errors->has('handler'))
		  		{{ $errors->first('handler') }}

		 	@endif

	      	@if ($errors->has('email'))
	      		{{ $errors->first('email') }}
	      	@endif
	    </p>
	  @endif
	  
    	
      
      <div class="docs-example docs-example-forms">
      	<form method="POST" action="#registerform">

      		{{ csrf_field() }}
      		<div class="row">
      			<div class="six columns">
      				<label for="handler">Handler</label>
      				<input class="u-full-width" type="text" placeholder="Ozymandias_2017" name="handler" id="handler" value="{{ old('handler') }}" required>
      			</div>
      			<div class="six columns">
      				<label for="email">E-mail</label>
      				<input class="u-full-width" type="email" placeholder="tio_ozzy@email.com.br" name="email" id="email" value="{{ old('email') }}" required>
      			</div>
      		</div>
      		<input class="button-primary" type="submit" value="Cadastrar">
      	</form>
      </div>

      <div class="docs-section" id="footer">
      	<center><p>&copy; 2017 - DeepNerd - todos os direitos reservados</p></center>
      </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  // Add smooth scrolling to all links
  $("a").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
});
</script>
	</body>
</html>