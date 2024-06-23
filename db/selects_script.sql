
-- likes and gender
SELECT DISTINCT p.id as product_id, p.name as product_name, u.gender_id, p.likes as likes_number
FROM product p
         JOIN user_likes ul ON p.id = ul.product_id
         JOIN users u ON ul.user_id = u.id
ORDER BY u.gender_id ASC, likes_number DESC;

-- likes and skintype
SELECT DISTINCT p.id as product_id, p.name as product_name, u.skintype_id, p.likes as likes_number
FROM product p
         JOIN user_likes ul ON p.id = ul.product_id
         JOIN users u ON ul.user_id = u.id
ORDER BY u.skintype_id ASC, likes_number DESC;

-- likes and social status
SELECT DISTINCT p.id as product_id, p.name as product_name, u.social_status_id, p.likes as likes_number
FROM product p
         JOIN user_likes ul ON p.id = ul.product_id
         JOIN users u ON ul.user_id = u.id
ORDER BY u.social_status_id ASC, likes_number DESC;

-- likes and zone
SELECT DISTINCT p.id as product_id, p.name as product_name, p.zone_id, p.likes as likes_number
FROM product p
ORDER BY p.zone_id ASC, likes_number DESC;

-- likes and age group
SELECT DISTINCT p.id as product_id, p.name as product_name, p.age_group_id, p.likes as likes_number
FROM product p
ORDER BY p.age_group_id ASC, likes_number DESC;


-- likes and time of day
SELECT DISTINCT p.id as product_id, p.name as product_name, potd.time_of_day_id, p.likes as likes_number
FROM product p
         JOIN product_for_time_of_day potd ON p.id = potd.product_id
ORDER BY potd.time_of_day_id ASC, likes_number DESC;

-- likes and occasion
SELECT DISTINCT p.id as product_id, p.name as product_name, pfo.occasion_id, p.likes as likes_number
FROM product p
         JOIN product_for_occasion pfo ON p.id = pfo.product_id
ORDER BY pfo.occasion_id ASC, likes_number DESC;


-- filtering products
SELECT p.id, p.name, p.brand, p.description, p.picture_path, p.product_category_id, p.zone_id, p.age_group_id
FROM product p
         JOIN product_for_occasion pfo ON p.id = pfo.product_id
         JOIN product_for_skintype pfs ON p.id = pfs.product_id
WHERE p.age_group_id = 2 AND pfs.skintype_id = 3 AND pfo.occasion_id = 1;