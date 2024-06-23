
create database mawa;
show databases;
use mawa;


-- -------------------------- create tables -------------------------
CREATE TABLE users (
                       id INT PRIMARY KEY AUTO_INCREMENT,
                       name VARCHAR(100),
                       email VARCHAR(100),
                       password VARCHAR(100),
                       city VARCHAR(100),
                       picture_path VARCHAR(100)
);

CREATE TABLE user_role (
                           id INT PRIMARY KEY AUTO_INCREMENT,
                           user_role VARCHAR(25)
);

CREATE TABLE gender (
                        id INT PRIMARY KEY AUTO_INCREMENT,
                        gender VARCHAR(25)
);

CREATE TABLE skintype (
                          id INT PRIMARY KEY AUTO_INCREMENT,
                          skintype VARCHAR(50)
);

CREATE TABLE social_status (
                               id INT PRIMARY KEY AUTO_INCREMENT,
                               social_status VARCHAR(100)
);

CREATE TABLE age_group (
                           id INT PRIMARY KEY AUTO_INCREMENT,
                           age_group VARCHAR(10)
);

CREATE TABLE product (
                         id INT PRIMARY KEY AUTO_INCREMENT,
                         name VARCHAR(100),
                         brand VARCHAR(100),
                         description VARCHAR(500),
                         picture_path VARCHAR(100),
                         likes INT DEFAULT 0
);

CREATE TABLE product_type (
                              id INT PRIMARY KEY AUTO_INCREMENT,
                              product_type VARCHAR(25)
);

CREATE TABLE product_category (
                                  id INT PRIMARY KEY AUTO_INCREMENT,
                                  product_category VARCHAR(50)
);

CREATE TABLE time_of_day (
                             id INT PRIMARY KEY AUTO_INCREMENT,
                             time_of_day VARCHAR(25)
);

CREATE TABLE zone (
                      id INT PRIMARY KEY AUTO_INCREMENT,
                      zone VARCHAR(25)
);

CREATE TABLE occasion (
                          id INT PRIMARY KEY AUTO_INCREMENT,
                          occasion VARCHAR(50)
);

CREATE TABLE product_for_occasion (
                                      product_id INT,
                                      occasion_id INT,
                                      FOREIGN KEY (product_id) REFERENCES product(id) ON DELETE CASCADE,
                                      FOREIGN KEY (occasion_id) REFERENCES occasion(id) ON DELETE CASCADE,
                                      PRIMARY KEY (product_id, occasion_id)
);

CREATE TABLE product_for_time_of_day (
                                         product_id INT,
                                         time_of_day_id INT,
                                         FOREIGN KEY (product_id) REFERENCES product(id) ON DELETE CASCADE,
                                         FOREIGN KEY (time_of_day_id) REFERENCES time_of_day(id) ON DELETE CASCADE,
                                         PRIMARY KEY (product_id, time_of_day_id)
);

CREATE TABLE product_for_skintype (
                                      product_id INT,
                                      skintype_id INT,
                                      FOREIGN KEY (product_id) REFERENCES product(id) ON DELETE CASCADE,
                                      FOREIGN KEY (skintype_id) REFERENCES skintype(id) ON DELETE CASCADE,
                                      PRIMARY KEY (product_id, skintype_id)
);

CREATE TABLE user_likes (
                            user_id INT,
                            product_id INT,
                            PRIMARY KEY (user_id, product_id),
                            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
                            FOREIGN KEY (product_id) REFERENCES product(id) ON DELETE CASCADE
);



-- -------------------------- add foreign keys -------------------------
ALTER TABLE users
    ADD COLUMN gender_id INT,
    ADD COLUMN skintype_id INT,
    ADD COLUMN social_status_id INT,
    ADD COLUMN age_group_id INT,
    ADD COLUMN user_role_id INT DEFAULT 2,
    ADD FOREIGN KEY (gender_id) REFERENCES gender(id) ON DELETE SET NULL,
    ADD FOREIGN KEY (skintype_id) REFERENCES skintype(id) ON DELETE SET NULL,
    ADD FOREIGN KEY (social_status_id) REFERENCES social_status(id) ON DELETE SET NULL,
    ADD FOREIGN KEY (age_group_id) REFERENCES age_group(id) ON DELETE SET NULL,
    ADD FOREIGN KEY (user_role_id) REFERENCES user_role(id)  ON DELETE SET NULL;

ALTER TABLE product
    ADD COLUMN product_category_id INT,
    ADD COLUMN zone_id INT,
    ADD COLUMN age_group_id INT,
    ADD FOREIGN KEY (product_category_id) REFERENCES product_category(id) ON DELETE SET NULL,
    ADD FOREIGN KEY (zone_id) REFERENCES zone(id) ON DELETE SET NULL,
    ADD FOREIGN KEY (age_group_id) REFERENCES age_group(id) ON DELETE SET NULL;

ALTER TABLE product_category
    ADD COLUMN product_type_id INT,
    ADD FOREIGN KEY (product_type_id) REFERENCES product_type(id) ON DELETE SET NULL;

ALTER TABLE age_group
    ADD COLUMN description VARCHAR(500) NOT NULL DEFAULT 'No description';

ALTER TABLE skintype
    ADD COLUMN description VARCHAR(500) NOT NULL DEFAULT 'No description';

ALTER TABLE occasion
    ADD COLUMN description VARCHAR(500) NOT NULL DEFAULT 'No description';

ALTER TABLE time_of_day
    ADD COLUMN description VARCHAR(500) NOT NULL DEFAULT 'No description';



-- -------------------------- insert data -------------------------
INSERT INTO gender (gender) VALUES ('Female');
INSERT INTO gender (gender) VALUES ('Male');
INSERT INTO gender (gender) VALUES ('Both');

INSERT INTO skintype (skintype) VALUES ('Dry');
INSERT INTO skintype (skintype) VALUES ('Oily');
INSERT INTO skintype (skintype) VALUES ('Combination');
INSERT INTO skintype (skintype) VALUES ('Sensitive');
INSERT INTO skintype (skintype) VALUES ('Normal');

INSERT INTO social_status (social_status) VALUES ('Student');
INSERT INTO social_status (social_status) VALUES ('Working');
INSERT INTO social_status (social_status) VALUES ('Retired');
INSERT INTO social_status (social_status) VALUES ('Unemployed');

INSERT INTO age_group (age_group) VALUES ('-18');
INSERT INTO age_group (age_group) VALUES ('19-40');
INSERT INTO age_group (age_group) VALUES ('41+');

INSERT INTO product_type (product_type) VALUES ('Makeup');
INSERT INTO product_type (product_type) VALUES ('Skincare');


-- Makeup products
INSERT INTO product_category (product_category, product_type_id) VALUES ('Foundation', 1);
INSERT INTO product_category (product_category, product_type_id) VALUES ('Concealer', 1);
INSERT INTO product_category (product_category, product_type_id) VALUES ('Powder', 1);
INSERT INTO product_category (product_category, product_type_id) VALUES ('Blush', 1);
INSERT INTO product_category (product_category, product_type_id) VALUES ('Bronzer', 1);
INSERT INTO product_category (product_category, product_type_id) VALUES ('Highlighter', 1);
INSERT INTO product_category (product_category, product_type_id) VALUES ('Eyeshadow', 1);
INSERT INTO product_category (product_category, product_type_id) VALUES ('Eyeliner', 1);
INSERT INTO product_category (product_category, product_type_id) VALUES ('Mascara', 1);
INSERT INTO product_category (product_category, product_type_id) VALUES ('Lipstick', 1);
INSERT INTO product_category (product_category, product_type_id) VALUES ('Lipgloss', 1);
INSERT INTO product_category (product_category, product_type_id) VALUES ('Lipstain', 1);
INSERT INTO product_category (product_category, product_type_id) VALUES ('Lipliner', 1);
INSERT INTO product_category (product_category, product_type_id) VALUES ('Eyebrow pencil', 1);
INSERT INTO product_category (product_category, product_type_id) VALUES ('Eyebrow gel', 1);
INSERT INTO product_category (product_category, product_type_id) VALUES ('Primer', 1);
INSERT INTO product_category (product_category, product_type_id) VALUES ('Setting spray', 1);
INSERT INTO product_category (product_category, product_type_id) VALUES ('Setting powder', 1);

-- Skincare products
INSERT INTO product_category (product_category, product_type_id) VALUES ('Facemask', 2);
INSERT INTO product_category (product_category, product_type_id) VALUES ('Cleanser', 2);
INSERT INTO product_category (product_category, product_type_id) VALUES ('Toner', 2);
INSERT INTO product_category (product_category, product_type_id) VALUES ('Serum', 2);
INSERT INTO product_category (product_category, product_type_id) VALUES ('Moisturizer', 2);
INSERT INTO product_category (product_category, product_type_id) VALUES ('Eye cream', 2);
INSERT INTO product_category (product_category, product_type_id) VALUES ('Lipbalm', 2);
INSERT iNTO product_category (product_category, product_type_id) values ('Lipoil', 2);
INSERT iNTO product_category (product_category, product_type_id) values ('Lipmask', 2);
INSERT INTO product_category (product_category, product_type_id) VALUES ('Sunscreen', 2);
INSERT INTO product_category (product_category, product_type_id) VALUES ('Face oil', 2);
INSERT INTO product_category (product_category, product_type_id) VALUES ('Face scrub', 2);
INSERT INTO product_category (product_category, product_type_id) VALUES ('Vitamins', 2);
INSERT INTO product_category (product_category, product_type_id) VALUES ('Eye mask', 2);
INSERT INTO product_category (product_category, product_type_id) VALUES ('Illuminator', 2);

INSERT INTO zone (zone) VALUES ('Face');
INSERT INTO zone (zone) VALUES ('Eyes');
INSERT INTO zone (zone) VALUES ('Lips');
INSERT INTO zone (zone) VALUES ('Brows');
INSERT INTO zone (zone) VALUES ('Lashes');

INSERT INTO time_of_day (time_of_day) VALUES ('Morning');
INSERT INTO time_of_day (time_of_day) VALUES ('Night');
INSERT INTO time_of_day (time_of_day) VALUES ('All day');

INSERT INTO occasion (occasion) VALUES ('Casual');
INSERT INTO occasion (occasion) VALUES ('Party');
INSERT INTO occasion (occasion) VALUES ('Wedding');
INSERT INTO occasion (occasion) VALUES ('Work');
INSERT INTO occasion (occasion) VALUES ('Date');
INSERT INTO occasion (occasion) VALUES ('Festival');
INSERT INTO occasion (occasion) VALUES ('Photoshoot');
INSERT INTO occasion (occasion) VALUES ('Natural');
INSERT INTO occasion (occasion) VALUES ('Glam');

INSERT INTO user_role (user_role) VALUES ('Admin');
INSERT INTO user_role (user_role) VALUES ('User');


