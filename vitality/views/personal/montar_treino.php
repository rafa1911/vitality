<?php 
session_start();
$id = $_GET['id']; 
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
  <title>Montar Treino - Vitality</title>
  <link rel="stylesheet" href="../../assets/css/montar_treino.css" />
  <link rel="icon" href="../../assets/img/favicon.svg" type="image/svg+xml">
</head>
<style>

</style>
<body>
  <header>
    <h1>Crie o seu Treino</h1>
    <a href="../personal/perfilAL.php" class="back-icon">
      <i class="fa-solid fa-arrow-left"></i>
    </a>
  </header>

  <form method="POST" action="../../controllers/Treino.php?id=<?php echo $id?>">
    <main>
      <div id="nome-treino-secao">
        <div class="treino-info">
          <label for="nome-treino">Nome do Treino:</label>
          <input type="text" name="nome_treino" id="nome-treino" placeholder="Digite o nome do treino" required />
        </div>

        <div class="grupo-muscular">
          <h2>Escolha o Membro</h2>
          <div class="membro">
            <label><input type="checkbox" name="membro" value="superiores" /> Membros Superiores</label>
            <label><input type="checkbox" name="membro" value="inferiores" /> Membros Inferiores</label>
          </div>
        </div>
      </div>

      <section id="aparelhos-secao" style="display: none;">
        <div id="aparelhos-superiores" style="display: none;">
          <h2>Aparelhos dos Membros Superiores</h2>
          
          <h3>Peitoral</h3>
          <label>
            <i class="fa-solid fa-play video-icon" data-video="supino_inclinado_com_halteres.mp4"></i>
            <input type="checkbox" name="aparelhos[]" value="Supino Inclinado com Halteres" />
            Supino Inclinado com Halteres
            <div class="video-container">
              <video controls>
                <source src="../../assets/gifs/Supino_inclinado_com_halteres.mp4" autoplay loop muted />
              </video>
            </div>
          </label>

          <label>
          <i class="fa-solid fa-play video-icon" data-video="crucifixo_na_maquina.mp4"></i>  
          <input type="checkbox" name="aparelhos[]" value="Crucifixo na Máquina" /> 
          Crucifixo na Máquina
          <div class="video-container">
              <video controls>
                <source src="../../assets/gifs/crucifixo_na_maquina.mp4" autoplay loop muted />
              </video>
            </div>
        </label>
          
          <h3>Dorsais</h3>
          <label>
          <i class="fa-solid fa-play video-icon" data-video="puxada_alta_com_triangulo.mp4"></i>    
          <input type="checkbox" name="aparelhos[]" value="Puxada Alta com Triângulo" /> 
          Puxada Alta com Triângulo
          <div class="video-container">
              <video controls>
                <source src="../../assets/gifs/puxada_alta_com_triangulo.mp4" autoplay loop muted />
              </video>
            </div>
        </label>

          <label>
          <i class="fa-solid fa-play video-icon" data-video="remada_baixa_com_triangulo.mp4"></i>    
            <input type="checkbox" name="aparelhos[]" value="Remada Baixa com Triângulo" />
             Remada Baixa com Triângulo
             <div class="video-container">
              <video controls>
                <source src="../../assets/gifs/remada_baixa_com_triangulo.mp4" autoplay loop muted />
              </video>
            </div>

            </label>

          <h3>Deltóides</h3>
          <label>
          <i class="fa-solid fa-play video-icon" data-video="elevacao_lateral.mp4"></i>    
            <input type="checkbox" name="aparelhos[]" value="Elevação Lateral" /> 
            Elevação Lateral
            <div class="video-container">
              <video controls>
                <source src="../../assets/gifs/elevacao_lateral.mp4" autoplay loop muted />
              </video>
            </div>
          </label>

          <label>
          <i class="fa-solid fa-play video-icon" data-video="desenvolvimento_com_halteres.mp4"></i>    
            <input type="checkbox" name="aparelhos[]" value="Desenvolvimento com Halteres" />
             Desenvolvimento com Halteres
             <div class="video-container">
              <video controls>
                <source src="../../assets/gifs/desenvolvimento_com_halteres.mp4" autoplay loop muted />
              </video>
            </div>

            </label>

          <h3>Tríceps</h3>
          <label>
          <i class="fa-solid fa-play video-icon" data-video="puxador_triceps_com_corda.mp4"></i>    
            <input type="checkbox" name="aparelhos[]" value="Puxador Tríceps com Corda" /> 
            Puxador Tríceps com Corda
            <div class="video-container">
              <video controls>
                <source src="../../assets/gifs/puxador_triceps_com_corda.mp4" autoplay loop muted />
              </video>
            </div>
          </label>

          <label>
          <i class="fa-solid fa-play video-icon" data-video="triceps_frances_com_halter.mp4"></i>    
            <input type="checkbox" name="aparelhos[]" value="Triceps Francês com Halter" /> 
            Tríceps Francês com Halter
            <div class="video-container">
              <video controls>
                <source src="../../assets/gifs/triceps_frances_com_halter.mp4" autoplay loop muted />
              </video>
            </div>
          </label>

          <h3>Bíceps</h3>
          <label>
          <i class="fa-solid fa-play video-icon" data-video="rosca_direta_com_barra.mp4"></i>    
            <input type="checkbox" name="aparelhos[]" value="Rosca Direta com Barra" /> 
            Rosca Direta com Barra
            <div class="video-container">
              <video controls>
                <source src="../../assets/gifs/rosca_direta_com_barra.mp4" autoplay loop muted />
              </video>
            </div>
          </label>

          <label>
          <i class="fa-solid fa-play video-icon" data-video="rosca_martelo_com_halteres.mp4"></i>    
            <input type="checkbox" name="aparelhos[]" value="Rosca Martelo com Halteres" /> 
            Rosca Martelo com Halteres
            <div class="video-container">
              <video controls>
                <source src="../../assets/gifs/" autoplay loop muted />
              </video>
            </div>
          </label>
        </div>
                
        <div id="aparelhos-inferiores" style="display: none;">
          <h2>Aparelhos dos Membros Inferiores</h2>
          
          <h3>Quadríceps</h3>
          <label>
          <i class="fa-solid fa-play video-icon" data-video="leg_press_45º.mp4"></i>    
            <input type="checkbox" name="aparelhos[]" value="Leg Press 45°" /> 
            Leg Press 45°
            <div class="video-container">
              <video controls>
                <source src="../../assets/gifs/leg_press_45º.mp4" autoplay loop muted />
              </video>
            </div>
          </label>

          <label>
          <i class="fa-solid fa-play video-icon" data-video="cadeira_extensora.mp4"></i>    
            <input type="checkbox" name="aparelhos[]" value="Cadeira extensora" /> 
            Cadeira Extensora
            <div class="video-container">
              <video controls>
                <source src="../../assets/gifs/cadeira_extensora.mp4" autoplay loop muted />
              </video>
            </div>
          </label>
         
          <h3>Posteriores</h3>
          <label>
          <i class="fa-solid fa-play video-icon" data-video="stiff_com_barra.mp4"></i>    
            <input type="checkbox" name="aparelhos[]" value="Stiff com Barra" />
             Stiff com Barra
             <div class="video-container">
              <video controls>
                <source src="../../assets/gifs/stiff_com_barra.mp4" autoplay loop muted />
              </video>
            </div>
            </label>

          <label>
          <i class="fa-solid fa-play video-icon" data-video="cadeira_flexora.mp4"></i>    
            <input type="checkbox" name="aparelhos[]" value="Cadeira Flexora" />
             Cadeira Flexora
             <div class="video-container">
              <video controls>
                <source src="../../assets/gifs/cadeira_flexora.mp4" autoplay loop muted />
              </video>
            </div>
            </label>

          <h3>Glúteos</h3>
          <label>
          <i class="fa-solid fa-play video-icon" data-video="elevacao_pelvica_maquina.mp4"></i>    
            <input type="checkbox" name="aparelhos[]" value="Elevação Pélvica na Máquina" /> 
            Elevação Pélvica na Máquina
            <div class="video-container">
              <video controls>
                <source src="../../assets/gifs/elevacao_pelvica_maquina.mp4" autoplay loop muted />
              </video>
            </div>
          </label>

          <label>
          <i class="fa-solid fa-play video-icon" data-video="cadeira_abdutora.mp4"></i>    
            <input type="checkbox" name="aparelhos[]" value="Cadeira Abdutora" /> 
            Cadeira Abdutora
            <div class="video-container">
              <video controls>
                <source src="../../assets/gifs/cadeira_abdutora.mp4" autoplay loop muted />
              </video>
            </div>
          </label>

          <h3>Panturrilhas</h3>
          <label>
          <i class="fa-solid fa-play video-icon" data-video="soleo_maquina.mp4"></i>    
            <input type="checkbox" name="aparelhos[]" value="Sóleo Máquina" /> 
            Sóleo Máquina
            <div class="video-container">
              <video controls>
                <source src="../../assets/gifs/soleo_maquina.mp4" autoplay loop muted />
              </video>
            </div>
          </label>

          <label>
          <i class="fa-solid fa-play video-icon" data-video="panturrila_em_pe_maquina.mp4"></i>    
            <input type="checkbox" name="aparelhos[]" value="Panturrilha em pé na máquina" /> 
            Panturrilha em Pé na Máquina
            <div class="video-container">
              <video controls>
                <source src="../../assets/gifs/panturrila_em_pe_maquina.mp4" autoplay loop muted />
              </video>
            </div>
          </label>

          <h3>Abdominais</h3>
          <label>
          <i class="fa-solid fa-play video-icon" data-video="abdominal_infra.mp4"></i>    
            <input type="checkbox" name="aparelhos[]" value="Abdominal Infra" /> 
            Abdominal Infra
            <div class="video-container">
              <video controls>
                <source src="../../assets/gifs/abdominal_infra.mp4" autoplay loop muted />
              </video>
            </div>
          </label>

          <label>
          <i class="fa-solid fa-play video-icon" data-video="abdominal_obliquo.mp4"></i>    
            <input type="checkbox" name="aparelhos[]" value="Abdominal Oblíquo" /> 
            Abdominal Oblíquo (Toque nos Pés)
            <div class="video-container">
              <video controls>
                <source src="../../assets/gifs/abdominal_obliquo.mp4" autoplay loop muted />
              </video>
            </div>
          </label>
        </div>
      </section>
      <button type="button" class="btn-proximo" style="display: none;">Próximo</button>

      <section id="config-secao" style="display: none;">
      <button type="button" class="btn-voltar"><i class="fa-solid fa-arrow-left"></i> Voltar</button>        <h2>Configurar Treino</h2>
        <div id="aparelhos-selecionados">
        </div>
        <button type="submit" class="btn-finalizar">Finalizar Treino</button>
      </section>
    </main>
  </form>
  
  <script>
document.querySelectorAll('.video-icon').forEach(icon => {
  icon.addEventListener('click', () => {
    const videoContainer = icon.parentNode.querySelector('.video-container'); // Seleciona o contêiner do vídeo
    const video = videoContainer.querySelector('video');
    const source = video.querySelector('source');
    const videoPath = `../../assets/gifs/${icon.dataset.video}`;

    // Atualiza a fonte do vídeo
    source.src = videoPath;
    video.load();

    // Lógica para alternar a exibição do vídeo
    if (videoContainer.style.display === 'none' || videoContainer.style.display === '') {
      videoContainer.style.display = 'block'; // Exibe o vídeo
      video.play().catch(error => {
        console.error('Erro ao reproduzir o vídeo:', error);
      });
    } else {
      video.pause();
      videoContainer.style.display = 'none'; // Oculta o vídeo
    }
  });
});
</script>
  <script src="../../assets/js/montar_treino.js"></script>
</body>
</html>
