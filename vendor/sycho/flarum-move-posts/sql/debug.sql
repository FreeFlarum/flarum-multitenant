CREATE TABLE posts (
    `id` bigint,
    `number` bigint,
    `created_at` timestamp
);

INSERT INTO posts (`id`, `number`, `created_at`)
VALUES
	(1, 5, '2021-08-01 12:00:00'),
	(2, 6, '2021-08-01 18:43:00'),
    (3, 7, '2021-08-02 08:26:00'),
    (4, 10, '2021-08-03 15:23:52'),
    (5, 11, '2021-08-04 23:01:25');

/* ====================== */

SELECT id, number, created_at, (
	SELECT COUNT(created_at)
  	FROM posts AS t
	WHERE t.id IN (22267, 22272)
  	    AND posts.created_at > t.created_at
) as `count`
FROM posts
WHERE discussion_id = 705;

EXPLAIN UPDATE fl_posts
SET number = number + (
	SELECT COUNT(t.created_at)
  	FROM (
  	    SELECT created_at
        FROM fl_posts
        WHERE id IN (491, 692, 1093, 1394, 1395, 1396)
    ) as t
  	WHERE fl_posts.created_at >= t.created_at
)
WHERE discussion_id = 4;

SELECT * from posts;


SELECT DISTINCT (
    SELECT MAX(number)
    FROM posts
    WHERE discussion_id = 4
        AND r.created_at > posts.created_at
) as number
FROM (
    SELECT created_at
    FROM posts
    WHERE id IN (491, 692, 1093, 1394, 1395, 1396)
) as r;

SELECT DISTINCT (
    SELECT number
    FROM posts
    WHERE discussion_id = 4
      AND r.created_at > posts.created_at
    ORDER BY number DESC
    LIMIT 1
) as number
FROM (
    SELECT created_at
    FROM posts
    WHERE id IN (491, 692, 1093, 1394, 1395, 1396)
 ) as r;
