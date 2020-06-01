--SELECT01
SELECT id, sender_id, content, date, receiver_id
FROM message
WHERE (sender_id = $u1_id AND receiver_id = $u2_id) OR (sender_id = $u2_id AND receiver_id = $u1_id)
ORDER BY date
LIMIT 20
OFFSET 0;

--SELECT02
SELECT id, sender_id, content, date
FROM group_message 
WHERE id = $id
ORDER BY date
LIMIT 20
OFFSET 0;

--SELECT03
SELECT p.id, p.content, p.date, s.name, s.profile_image 
FROM post JOIN student s
ON author_id = s.id
WHERE cu_id = $cu_id AND feed_type = $feed
ORDER BY p.date
LIMIT 10
OFFSET 0;

--SELECT04
SELECT p.id, p.content, p.date, s.name, s.profile_image
FROM post p JOIN student s
ON author_id = s.id
WHERE public_feed = TRUE
ORDER BY p.date
LIMIT 10
OFFSET 0;

--SELCT05
SELECT c.id, c.content, c.date, s.name, s.profile_image
FROM comment c JOIN student s
ON c.author_id = s.id
WHERE post_id = $id
ORDER BY c.date DESC
LIMIT 10
OFFSET 0;

--SELECT06
SELECT c.id, c.content, c.date, s.name, s.profile_image
FROM comment c JOIN student s
ON c.author_id = s.id
WHERE c.id in (
    SELECT comment_id 
    FROM comment_thread 
    WHERE parent_id = $parent_comment
)
ORDER BY date DESC;

--SELECT07
SELECT id, abbrev, description 
FROM curricular_unit 
WHERE id in (
    SELECT cu_id 
    FROM enrolled
    WHERE student_id = $uid
);

--SELECT08
SELECT id, student_number, name, bio, email, profile_image 
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
SELECT *
FROM banned
WHERE student_id = $student_id AND cu_id = $cuid;


--SELECT13
SELECT *
FROM post, to_tsquery('portuguese', $content) AS query, to_tsvector('portuguese', content) AS textsearch
WHERE cu_id = $cu_id AND query @@ textsearch 
ORDER BY date 
LIMIT 15;

--SELECT14
SELECT *
FROM post, to_tsquery('portuguese', $content) AS query, to_tsvector('portuguese', content) AS textsearch
WHERE cu_id = $cu_id AND feed_type = $type AND query @@ textsearch 
ORDER BY date 
LIMIT 15;

--SELECT15
SELECT *
FROM curricular_unit, to_tsquery('portuguese', $content) AS query, to_tsvector('portuguese', name | description) AS textsearch
WHERE query @@ textsearch 
ORDER BY name;

--SELECT16
SELECT p.id, p.content, p.date, s.name, s.profile_image 
FROM post AS p JOIN student AS s ON p.author_id = s.id
WHERE p.cu_id in (
    SELECT e.cu_id
    FROM enrolled AS e
    WHERE  $id = e.student_id 
) OR p.public_feed = TRUE
ORDER BY p.date DESC
LIMIT 10;