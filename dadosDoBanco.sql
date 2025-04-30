CREATE TABLE usuario (
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

CREATE TABLE jogo (
    jogoID INT AUTO_INCREMENT PRIMARY KEY,
    jogoNome VARCHAR(255) NOT NULL UNIQUE,
    sinopse VARCHAR(2500) NOT NULL,
    jogoRequisitosJogoID INT,
    classificacao ENUM('livre', '10', '12', '14', '16', '18') NOT NULL,
    playstation TINYINT(1) DEFAULT 0,
    xbox TINYINT(1) DEFAULT 0,
    nintendoSwitch TINYINT(1) DEFAULT 0,
    windowsOS TINYINT(1) DEFAULT 0,
    macOS TINYINT(1) DEFAULT 0,
    linuxOS TINYINT(1) DEFAULT 0,
    androidOS TINYINT(1) DEFAULT 0);
    
CREATE TABLE requisitosJogo (
    requisitosJogoID INT AUTO_INCREMENT PRIMARY KEY,
    so VARCHAR(50) NOT NULL,
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
('Windows 10 64-bit', 'Intel i5-4670k or AMD Ryzen 3 1200', 'NVIDIA GTX 1060 (6GB) or AMD RX 5500 XT (8GB) or Intel Arc A750', '8 GB de RAM', '190 GB de espaço disponível');

INSERT INTO jogo (jogoNome, jogoRequisitosJogoID, sinopse, classificacao, playstation, xbox, nintendoSwitch, windowsOS, macOS, linuxOS, androidOS)
VALUES ('Black Myth Wukong', 1, '"Um mundo desconhecido onde maravilhas reluzem
e a cada passo novos cenários surgem."

Entre em um reino fascinante repleto de maravilhas e descobertas da antiga mitologia chinesa!
No papel principal de Predestinado, você verá cenários de tirar o fôlego do romance clássico "Jornada para o Oeste" e criará um novo conto épico enquanto se aventura.', '14', 1, 1, 0, 1, 0, 0, 0),
('Counter Strike 2', 2, 'Há mais de duas décadas, o Counter-Strike oferece uma experiência competitiva de elite moldada por milhões de jogadores mundialmente. Agora, o próximo capítulo da história do CS vai começar. Isso é Counter-Strike 2.

Uma atualização gratuita para o CS:GO, o Counter-Strike 2 é o maior salto tecnológico na história da série. Feito na engine Source 2, o Counter-Strike 2 foi modernizado com renderização realística baseada na física, mecanismos de conexão de ponta e ferramentas da Oficina aprimoradas.', '16', 0, 0, 0, 1, 0, 1, 0),
('Zenless Zone Zero', 3, 'Zenless Zone Zero é o novo RPG de ação e fantasia urbana da HoYoverse. Nele, a civilização contemporânea foi destruída por uma calamidade conhecida como Esferas Negras. Elas aparecem do nada, criando anomalias espaciais carregadas de formidáveis monstros conhecidos como Etéreos..', '12', 1, 0, 0, 1, 0, 0, 1),
('Tekken 8', 4, 'O jogo apresenta um elenco rico de mais de 32 personagens com modelos de alta resolução meticulosamente detalhados que levam o hardware moderno até o limite. Experimente batalhas empolgantes com novos recursos de batalha, como o Heat, ou se vire em situações complicadas com golpes supremos poderosos chamados Rage Arts. Com o novo sistema de controle, o Estilo Especial, é possível realizar combos poderosos com apenas um simples botão, tornando o jogo ainda mais acessível para os novatos.', '12', 1, 1, 0, 1, 0, 0, 0),
('God of War Ragnarök', 5, 'Do Santa Monica Studio, esta é a sequência da aclamada versão de 2018 de God of War. O Fimbulwinter já começou. Kratos e Atreus devem viajar pelos Nove Reinos em busca de respostas enquanto as forças asgardianas se preparam para uma batalha profetizada que causará o fim do mundo. Nessa jornada, eles explorarão paisagens míticas impressionantes e enfrentarão inimigos aterradores: deuses nórdicos e monstros. A ameaça do Ragnarök se aproxima. Kratos e Atreus terão de escolher entre a segurança deles próprios e a dos reinos.', '18', 1, 0, 0, 1, 0, 0, 0);

CREATE TABLE avaliacao (
    avaliacaoUsuarioID INT NOT NULL,
    avaliacaoJogoID INT NOT NULL,
    nota INT NOT NULL,
    avaliacaoData TIMESTAMP DEFAULT CURRENT_TIMESTAMP);

ALTER TABLE avaliacao ADD CONSTRAINT chaveCompostaAvaliacao PRIMARY KEY (avaliacaoUsuarioID, avaliacaoJogoID);

ALTER TABLE avaliacao ADD CONSTRAINT fkAvaliacaoUsuario FOREIGN KEY (avaliacaoUsuarioID) REFERENCES usuario(usuarioID);

ALTER TABLE avaliacao ADD CONSTRAINT fkAvaliacaoJogo FOREIGN KEY (avaliacaoJogoID) REFERENCES jogo(jogoID);

INSERT INTO avaliacao (avaliacaoJogoID, avaliacaoUsuarioID, nota) VALUES (5, 1, 10), (5, 2, 7), (5, 3, 9), (5, 4, 8), (5, 5, 5), (5, 6, 9);

CREATE TABLE listaJogado (
    listaJogadoUsuarioID INT NOT NULL,
    listaJogadoJogoID INT NOT NULL,
    jogado TINYINT(1));
    
ALTER TABLE listaJogado ADD CONSTRAINT pk_listaJogado PRIMARY KEY (listaJogadoUsuarioID, listaJogadoJogoID);
ALTER TABLE listaJogado ADD CONSTRAINT fk_usuariolistaJogado FOREIGN KEY (listaJogadoUsuarioID) REFERENCES usuario(usuarioID);
ALTER TABLE listaJogado ADD CONSTRAINT fk_jogolistaJogado FOREIGN KEY (listaJogadoJogoID) REFERENCES jogo(jogoID);

CREATE TABLE comentario (
	comentarioID INT AUTO_INCREMENT PRIMARY KEY,
    conteudo VARCHAR(600) NOT NULL,
    likes INT DEFAULT 0,
    spoiler TINYINT(1) NOT NULL,
    comentarioData TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    editado TINYINT(1) DEFAULT 0,
    responde INT,
   	comentarioUsuarioID INT NOT NULL,
    comentarioJogoID INT NOT NULL
);

ALTER TABLE comentario ADD CONSTRAINT FK_comentarioUsuario FOREIGN KEY (comentarioUsuarioID) REFERENCES usuario(usuarioID);

CREATE VIEW vw_jogosPopulares AS
SELECT 
	J.*
FROM jogo J
LEFT JOIN avaliacao A ON A.avaliacaoJogoID = J.jogoID
WHERE A.avaliacaoData >= DATE(NOW()) - INTERVAL 1 WEEK
GROUP BY J.jogoID
ORDER BY AVG(A.nota) DESC;