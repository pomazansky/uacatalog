
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- blog
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `blog`;

CREATE TABLE `blog`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    `text` TEXT NOT NULL,
    `image` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- product
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `price` DOUBLE,
    `description` TEXT NOT NULL,
    `images` TEXT NOT NULL,
    `category_id` INTEGER NOT NULL,
    `manufacturer_id` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `product_fi_904832` (`category_id`),
    INDEX `product_fi_26eba6` (`manufacturer_id`),
    CONSTRAINT `product_fk_904832`
        FOREIGN KEY (`category_id`)
        REFERENCES `category` (`id`),
    CONSTRAINT `product_fk_26eba6`
        FOREIGN KEY (`manufacturer_id`)
        REFERENCES `manufacturer` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- category
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `parent_id` INTEGER,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- manufacturer
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `manufacturer`;

CREATE TABLE `manufacturer`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `url` VARCHAR(255),
    `shops` TEXT,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
