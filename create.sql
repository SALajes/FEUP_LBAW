CREATE TYPE feed_type_enum AS ENUM ('General', 'Doubts', 'Tutoring');

DROP TABLE IF EXISTS student;

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


DROP TABLE IF EXISTS professor;

CREATE TABLE professor (
    id              SERIAL PRIMARY KEY,
    name            TEXT NOT NULL,
    email           TEXT NOT NULL CONSTRAINT professor_email_uk UNIQUE,
    picture_path    TEXT,
    abbrevr         TEXT NOT NULL CONSTRAINT professor_abbrevr_uk UNIQUE,
    
    CONSTRAINT email_ck CHECK (email !~ '^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+[.][a-za-z]+\$'::TEXT)
);

DROP TABLE IF EXISTS curricular_unit;

DROP TABLE IF EXISTS about_cu;

CREATE TABLE about_cu (
    id              SERIAL PRIMARY KEY,
    description     TEXT  NOT NULL
);

CREATE TABLE curricular_unit (
    id          SERIAL PRIMARY KEY,
    name        TEXT  NOT NULL CONSTRAINT cu_name_uk UNIQUE,
    abbrev      TEXT  NOT NULL CONSTRAINT cu_abbrev_uk UNIQUE,
    about_id    INTEGER NOT NULL REFERENCES about_cu (id) ON UPDATE CASCADE ON DELETE CASCADE
);

DROP TABLE IF EXISTS rating;

CREATE TABLE rating (
    id              SERIAL PRIMARY KEY,
    reviewer_id     INTEGER REFERENCES student (id) ON UPDATE CASCADE ON DELETE CASCADE,
    has_voted       BOOLEAN NOT NULL,
    review          TEXT,
    student_id      INTEGER REFERENCES student (id) ON UPDATE CASCADE ON DELETE CASCADE,
    cu_id           INTEGER REFERENCES curricular_unit (id) ON UPDATE CASCADE ON DELETE CASCADE,
    professor_id    INTEGER REFERENCES professor (id) ON UPDATE CASCADE ON DELETE CASCADE,
    
    CONSTRAINT rated_ck CHECK (
        student_id IS NOT NULL AND cu_id IS NULL AND professor_id IS NULL 
        OR 
        student_id IS NULL AND cu_id IS NOT NULL AND professor_id IS NULL 
        OR 
        student_id IS NULL AND cu_id IS NULL AND professor_id IS NOT NULL
    )
);

DROP TABLE IF EXISTS friend;

CREATE TABLE friend (
    student1_id INTEGER NOT NULL REFERENCES student (id) ON UPDATE CASCADE ON DELETE CASCADE,
    student2_id INTEGER NOT NULL REFERENCES student (id) ON UPDATE CASCADE ON DELETE CASCADE,
    PRIMARY KEY (student1_id, student2_id)
);

DROP TABLE IF EXISTS "group";

CREATE TABLE "group" (
    group_id    SERIAL,
    student_id  INTEGER NOT NULL REFERENCES student (id) ON UPDATE CASCADE ON DELETE CASCADE,
    PRIMARY KEY (group_id, student_id)
);

DROP TABLE IF EXISTS class;

CREATE TABLE class (
    student_id  INTEGER NOT NULL REFERENCES student (id) ON UPDATE CASCADE ON DELETE CASCADE,
    cu_id       INTEGER NOT NULL REFERENCES curricular_unit (id) ON UPDATE CASCADE ON DELETE CASCADE,
    identifier  TEXT NOT NULL CONSTRAINT identifier_uk UNIQUE,
    PRIMARY KEY (student_id, cu_id)
);

DROP TABLE IF EXISTS moderator;

CREATE TABLE moderator (
    student_id  INTEGER NOT NULL REFERENCES student (id) ON UPDATE CASCADE ON DELETE CASCADE,
    cu_id       INTEGER NOT NULL REFERENCES curricular_unit (id) ON UPDATE CASCADE ON DELETE CASCADE,
    PRIMARY KEY (student_id, cu_id),

    CONSTRAINT pair_student_cu_uk UNIQUE (student_id, cu_id)
);

-- DROP TABLE IF EXISTS banned;

-- CREATE TABLE banned (
--     student_id      INTEGER NOT NULL REFERENCES student (id) ON UPDATE CASCADE ON DELETE CASCADE,
--     cu_id           INTEGER NOT NULL REFERENCES curricular_unit (id) ON UPDATE CASCADE ON DELETE CASCADE,
--     mod_student_id  INTEGER NOT NULL REFERENCES moderator (student_id) ON UPDATE CASCADE ON DELETE CASCADE,
--     reason          TEXT NOT NULL,
--     "date"          TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
--     PRIMARY KEY (student_id, cu_id)
-- );

DROP TABLE IF EXISTS teaches;

CREATE TABLE teaches (
    professor_id    INTEGER NOT NULL REFERENCES curricular_unit (id) ON UPDATE CASCADE ON DELETE CASCADE,
    cu_id           INTEGER NOT NULL REFERENCES professor (id) ON UPDATE CASCADE ON DELETE CASCADE,
    PRIMARY KEY (professor_id, cu_id)
);

DROP TABLE IF EXISTS post;

CREATE TABLE post (
    id              SERIAL PRIMARY KEY,
    author_id       INTEGER NOT NULL REFERENCES student (id) ON UPDATE CASCADE ON DELETE CASCADE,
    content         TEXT  NOT NULL,
    "date"          TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    like_counter    INTEGER NOT NULL,
    cu_id           INTEGER REFERENCES curricular_unit (id) ON UPDATE CASCADE ON DELETE CASCADE,
    public_feed     BOOLEAN,
    feed_type       feed_type_enum,

    CONSTRAINT post_feed_ck CHECK (
        cu_id IS NOT NULL AND public_feed IS NULL AND feed_type IS NOT NULL
        OR 
        cu_id IS NULL AND public_feed IS NOT NULL AND feed_type IS NULL
    )
);

DROP TABLE IF EXISTS comment;

CREATE TABLE comment (
    id          SERIAL PRIMARY KEY,
    content     TEXT  NOT NULL,
    "date"      TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    author_id   INTEGER NOT NULL REFERENCES student (id) ON UPDATE CASCADE ON DELETE CASCADE,
    post_id     INTEGER NOT NULL REFERENCES post (id) ON UPDATE CASCADE ON DELETE CASCADE
);

DROP TABLE IF EXISTS comment_thread;

CREATE TABLE comment_thread (
    comment_id  INTEGER NOT NULL REFERENCES comment (id) ON UPDATE CASCADE ON DELETE CASCADE,
    parent_id   INTEGER NOT NULL REFERENCES comment (id) ON UPDATE CASCADE ON DELETE CASCADE,
    PRIMARY KEY (comment_id, parent_id)
);

DROP TABLE IF EXISTS message;

CREATE TABLE message (
    id              SERIAL PRIMARY KEY,
    sender_id       INTEGER NOT NULL REFERENCES student (id) ON UPDATE CASCADE ON DELETE CASCADE,
    receiver_id     INTEGER NOT NULL REFERENCES student (id) ON UPDATE CASCADE ON DELETE CASCADE,
    content         TEXT  NOT NULL,
    "date"          TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL
);

DROP TABLE IF EXISTS group_message;

CREATE TABLE group_message (
    id          SERIAL PRIMARY KEY,
    name        TEXT  NOT NULL,
    content     TEXT  NOT NULL,
    "date"      TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    sender_id   INTEGER NOT NULL REFERENCES student (id) ON UPDATE CASCADE ON DELETE CASCADE
);

DROP TABLE IF EXISTS group_message_receiver;

CREATE TABLE group_message_receiver (
    group_id    INTEGER NOT NULL REFERENCES group_message (id) ON UPDATE CASCADE ON DELETE CASCADE,
    student_id  INTEGER NOT NULL REFERENCES student (id) ON UPDATE CASCADE ON DELETE CASCADE,
    PRIMARY KEY (group_id, student_id)
);