create DATABASE forma;
use forma;

CREATE TABLE unidade (
    id_un INT AUTO_INCREMENT PRIMARY KEY,
    unidade VARCHAR(10) NOT NULL
);
CREATE TABLE Quadrado (
    id_quad INT AUTO_INCREMENT PRIMARY KEY,
    id_un INT,
    lado INT NOT NULL,
    cor VARCHAR(250),
	fundo VARCHAR(250),
    FOREIGN KEY (id_un) REFERENCES unidade(id_un) ON DELETE CASCADE
);
COMMIT;

