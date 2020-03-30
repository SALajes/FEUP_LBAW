--SELECT01

--SELECT02
SELECT id, sender_id, content, date, receiver_id 
FROM group_message 
WHERE id = $id;

--SELECT03
SELECT id, author_id, content, date 
FROM post 
WHERE cu_id = $cu_id AND feed_type = $feed;

--SELECT04
SELECT id, author_id, content, date 
FROM post 
WHERE public_feed = TRUE;

--SELCT05
SELECT id, author_id, content, date 
FROM comment 
WHERE post_id = $id;

--SELECT06
SELECT id, author_id, content, date 
FROM comment 
WHERE id in (
    SELECT comment_id 
    FROM comment_thread 
    WHERE parent_id = $parent_comment
);

--SELECT07
SELECT id, abbrev, description 
FROM curricular_unit 
WHERE id in (
    SELECT cu_id 
    FROM class 
    WHERE student_id = $uid
);

--SELECT08
SELECT id, student_number, name, bio, email, picture_path 
FROM student 
WHERE id = $uid;

--SELCT09
SELECT id, has_voted, review 
FROM rating 
WHERE student_id = $uid;

--SELECT10
SELECT id, has_voted, review 
FROM rating 
WHERE professor_id = $pid;

--SELECT11
SELECT id, has_voted, review
FROM rating
WHERE cu_id = $cuid;

--SELECT12


--SELECT13