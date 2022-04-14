-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Gép: localhost:3306
-- Létrehozás ideje: 2022. Ápr 14. 20:16
-- Kiszolgáló verziója: 10.3.34-MariaDB-cll-lve
-- PHP verzió: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `csongra3_kviz`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `comment`
--

CREATE TABLE `comment` (
  `sorszam` int(8) NOT NULL,
  `username` varchar(20) COLLATE utf8_hungarian_ci NOT NULL,
  `ideje` timestamp NOT NULL DEFAULT current_timestamp(),
  `comment` varchar(500) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `gamemode1`
--

CREATE TABLE `gamemode1` (
  `usernev` varchar(20) COLLATE utf8_hungarian_ci NOT NULL,
  `okanswer` int(4) NOT NULL,
  `questnumber` int(4) NOT NULL,
  `jatekido` time NOT NULL,
  `pontszam` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `gamemode2`
--

CREATE TABLE `gamemode2` (
  `usernev` varchar(20) COLLATE utf8_hungarian_ci NOT NULL,
  `okanswer` int(4) NOT NULL,
  `questnumber` int(4) NOT NULL,
  `jatekido` time NOT NULL,
  `pontszam` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kerdesvalasz`
--

CREATE TABLE `kerdesvalasz` (
  `sorszam` int(8) NOT NULL,
  `kerdes` varchar(256) COLLATE utf8_hungarian_ci NOT NULL,
  `valasz1` varchar(256) COLLATE utf8_hungarian_ci NOT NULL,
  `valasz2` varchar(256) COLLATE utf8_hungarian_ci NOT NULL,
  `valasz3` varchar(256) COLLATE utf8_hungarian_ci NOT NULL,
  `valasz4` varchar(256) COLLATE utf8_hungarian_ci NOT NULL,
  `helyesvalasz` int(1) NOT NULL,
  `pontertek` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `toplista`
--

CREATE TABLE `toplista` (
  `id` int(8) NOT NULL,
  `username` varchar(16) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `score` int(4) NOT NULL,
  `jatekido` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- A tábla adatainak kiíratása `toplista`
--

INSERT INTO `toplista` (`id`, `username`, `score`, `jatekido`) VALUES
(5, 'PrÃ³ba01', 1, '2022-04-14 13:24:06'),
(6, 'PrÃ³ba01', 36, '2022-04-14 13:25:15'),
(7, 'PrÃ³ba01', 7, '2022-04-14 13:29:27'),
(8, 'PrÃ³ba01', 11, '2022-04-14 13:33:45'),
(9, 'PrÃ³ba01', 5, '2022-04-14 13:36:41'),
(10, 'PrÃ³ba01', 0, '2022-04-14 13:38:12'),
(12, 'PrÃ³ba01', 2, '2022-04-14 14:41:48'),
(13, 'PrÃ³ba01', 7, '2022-04-14 14:45:12'),
(14, 'PrÃ³ba01', 6, '2022-04-14 15:03:22'),
(15, 'PrÃ³ba01', 17, '2022-04-14 15:04:29'),
(16, 'PrÃ³ba01', 8, '2022-04-14 15:15:25');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `email` varchar(200) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `created_at`) VALUES
(6, 'Proba1', '$2y$10$bu37sA.7BgCGaBl9VDnPoeMB.zEHPXtwsq9.BxYoMdNVFDqsRIpPG', 'kukoriku@gmail.com', '2022-03-31 13:59:35'),
(7, 'Proba01', '$2y$10$ilh9E/3qcz3tg7vq3rwdvu9/IeRBCeDGnUPVpvs3Wl7fHIuvxaadq', 'kukoriku@gmail.com', '2022-04-01 15:14:35'),
(8, 'PrÃ³ba01', '$2y$10$N0rKI0OMBVaJRI5SDDGtb.IASP//Wb7wLm.V1R0p4mpCHwqZ0Ww4e', 'mokuslekvar01@gmail.com', '2022-04-01 15:16:17'),
(9, 'MrDanielHarka', '$2y$10$tU2wyai7K.Ax1hXZL2OH1OKC92etIE5fEf8mLXqdG6Bung1p7ztCu', 'daniel@harka.com', '2022-04-09 19:36:20'),
(10, 'Szuper Andras', '$2y$10$nUD1aEUP3nbkLytcXKD6l.4oo3kcO6t8r5TZiLNPUHJKB1kc9E3pm', 'szuperandrasmarcell@gmail.com', '2022-04-10 20:09:15'),
(12, 'samsung0104', '$2y$10$yQKtD4qiVe0Ks/qTn6NdeeCz9pKUCESULyHpA3XNq/fIE5VF3MQz6', 'patrik20010104@gmail.com', '2022-04-13 22:48:58');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`username`);

--
-- A tábla indexei `gamemode1`
--
ALTER TABLE `gamemode1`
  ADD PRIMARY KEY (`usernev`);

--
-- A tábla indexei `gamemode2`
--
ALTER TABLE `gamemode2`
  ADD PRIMARY KEY (`usernev`);

--
-- A tábla indexei `kerdesvalasz`
--
ALTER TABLE `kerdesvalasz`
  ADD PRIMARY KEY (`sorszam`);

--
-- A tábla indexei `toplista`
--
ALTER TABLE `toplista`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `kerdesvalasz`
--
ALTER TABLE `kerdesvalasz`
  MODIFY `sorszam` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `toplista`
--
ALTER TABLE `toplista`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `gamemode1`
--
ALTER TABLE `gamemode1`
  ADD CONSTRAINT `gamemode1_ibfk_1` FOREIGN KEY (`usernev`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gamemode1_ibfk_2` FOREIGN KEY (`usernev`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `gamemode2`
--
ALTER TABLE `gamemode2`
  ADD CONSTRAINT `gamemode2_ibfk_1` FOREIGN KEY (`usernev`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gamemode2_ibfk_2` FOREIGN KEY (`usernev`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
