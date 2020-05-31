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

DROP TYPE IF EXISTS feed_type_enum;

DROP FUNCTION IF EXISTS set_friends() CASCADE;
DROP FUNCTION IF EXISTS ban_student() CASCADE;
DROP FUNCTION IF EXISTS group_exists() CASCADE;

-- Type

CREATE TYPE feed_type_enum AS ENUM ('General', 'Doubts', 'Tutoring');

-- Tables

CREATE TABLE student (
   id              SERIAL PRIMARY KEY,
   password        TEXT NOT NULL,
   student_number  TEXT NOT NULL CONSTRAINT student_number_uk UNIQUE,
   name            TEXT NOT NULL,
   bio             TEXT,
   email           TEXT NOT NULL CONSTRAINT student_email_uk UNIQUE,
   picture_path    TEXT,
   administrator   BOOLEAN NOT NULL,

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
   public_feed  BOOLEAN,
   feed_type    feed_type_enum,

   CONSTRAINT post_feed_ck CHECK (
       cu_id IS NOT NULL AND public_feed IS NULL AND feed_type IS NOT NULL
       OR
       cu_id IS NULL AND public_feed IS NOT NULL AND feed_type IS NULL
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
   group_id     SERIAL,
   student_id   INTEGER NOT NULL REFERENCES student (id) ON UPDATE CASCADE ON DELETE CASCADE,
   group_name   TEXT NOT NULL,
   PRIMARY KEY (group_id, student_id)
);

--Index--

CREATE INDEX sender_id_message ON message USING hash(sender_id);
CREATE INDEX receiver_id_message ON message USING hash(sender_id);
CREATE INDEX cu_id_post ON post USING hash(cu_id);
CREATE INDEX public_feed_post ON post USING hash(public_feed);
CREATE INDEX student_id_rating ON rating USING hash(student_id);
CREATE INDEX professor_id_rating ON rating USING hash(professor_id);
CREATE INDEX cu_id_rating ON rating USING hash(cu_id);
CREATE INDEX post_date_idx ON post USING USING btree(date);
CREATE INDEX comment_date_idx ON comment USING USING btree(date);
CREATE INDEX message_date_idx ON message USING USING btree(date);
CREATE INDEX group_message_date_idx ON group_message USING USING btree(date);
CREATE INDEX search_post_idx ON post USING GIST (to_tsvector('portuguese', content));
CREATE INDEX search_cu_idx ON curricular_unit USING GIST (to_tsvector('portuguese', name || ' ' || abbrev || ' ' || description));

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
