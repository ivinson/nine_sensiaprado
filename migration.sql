ALTER TABLE convidados
ADD COLUMN nome_credencial text,
ADD COLUMN primeiro_nome_passaporte text,
ADD COLUMN ultimo_nome_passaporte text,
ADD COLUMN numero_passaporte text,
ADD COLUMN identidade_de_genero text,
ADD COLUMN orientacao_sexual text,
ADD COLUMN numero_de_colaboradores INT,
ADD COLUMN eh_pacto char(3),
ADD COLUMN origem_convite text;
