
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
  `first_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(150) NOT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `last_name` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;;

-- Example entries for ZodiacSigns
INSERT INTO `zodiac` (`sign_name`, `description`, `image_url`) VALUES
('Aries', 'Aries are bold and ambitious, diving headfirst into even the most challenging situations.', 'https://cdn.britannica.com/84/13384-004-ECCA3832/Aries-illumination-Book-of-Hours-Italian-Pierpont.jpg'),
('Taurus', 'Taurus is an earth sign represented by the bull. They enjoy relaxing environments filled with soft sounds.', 'https://cdn.britannica.com/96/4596-004-1E0712A4/Taurus-Book-of-Hours-Italian-Pierpont-Morgan.jpg'),
('Gemini', 'Gemini is playful and curious, constantly juggling a variety of passions, hobbies, and friends.', 'https://cdn.britannica.com/64/136164-004-6A4FC8FA/Gemini-zodiac-sign.jpg'),
('Cancer', 'Cancer is a deeply intuitive and emotional sign, often caring deeply for their loved ones.', 'https://cdn.britannica.com/96/137996-004-BA8B2E2E/Cancer-zodiac-sign.jpg'),
('Leo', 'Leo is represented by the lion and is known for their charisma, creativity, and confidence.', 'https://cdn.britannica.com/88/135788-004-ABDBD6AC/Leo-zodiac-sign.jpg'),
('Virgo', 'Virgo is logical, practical, and systematic in their approach to life.', 'https://cdn.britannica.com/04/138504-004-D03FA52D/Virgo-zodiac-sign.jpg'),
('Libra', 'Libra is an air sign represented by the scales and is known for their love of balance and harmony.', 'https://cdn.britannica.com/28/134428-004-35F2F790/Libra-zodiac-sign.jpg'),
('Scorpio', 'Scorpio is passionate, assertive, and resourceful, often known for their intensity.', 'https://cdn.britannica.com/16/134416-004-166BBACF/Scorpio-zodiac-sign.jpg'),
('Sagittarius', 'Sagittarius is a fire sign, known for their adventurous spirit and love of travel.', 'https://cdn.britannica.com/44/135444-004-B3C03A61/Sagittarius-zodiac-sign.jpg'),
('Capricorn', 'Capricorn is disciplined and responsible, often taking a practical approach to achieving their goals.', 'https://cdn.britannica.com/84/13384-004-ECCA3832/Aries-illumination-Book-of-Hours-Italian-Pierpont.jpg'),
('Aquarius', 'Aquarius is an air sign known for their progressive ideas, creativity, and humanitarian outlook.', 'https://cdn.britannica.com/24/133924-004-FD2C1B95/Aquarius-zodiac-sign.jpg'),
('Pisces', 'Pisces is empathetic, artistic, and often deeply connected to their emotions.', 'https://cdn.britannica.com/24/137924-004-FD2C1B95/Pisces-zodiac-sign.jpg');

-- Example entries for Users

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;