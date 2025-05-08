CREATE DATABASE IF NOT EXISTS discing;

USE discing;

CREATE TABLE IF NOT EXISTS usuario (
    usuarioID INT AUTO_INCREMENT PRIMARY KEY,
    usuarioNome VARCHAR(70) NOT NULL,
    usuarioSobrenome VARCHAR(255) NOT NULL,
   	username VARCHAR(127) COLLATE utf8mb4_bin NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(127) NOT NULL,
	adm TINYINT(1) DEFAULT 0);

INSERT INTO usuario (email, senha, usuarioNome, usuarioSobrenome, username, adm)
VALUES ('pedroguibas123@gmail.com', 'senha123', 'Pedro', 'Bastos', 'Pedroguibas', 1),
('erick@gmail.com', 'senha123', 'Erick', 'Neves', 'ErickNeves', 0),
('eduarda@gmail.com', 'senha123', 'Eduarda', 'Solano', 'SolanoEd', 0),
('jessica@gmail.com', 'senha123', 'Jessica', 'Cristina', 'CristinaJess', 0),
('joao@gmail.com', 'senha123', 'Joao', 'Cardia', 'Jao', 0),
('querino@gmail.com', 'senha123', 'Luiz', 'Querino', 'QuerinoLu', 0);

CREATE TABLE IF NOT EXISTS jogo (
    jogoID INT AUTO_INCREMENT PRIMARY KEY,
    jogoNome VARCHAR(255) NOT NULL UNIQUE,
    sinopse TEXT(2500) NOT NULL,
    jogoRequisitosJogoID INT,
    classificacao ENUM('livre', '10', '12', '14', '16', '18') NOT NULL,
    playstation TINYINT(1) DEFAULT 0,
    xbox TINYINT(1) DEFAULT 0,
    nintendoSwitch TINYINT(1) DEFAULT 0,
    windowsOS TINYINT(1) DEFAULT 0,
    macOS TINYINT(1) DEFAULT 0,
    linuxOS TINYINT(1) DEFAULT 0,
    androidOS TINYINT(1) DEFAULT 0);

CREATE INDEX IF NOT EXISTS idx_jogoNome ON jogo(jogoNome);
    
CREATE TABLE IF NOT EXISTS requisitosJogo (
    requisitosJogoID INT AUTO_INCREMENT PRIMARY KEY,
    so VARCHAR(255) NOT NULL,
    cpu VARCHAR(255) NOT NULL,
    gpu VARCHAR(255) NOT NULL,
    ram VARCHAR(255) NOT NULL,
    armazenamento VARCHAR(127) NOT NULL);
    
ALTER TABLE jogo ADD CONSTRAINT fk_jogo_requisitos FOREIGN KEY (jogoRequisitosJogoID) REFERENCES requisitosJogo(requisitosJogoID);

INSERT INTO requisitosJogo (so, cpu, gpu, ram, armazenamento)
VALUES ('Windows 10 64-bit', 'Intel Core i5-8400 / AMD Ryzen 5 1600', 'NVIDIA GeForce GTX 1060 6GB / AMD Radeon RX 580 8GB', '16 GB de RAM', '130 GB de espaço disponível'), 
('Windows 10 64-bit', 'Intel Core i5-750', 'A placa de vídeo deve ser compatível com DirectX 11 e Shader Model 5.0', '8 GB de RAM', '85 GB de espaço disponível'),
('Windows 10 64-bit', 'Intel Core i5 da 7ª Geração', 'NVIDIA GeForce GTX 970', '8 GB de RAM', '40 GB (sendo 35 GB de espaço adicional)'), 
('Windows 10 64-bit', 'Intel Core i5-6600K/AMD Ryzen 5 1600', 'Nvidia GeForce GTX 1050Ti/AMD Radeon R9 380X', '8 GB de RAM', '100 GB de espaço disponível'),
('Windows 10 64-bit', 'Intel i5-4670k or AMD Ryzen 3 1200', 'NVIDIA GTX 1060 (6GB) or AMD RX 5500 XT (8GB) or Intel Arc A750', '8 GB de RAM', '190 GB de espaço disponível'),
('Windows 7 (64bit) / Mac OS 10.13 (64bit) / Ubuntu 16.04 LTS (64bit)', 'Intel Core 2 Duo E5200', 'GeForce 9800GTX+ (1GB)', '4 GB de RAM', '9 GB de espaço disponível'),
('Windows 7 / Lion 10.7.5, 32/64-bit / glibc 2.17+, 32/64-bit', 'Intel Core i3 M380', 'Intel HD 4000', '2 GB de RAM', '1200 MB de espaço disponível'),
('Windows 10', 'Intel Celeron J4105 / AMD FX-4100', 'Intel HD Graphics 4000 / AMD Radeon R5', '4 GB de RAM', 'pelo menos 1 GB de espaço disponível'),
('Windows 10', 'Intel Core i5-2300 / AMD FX-4350', 'NVIDIA GeForce GTX 650 Ti, 2 GB / AMD Radeon HD 7850, 2 GB', '8 GB de RAM', '30 GB de espaço disponível'),
('Console Nintendo Switch', 'Console Nintendo Switch', 'Console Nintendo Switch', 'Console Nintendo Switch', 'Mídia física / 10 GB de espaço disponível'),
('Windows 7', 'Intel i5 3570K / AMD FX-8350', 'GTX 770 with 2GB VRAM / Radeon R9 280X 3GB', '8 GB de RAM', '30 GB de espaço disponível');

INSERT INTO jogo (jogoNome, jogoRequisitosJogoID, sinopse, classificacao, playstation, xbox, nintendoSwitch, windowsOS, macOS, linuxOS, androidOS)
VALUES ('Black Myth Wukong', 1, '"Um mundo desconhecido onde maravilhas reluzem
e a cada passo novos cenários surgem."

Entre em um reino fascinante repleto de maravilhas e descobertas da antiga mitologia chinesa!
No papel principal de Predestinado, você verá cenários de tirar o fôlego do romance clássico "Jornada para o Oeste" e criará um novo conto épico enquanto se aventura.', '14', 1, 1, 0, 1, 0, 0, 0),
('Counter Strike 2', 2, 'Há mais de duas décadas, o Counter-Strike oferece uma experiência competitiva de elite moldada por milhões de jogadores mundialmente. Agora, o próximo capítulo da história do CS vai começar. Isso é Counter-Strike 2.

Uma atualização gratuita para o CS:GO, o Counter-Strike 2 é o maior salto tecnológico na história da série. Feito na engine Source 2, o Counter-Strike 2 foi modernizado com renderização realística baseada na física, mecanismos de conexão de ponta e ferramentas da Oficina aprimoradas.', '16', 0, 0, 0, 1, 0, 1, 0),
('Zenless Zone Zero', 3, 'Zenless Zone Zero é o novo RPG de ação e fantasia urbana da HoYoverse. Nele, a civilização contemporânea foi destruída por uma calamidade conhecida como Esferas Negras. Elas aparecem do nada, criando anomalias espaciais carregadas de formidáveis monstros conhecidos como Etéreos..', '12', 1, 0, 0, 1, 0, 0, 1),
('Tekken 8', 4, 'O jogo apresenta um elenco rico de mais de 32 personagens com modelos de alta resolução meticulosamente detalhados que levam o hardware moderno até o limite. Experimente batalhas empolgantes com novos recursos de batalha, como o Heat, ou se vire em situações complicadas com golpes supremos poderosos chamados Rage Arts. Com o novo sistema de controle, o Estilo Especial, é possível realizar combos poderosos com apenas um simples botão, tornando o jogo ainda mais acessível para os novatos.', '12', 1, 1, 0, 1, 0, 0, 0),
('God of War Ragnarök', 5, 'Do Santa Monica Studio, esta é a sequência da aclamada versão de 2018 de God of War. O Fimbulwinter já começou. Kratos e Atreus devem viajar pelos Nove Reinos em busca de respostas enquanto as forças asgardianas se preparam para uma batalha profetizada que causará o fim do mundo. Nessa jornada, eles explorarão paisagens míticas impressionantes e enfrentarão inimigos aterradores: deuses nórdicos e monstros. A ameaça do Ragnarök se aproxima. Kratos e Atreus terão de escolher entre a segurança deles próprios e a dos reinos.', '18', 1, 0, 0, 1, 0, 0, 0),
('Hollow Knight', 6, 'Abaixo da cidade moribunda de Dirtmouth jaz um reino antigo e arruinado. Muitos são atraídos para o subterrâneo em busca de riquezas, glórias ou respostas para antigos segredos.


Hollow Knight é uma aventura de ação clássica em estilo 2D por um vasto mundo interligado. Explore cavernas serpenteantes, cidades antigas e ermos mortais; lute contra criaturas malignas e alie-se a insetos bizarros, e solucione mistérios antigos no centro do reino.', 'livre', 1, 1, 1, 1, 1, 1, 0),
('Celeste', 7, 'Ajude Madeline a enfrentar seus demônios internos em sua jornada até o topo da Montanha Celeste, nesse jogo meticuloso e super afiado de plataforma dos criadores do clássico multiplayer TowerFall.',  'livre', 1, 1, 1, 1, 1, 1, 0),
('Minecraft', 8, 'Minecraft é um jogo eletrônico sandbox de sobrevivência criado pelo desenvolvedor sueco Markus "Notch" Persson e posteriormente desenvolvido e publicado pela Mojang Studios, cuja propriedade intelectual foi obtida pela Microsoft em 2014.', 'livre', 1, 1, 1, 1, 1, 1, 1),
('Persona 3 Reload', 9, 'Assuma o papel de um estudante transferido que acaba vivendo um destino inesperado ao ingressar na hora ""oculta"" entre um dia e outro. Desperte um poder incrível, investigue a misteriosa Hora Sombria, lute em nome dos seus amigos e deixe sua marca para sempre nas memórias deles.

Persona 3 Reload é uma reimaginação cativante do RPG que redefiniu o gênero, agora repensado para a era moderna.', '16', 1, 1, 0, 1, 0, 0, 0),
('The Legend Of Zelda: Breath Of The Wild', 10, 'Abra os olhos...
Sem reino. Sem memória. Após um sono de 100 anos, Link acorda sozinho num mundo do qual ele não se lembra mais. Agora, o lendário herói deve explorar perigosas terras vastas e recuperar sua memória antes que Hyrule se perca para sempre. Armado apenas com o que encontra, Link parte em busca de respostas e dos recursos necessários para sobreviver.', '10', 0, 0, 1, 0, 0, 0, 0),
('Hellblade: Senua’s Sacrifice', 11, 'Dos criadores de Heavenly Sword, Enslaved: Odyssey to the West, e DmC: Devil May Cry, chega agora a viagem brutal de uma guerreira até ao mito e a loucura.

Na era dos vikings, uma guerreira celta parte numa jornada pessoal arrepiante até ao inferno viking para lutar pela alma de seu falecido amado.

Criado em parceria com neurocientistas e pessoas que vivenciam psicose, Hellblade: Senua’s Sacrifice vai te levar para as profundezas da mente de Senua.
', '16', 1, 1, 1, 1, 0, 0, 0);

CREATE TABLE IF NOT EXISTS avaliacao (
    avaliacaoUsuarioID INT NOT NULL,
    avaliacaoJogoID INT NOT NULL,
    nota INT NOT NULL,
    avaliacaoData TIMESTAMP DEFAULT CURRENT_TIMESTAMP);

ALTER TABLE avaliacao ADD CONSTRAINT chaveCompostaAvaliacao PRIMARY KEY (avaliacaoUsuarioID, avaliacaoJogoID);

ALTER TABLE avaliacao ADD CONSTRAINT fkAvaliacaoUsuario FOREIGN KEY (avaliacaoUsuarioID) REFERENCES usuario(usuarioID);

ALTER TABLE avaliacao ADD CONSTRAINT fkAvaliacaoJogo FOREIGN KEY (avaliacaoJogoID) REFERENCES jogo(jogoID);

INSERT INTO avaliacao (avaliacaoJogoID, avaliacaoUsuarioID, nota) VALUES (5, 1, 10), (5, 2, 7), (5, 3, 9), (5, 4, 8), (5, 5, 5), (5, 6, 9), (11, 3, 10), (8, 4, 7), (2, 1, 4), (3, 5, 1), (11, 4, 7);

CREATE TABLE IF NOT EXISTS listaJogado (
    listaJogadoUsuarioID INT NOT NULL,
    listaJogadoJogoID INT NOT NULL,
    jogado TINYINT(1) DEFAULT 1,
    dataMarcacaoJogado TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
    
ALTER TABLE listaJogado ADD CONSTRAINT pk_listaJogado PRIMARY KEY (listaJogadoUsuarioID, listaJogadoJogoID);
ALTER TABLE listaJogado ADD CONSTRAINT fk_usuariolistaJogado FOREIGN KEY (listaJogadoUsuarioID) REFERENCES usuario(usuarioID);
ALTER TABLE listaJogado ADD CONSTRAINT fk_jogolistaJogado FOREIGN KEY (listaJogadoJogoID) REFERENCES jogo(jogoID);

CREATE TABLE IF NOT EXISTS comentario (
	comentarioID INT AUTO_INCREMENT PRIMARY KEY,
    conteudo TEXT(600) NOT NULL,
    likes INT DEFAULT 0,
    spoiler TINYINT(1) NOT NULL,
    comentarioData TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    editado TINYINT(1) DEFAULT 0,
    responde INT,
   	comentarioUsuarioID INT NOT NULL,
    comentarioJogoID INT NOT NULL
);

ALTER TABLE comentario ADD CONSTRAINT FK_comentarioUsuario FOREIGN KEY (comentarioUsuarioID) REFERENCES usuario(usuarioID);

CREATE TABLE IF NOT EXISTS usuarioLikeComentario (
    likeUsuarioID INT,
    likeComentarioID INT,
    liked TINYINT(1) DEFAULT 1,
	PRIMARY KEY(likeUsuarioID, likeComentarioID));

ALTER TABLE usuarioLikeComentario ADD CONSTRAINT fk_like_usuario FOREIGN KEY (likeUsuarioID) REFERENCES usuario(usuarioID);
ALTER TABLE usuarioLikeComentario ADD CONSTRAINT fk_like_comentario FOREIGN KEY (likeComentarioID) REFERENCES comentario(comentarioID);

CREATE VIEW IF NOT EXISTS vw_jogosPopulares AS
SELECT 
	J.*
FROM jogo J
LEFT JOIN avaliacao A ON A.avaliacaoJogoID = J.jogoID
WHERE A.avaliacaoData >= DATE(NOW()) - INTERVAL 1 WEEK
GROUP BY J.jogoID
ORDER BY AVG(A.nota) DESC;


CREATE USER discing IDENTIFIED BY '532262';
GRANT ALL ON discing.* TO discing;