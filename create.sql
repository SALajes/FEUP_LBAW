CREATE TYPE public."Feed_Type" AS ENUM
    ('"General"', '"Doubts"', '"Tutoring');

CREATE TYPE public."Report_Status" AS ENUM
    ('"Pending"', '"Closed"');

CREATE TYPE public."Suggestion_Status" AS ENUM
    ('"Pending"', '"Accepted"', '"Rejected"');

DROP TABLE public.about_cu;

CREATE TABLE public.about_cu
(
    id integer NOT NULL,
    description text COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT "AboutCU_pkey" PRIMARY KEY (id)
)

DROP TABLE public.administrator;

CREATE TABLE public.administrator
(
    administrator_id integer NOT NULL,
    CONSTRAINT "Administrator_pkey" PRIMARY KEY (administrator_id),
    CONSTRAINT administrator_id_foreign FOREIGN KEY (administrator_id)
        REFERENCES public.student (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
)

DROP TABLE public.banned;

CREATE TABLE public.banned
(
    student_id integer NOT NULL,
    moderator_id integer NOT NULL,
    reason text COLLATE pg_catalog."default" NOT NULL,
    date date NOT NULL,
    CONSTRAINT banned_pkey PRIMARY KEY (moderator_id, student_id),
    CONSTRAINT moderator_id_foreign FOREIGN KEY (moderator_id)
        REFERENCES public.moderator (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
        NOT VALID,
    CONSTRAINT student_id_foreign FOREIGN KEY (student_id)
        REFERENCES public.student (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
        NOT VALID
)


DROP TABLE public.class;

CREATE TABLE public.class
(
    student_id integer NOT NULL,
    cu_id integer NOT NULL,
    identifier text COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT "Class_pkey" PRIMARY KEY (student_id, cu_id),
    CONSTRAINT identifier_uk UNIQUE (identifier),
    CONSTRAINT cu_id_foreign FOREIGN KEY (cu_id)
        REFERENCES public.curricular_unit (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
        NOT VALID,
    CONSTRAINT student_id_foreign FOREIGN KEY (student_id)
        REFERENCES public.student (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
)

DROP TABLE public.comment;

CREATE TABLE public.comment
(
    id integer NOT NULL,
    content text COLLATE pg_catalog."default" NOT NULL,
    date date NOT NULL,
    author_id integer NOT NULL,
    post_id integer NOT NULL,
    CONSTRAINT comment_pkey PRIMARY KEY (id),
    CONSTRAINT comment_post_uk UNIQUE (post_id),
    CONSTRAINT author_id_foreign FOREIGN KEY (author_id)
        REFERENCES public.student (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT post_id_foreign FOREIGN KEY (post_id)
        REFERENCES public.post (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
)

DROP TABLE public.comment_thread;

CREATE TABLE public.comment_thread
(
    comment_id integer NOT NULL,
    parent_id integer NOT NULL,
    CONSTRAINT comment_thread_pkey PRIMARY KEY (comment_id, parent_id),
    CONSTRAINT comment_id_foreign FOREIGN KEY (comment_id)
        REFERENCES public.comment (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT parent_id_foreign FOREIGN KEY (parent_id)
        REFERENCES public.comment (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
)


DROP TABLE public.curricular_unit;

CREATE TABLE public.curricular_unit
(
    id integer NOT NULL,
    name text COLLATE pg_catalog."default" NOT NULL,
    abbrev text COLLATE pg_catalog."default" NOT NULL,
    drive_id integer NOT NULL,
    about_id integer NOT NULL,
    CONSTRAINT "CurricularUnit_pkey" PRIMARY KEY (id),
    CONSTRAINT cu_abbrev_uk UNIQUE (abbrev),
    CONSTRAINT cu_about_uk UNIQUE (about_id),
    CONSTRAINT cu_drive_uk UNIQUE (drive_id),
    CONSTRAINT cu_name_uk UNIQUE (name),
    CONSTRAINT about_id_foreign FOREIGN KEY (about_id)
        REFERENCES public.about_cu (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
        NOT VALID,
    CONSTRAINT drive_id_foreign FOREIGN KEY (drive_id)
        REFERENCES public.drive (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
        NOT VALID
)


DROP TABLE public.drive;

CREATE TABLE public.drive
(
    id integer NOT NULL,
    fs_path text COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT drive_pkey PRIMARY KEY (id),
    CONSTRAINT drive_fs_path_uk UNIQUE (fs_path)
)


DROP TABLE public.feed;

CREATE TABLE public.feed
(
    post_id integer NOT NULL,
    cu_id integer NOT NULL,
    type "Feed_Type" NOT NULL,
    CONSTRAINT "Feed_pkey" PRIMARY KEY (post_id),
    CONSTRAINT cu_id_foreign FOREIGN KEY (cu_id)
        REFERENCES public.curricular_unit (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT post_id_foreign FOREIGN KEY (post_id)
        REFERENCES public.post (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
        NOT VALID
)


DROP TABLE public.file;

CREATE TABLE public.file
(
    id integer NOT NULL,
    fs_path text COLLATE pg_catalog."default" NOT NULL,
    ftype text COLLATE pg_catalog."default" NOT NULL,
    folder_id integer NOT NULL,
    drive_id integer NOT NULL,
    CONSTRAINT file_pkey PRIMARY KEY (id),
    CONSTRAINT drive_id_foreign FOREIGN KEY (drive_id)
        REFERENCES public.drive (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
        NOT VALID,
    CONSTRAINT folder_id_foreign FOREIGN KEY (folder_id)
        REFERENCES public.folder (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
)


DROP TABLE public.folder;

CREATE TABLE public.folder
(
    id integer NOT NULL,
    fs_path text COLLATE pg_catalog."default" NOT NULL,
    drive_id integer NOT NULL,
    CONSTRAINT folder_pkey PRIMARY KEY (id),
    CONSTRAINT fs_path_uk UNIQUE (fs_path),
    CONSTRAINT drive_id_foreign FOREIGN KEY (drive_id)
        REFERENCES public.drive (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
        NOT VALID
)


DROP TABLE public.friend;

CREATE TABLE public.friend
(
    student1_id integer NOT NULL,
    student2_id integer NOT NULL,
    CONSTRAINT "Friend_pkey" PRIMARY KEY (student1_id, student2_id),
    CONSTRAINT student1_id_foreign FOREIGN KEY (student1_id)
        REFERENCES public.student (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
        NOT VALID,
    CONSTRAINT student2_id_foreign FOREIGN KEY (student2_id)
        REFERENCES public.student (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
        NOT VALID
)


DROP TABLE public.group;

CREATE TABLE public."group"
(
    group_id text COLLATE pg_catalog."default" NOT NULL,
    student_id integer NOT NULL,
    CONSTRAINT "Group_pkey" PRIMARY KEY (group_id, student_id),
    CONSTRAINT student_id_foreign FOREIGN KEY (student_id)
        REFERENCES public.student (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
)


DROP TABLE public.group_message;

CREATE TABLE public.group_message
(
    id integer NOT NULL,
    name text COLLATE pg_catalog."default" NOT NULL,
    content text COLLATE pg_catalog."default" NOT NULL,
    date date NOT NULL,
    sender_id integer NOT NULL,
    CONSTRAINT group_message_pkey PRIMARY KEY (id),
    CONSTRAINT sender_id_foreign FOREIGN KEY (sender_id)
        REFERENCES public.student (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
)


DROP TABLE public.group_message_receiver;

CREATE TABLE public.group_message_receiver
(
    group_id integer NOT NULL,
    student_id integer NOT NULL,
    CONSTRAINT group_message_receiver_pkey PRIMARY KEY (group_id, student_id),
    CONSTRAINT group_message_id_foreign FOREIGN KEY (group_id)
        REFERENCES public.group_message (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT student_id_foreign FOREIGN KEY (student_id)
        REFERENCES public.student (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
)


DROP TABLE public.message;

CREATE TABLE public.message
(
    id integer NOT NULL,
    sender_id integer NOT NULL,
    receiver_id integer NOT NULL,
    content text COLLATE pg_catalog."default" NOT NULL,
    date date NOT NULL,
    CONSTRAINT message_pkey PRIMARY KEY (id),
    CONSTRAINT receiver_id_foreign FOREIGN KEY (receiver_id)
        REFERENCES public.student (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT sender_id_foreign FOREIGN KEY (sender_id)
        REFERENCES public.student (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
)


DROP TABLE public.moderator;

CREATE TABLE public.moderator
(
    id integer NOT NULL,
    student_id integer NOT NULL,
    cu_id integer NOT NULL,
    CONSTRAINT moderator_pkey PRIMARY KEY (id),
    CONSTRAINT pair_student_cu_uk UNIQUE (student_id, cu_id),
    CONSTRAINT cu_id_foreign FOREIGN KEY (cu_id)
        REFERENCES public.curricular_unit (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT student_id_foreign FOREIGN KEY (student_id)
        REFERENCES public.student (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
)


DROP TABLE public.post;

CREATE TABLE public.post
(
    id integer NOT NULL,
    author_id integer NOT NULL,
    content text COLLATE pg_catalog."default" NOT NULL,
    date date NOT NULL,
    like_counter integer NOT NULL,
    cu_id integer,
    public_feed_id integer,
    CONSTRAINT post_pkey PRIMARY KEY (id),
    CONSTRAINT author_id_foreign FOREIGN KEY (author_id)
        REFERENCES public.student (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
        NOT VALID,
    CONSTRAINT cu_id_foreign FOREIGN KEY (cu_id)
        REFERENCES public.curricular_unit (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT public_feed_id_foreign FOREIGN KEY (public_feed_id)
        REFERENCES public.public_feed (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT post_feed_ck CHECK (cu_id IS NOT NULL AND public_feed_id IS NULL OR cu_id IS NULL AND public_feed_id IS NOT NULL) NOT VALID
)


DROP TABLE public.professor;

CREATE TABLE public.professor
(
    id integer NOT NULL,
    name text COLLATE pg_catalog."default" NOT NULL,
    email text COLLATE pg_catalog."default" NOT NULL,
    picture_path text COLLATE pg_catalog."default",
    abbrevr text COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT "Professor_pkey" PRIMARY KEY (id),
    CONSTRAINT "Professor_abbrevr_uk" UNIQUE (abbrevr),
    CONSTRAINT "Professor_email_uk" UNIQUE (email),
    CONSTRAINT email_ck CHECK (email !~ '^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+[.][a-za-z]+\$'::text) NOT VALID
)


DROP TABLE public.public_feed;

CREATE TABLE public.public_feed
(
    id integer NOT NULL,
    CONSTRAINT public_feed_pkey PRIMARY KEY (id)
)


DROP TABLE public.rating;

CREATE TABLE public.rating
(
    id integer NOT NULL,
    has_voted boolean NOT NULL,
    review text COLLATE pg_catalog."default",
    student_id integer,
    cu_id integer,
    professor_id integer,
    CONSTRAINT "Rating_pkey" PRIMARY KEY (id),
    CONSTRAINT cu_id_foreign FOREIGN KEY (cu_id)
        REFERENCES public.curricular_unit (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
        NOT VALID,
    CONSTRAINT professor_id_foreign FOREIGN KEY (professor_id)
        REFERENCES public.professor (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
        NOT VALID,
    CONSTRAINT student_id_foreign FOREIGN KEY (student_id)
        REFERENCES public.student (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
        NOT VALID,
    CONSTRAINT rated_ck CHECK (student_id IS NOT NULL AND cu_id IS NULL AND professor_id IS NULL OR student_id IS NULL AND cu_id IS NOT NULL AND professor_id IS NULL OR student_id IS NULL AND cu_id IS NULL AND professor_id IS NOT NULL) NOT VALID
)


DROP TABLE public.report;

CREATE TABLE public.report
(
    id integer NOT NULL,
    content text COLLATE pg_catalog."default" NOT NULL,
    status "Report_Status" NOT NULL,
    reporter_id integer NOT NULL,
    reported_id integer NOT NULL,
    CONSTRAINT report_pkey PRIMARY KEY (id),
    CONSTRAINT reported_id_foreign FOREIGN KEY (reported_id)
        REFERENCES public.student (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT reporter_id_foreign FOREIGN KEY (reporter_id)
        REFERENCES public.student (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
)


DROP TABLE public.report_history;

CREATE TABLE public.report_history
(
    id integer NOT NULL,
    report_id integer NOT NULL,
    administrator_id integer NOT NULL,
    date date NOT NULL,
    CONSTRAINT report_history_pkey PRIMARY KEY (id),
    CONSTRAINT administrator_id_foreign FOREIGN KEY (administrator_id)
        REFERENCES public.administrator (administrator_id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT report_id_foreign FOREIGN KEY (report_id)
        REFERENCES public.report (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
)


DROP TABLE public.student;

CREATE TABLE public.student
(
    id integer NOT NULL,
    password text COLLATE pg_catalog."default" NOT NULL,
    student_number text COLLATE pg_catalog."default" NOT NULL,
    name text COLLATE pg_catalog."default" NOT NULL,
    bio text COLLATE pg_catalog."default",
    email text COLLATE pg_catalog."default" NOT NULL,
    picture_path text COLLATE pg_catalog."default",
    CONSTRAINT "Student_pkey" PRIMARY KEY (id),
    CONSTRAINT "Student_email_uk" UNIQUE (email),
    CONSTRAINT "Student_number_uk" UNIQUE (student_number),
    CONSTRAINT email_ck CHECK (email !~ '^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+[.][a-za-z]+\$'::text) NOT VALID
)


DROP TABLE public.student_rating;

CREATE TABLE public.student_rating
(
    rating_id integer NOT NULL,
    student_id integer NOT NULL,
    CONSTRAINT "StudentRating_pkey" PRIMARY KEY (rating_id, student_id),
    CONSTRAINT rating_id_foreign FOREIGN KEY (rating_id)
        REFERENCES public.rating (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
        NOT VALID,
    CONSTRAINT student_id_foreign FOREIGN KEY (student_id)
        REFERENCES public.student (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
        NOT VALID
)


DROP TABLE public.sub_folder;

CREATE TABLE public.sub_folder
(
    folder_id integer NOT NULL,
    parent_id integer NOT NULL,
    CONSTRAINT sub_folder_pkey PRIMARY KEY (folder_id),
    CONSTRAINT folder_id_foreign FOREIGN KEY (folder_id)
        REFERENCES public.folder (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT parentfolder_id_foreign FOREIGN KEY (parent_id)
        REFERENCES public.folder (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
)


DROP TABLE public.suggestion;

CREATE TABLE public.suggestion
(
    id integer NOT NULL,
    content text COLLATE pg_catalog."default" NOT NULL,
    student_id integer,
    status "Suggestion_Status" NOT NULL,
    CONSTRAINT "Suggestion_pkey" PRIMARY KEY (id),
    CONSTRAINT student_id_foreign FOREIGN KEY (student_id)
        REFERENCES public.student (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
        NOT VALID
)


DROP TABLE public.suggestion_history;

CREATE TABLE public.suggestion_history
(
    id integer NOT NULL,
    suggestion_id integer NOT NULL,
    administrator_id integer NOT NULL,
    date date NOT NULL,
    CONSTRAINT "SuggestionHistory_pkey" PRIMARY KEY (id),
    CONSTRAINT administrator_id_foreign FOREIGN KEY (administrator_id)
        REFERENCES public.administrator (administrator_id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
        NOT VALID,
    CONSTRAINT suggestion_id_foreign FOREIGN KEY (suggestion_id)
        REFERENCES public.suggestion (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
        NOT VALID
)


DROP TABLE public.teacher;

CREATE TABLE public.teaches
(
    professor_id integer NOT NULL,
    cu_id integer NOT NULL,
    CONSTRAINT teaches_pkey PRIMARY KEY (professor_id, cu_id),
    CONSTRAINT cu_id_foreign FOREIGN KEY (cu_id)
        REFERENCES public.curricular_unit (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
        NOT VALID,
    CONSTRAINT professor_id_foreign FOREIGN KEY (professor_id)
        REFERENCES public.professor (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
)
