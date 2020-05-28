-- CREATE --

-- Drop old schema

DROP TABLE IF EXISTS student CASCADE;
DROP TABLE IF EXISTS professor CASCADE;
DROP TABLE IF EXISTS curricular_unit CASCADE;
DROP TABLE IF EXISTS rating CASCADE;
DROP TABLE IF EXISTS friend CASCADE;
DROP TABLE IF EXISTS "group" CASCADE;
DROP TABLE IF EXISTS enrolled CASCADE;
DROP TABLE IF EXISTS moderator CASCADE;
DROP TABLE IF EXISTS banned CASCADE;
DROP TABLE IF EXISTS teaches CASCADE;
DROP TABLE IF EXISTS post CASCADE;
DROP TABLE IF EXISTS comment CASCADE;
DROP TABLE IF EXISTS comment_thread CASCADE;
DROP TABLE IF EXISTS message CASCADE;
DROP TABLE IF EXISTS group_message CASCADE;
DROP TABLE IF EXISTS group_message_receiver CASCADE;
DROP TABLE IF EXISTS notification CASCADE;
DROP TABLE IF EXISTS cu_request CASCADE;
DROP TABLE IF EXISTS cu_join_request CASCADE;

DROP TYPE IF EXISTS feed_type_enum;
DROP TYPE IF EXISTS notification_type_enum;
DROP TYPE IF EXISTS request_status_enum;

DROP FUNCTION IF EXISTS set_friends() CASCADE;
DROP FUNCTION IF EXISTS ban_student() CASCADE;
DROP FUNCTION IF EXISTS group_exists() CASCADE;
DROP FUNCTION IF EXISTS notify_cu_entry() CASCADE;


-- Type

CREATE TYPE feed_type_enum AS ENUM ('General', 'Doubts', 'Tutoring');
CREATE TYPE notification_type_enum AS ENUM ('FriendRequest', 'FriendRequestAccepted','NewPost', 'LikeOnPost', 'CommentOnPost', 'RequestAccessCU', 'RequestCU', 'AccessGrantedCU', 'NewMessage', 'NewRating', 'GroupInvite', 'ReplyInvite', 'Tag', 'UserBan', 'UserReport', 'UpdateProf', 'UpdateCU');
CREATE TYPE request_status_enum AS ENUM ('NotSeen', 'Seen', 'Accepted', 'Rejected');

-- Tables

CREATE TABLE student (
   id              SERIAL PRIMARY KEY,
   password        TEXT NOT NULL,
   student_number  TEXT NOT NULL CONSTRAINT student_number_uk UNIQUE,
   name            TEXT NOT NULL,
   bio             TEXT,
   email           TEXT NOT NULL CONSTRAINT student_email_uk UNIQUE,
   profile_image   TEXT,
   administrator   BOOLEAN DEFAULT false NOT NULL,

   CONSTRAINT email_ck CHECK (email !~ '^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+[.][a-za-z]+\$'::TEXT)
);

CREATE TABLE professor (
   id              SERIAL PRIMARY KEY,
   name            TEXT NOT NULL,
   email           TEXT NOT NULL CONSTRAINT professor_email_uk UNIQUE,
   picture_path    TEXT,
   abbrev          TEXT NOT NULL CONSTRAINT professor_abbrev_uk UNIQUE,

   CONSTRAINT email_ck CHECK (email !~ '^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+[.][a-za-z]+\$'::TEXT)
);

CREATE TABLE curricular_unit (
   id              SERIAL PRIMARY KEY,
   name            TEXT NOT NULL CONSTRAINT cu_name_uk UNIQUE,
   abbrev          TEXT NOT NULL CONSTRAINT cu_abbrev_uk UNIQUE,
   description     TEXT NOT NULL
);

CREATE TABLE rating (
   id               SERIAL PRIMARY KEY,
   reviewer_id      INTEGER REFERENCES student (id) ON UPDATE CASCADE ON DELETE CASCADE,
   has_voted        BOOLEAN NOT NULL DEFAULT FALSE,
   review           TEXT,
   student_id       INTEGER REFERENCES student (id) ON UPDATE CASCADE ON DELETE CASCADE,
   cu_id            INTEGER REFERENCES curricular_unit (id) ON UPDATE CASCADE ON DELETE CASCADE,
   professor_id     INTEGER REFERENCES professor (id) ON UPDATE CASCADE ON DELETE CASCADE,

   CONSTRAINT rated_ck CHECK (
       student_id IS NOT NULL AND cu_id IS NULL AND professor_id IS NULL
       OR
       student_id IS NULL AND cu_id IS NOT NULL AND professor_id IS NULL
       OR
       student_id IS NULL AND cu_id IS NULL AND professor_id IS NOT NULL
   )
);

CREATE TABLE friend (
   student1_id     INTEGER NOT NULL REFERENCES student (id) ON UPDATE CASCADE ON DELETE CASCADE,
   student2_id     INTEGER NOT NULL REFERENCES student (id) ON UPDATE CASCADE ON DELETE CASCADE,
   PRIMARY KEY (student1_id, student2_id)
);

CREATE TABLE "group" (
   group_id    SERIAL,
   student_id  INTEGER NOT NULL REFERENCES student (id) ON UPDATE CASCADE ON DELETE CASCADE,
   PRIMARY KEY (group_id, student_id)
);

CREATE TABLE enrolled (
   student_id   INTEGER NOT NULL REFERENCES student (id) ON UPDATE CASCADE ON DELETE CASCADE,
   cu_id        INTEGER NOT NULL REFERENCES curricular_unit (id) ON UPDATE CASCADE ON DELETE CASCADE,
   identifier   TEXT NOT NULL,
   PRIMARY KEY (student_id, cu_id)
);

CREATE TABLE moderator (
   student_id   INTEGER NOT NULL REFERENCES student (id) ON UPDATE CASCADE ON DELETE CASCADE,
   cu_id        INTEGER NOT NULL REFERENCES curricular_unit (id) ON UPDATE CASCADE ON DELETE CASCADE,
   PRIMARY KEY (student_id, cu_id)
);

CREATE TABLE banned (
   student_id       INTEGER NOT NULL REFERENCES student (id) ON UPDATE CASCADE ON DELETE CASCADE,               --banned student
   cu_id            INTEGER NOT NULL REFERENCES curricular_unit (id) ON UPDATE CASCADE ON DELETE CASCADE,
   mod_student_id   INTEGER NOT NULL REFERENCES student (id) ON UPDATE CASCADE ON DELETE CASCADE,     --mod who banned
   reason           TEXT NOT NULL,
   "date"           TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
   PRIMARY KEY (student_id, cu_id),

   CONSTRAINT dif_student CHECK(
       student_id <> mod_student_id
   )
);

CREATE TABLE teaches (
   professor_id     INTEGER NOT NULL REFERENCES professor (id) ON UPDATE CASCADE ON DELETE CASCADE,
   cu_id            INTEGER NOT NULL REFERENCES curricular_unit (id) ON UPDATE CASCADE ON DELETE CASCADE,
   PRIMARY KEY (professor_id, cu_id)
);

CREATE TABLE post (
   id           SERIAL PRIMARY KEY,
   author_id    INTEGER NOT NULL REFERENCES student (id) ON UPDATE CASCADE ON DELETE CASCADE,
   content      TEXT NOT NULL,
   "date"       TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
   cu_id        INTEGER REFERENCES curricular_unit (id) ON UPDATE CASCADE ON DELETE CASCADE,
   public_feed  BOOLEAN DEFAULT FALSE NOT NULL,
   feed_type    feed_type_enum,

   CONSTRAINT post_feed_ck CHECK (
       cu_id IS NOT NULL AND public_feed IS FALSE AND feed_type IS NOT NULL
       OR
       cu_id IS NULL AND public_feed IS TRUE
   )
);

CREATE TABLE comment (
   id           SERIAL PRIMARY KEY,
   content      TEXT NOT NULL,
   "date"       TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
   author_id    INTEGER NOT NULL REFERENCES student (id) ON UPDATE CASCADE ON DELETE CASCADE,
   post_id      INTEGER NOT NULL REFERENCES post (id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE comment_thread (
   comment_id  INTEGER NOT NULL REFERENCES comment (id) ON UPDATE CASCADE ON DELETE CASCADE,
   parent_id   INTEGER NOT NULL REFERENCES comment (id) ON UPDATE CASCADE ON DELETE CASCADE,
   PRIMARY KEY (comment_id, parent_id)
);

CREATE TABLE message (
   id           SERIAL PRIMARY KEY,
   sender_id    INTEGER NOT NULL REFERENCES student (id) ON UPDATE CASCADE ON DELETE CASCADE,
   receiver_id  INTEGER NOT NULL REFERENCES student (id) ON UPDATE CASCADE ON DELETE CASCADE,
   content      TEXT NOT NULL,
   "date"       TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL
);

CREATE TABLE group_message (
   id           SERIAL PRIMARY KEY,
   group_id     INTEGER NOT NULL,
   content      TEXT NOT NULL,
   "date"       TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
   sender_id    INTEGER NOT NULL REFERENCES student (id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE group_message_receiver (
   group_id     INTEGER NOT NULL,
   student_id   INTEGER NOT NULL REFERENCES student (id) ON UPDATE CASCADE ON DELETE CASCADE,
   group_name   TEXT NOT NULL,
   PRIMARY KEY (group_id, student_id)
);

CREATE TABLE notification (
   id                   SERIAL PRIMARY KEY,
   content              TEXT NOT NULL,
   "date"               TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
   student_id           INTEGER NOT NULL REFERENCES student (id) ON UPDATE CASCADE ON DELETE CASCADE,
   notification_type    notification_type_enum,
   seen                 BOOLEAN NOT NULL DEFAULT FALSE
);

CREATE TABLE cu_request(
   id                SERIAL PRIMARY KEY,
   cu_name              TEXT NOT NULL,
   abbrev            TEXT NOT NULL,
   link_to_cu_page   TEXT NOT NULL,
   additional_info   TEXT,
   request_status    request_status_enum DEFAULT 'NotSeen',
   student_id        INTEGER NOT NULL REFERENCES student (id) ON UPDATE CASCADE ON DELETE CASCADE
);

--Index--

CREATE INDEX sender_id_message ON message USING hash(sender_id);
CREATE INDEX receiver_id_message ON message USING hash(sender_id);
CREATE INDEX cu_id_post ON post USING hash(cu_id);
CREATE INDEX public_feed_post ON post USING hash(public_feed);
CREATE INDEX student_id_rating ON rating USING hash(student_id);
CREATE INDEX professor_id_rating ON rating USING hash(professor_id);
CREATE INDEX cu_id_rating ON rating USING hash(cu_id);
CREATE INDEX post_date_idx ON post USING btree(date);
CREATE INDEX comment_date_idx ON comment USING btree(date);
CREATE INDEX message_date_idx ON message USING btree(date);
CREATE INDEX group_message_date_idx ON group_message USING btree(date);
CREATE INDEX search_post_idx ON post USING GIST (to_tsvector('english', content));
CREATE INDEX search_cu_idx ON curricular_unit USING GIST (to_tsvector('portuguese', name || description));

--Triggers--

CREATE FUNCTION set_friends() RETURNS TRIGGER AS
$BODY$
BEGIN
   IF EXISTS (SELECT * FROM friend WHERE (NEW.student1_id = student1_id AND NEW.student2_id = student2_id) OR (NEW.student1_id = student2_id AND NEW.student2_id = student1_id))
       THEN RAISE EXCEPTION 'The pair of friends exist already.';
   END IF;
   RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER set_friends
   BEFORE INSERT ON friend
   FOR EACH ROW
   EXECUTE PROCEDURE set_friends();

CREATE FUNCTION ban_student() RETURNS TRIGGER AS
$BODY$
BEGIN
   IF NOT EXISTS (SELECT * FROM moderator WHERE NEW.mod_student_id = student_id AND NEW.cu_id = cu_id)
       THEN RAISE EXCEPTION 'Not a valid moderator.';
   END IF;
   RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER ban_student
   BEFORE INSERT ON banned
   FOR EACH ROW
   EXECUTE PROCEDURE ban_student();

CREATE FUNCTION group_exists() RETURNS TRIGGER AS
$BODY$
BEGIN
   IF NOT EXISTS (SELECT * FROM group_message_receiver WHERE NEW.group_id = group_id AND NEW.sender_id = student_id)
       THEN RAISE EXCEPTION 'Not a valid group/student.';
   END IF;
   RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER group_exists
   BEFORE INSERT ON group_message
   FOR EACH ROW
   EXECUTE PROCEDURE group_exists();

CREATE FUNCTION notify_cu_entry() RETURNS TRIGGER AS
$BODY$
BEGIN
   INSERT INTO notification (content, student_id, notification_type) VALUES (NEW.cu_id, NEW.student_id, 'AccessGrantedCU');
   RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER not_cu_entry
   AFTER INSERT ON enrolled
   FOR EACH ROW
   EXECUTE PROCEDURE notify_cu_entry();

-- POPULATE --

-- student --
INSERT INTO student (id, password, student_number, name, email, administrator) VALUES (DEFAULT, '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'up000000000', 'Simao Oliveira', 'simaosimaosimao@simao.pt', true);
INSERT INTO student (id, password, student_number, name, email, administrator) VALUES (DEFAULT, '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'up111111111', 'Carlos Nova', 'carloscarloscarlos@carlos.pt', true);
INSERT INTO student (id, password, student_number, name, email, administrator) VALUES (DEFAULT, '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'up222222222', 'Sofia Lajes', 'sofiasofiasofia@sofia.pt', true);
INSERT INTO student (id, password, student_number, name, email, administrator) VALUES (DEFAULT, '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'up333333333', 'Pedro Pereira', 'pedropedropedro@pedro.pt', true);
INSERT INTO student (id, password, student_number, name, email, administrator) VALUES (DEFAULT, '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'up444444444', 'Fernando Pessoa', 'fernandofernandofernando@fernando.pt', false);
INSERT INTO student (id, password, student_number, name, email, administrator) VALUES (DEFAULT, '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'up555555555', 'Alvaro Campos', 'alvaroalvaroalvaro@alvaro.pt', false);
INSERT INTO student (id, password, student_number, name, email, administrator) VALUES (DEFAULT, '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'up666666666', 'Ricardo Reis', 'ricardoricardoricardo@ricardo.pt', false);
INSERT INTO student (id, password, student_number, name, email, administrator) VALUES (DEFAULT, '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'up777777777', 'Alberto Caerio', 'albertoalbertoalberto@alberto.pt', false);
INSERT INTO student (id, password, student_number, name, email, administrator) VALUES (DEFAULT, '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'up888888888', 'Bernardo Soares', 'bernardobernardobernardo@bernardo.pt', false);
INSERT INTO student (id, password, student_number, name, email, administrator) VALUES (DEFAULT, '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'up999999999', 'Eca Queiroz', 'eca@eca.pt', false);
INSERT INTO student (id, password, student_number, name, email, administrator) VALUES (DEFAULT, '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'up12346578', 'Wilson Edmundo Edgar Diogo', 'wilsonwilsonwilson@wilson.br', false);

--professor--
INSERT INTO professor (id, name, email, abbrev) VALUES (DEFAULT, 'Sergio Sobral Nunes', 'segiosergio@sergio.pt','SSN');
INSERT INTO professor (id, name, email, abbrev) VALUES (DEFAULT, 'Joao Antonio Correia Lopes', 'joaojoao@joao.pt', 'JCL');
INSERT INTO professor (id, name, email, abbrev) VALUES (DEFAULT, 'Fernando Jose Cassola Marques', 'fernandofernadno@fernando.pt', 'FJCM');
INSERT INTO professor (id, name, email, abbrev) VALUES (DEFAULT, 'Tiago Boldt Pereira de Sousa', 'tiagotiago@tiago.pt', 'TBS');
INSERT INTO professor (id, name, email, abbrev) VALUES (DEFAULT, 'Carla Alexandra Teixeira Lopes', 'carlacarla@carla.pt', 'CTL');
INSERT INTO professor (id, name, email, abbrev) VALUES (DEFAULT, 'Andre Monteiro de Oliveira Restivo', 'andreandre@andre.pt', 'AOR');
INSERT INTO professor (id, name, email, abbrev) VALUES (DEFAULT, 'Antonio Augusto de Sousa', 'antonioantonio@antonio.pt', 'AAS');
INSERT INTO professor (id, name, email, abbrev) VALUES (DEFAULT, 'Luis Paulo Goncalves dos Reis', 'luisluis@luis.pt', 'LPR');
INSERT INTO professor (id, name, email, abbrev) VALUES (DEFAULT, 'Jorge Alves da Silva', 'jorgejorge@jorge.pt', 'JAS');
INSERT INTO professor (id, name, email, abbrev) VALUES (DEFAULT, 'Pedro Miguel Moreira da Silva', 'pedropedro@pedro.pt', 'PMMS');

--curricular_unit--
INSERT INTO curricular_unit (id, name, abbrev, description) VALUES (DEFAULT, 'Laboratorio de Bases de Dados e Aplicacoes Web', 'LBAW', 'A unidade curricular de LBAW tem como objetivo sedimentar as matérias expostas nas unidades curriculares de bases de dados e linguagens e tecnologias web. Esta unidade curricular oferece uma perspetiva prática sobre duas áreas centrais da engenharia informática. Nesta unidade curricular pretende-se dotar os estudantes da capacidade de projetar e desenvolver sistemas de informação acessíveis através da web e suportados por sistemas de gestão de bases de dados.');
INSERT INTO curricular_unit (id, name, abbrev, description) VALUES (DEFAULT, 'Bases de Dados', 'BDAD', 'Este é um curso introdutório sobre bases de dados. Aborda o paradigma relacional. Abrange o desenho (modelo UML), construção (linguagem de definição de dados SQL), consulta (linguagem de manipulação de dados SQL) e gestão (optimização, controlo de acesso e políticas de concorrência) de bases de dados relacionais. Introduz, ainda, o conceito de bases de dados multi-dimensionais, bases de dados NoSQL e modelos de dados semi-estruturados.');
INSERT INTO curricular_unit (id, name, abbrev, description) VALUES (DEFAULT, 'Sistemas Operativos', 'SOPE', 'A estrutura e o funcionamento de um sistema operativo;');

--rating--
INSERT INTO rating (id, reviewer_id, has_voted, student_id) VALUES (DEFAULT, 1, TRUE, 5);
INSERT INTO rating (id, reviewer_id, has_voted, student_id) VALUES (DEFAULT, 1, TRUE, 6);
INSERT INTO rating (id, reviewer_id, has_voted, student_id) VALUES (DEFAULT, 6, FALSE, 7);
INSERT INTO rating (id, reviewer_id, has_voted, student_id) VALUES (DEFAULT, 5, FALSE, 10);
INSERT INTO rating (id, reviewer_id, has_voted, student_id) VALUES (DEFAULT, 10, TRUE, 1);

INSERT INTO rating (id, reviewer_id, has_voted, cu_id) VALUES (DEFAULT, 2, TRUE, 2);
INSERT INTO rating (id, reviewer_id, has_voted, cu_id) VALUES (DEFAULT, 2, TRUE, 1);
INSERT INTO rating (id, reviewer_id, has_voted, cu_id) VALUES (DEFAULT, 4, TRUE, 2);
INSERT INTO rating (id, reviewer_id, has_voted, cu_id) VALUES (DEFAULT, 6, FALSE, 3);
INSERT INTO rating (id, reviewer_id, has_voted, cu_id) VALUES (DEFAULT, 1, FALSE, 2);
INSERT INTO rating (id, reviewer_id, has_voted, cu_id) VALUES (DEFAULT, 3, TRUE, 2);

INSERT INTO rating (id, reviewer_id, has_voted, professor_id) VALUES (DEFAULT, 5, FALSE, 1);
INSERT INTO rating (id, reviewer_id, has_voted, professor_id) VALUES (DEFAULT, 6, TRUE, 2);
INSERT INTO rating (id, reviewer_id, has_voted, professor_id) VALUES (DEFAULT, 7, FALSE, 3);
INSERT INTO rating (id, reviewer_id, has_voted, professor_id) VALUES (DEFAULT, 8, TRUE, 4);
INSERT INTO rating (id, reviewer_id, has_voted, professor_id) VALUES (DEFAULT, 9, FALSE, 5);

--friend--
INSERT INTO friend (student1_id, student2_id) VALUES (1, 2);
INSERT INTO friend (student1_id, student2_id) VALUES (2, 3);
INSERT INTO friend (student1_id, student2_id) VALUES (4, 5);
INSERT INTO friend (student1_id, student2_id) VALUES (1, 5);
INSERT INTO friend (student1_id, student2_id) VALUES (1, 6);
INSERT INTO friend (student1_id, student2_id) VALUES (5, 6);
INSERT INTO friend (student1_id, student2_id) VALUES (6, 7);
INSERT INTO friend (student1_id, student2_id) VALUES (7, 8);

--"group"-- Serial aqui não sei se faz sentido, porque o grupo id é o mesmo, para os varios estudantes
INSERT INTO "group" (group_id, student_id) VALUES (DEFAULT, 1);
INSERT INTO "group" (group_id, student_id) VALUES (DEFAULT, 1);
INSERT INTO "group" (group_id, student_id) VALUES (DEFAULT, 2);
INSERT INTO "group" (group_id, student_id) VALUES (DEFAULT, 3);
INSERT INTO "group" (group_id, student_id) VALUES (DEFAULT, 1);
INSERT INTO "group" (group_id, student_id) VALUES (DEFAULT, 4);

--enrolled--
INSERT INTO enrolled (student_id, cu_id, identifier) VALUES (1, 1, 'LBAW01');
INSERT INTO enrolled (student_id, cu_id, identifier) VALUES (2, 1, 'LBAW01');
INSERT INTO enrolled (student_id, cu_id, identifier) VALUES (3, 1, 'LBAW01');
INSERT INTO enrolled (student_id, cu_id, identifier) VALUES (4, 1, 'LBAW01');
INSERT INTO enrolled (student_id, cu_id, identifier) VALUES (4, 2, 'BDAD02');
INSERT INTO enrolled (student_id, cu_id, identifier) VALUES (5, 1, 'LBAW01');
INSERT INTO enrolled (student_id, cu_id, identifier) VALUES (6, 3, 'SOPE03');
INSERT INTO enrolled (student_id, cu_id, identifier) VALUES (7, 3, 'SOPE03');
INSERT INTO enrolled (student_id, cu_id, identifier) VALUES (8, 3, 'SOPE03');
INSERT INTO enrolled (student_id, cu_id, identifier) VALUES (9, 3, 'SOPE03');
INSERT INTO enrolled (student_id, cu_id, identifier) VALUES (10, 3, 'SOPE03');
INSERT INTO enrolled (student_id, cu_id, identifier) VALUES (11, 3, 'SOPE02');

--moderator--
INSERT INTO moderator (student_id, cu_id) VALUES (5, 3);
INSERT INTO moderator (student_id, cu_id) VALUES (6, 2);

--banned--
INSERT INTO banned (student_id, cu_id, mod_student_id, reason) VALUES (11, 3, 5, 'Continuo postagem de postes desnecessarios e no meio do caminho de postes uteis');

--teaches--
INSERT INTO teaches (professor_id, cu_id) VALUES (1, 1);
INSERT INTO teaches (professor_id, cu_id) VALUES (2, 1);
INSERT INTO teaches (professor_id, cu_id) VALUES (3, 1);
INSERT INTO teaches (professor_id, cu_id) VALUES (4, 1);
INSERT INTO teaches (professor_id, cu_id) VALUES (5, 2);
INSERT INTO teaches (professor_id, cu_id) VALUES (9, 3);
INSERT INTO teaches (professor_id, cu_id) VALUES (10, 3);

--post--
INSERT INTO post (id, author_id, content, cu_id, feed_type) VALUES (DEFAULT, 6, 'No artefacto 6 como e suposto povoar a base de dados??', 1, 'Doubts');
INSERT INTO post (id, author_id, content, cu_id, feed_type) VALUES (DEFAULT, 5, 'Vai haver aula hoje?', 1, 'General');
INSERT INTO post (id, author_id, content, cu_id, feed_type) VALUES (DEFAULT, 10, 'Estou com um problema na base de dados. Alguem me pode ajudar?? BDAD e muito complicado para o meu pequeno cerebro, nao tenho um QI superiro a 200. Preciso mesmo de ajuda se nao ja reprovei', 2, 'Tutoring');
INSERT INTO post (id, author_id, content, cu_id, feed_type) VALUES (DEFAULT, 8, 'Nao vai haver aulas hoje nos queijos, estao a limpar o cheirete a bolor, get it porque sao queijos??', 2, 'General');
INSERT INTO post (id, author_id, content, cu_id, feed_type) VALUES (DEFAULT, 7, 'Se pesquisarem no youtube por sopa tem muitos tutoriais de como fazer esta cadeira', 3, 'General');
INSERT INTO post (id, author_id, content, cu_id, feed_type) VALUES (DEFAULT, 9, 'Por causa do covid 33 estamos a usar uma plataforma de aulas virtual, cada pessoa deve usar os seus oculos vr para assistir a aula', 1, 'General');

INSERT INTO post (id, author_id, content, public_feed) VALUES (DEFAULT, 5, 'Nao se esquecam de preencher os inqueritos pedagogicos, e nao digam so mal de plog', TRUE);
INSERT INTO post (id, author_id, content, public_feed) VALUES (DEFAULT, 1, 'Grande evento que vai acontecer em abril, dia 20 nao percas!!!', TRUE);

--comment--
INSERT INTO comment (id, content, author_id, post_id) VALUES (DEFAULT, 'Nao tambem queria saber', 7, 1);
INSERT INTO comment (id, content, author_id, post_id) VALUES (DEFAULT, 'Sim as aulas estao a corer na normalidad, que raio de pergunta', 9, 4);
INSERT INTO comment (id, content, author_id, post_id) VALUES (DEFAULT, 'Vai haver comida e bebida para todos e so aparecer', 1, 8);
INSERT INTO comment (id, content, author_id, post_id) VALUES (DEFAULT, 'Ja preenchi', 3, 5);
INSERT INTO comment (id, content, author_id, post_id) VALUES (DEFAULT, 'Posso te ajudar com bdad', 5, 3);
INSERT INTO comment (id, content, author_id, post_id) VALUES (DEFAULT, 'Obrigado, quando podes ajudar me?', 10, 3);
INSERT INTO comment (id, content, author_id, post_id) VALUES (DEFAULT, 'Amanha as 20:40 podes? Eu mando te invite para o discord', 5, 3);
INSERT INTO comment (id, content, author_id, post_id) VALUES (DEFAULT, 'Comida?? Conta comigo', 9, 8);
INSERT INTO comment (id, content, author_id, post_id) VALUES (DEFAULT, 'Só porque disseste eu vou :)', 3, 8);
INSERT INTO comment (id, content, author_id, post_id) VALUES (DEFAULT, 'Por isso e que falei', 1, 8);

--comment_thread--
INSERT INTO comment_thread (comment_id, parent_id) VALUES (6, 5);
INSERT INTO comment_thread (comment_id, parent_id) VALUES (7, 5);
INSERT INTO comment_thread (comment_id, parent_id) VALUES (8, 3);
INSERT INTO comment_thread (comment_id, parent_id) VALUES (10, 9);

--message--
INSERT INTO message (id, sender_id, receiver_id, content) VALUES (DEFAULT, 6, 7, 'Tenho uma irritacao nas costas o que pode ser?');
INSERT INTO message (id, sender_id, receiver_id, content) VALUES (DEFAULT, 7, 6, 'Deixei de ser medico. Estava demasiado perto das pessoas tenho que me desenlacar de tudo');
INSERT INTO message (id, sender_id, receiver_id, content) VALUES (DEFAULT, 7, 8, 'Como estao as ovelha?');
INSERT INTO message (id, sender_id, receiver_id, content) VALUES (DEFAULT, 8, 1, 'So para dizer que hoje esta um belo dia');
INSERT INTO message (id, sender_id, receiver_id, content) VALUES (DEFAULT, 4, 5, 'Ja fizeste o que faltava??');

INSERT INTO notification (id, content, student_id, notification_type) VALUES (DEFAULT, 'AAAABBBB', 4, 'Tag');

INSERT INTO cu_request (id, cu_name, abbrev, link_to_cu_page, additional_info, request_status, student_id) VALUES (DEFAULT, 'Engenharia de Software', 'ESOF', 'https://sigarra.up.pt/feup/pt/ucurr_geral.ficha_uc_view?pv_ocorrencia_id=436443', 'Familiarizar-se com os metodos de engenharia e gestao necessarios ao desenvolvimento de sistemas de software complexos e/ou em larga escala, de forma economicamente eficaz e com elevada qualidade.', 'NotSeen', 1);
INSERT INTO cu_request (id, cu_name, abbrev, link_to_cu_page, additional_info, request_status, student_id) VALUES (DEFAULT, 'Programacao em Logica', 'PLOG', 'https://sigarra.up.pt/feup/pt/ucurr_geral.ficha_uc_view?pv_ocorrencia_id=436444', 'O paradigma da Programação em Logica apresenta uma abordagem declarativa e baseada em processos formais de raciocinio a programação, mais apropriada para a resolucao de alguns tipos de problemas. A programaçao em logica com restricoes permite abordar problemas de satisfacao de restricoes e de optimizacao, modelando-os de uma forma directa e elegante.', 'NotSeen', 2);
INSERT INTO cu_request (id, cu_name, abbrev, link_to_cu_page, additional_info, request_status, student_id) VALUES (DEFAULT, 'Fisica II', 'ESOF', 'https://sigarra.up.pt/feup/pt/ucurr_geral.ficha_uc_view?pv_ocorrencia_id=419992', 'Esta unidade curricular visa dotar os estudantes com conhecimentos basicos de eletromagnetismo e processamento de sinais. A abordagem e experimental, com recurso a experiencias simples que os estudantes podem realizar durante as aulas teorico-praticas para consolidar os conhecimentos teoricos e adquirir experiencia no uso dos instrumentos de medicao. O Sistema de Computacao Algrbrica (CAS) usado na unidade curricular Fisica 1 e tambem aproveitado para facilitar a resolucao de problemas e para visualizar campos eletricos e magneticos.', 'NotSeen', 3);
INSERT INTO cu_request (id, cu_name, abbrev, link_to_cu_page, additional_info, request_status, student_id) VALUES (DEFAULT, 'Microprocessadores e Computadores Pessoais', 'MPCP', 'https://sigarra.up.pt/feup/pt/ucurr_geral.ficha_uc_view?pv_ocorrencia_id=399884', 'Os computadores pessoais (PC), tanto computadores de mesa como portateis, constituem uma ferramenta ubiqua nas sociedades modernas. A sua arquitetura reflete o avanço tecnologico atual, mas tambem estabelece os limites das suas capacidades e desempenho. O conjunto de instrucoes IA-32 esta no centro de todos os computadores pessoais atualmente em uso. Tanto a arquitetura como o conjunto de instrucoes tem um impacto profundo na pratica diaria dos engenheiros informaticos.', 'NotSeen', 4);

--group_message_receiver--
-- INSERT INTO group_message_receiver (group_id, student_id, group_name) VALUES (0, 0, 'LBAW');
-- INSERT INTO group_message_receiver (group_id, student_id, group_name) VALUES (0, 1, 'LBAW');
-- INSERT INTO group_message_receiver (group_id, student_id, group_name) VALUES (0, 2, 'LBAW');
-- INSERT INTO group_message_receiver (group_id, student_id, group_name) VALUES (0, 3, 'LBAW');
-- INSERT INTO group_message_receiver (group_id, student_id, group_name) VALUES (1, 0, 'MeMeS');
-- INSERT INTO group_message_receiver (group_id, student_id, group_name) VALUES (1, 1, 'MeMeS');
-- INSERT INTO group_message_receiver (group_id, student_id, group_name) VALUES (1, 2, 'MeMeS');
-- INSERT INTO group_message_receiver (group_id, student_id, group_name) VALUES (1, 3, 'MeMeS');
-- INSERT INTO group_message_receiver (group_id, student_id, group_name) VALUES (1, 4, 'MeMeS');
-- INSERT INTO group_message_receiver (group_id, student_id, group_name) VALUES (1, 5, 'MeMeS');
-- INSERT INTO group_message_receiver (group_id, student_id, group_name) VALUES (1, 6, 'MeMeS');
-- INSERT INTO group_message_receiver (group_id, student_id, group_name) VALUES (1, 9, 'MeMeS');

--group_message--
-- INSERT INTO group_message (id, group_id, content, sender_id) VALUES (0, 0, 'Ja acabei de povoar a base de dados que acham?? Meti alguns easter eggs? Quanto nao sei...', 0);
-- INSERT INTO group_message (id, group_id, content, sender_id) VALUES (1, 0, 'Ja acabei os triggers. Que triggered que fiquei', 3);
-- INSERT INTO group_message (id, group_id, content, sender_id) VALUES (2, 1, 'A minha amiga asiatica ficou doente. Mas eu Coreia.', 6);
-- INSERT INTO group_message (id, group_id, content, sender_id) VALUES (3, 1, 'Por causa do coronavirus ja nao e permitido fazer festas com 20 ou mais pesoas. Por isso agora so COVID 19', 9);
-- INSERT INTO group_message (id, group_id, content, sender_id) VALUES (4, 1, 'Ao gajo que inventou o zero: Obrigado por nada!', 5);
