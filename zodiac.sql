
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

-- Create table for Zodiac Signs
CREATE TABLE `zodiac` (
    `sign_name` VARCHAR(100) DEFAULT NULL,
    `description` VARCHAR(255) DEFAULT NULL,
    `image_url` VARCHAR(255) DEFAULT NULL
);
 
-- Create table for Users
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `is_admin` int(1) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(150) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(150) NOT NULL,
  `birthday` date NOT NULL,  
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Example entries for ZodiacSigns
INSERT INTO `zodiac` (`sign_name`, `description`, `image_url`) VALUES
('Aries', 'Aries are bold and ambitious, diving headfirst into even the most challenging situations.', 'https://i.pinimg.com/736x/a9/5c/73/a95c734313804ed2ede38483868a08d1.jpg'),--
('Taurus', 'Taurus is an earth sign represented by the bull. They enjoy relaxing environments filled with soft sounds.', 'https://i.pinimg.com/736x/2a/87/02/2a8702f61089e2eb5af7cf3e3b137485.jpg'),--
('Gemini', 'Gemini is playful and curious, constantly juggling a variety of passions, hobbies, and friends.', 'https://i.pinimg.com/736x/3a/b7/48/3ab74816be5bda0b2c5a6ac1c3c0bafd.jpg'),--
('Cancer', 'Cancer is a deeply intuitive and emotional sign, often caring deeply for their loved ones.', 'https://i.pinimg.com/736x/93/59/82/9359825b07e306e4d044c8e506ede579.jpg'),--
('Leo', 'Leo is represented by the lion and is known for their charisma, creativity, and confidence.', 'https://i.pinimg.com/736x/dd/3c/21/dd3c21640b77e6ed63e93fe29b1d6bb9.jpg'),--
('Virgo', 'Virgo is logical, practical, and systematic in their approach to life.', 'https://i.pinimg.com/736x/c1/84/7e/c1847e2c5ece6d73827f2fa64b33a02b.jpg'),--
('Libra', 'Libra is an air sign represented by the scales and is known for their love of balance and harmony.', 'https://i.pinimg.com/736x/8c/33/f4/8c33f4c1f2fb134a566e343b71954640.jpg'),--
('Scorpio', 'Scorpio is passionate, assertive, and resourceful, often known for their intensity.', 'https://i.pinimg.com/736x/95/38/3f/95383fa03a3e45189b4deadd1e5bae56.jpg'),--
('Sagittarius', 'Sagittarius is a fire sign, known for their adventurous spirit and love of travel.', 'https://i.pinimg.com/736x/79/46/9c/79469cc60fce052cad3295a6bb7c2d49.jpg'),--
('Capricorn', 'Capricorn is disciplined and responsible, often taking a practical approach to achieving their goals.', 'https://i.pinimg.com/736x/3e/2d/37/3e2d379772bccbe761c50e82c6bd8f2b.jpg'),--
('Aquarius', 'Aquarius is an air sign known for their progressive ideas, creativity, and humanitarian outlook.', 'https://i.pinimg.com/736x/a7/66/56/a7665620fea5f1ebea01a88d446ef22b.jpg'),
('Pisces', 'Pisces is empathetic, artistic, and often deeply connected to their emotions.', 'https://i.pinimg.com/736x/18/1b/aa/181baaa58a98adffd78fef95f4f122a6.jpg');--

-- Example entries for Users

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;