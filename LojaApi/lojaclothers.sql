CREATE DATABASE lojaclothers;

USE lojaclothers;

CREATE TABLE roupa(
id INT(10) NOT NULL,
nome VARCHAR(20) NOT NULL,
marca VARCHAR(20) NOT NULL,
tipo VARCHAR(20) NOT NULL,
avaliacao INT(10) NOT NULL
);

INSERT INTO roupa(id, nome, marca, tipo, avaliacao) VALUES
(1, 'Camiseta COMPTOM', 'COMPTON', 'camiseta', 5),
(2, 'Moletom OSLO militar', 'OSLO', 'Blusa Moletom', 4);

ALTER TABLE roupa
  ADD PRIMARY KEY (id);

ALTER TABLE roupa
  MODIFY id INT(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT = 3;

