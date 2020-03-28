-- student --
INSERT INTO student (id, password, student_number, name, email, administrator) VALUES (0, '1234', 'up000000000', 'Simao Oliveira', 'simaosimaosimao@simao.pt', true);
INSERT INTO student (id, password, student_number, name, email, administrator) VALUES (1, '1234', 'up111111111', 'Carlos Nova', 'carloscarloscarlos@carlos.pt', true);
INSERT INTO student (id, password, student_number, name, email, administrator) VALUES (2, '1234', 'up222222222', 'Sofia Lajes', 'sofiasofiasofia@sofia.pt', true);
INSERT INTO student (id, password, student_number, name, email, administrator) VALUES (3, '1234', 'up333333333', 'Pedro Pereira', 'pedropedropedro@pedro.pt', true);
INSERT INTO student (id, password, student_number, name, email, administrator) VALUES (4, '1234', 'up444444444', 'Fernando Pessoa', 'fernandofernandofernando@sfernando.pt', false);
INSERT INTO student (id, password, student_number, name, email, administrator) VALUES (5, '1234', 'up555555555', 'Alvaro Campos', 'alvaroalvaroalvaro@alvaro.pt', false);
INSERT INTO student (id, password, student_number, name, email, administrator) VALUES (6, '1234', 'up666666666', 'Ricardo Reis', 'ricardoricardoricardo@ricardo.pt', false);
INSERT INTO student (id, password, student_number, name, email, administrator) VALUES (7, '1234', 'up777777777', 'Alberto Caerio', 'albertoalbertoalberto@alberto.pt', false);
INSERT INTO student (id, password, student_number, name, email, administrator) VALUES (8, '1234', 'up888888888', 'Bernardo Soares', 'bernardobernardobernardo@bernardo.pt', false);
INSERT INTO student (id, password, student_number, name, email, administrator) VALUES (9, '1234', 'up999999999', 'Eca Queiroz', 'eca@eca.pt', false);
INSERT INTO student (id, password, student_number, name, email, administrator) VALUES (10, '1234', 'up12346578', 'Wilson Edmundo Edgar Diogo', 'wilsonwilsonwilson@wilson.br', false);

--professor--
INSERT INTO professor (id, name, email, abbrev) VALUES (0, 'Sergio Sobral Nunes', 'segiosergio@sergio.pt','SSN');
INSERT INTO professor (id, name, email, abbrev) VALUES (1, 'Joao Antonio Correia Lopes', 'joaojoao@joao.pt', 'JCL');
INSERT INTO professor (id, name, email, abbrev) VALUES (2, 'Fernando Jose Cassola Marques', 'fernandofernadno@fernando.pt', 'FJCM');
INSERT INTO professor (id, name, email, abbrev) VALUES (3, 'Tiago Boldt Pereira de Sousa', 'tiagotiago@tiago.pt', 'TBS');
INSERT INTO professor (id, name, email, abbrev) VALUES (4, 'Carla Alexandra Teixeira Lopes', 'carlacarla@carla.pt', 'CTL');
INSERT INTO professor (id, name, email, abbrev) VALUES (5, 'Andre Monteiro de Oliveira Restivo', 'andreandre@andre.pt', 'AOR');
INSERT INTO professor (id, name, email, abbrev) VALUES (6, 'Antonio Augusto de Sousa', 'antonioantonio@antonio.pt', 'AAS');
INSERT INTO professor (id, name, email, abbrev) VALUES (7, 'Luis Paulo Goncalves dos Reis', 'luisluis@luis.pt', 'LPR');
INSERT INTO professor (id, name, email, abbrev) VALUES (8, 'Jorge Alves da Silva', 'jorgejorge@jorge.pt', 'JAS');
INSERT INTO professor (id, name, email, abbrev) VALUES (9, 'Pedro Miguel Moreira da Silva', 'pedropedro@pedro.pt', 'PMMS');

--curricular_unit--
INSERT INTO curricular_unit (id, name, abbrev, description) VALUES (0, 'Laboratorio de Bases de Dados e Aplicacoes Web', 'LBAW', 'A unidade curricular de LBAW tem como objetivo sedimentar as matérias expostas nas unidades curriculares de bases de dados e linguagens e tecnologias web. Esta unidade curricular oferece uma perspetiva prática sobre duas áreas centrais da engenharia informática. Nesta unidade curricular pretende-se dotar os estudantes da capacidade de projetar e desenvolver sistemas de informação acessíveis através da web e suportados por sistemas de gestão de bases de dados.');
INSERT INTO curricular_unit (id, name, abbrev, description) VALUES (1, 'Bases de Dados', 'BDAD', 'Este é um curso introdutório sobre bases de dados. Aborda o paradigma relacional. Abrange o desenho (modelo UML), construção (linguagem de definição de dados SQL), consulta (linguagem de manipulação de dados SQL) e gestão (optimização, controlo de acesso e políticas de concorrência) de bases de dados relacionais. Introduz, ainda, o conceito de bases de dados multi-dimensionais, bases de dados NoSQL e modelos de dados semi-estruturados.');
INSERT INTO curricular_unit (id, name, abbrev, description) VALUES (2, 'Sistemas Operativos', 'SOPE', 'A estrutura e o funcionamento de um sistema operativo;');

--rating--
INSERT INTO rating (id, reviewer_id, has_voted, student_id) VALUES (0, 0, TRUE, 4);
INSERT INTO rating (id, reviewer_id, has_voted, student_id) VALUES (1, 0, TRUE, 5);
INSERT INTO rating (id, reviewer_id, has_voted, student_id) VALUES (2, 5, FALSE, 6);
INSERT INTO rating (id, reviewer_id, has_voted, student_id) VALUES (3, 4, FALSE, 9);
INSERT INTO rating (id, reviewer_id, has_voted, student_id) VALUES (4, 9, TRUE, 0);

INSERT INTO rating (id, reviewer_id, has_voted, cu_id) VALUES (5, 1, TRUE, 1);
INSERT INTO rating (id, reviewer_id, has_voted, cu_id) VALUES (6, 1, TRUE, 0);
INSERT INTO rating (id, reviewer_id, has_voted, cu_id) VALUES (7, 3, TRUE, 1);
INSERT INTO rating (id, reviewer_id, has_voted, cu_id) VALUES (8, 5, FALSE, 2);
INSERT INTO rating (id, reviewer_id, has_voted, cu_id) VALUES (9, 0, FALSE, 1);
INSERT INTO rating (id, reviewer_id, has_voted, cu_id) VALUES (10, 2, TRUE, 1);

INSERT INTO rating (id, reviewer_id, has_voted, professor_id) VALUES (11, 4, FALSE, 0);
INSERT INTO rating (id, reviewer_id, has_voted, professor_id) VALUES (12, 5, TRUE, 1);
INSERT INTO rating (id, reviewer_id, has_voted, professor_id) VALUES (13, 6, FALSE, 2);
INSERT INTO rating (id, reviewer_id, has_voted, professor_id) VALUES (14, 7, TRUE, 3);
INSERT INTO rating (id, reviewer_id, has_voted, professor_id) VALUES (15, 8, FALSE, 4);

--friend--
INSERT INTO friend (student1_id, student2_id) VALUES (0, 1);
INSERT INTO friend (student1_id, student2_id) VALUES (1, 2);
INSERT INTO friend (student1_id, student2_id) VALUES (3, 4);
INSERT INTO friend (student1_id, student2_id) VALUES (0, 4);
INSERT INTO friend (student1_id, student2_id) VALUES (0, 5);
INSERT INTO friend (student1_id, student2_id) VALUES (4, 5);
INSERT INTO friend (student1_id, student2_id) VALUES (5, 6);
INSERT INTO friend (student1_id, student2_id) VALUES (6, 7);

--"group"--
INSERT INTO "group" (group_id, student_id) VALUES (0, 0);
INSERT INTO "group" (group_id, student_id) VALUES (0, 1);
INSERT INTO "group" (group_id, student_id) VALUES (0, 2);
INSERT INTO "group" (group_id, student_id) VALUES (0, 3);
INSERT INTO "group" (group_id, student_id) VALUES (1, 0);
INSERT INTO "group" (group_id, student_id) VALUES (1, 1);
INSERT INTO "group" (group_id, student_id) VALUES (1, 4);

--class--
INSERT INTO class (student_id, cu_id, identifier) VALUES (0, 0, 'LBAW01');
INSERT INTO class (student_id, cu_id, identifier) VALUES (1, 0, 'LBAW01');
INSERT INTO class (student_id, cu_id, identifier) VALUES (2, 0, 'LBAW01');
INSERT INTO class (student_id, cu_id, identifier) VALUES (3, 0, 'LBAW01');
INSERT INTO class (student_id, cu_id, identifier) VALUES (4, 0, 'LBAW01');
INSERT INTO class (student_id, cu_id, identifier) VALUES (5, 2, 'SOPE03');
INSERT INTO class (student_id, cu_id, identifier) VALUES (6, 2, 'SOPE03');
INSERT INTO class (student_id, cu_id, identifier) VALUES (7, 2, 'SOPE03');
INSERT INTO class (student_id, cu_id, identifier) VALUES (8, 2, 'SOPE03');
INSERT INTO class (student_id, cu_id, identifier) VALUES (9, 2, 'SOPE03');
INSERT INTO class (student_id, cu_id, identifier) VALUES (10, 2, 'SOPE02');

--moderator--
INSERT INTO moderator (student_id, cu_id) VALUES (4, 2);
INSERT INTO moderator (student_id, cu_id) VALUES (5, 1);

--banned--
INSERT INTO banned (student_id, cu_id, mod_student_id, reason) VALUES (10, 2, 4, 'Continuo postagem de postes desnecessarios e no meio do caminho de postes uteis');

--teaches--
INSERT INTO teaches (professor_id, cu_id) VALUES (0, 0);
INSERT INTO teaches (professor_id, cu_id) VALUES (1, 0);
INSERT INTO teaches (professor_id, cu_id) VALUES (2, 0);
INSERT INTO teaches (professor_id, cu_id) VALUES (3, 0);
INSERT INTO teaches (professor_id, cu_id) VALUES (4, 1);
INSERT INTO teaches (professor_id, cu_id) VALUES (8, 2);
INSERT INTO teaches (professor_id, cu_id) VALUES (9, 2);

--post--
INSERT INTO post (id, author_id, content, cu_id, feed_type) VALUES (0, 5, 'No artefacto 6 como e suposto povoar a base de dados??', 0, 'Doubts');
INSERT INTO post (id, author_id, content, cu_id, feed_type) VALUES (1, 4, 'Vai haver aula hoje?', 0, 'General');
INSERT INTO post (id, author_id, content, cu_id, feed_type) VALUES (2, 9, 'Estou com um problema na base de dados. Alguem me pode ajudar?? BDAD e muito complicado para o meu pequeno cerebro, nao tenho um QI superiro a 200. Preciso mesmo de ajuda se nao ja reprovei', 1, 'Tutoring');
INSERT INTO post (id, author_id, content, cu_id, feed_type) VALUES (3, 7, 'Nao vai haver aulas hoje nos queijos, estao a limpar o cheirete a bolor, get it porque sao queijos??', 1, 'General');
INSERT INTO post (id, author_id, content, cu_id, feed_type) VALUES (4, 6, 'Se pesquisarem no youtube por sopa tem muitos tutoriais de como fazer esta cadeira', 2, 'General');
INSERT INTO post (id, author_id, content, cu_id, feed_type) VALUES (5, 8, 'Por causa do covid 33 estamos a usar uma plataforma de aulas virtual, cada pessoa deve usar os seus oculos vr para assistir a aula', 0, 'General');

INSERT INTO post (id, author_id, content, public_feed) VALUES (6, 4, 'Nao se esquecam de preencher os inqueritos pedagogicos, e nao digam so mal de plog', TRUE);
INSERT INTO post (id, author_id, content, public_feed) VALUES (7, 0, 'Grande evento que vai acontecer em abril, dia 20 nao percas!!!', TRUE);

--comment--
INSERT INTO comment (id, content, author_id, post_id) VALUES (0, 'Nao tambem queria saber', 6, 0);
INSERT INTO comment (id, content, author_id, post_id) VALUES (1, 'Sim as aulas estao a corer na normalidad, que raio de pergunta', 8, 3);
INSERT INTO comment (id, content, author_id, post_id) VALUES (2, 'Vai haver comida e bebida para todos e so aparecer', 0, 7);
INSERT INTO comment (id, content, author_id, post_id) VALUES (3, 'Ja preenchi', 2, 4);
INSERT INTO comment (id, content, author_id, post_id) VALUES (4, 'Posso te ajudar com bdad', 4, 2);
INSERT INTO comment (id, content, author_id, post_id) VALUES (5, 'Obrigado, quando podes ajudar me?', 9, 2);
INSERT INTO comment (id, content, author_id, post_id) VALUES (6, 'Amanha as 20:40 podes? Eu mando te invite para o discord', 4, 2);
INSERT INTO comment (id, content, author_id, post_id) VALUES (7, 'Comida?? Conta comigo', 8, 7);

--comment_thread--
INSERT INTO comment_thread (comment_id, parent_id) VALUES (5, 4);
INSERT INTO comment_thread (comment_id, parent_id) VALUES (6, 5);
INSERT INTO comment_thread (comment_id, parent_id) VALUES (7, 2);

--message--
INSERT INTO message (id, sender_id, receiver_id, content) VALUES (0, 5, 6, 'Tenho uma irritacao nas costas o que pode ser?');
INSERT INTO message (id, sender_id, receiver_id, content) VALUES (1, 6, 5, 'Deixei de ser medico. Estava demasiado perto das pessoas tenho que me desenlacar de tudo');
INSERT INTO message (id, sender_id, receiver_id, content) VALUES (2, 6, 7, 'Como estao as ovelha?');
INSERT INTO message (id, sender_id, receiver_id, content) VALUES (3, 7, 0, 'So para dizer que hoje esta um belo dia');
INSERT INTO message (id, sender_id, receiver_id, content) VALUES (4, 3, 4, 'Ja fizeste o que faltava??');

--group_message--
INSERT INTO group_message (id, group_id, content, sender_id) VALUES (0, 0, 'Ja acabei de povoar a base de dados que acham?? Meti alguns easter eggs? Quanto nao sei...', 0);
INSERT INTO group_message (id, group_id, content, sender_id) VALUES (1, 0, 'Ja acabei os triggers. Que triggered que fiquei', 3);
INSERT INTO group_message (id, group_id, content, sender_id) VALUES (2, 1, 'A minha amiga asiatica ficou doente. Mas eu Coreia.', 6);
INSERT INTO group_message (id, group_id, content, sender_id) VALUES (3, 1, 'Por causa do coronavirus ja nao e permitido fazer festas com 20 ou mais pesoas. Por isso agora so COVID 19', 9);
INSERT INTO group_message (id, group_id, content, sender_id) VALUES (4, 1, 'Ao gajo que inventou o zero: Obrigado por nada!', 5);

--group_message_receiver--
INSERT INTO group_message_receiver (group_id, student_id, group_name) VALUES (0, 0, 'LBAW');
INSERT INTO group_message_receiver (group_id, student_id, group_name) VALUES (0, 1, 'LBAW');
INSERT INTO group_message_receiver (group_id, student_id, group_name) VALUES (0, 2, 'LBAW');
INSERT INTO group_message_receiver (group_id, student_id, group_name) VALUES (0, 3, 'LBAW');
INSERT INTO group_message_receiver (group_id, student_id, group_name) VALUES (1, 0, 'MeMeS');
INSERT INTO group_message_receiver (group_id, student_id, group_name) VALUES (1, 1, 'MeMeS');
INSERT INTO group_message_receiver (group_id, student_id, group_name) VALUES (1, 2, 'MeMeS');
INSERT INTO group_message_receiver (group_id, student_id, group_name) VALUES (1, 3, 'MeMeS');
INSERT INTO group_message_receiver (group_id, student_id, group_name) VALUES (1, 4, 'MeMeS');
INSERT INTO group_message_receiver (group_id, student_id, group_name) VALUES (1, 5, 'MeMeS');
INSERT INTO group_message_receiver (group_id, student_id, group_name) VALUES (1, 6, 'MeMeS');
INSERT INTO group_message_receiver (group_id, student_id, group_name) VALUES (1, 9, 'MeMeS');