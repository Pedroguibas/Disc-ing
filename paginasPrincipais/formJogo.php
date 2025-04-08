<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Registrar jogo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="../assets/favicon.ico">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<body class="gamePageBody">
    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">
                    <img src="../assets/LogoDisc-ing.png" alt="Logo Disc-ing" class="d-inline-block w-100">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="#navbarSupportedContent"
                    aria-expanded="false" aria-label="Esconder a navegação">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="ms-auto">
                        <ul class="navbar-nav ml-auto mb-2 mb-lh-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="sobre.php">Sobre</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="perfilDoUsuario.php">Perfil</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <div class="headerShadow"></div>
    </header>
    <main>
        <form action="../form/registraJogo.php" method="POST" enctype="multipart/form-data">
            <div class="registroContentContainer container mt-5">
                <div class="gameInput mt-3">
                    <h1>Nome</h1>
                    <input type="text" name="nome" class="textInput col-3" required>
                </div>
                <div class="gameInput mt-3">
                    <h1>Classificação indicativa</h1>

                    <div class="col-3">
                        <select name="classificacao" class="form-select">
                            <option value="livre">Livre</option>
                            <option value="10">10 Anos</option>
                            <option value="12">12 Anos</option>
                            <option value="14">14 Anos</option>
                            <option value="16">16 Anos</option>
                            <option value="18">18 Anos</option>
                        </select>
                    </div>
                </div>
                <div class="gameInput mt-3">
                    <h1>Banner do jogo</h1>
                    <input type="file" name="banner" accept="image/jpeg" required />
                </div>
                <div class="gameInput mt-3">
                    <h1>Capa do jogo</h1>
                    <input type="file" name="cover" accept="image/jpeg" required />
                </div>
                <div class="gameInput mt-3">
                    <h1>Sinopse:</h1>
                    <textarea name="sinopse" class="col-12 textInput" required></textarea>
                </div>
                
                <div class="gameInput mt-3">
                    <div>
                        <h1>Requisistos Mínimos:</h1>
                        <h2 class="mt-3">Sistema Operacional: </h2>
                        <input type="text" name="so" class="col-3 textInput" required>
                        
                        <h2 class="mt-3">Processador: </h2>
                        <input type="text" name="cpu" class="col-3 textInput" required>
                        
                        <h2 class="mt-3">Placa de Vídeo: </h2>
                        <input type="text" name="gpu" class="col-3 textInput" required>
                        
                        <h2 class="mt-3">Memória: </h2>
                        <input type="text" name="ram" class="col-3 textInput" required>
                        
                        <h2 class="mt-3">Armazenamento: </h2>
                        <input type="text" name="armazenamento" class="col-3 textInput" required>
                        

                    </div>
                </div>
                <h1 class="tituloPlat m-2">Plataformas</h1>
                <div class="gameInput d-flex justify-content-around align-items-center mt-3 mb-5">

                    <input id="plat1" type="checkbox" name="plataforma[]" value="switch">
                    <label class="plataformaCheck" for="plat1"><i class="bi bi-nintendo-switch"></i></label>

                    <input id="plat2" type="checkbox" name="plataforma[]" value="playstation">
                    <label class="plataformaCheck" for="plat2"><i class="bi bi-playstation"></i></label>

                    <input id="plat3" type="checkbox" name="plataforma[]" value="xbox">
                    <label class="plataformaCheck" for="plat3"><i class="bi bi-xbox"></i></label>

                    <input id="plat4" type="checkbox" name="plataforma[]" value="pc">
                    <label class="plataformaCheck" for="plat4"><i class="bi bi-pc-display"></i></label>
                </div>
            </div>

                <div class="d-flex justify-content-center mt-3">
                    <input type="submit">
                </div>
        </form>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>