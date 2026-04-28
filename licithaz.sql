-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2026. Ápr 28. 13:20
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `licithaz`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `bids`
--

CREATE TABLE `bids` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount` int(11) NOT NULL DEFAULT 1000,
  `auction_item_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_02_12_165109_create_products_table', 1),
(5, '2026_02_12_165120_create_bids_table', 1),
(6, '2026_03_05_092131_create_personal_access_tokens_table', 1),
(7, '2026_04_26_085127_create_payments_table', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `amount` bigint(20) UNSIGNED NOT NULL,
  `is_paid` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `extended_description` text NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `starter_bid` int(11) NOT NULL DEFAULT 1000,
  `bid_start_date` datetime NOT NULL,
  `bid_end_date` datetime NOT NULL,
  `category` enum('Electronics','Books','Clothing','House','Sports','Vehicles','Jewelry') NOT NULL DEFAULT 'Electronics',
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `winner_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `extended_description`, `image_url`, `starter_bid`, `bid_start_date`, `bid_end_date`, `category`, `status`, `winner_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Mikro - SAMSUNG MS23K3513AK/EO ', 'Mikrohullámú sütő - szabadon álló, 1250 W teljesítmény, vezérlés nyomógomb segítségével, 23 l belső űrtartalom, 6 teljesítményfokozat, 800W mikrohullám teljesítmény, 28,8 cm átmérőjű forgótányér, kiolvasztás, automata programok, balra nyíló ajtó, tartozék forgótányér, külső méretei 27,5 × 48,9 × 37,4 cm (ma × szé × mé), belső méretei 21,1 × 33 × 32,4 cm (ma × szé × mé)', 'Sit non quaerat consequuntur explicabo ea soluta inventore dolor. Iusto temporibus et atque veritatis. Quas libero voluptates eos dicta cum. Eligendi at maxime magnam dolorem in est quaerat. Quo tenetur quasi atque provident. Assumenda ut odio qui. Perspiciatis sunt sunt assumenda voluptatem perferendis voluptatem iste. Numquam rem quisquam accusamus cupiditate. Repudiandae minus quasi voluptatum omnis qui impedit qui. Itaque laudantium sint numquam numquam nobis. Cum quos at dicta totam. Rem commodi aliquid et nisi neque tempore qui. Modi architecto eos et sint sit laboriosam sunt. Delectus cum commodi et ut. Deserunt eum error non. Voluptates corporis error qui eligendi qui quia quasi. Minus velit dicta soluta eum enim eius iste. Eaque labore quam et molestiae non. Laborum impedit maiores voluptas animi harum adipisci accusantium. Qui aliquid fuga sit in molestiae aliquam impedit.', 'https://image.alza.cz/products/SAMMW010/SAMMW010.jpg?width=800&height=800', 39990, '2026-04-26 12:13:06', '2026-05-03 21:48:06', 'Electronics', 'active', NULL, '2026-04-28 11:16:06', '2026-04-28 11:16:06', NULL),
(2, 'Hütő - BOSCH KGV58VLEAS', 'Hűtőszekrény fagyasztóval - E energiaosztály, 376 l hűtőszekrény kapacitás, 124 l fagyasztó kapacitás, 4 polc, opcionálisan elhelyezhető pántok, kijelző és LED világítás, automatikus hűtő leolvasztás, LowFrost, méretei 191 × 70 × 77 cm (ma × szé × mé)', 'Corporis nihil consequatur accusamus eligendi. Atque numquam neque rerum unde mollitia suscipit ea. Ipsum delectus sint dolor minus. Quia animi maxime vero voluptatem explicabo at. Ea qui asperiores dolore consequatur et animi magni. Autem dignissimos et possimus quod ipsam et a nisi. Error velit vero corporis velit. Pariatur alias odit et hic. Itaque ex ut et molestiae veritatis debitis. Voluptas quae excepturi ullam ullam laborum tempore. Et et harum quisquam nam quaerat numquam non modi. Nostrum dolores dolores officia velit sit. Voluptatem voluptas iusto odio maiores aut soluta alias. Et et quibusdam labore sed quidem perspiciatis id. Ut dolor iure et maiores. Maxime deleniti reprehenderit qui sed placeat. Necessitatibus ullam sunt ea pariatur corrupti deserunt. Cupiditate doloribus laborum quas. Enim perferendis aut quia. Ut dolores recusandae quisquam fugiat in maxime explicabo. Distinctio doloribus est veniam. Corporis non exercitationem et autem error ab ad. Qui qui aut eaque enim neque. Dolorem animi nulla est.', 'https://image.alza.cz/products/BOCHL172/BOCHL172.jpg?width=800&height=800', 249990, '2026-04-23 08:43:06', '2026-04-30 04:34:06', 'Electronics', 'active', NULL, '2026-04-28 11:16:06', '2026-04-28 11:16:06', NULL),
(3, 'Apple iPhone 15 128GB fekete', 'Okostelefon 6.1\" Super Retina XDR kijelzővel, A16 Bionic chip, 48 MP kamera rendszer, Face ID, 5G támogatás.', 'Quo molestiae id autem dolores eum. Atque nulla doloremque unde corporis et at et. Similique ad earum nihil maiores sint esse aut ex. Perferendis accusamus velit at nemo. Nisi omnis nam odit tenetur voluptatum. Ut eligendi ut voluptas iure magni nihil ut. Beatae omnis officia sit nihil iusto magni eum. Perferendis voluptatibus magni hic dolorem qui atque nostrum. Numquam praesentium dolorum molestiae architecto ex. Eum aut aut a debitis consequuntur voluptatum ad. Voluptatem ea voluptatem impedit quibusdam ad officia rerum. Officia sed corrupti qui. Culpa quis minima quo exercitationem ut exercitationem. Consequatur sequi reprehenderit saepe possimus accusamus vero temporibus at. Unde dignissimos omnis necessitatibus consequuntur nulla consequuntur. Voluptates sit ut ut minima. Numquam ducimus odit officiis saepe esse sunt est consequatur. Maxime ut laudantium natus et qui. Molestias pariatur error quo. Architecto ut totam in ut in. Suscipit ipsum quo quo consequatur ut sit. Fuga eius quia totam. In quia a porro numquam numquam velit. Iure sit nobis quisquam quos est sit officia recusandae. Perferendis ut voluptas facilis ipsa. Consectetur illo sint ut quod voluptatem.', 'https://image.alza.cz/products/HRI045b1/HRI045b1.jpg?width=800&height=800', 389990, '2026-04-26 01:30:06', '2026-05-04 01:56:06', 'Electronics', 'active', NULL, '2026-04-28 11:16:06', '2026-04-28 11:16:06', NULL),
(4, 'Samsung Galaxy Tab S9', '11\" AMOLED kijelző, Snapdragon 8 Gen 2, S Pen támogatás, 256GB tárhely.', 'Suscipit vero omnis nostrum ducimus. Magni ipsum quasi voluptatem beatae beatae omnis sit neque. Asperiores necessitatibus quasi dolores cumque distinctio modi et minima. Numquam iste modi rerum et. A vel inventore aperiam voluptatem voluptate aut nostrum. Enim aliquam qui rerum ullam. Soluta nulla eius blanditiis. Veritatis dolor sit delectus voluptatem praesentium non dolorum quis. Aut ut corrupti voluptatem excepturi repudiandae fugiat. Error voluptatem amet sit enim voluptate eaque reprehenderit. Fugit sint non ut voluptatem modi. Est magnam rem unde eius animi voluptates. Quis aut est perferendis iusto modi omnis quidem. Nostrum sapiente consequatur quia voluptatibus ipsa. Et quia voluptatem dolor in ea et aliquam. Delectus ipsam cum voluptatem neque.', 'https://assets.mmsrg.com/isr/166325/c1/-/ASSET_MMS_127814357?x=1800&y=1800&format=jpg&quality=80&sp=yes&strip=yes&trim&ex=1800&ey=1800&align=center&resizesource&unsharp=1.5x1+0.7+0.02&cox=0&coy=0&cdx=1800&cdy=1800', 329990, '2026-04-23 07:39:06', '2026-04-29 22:01:06', 'Electronics', 'active', NULL, '2026-04-28 11:16:06', '2026-04-28 11:16:06', NULL),
(5, 'Harry Potter és a Bölcsek Köve', 'J. K. Rowling klasszikus fantasy regénye, keménykötéses kiadás.', 'Rem molestiae aliquam hic hic. Error et dolor quia eum enim accusamus. A molestiae placeat et maiores expedita earum consectetur. Voluptatem id labore ullam eaque mollitia aspernatur velit. Iusto est corporis aut. Incidunt deleniti eos quos et asperiores quia in. Laborum aut quia facilis incidunt. Nihil explicabo incidunt provident sed quam ea autem. Aperiam corrupti dolorum eveniet consequuntur eos omnis ab. Quod beatae quibusdam porro qui. Et sapiente quis minima ex voluptatibus ut. Et quod quam voluptas nostrum quasi. Ab placeat impedit ad magni aut voluptatem. Et sunt neque aut. Facere numquam illo tempora. Quod tenetur quos et rerum dolor nihil. Odit qui ut qui et. Nesciunt voluptatum accusantium debitis neque consequatur.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS6n1FjUsoFf5JL4gjUn2S2UtCpvpJCJEqJhQ&s', 4990, '2026-04-21 18:20:06', '2026-05-05 10:20:06', 'Books', 'active', NULL, '2026-04-28 11:16:06', '2026-04-28 11:16:06', NULL),
(6, 'A hobbit - J. R. R. Tolkien', 'Fantasy regény Bilbó utazásáról, puhatáblás kiadás.', 'Blanditiis veniam voluptatem assumenda saepe nobis voluptas rerum. Sint incidunt est autem excepturi quis. Commodi quaerat nihil ipsa rerum. Ut officiis enim illum aut accusamus. Quia natus suscipit et corporis debitis assumenda. Architecto perferendis asperiores aliquid nesciunt rerum recusandae. Vitae consequatur dolore molestiae hic ut. Id est maxime consectetur ut eveniet nulla. Voluptatem deserunt aut nam harum. Est quas ipsam ad. Mollitia eaque quidem est nesciunt id totam. Et ea sequi autem laborum. Aut ut laudantium consequatur quia voluptas ratione.', 'https://lira.erbacdn.net/upload/M_28/rek1/776/1949776.jpg', 3990, '2026-04-27 00:01:06', '2026-04-29 18:20:06', 'Books', 'active', NULL, '2026-04-28 11:16:06', '2026-04-28 11:16:06', NULL),
(7, 'Nike Air Max 270', 'Sportcipő légbetétes talppal, mindennapi használatra és sporthoz.', 'Nihil mollitia eos consequatur. Voluptatem quia aperiam voluptatum eos ex architecto. Dignissimos distinctio non pariatur necessitatibus animi non nulla. Est harum et quas omnis et inventore aliquid. Itaque facere quasi veritatis hic. Dolores aperiam nesciunt illum quaerat. Voluptatum voluptatem officia adipisci commodi est et in. Distinctio est ut dignissimos maxime dolorum iusto et quia. Tempora dolorum est et accusantium. Totam debitis ut iure et rerum. Dolor placeat voluptate vero provident omnis similique. Reiciendis omnis non quo impedit distinctio. Neque autem aliquam dolor quis.', 'https://sportano.hu/img/986c30c27a3d26a3ee16c136f92f4ff5/6/6/666003558919_20-jpg/nike-air-max-270-ferfi-cipo-fekete-fekete-fekete-fekete-1687233.jpg', 54990, '2026-04-27 01:01:06', '2026-04-29 12:43:06', 'Clothing', 'active', NULL, '2026-04-28 11:16:06', '2026-04-28 11:16:06', NULL),
(8, 'Adidas Essentials Hoodie', 'Uniszex kapucnis pulóver, pamut anyag, kényelmes viselet.', 'Animi perferendis modi eaque ex et soluta rem ratione. Est doloremque et voluptas ad assumenda. Porro odit ipsum perspiciatis sint voluptates dolores. Qui ipsa est praesentium quam corrupti excepturi perspiciatis deserunt. Nisi quis veritatis ab consequatur id repudiandae iure. Sed hic et eum et culpa eum iure. Culpa rerum qui et explicabo sit qui. Molestiae cumque sit veritatis sed magnam neque. Vitae quaerat nemo cumque voluptatem aspernatur et inventore velit. Ut autem ut ipsam ea. Officia porro itaque nisi non pariatur consequatur tempore. Provident ea nostrum eum sunt. Velit at totam natus eos itaque. Id dolores et repellendus sint. Nostrum quia iste consequatur. Unde perspiciatis sed molestias et. Veniam qui sunt nesciunt omnis. Et veniam dolores voluptas tempore saepe delectus possimus et. In et autem odio molestias. Doloribus cumque aliquid harum nostrum qui enim.', 'https://i.sportisimo.com/products/images/2064/2064335/700x700/adidas-m-feelcozy-hoody_0.jpg', 19990, '2026-04-25 01:12:06', '2026-05-05 03:24:06', 'Clothing', 'active', NULL, '2026-04-28 11:16:06', '2026-04-28 11:16:06', NULL),
(9, 'IKEA MALM Komód', 'Modern komód 6 fiókkal, fehér színben, hálószobába vagy nappaliba.', 'Accusamus quia cumque architecto sed sapiente consequuntur adipisci. Et veritatis quisquam dignissimos natus tempora culpa quae. Non officiis aperiam soluta eaque amet. Facere error architecto omnis omnis odio accusantium ut placeat. Non enim fugit nam alias delectus veniam praesentium. Vel eos dicta suscipit laboriosam consequatur. Architecto suscipit sint et et. Omnis voluptatum aut voluptatibus excepturi voluptas. Ipsa velit eligendi aut et. Quo praesentium rerum aut error ut vitae. Inventore veritatis non error assumenda facere est tempora. A laborum nesciunt mollitia illo vitae a qui culpa. Quia repudiandae soluta dolores voluptatem ut quas. Commodi tempora soluta odio eveniet perspiciatis ipsum aliquid. Illum autem cumque consequatur. Ut corporis omnis cupiditate eum rerum. Molestias temporibus qui eveniet libero. Dolore harum qui provident porro eveniet. Ea et voluptas repellat saepe enim nostrum voluptas. Iste ut non qui sint sequi nobis. Temporibus eligendi nobis sequi at veniam maxime doloribus quod. Natus aliquid rem consectetur enim a iure accusantium. Amet aut aut distinctio ut eos quo dolorem. In tenetur qui qui iste adipisci rem. Aut ut consequatur molestias ab. Consectetur eaque quidem at blanditiis temporibus aspernatur. Corporis aperiam qui aut earum asperiores earum ullam. Hic quas reprehenderit consequatur laudantium atque et.', 'https://www.ikea.com/hu/hu/images/products/malm-4-fiokos-szekreny-fekete-barna__0484876_pe621355_s5.jpg', 44990, '2026-04-26 11:45:06', '2026-05-01 02:40:06', 'House', 'active', NULL, '2026-04-28 11:16:06', '2026-04-28 11:16:06', NULL),
(10, 'Philips Hue Starter Kit', 'Okos világítási csomag, állítható színű LED izzókkal.', 'Sapiente ipsam sunt cupiditate sint. Id eaque quos praesentium est autem. Reprehenderit quibusdam iusto et totam quae dolores architecto et. Blanditiis occaecati quaerat odit porro quam possimus. Aliquid et maxime architecto aliquam qui corporis. Natus incidunt sapiente veniam quibusdam id est voluptas et. Ducimus ut fugit minima voluptatum. Dolores excepturi est quis sunt blanditiis omnis facilis quia. Sunt non voluptatem omnis autem sunt dolorem. Exercitationem praesentium delectus perferendis qui placeat dolore. Molestiae provident omnis odit quia autem. Voluptate itaque id cupiditate eum aperiam. Magni expedita earum possimus officia blanditiis fugit quia. Quis similique praesentium sed expedita. Fuga eum tempora nulla. Dolorum corporis error dolore odit saepe eligendi. Quo accusamus magni error fugit nam suscipit illo. Numquam quam nulla eaque. Quibusdam totam nemo maxime dolorum. Ipsum nesciunt deserunt quis in. Est facere repudiandae odit deleniti reprehenderit et non ut. Recusandae accusamus pariatur ipsum nihil consequuntur voluptas.', 'https://www.lampak.hu/kezdocsomag-philips-hue-starter-kit-white-3xe27-9w-2700k-kozponti-egyseg-img-p3081-fd-3.jpg', 59990, '2026-04-24 17:44:06', '2026-05-01 14:15:06', 'House', 'active', NULL, '2026-04-28 11:16:06', '2026-04-28 11:16:06', NULL),
(11, 'Adidas UEFA Champions League Labda', 'Hivatalos meccslabda, prémium varrással.', 'Corporis quae exercitationem voluptatem amet autem. Quia dicta voluptatem at suscipit atque rem nihil. Praesentium sequi voluptatem quia architecto quo iure consequuntur molestiae. Blanditiis quia tenetur enim eius minus. Et inventore consequuntur exercitationem repellendus et sint repellendus. Quis aliquid autem qui laborum perferendis. Repellat atque blanditiis id cupiditate. Explicabo iste voluptas corrupti quod veniam. Aliquid sed ut excepturi non enim tempore aut. Eligendi consectetur dolor et ullam. Porro magnam recusandae dolorem et in. Velit iste nesciunt vel delectus. Vero temporibus iste sapiente natus neque totam. Ipsam expedita accusantium eos voluptate. Sed aut eveniet magni dolores rerum. Vel iusto rerum debitis minima deserunt corrupti nobis. Praesentium aut in est doloremque voluptatem possimus. Nisi maiores suscipit sapiente deleniti numquam. Et pariatur ad et nihil unde ipsa et. Aut repudiandae dolor omnis quis quo id.', 'https://image.1ntersport.com/storage/products-new/4A/94/4A944CABC1D82E5A5704BD6731AF443FA4ca.1125x1125.jpg', 12990, '2026-04-23 23:13:06', '2026-05-03 04:49:06', 'Sports', 'active', NULL, '2026-04-28 11:16:06', '2026-04-28 11:16:06', NULL),
(12, 'Kettler Fitness Kerékpár', 'Otthoni szobakerékpár LCD kijelzővel és állítható ellenállással.', 'Quae ipsum et perferendis adipisci. Rerum eos nobis fugiat. Vero quo rem sit culpa. Quia molestiae sint nobis consequatur iure. Voluptatibus voluptatem ipsam est. Fuga omnis deserunt sint omnis quae fugiat voluptate. Et sed fugiat dolorem iste. Nulla possimus incidunt et unde eum vel deserunt sed. Inventore velit voluptatem quidem. Ipsa ea id illo voluptate numquam et maiores recusandae. Repudiandae eligendi sed dicta sit adipisci vitae. Dolores officia possimus voluptatibus earum eligendi. Quia molestiae pariatur dolorem incidunt quaerat. Maxime ut nihil culpa tempora incidunt animi eligendi. Ut neque est qui. Voluptatem rem omnis repellendus in. Ut vitae sed velit pariatur dolores in repudiandae. Quasi illum omnis aliquam at iure porro eaque voluptas. Porro perspiciatis delectus harum qui fugit. Suscipit ratione nostrum rerum reprehenderit sed. Fugit officiis reiciendis pariatur nisi. Iste voluptates dignissimos voluptates vitae cum molestiae. Deleniti quos adipisci autem est. Sapiente veniam totam id consequatur aut accusantium odit. Excepturi et hic impedit. Libero tempore possimus voluptatem minus ut omnis inventore. Et ea deleniti voluptatem illum.', 'https://example.com/bike.jpg', 89990, '2026-04-24 10:21:06', '2026-05-04 21:38:06', 'Sports', 'active', NULL, '2026-04-28 11:16:06', '2026-04-28 11:16:06', NULL),
(13, 'Toyota Corolla 1.8 Hybrid', 'Hibrid személyautó, alacsony fogyasztással és modern biztonsági rendszerekkel.', 'Nam nemo quasi velit eos aut atque. Sit velit voluptatem animi exercitationem aperiam necessitatibus. Officiis sit illum esse laudantium. In voluptas fugit est neque suscipit. Eum nihil labore non ducimus aperiam commodi. Velit ut fuga quia et ut quidem esse. Voluptatibus ea vel provident vitae ut. Consectetur aut vero quos repellendus. Quos et minima corrupti at. Quos vel quo labore voluptates maxime. Est vel odit cum quis eos doloremque. Provident magni at aut voluptatem repudiandae. Perferendis quia ut natus iste nihil ipsum deleniti. Dolorum repudiandae placeat velit nemo. Est quis velit voluptas impedit placeat. Atque nostrum id qui. Quisquam enim eum modi. Voluptates voluptatem vel reiciendis est. Dolorem labore reprehenderit vel earum incidunt facilis quia natus. Dicta debitis debitis iste pariatur quod dolores accusantium. Maiores architecto iure mollitia id. Amet at illo unde veritatis quisquam.', 'https://example.com/corolla.jpg', 10999000, '2026-04-27 02:54:06', '2026-05-01 18:58:06', 'Vehicles', 'active', NULL, '2026-04-28 11:16:06', '2026-04-28 11:16:06', NULL),
(14, 'Yamaha YZF-R3 Motor', 'Sportmotor 321cc motorral, könnyű kezelhetőség.', 'In amet temporibus ut illo et delectus placeat. Odit necessitatibus laboriosam perferendis reprehenderit eum dolorem molestiae est. Excepturi sit quia voluptas quia natus. Occaecati perferendis mollitia est aut dolorem. Facere dolore dignissimos quod provident aut. Quis sit quaerat non magnam totam praesentium. In labore odio aperiam eius. Ea iusto et in porro enim accusamus nesciunt. Illo optio cupiditate itaque voluptas eius. Veniam voluptate ut voluptatibus asperiores rem exercitationem. Qui atque similique optio sit fugiat. Consequatur quod aut vel incidunt natus quisquam. Saepe aut dolorem dolores tempora. Voluptatum illo esse ea sed. Aspernatur dicta eveniet enim incidunt labore omnis quisquam. Temporibus et provident ipsum laudantium. Quia quam iusto deserunt id quia soluta. Sit ullam dolores qui earum animi culpa. Dolores aut facere voluptas reprehenderit. Ut beatae odio non nihil sed culpa. Sed aperiam accusamus possimus ad fuga.', 'https://example.com/yamaha.jpg', 2299000, '2026-04-27 11:00:06', '2026-05-03 21:50:06', 'Vehicles', 'active', NULL, '2026-04-28 11:16:06', '2026-04-28 11:16:06', NULL),
(15, '14K Arany Gyűrű', 'Elegáns arany gyűrű minimalista dizájnnal.', 'Enim deserunt nisi doloribus et consequatur ut. Architecto aut ipsam veniam qui. Delectus nulla iste qui nobis aut facere eaque qui. Quam sunt possimus dolorem sint. Facilis et rem inventore enim et. Vel accusantium dolore qui rerum qui. Aut eveniet cumque expedita. Velit qui et unde ut. Nihil maiores omnis voluptas suscipit sint repellat maiores. Perspiciatis a quia rerum consequatur temporibus ut eos. Eum quis dolore sit inventore. Earum maiores aspernatur debitis placeat. Et odit qui delectus quia nam. Nostrum sequi aspernatur animi voluptatibus. Quia mollitia in consequatur ipsa qui ipsum. Necessitatibus quisquam nemo ea modi mollitia reprehenderit ducimus enim. Velit accusantium voluptatem expedita vitae reiciendis et. Minima voluptatem maiores inventore inventore. Ut tempora perspiciatis totam. Itaque quam qui et nisi eligendi ea. Eaque veniam et nisi id ut necessitatibus perferendis. Nesciunt dolores officia dolor ut facere eos neque. Aut soluta soluta aut facere vero. Aspernatur perferendis corporis ut voluptas eveniet expedita adipisci quae. Illum et quia sapiente molestiae facilis laudantium ea. Aut dolorum enim qui aspernatur. Qui aperiam consequatur dicta deleniti reiciendis doloribus voluptate. Exercitationem sint enim fugit velit voluptatem suscipit.', 'https://example.com/ring.jpg', 89990, '2026-04-24 01:53:06', '2026-05-05 02:56:06', 'Jewelry', 'active', NULL, '2026-04-28 11:16:06', '2026-04-28 11:16:06', NULL),
(16, 'Swarovski Nyaklánc', 'Kristály díszítésű nyaklánc, ajándéknak is tökéletes.', 'Consectetur magnam cum accusantium quaerat debitis et aliquid. Esse eligendi dolorem culpa qui temporibus et. Itaque ut maiores aliquid reprehenderit. Numquam velit veniam voluptatem praesentium cumque porro autem. Tempora accusamus magnam et illum rerum quas. Et ut nihil sint molestiae eum. Aut est doloribus vel et quisquam sed quae qui. Rem necessitatibus sit enim corporis occaecati reiciendis. Odio alias sed consequatur eos rerum modi. Quia a qui non optio. Vel voluptas consequatur labore accusamus magni aliquid facere excepturi. Natus qui est commodi at aut quo aut eum. Et quis totam enim culpa tenetur incidunt. Molestias qui sit explicabo recusandae maxime. Dolorum et voluptas quod vel maiores. Suscipit iste perspiciatis sit qui et voluptas. Sapiente culpa dolores delectus eos soluta odio minima. Modi inventore voluptate architecto voluptatibus corrupti pariatur aut rerum. Reprehenderit earum accusantium eligendi autem sequi assumenda. Rerum quo laborum tenetur est voluptate.', 'https://example.com/necklace.jpg', 34990, '2026-04-26 00:21:06', '2026-04-29 09:47:06', 'Jewelry', 'active', NULL, '2026-04-28 11:16:06', '2026-04-28 11:16:06', NULL),
(17, 'Sony WH-1000XM5 Fejhallgató', 'Zajszűrős vezeték nélküli fejhallgató prémium hangzással.', 'Sed quasi sint nostrum harum veniam omnis. Iure mollitia veniam corrupti voluptatem ex. Pariatur qui et quo officia quibusdam nisi illo. Accusantium consequatur aut eos perferendis ut quam. In rem qui ex reiciendis labore. Enim molestiae consequatur quibusdam animi sit. Alias animi rem qui quibusdam omnis. Culpa odit vel est asperiores inventore. Ut dolorem sed voluptatem praesentium. Et iusto fugiat ut eos cumque vel. Eveniet et et beatae iusto dolorum. Quidem laudantium ut tempora numquam. Eum sit maxime earum beatae vel. Veritatis quasi id officiis totam voluptatem corrupti accusantium. Vero eum voluptas laboriosam eius et magni. Dolorem dolorum ipsam id culpa numquam. Temporibus libero ullam ea vero laudantium quia ullam qui. In nam qui eum quidem non quidem. Voluptas ipsa fuga optio soluta voluptas. Aut et et id velit aut occaecati atque. Quia dolore ab aut maiores. Repellendus id et qui iusto. Error consequatur repellendus pariatur id. Quis minima quia voluptatem illo et aut. Ex perferendis consequatur sunt molestiae. Ducimus consequuntur cupiditate voluptatem atque quis ex. Dolore minus quos quas. Rerum rerum voluptas deserunt voluptate voluptatem et.', 'https://example.com/sony-headphones.jpg', 149990, '2026-04-24 00:16:06', '2026-05-04 17:54:06', 'Electronics', 'active', NULL, '2026-04-28 11:16:06', '2026-04-28 11:16:06', NULL),
(18, 'Canon EOS R10 Kamera', 'Tükör nélküli fényképezőgép 24.2 MP szenzorral.', 'Dignissimos aperiam molestiae autem dolore. Neque sequi dignissimos culpa odit reiciendis ipsa possimus dolores. Placeat eum rem minima quaerat rem. Voluptas quia ab consectetur unde dolor. Hic corporis et molestias vero architecto. Nemo aut impedit sit. Voluptatem voluptates nihil harum. Accusamus repudiandae voluptas aspernatur repellendus omnis et in. Eum vero reprehenderit atque nihil assumenda. Quidem deleniti aut aliquid eveniet. Sint voluptatem doloribus odio aut aliquam numquam. Neque iste voluptatem corporis mollitia voluptatem autem. Dicta ea consectetur cumque assumenda. Incidunt ad dicta ratione enim recusandae non reiciendis. Consequuntur nihil rerum molestiae sequi. Veritatis deserunt officiis aperiam vitae quo. Distinctio maxime quas quas ea ad aut. Autem non accusamus eos quam. Possimus voluptatem labore ad vero itaque. Quas et odit perferendis aut maiores iure quasi adipisci. Enim maiores velit ipsa quos qui ullam impedit. Sit ipsum ipsam voluptatem quam atque qui. Quae voluptatem suscipit id voluptatibus. Eligendi ut omnis eveniet autem porro. Dolorem consequuntur ut debitis iure maiores eligendi vitae repudiandae. Et aut sed aut unde quaerat. Rerum minus nobis ipsa. Natus alias ab esse ipsum ut ad ea sit.', 'https://example.com/canon.jpg', 329990, '2026-04-24 18:33:06', '2026-05-01 22:32:06', 'Electronics', 'active', NULL, '2026-04-28 11:16:06', '2026-04-28 11:16:06', NULL),
(19, 'The North Face Kabát', 'Téli kabát vízálló és szélálló anyagból.', 'Illo incidunt ex corporis delectus tenetur. Et veniam harum architecto ex odit qui quod. Aliquam ab a eaque qui. Quo magnam repudiandae maiores suscipit ratione vero ipsam. Quam nam illo porro id ipsa sit numquam. Blanditiis ex soluta ex quae enim. Possimus vel officiis dolore maiores iste excepturi. Eum quae eligendi asperiores exercitationem veritatis eum aut. Beatae explicabo quaerat rem sit fuga voluptas sed. Reiciendis molestiae optio dolores consequatur. Quia eaque omnis aut sed possimus dolor. Molestiae accusantium culpa molestias veritatis ad. Velit autem deleniti nulla aspernatur dicta fugit.', 'https://example.com/northface.jpg', 79990, '2026-04-28 01:33:06', '2026-05-01 13:06:06', 'Clothing', 'active', NULL, '2026-04-28 11:16:06', '2026-04-28 11:16:06', NULL),
(20, 'Gumicsónak Intex Explorer 300', '3 személyes gumicsónak evezőkkel és pumpával.', 'Iure quia veritatis earum vitae magnam aut velit. Earum vel suscipit assumenda quia. Aperiam magnam fugiat id error. Voluptatum itaque temporibus similique perferendis. Praesentium qui tempore voluptatem harum. Consequatur quia quos dolorem culpa. Quaerat officiis modi veritatis voluptatum. Et culpa dolorem omnis nostrum sint pariatur sed quasi. Magnam similique dignissimos dolorum. Enim modi voluptatem perspiciatis velit magni delectus animi. Voluptate dolores est velit architecto vel aut. Voluptatem sunt laboriosam id eaque. Dolore illo ut illum. Blanditiis omnis sit vitae quis laudantium pariatur eius deleniti. Saepe non dolorem est omnis recusandae quisquam delectus. Repellat ea est id. Autem reprehenderit ipsa nam consequatur impedit quis ratione. Sed omnis a voluptatem. Quaerat veniam inventore sint sint ducimus. Enim officia nam suscipit quaerat. Voluptate et commodi molestias excepturi dolore quo eos. Sed dolorem eligendi cupiditate qui voluptatem veritatis. Est tempore autem ut eaque et. Nam doloribus eius illo ipsum accusantium ducimus eum. Autem cumque ut repudiandae incidunt ab. Quae sit aut in expedita distinctio tenetur ex. Consequatur sunt et nulla ad praesentium repellendus.', 'https://example.com/boat.jpg', 24990, '2026-04-25 16:49:06', '2026-04-28 18:51:06', 'Sports', 'active', NULL, '2026-04-28 11:16:06', '2026-04-28 11:16:06', NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `is_banned` tinyint(1) NOT NULL DEFAULT 0,
  `avatar` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `is_admin`, `is_banned`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@example.com', '2026-04-28 11:16:05', '$2y$12$eDXf2.53Q7k82nOlN9LUmOuACIk3xM41HmXywLcd0PkUcABwaqVe.', 1, 0, NULL, 'thOjTeObLB', '2026-04-28 11:16:06', '2026-04-28 11:16:06'),
(2, 'Test User', 'test@example.com', '2026-04-28 11:16:06', '$2y$12$X9ExVRl.2gYYiLxr0GsEBO1cK9bjf/aIxmA/7uhYI4zIpa3txw3H2', 0, 0, NULL, 'Md9O0SWHTx', '2026-04-28 11:16:06', '2026-04-28 11:16:06'),
(3, 'Ban user test', 'ban@example.com', '2026-04-28 11:16:06', '$2y$12$X9ExVRl.2gYYiLxr0GsEBO1cK9bjf/aIxmA/7uhYI4zIpa3txw3H2', 0, 0, NULL, '7kpfHS5hXR', '2026-04-28 11:16:06', '2026-04-28 11:16:06');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bids_user_id_foreign` (`user_id`),
  ADD KEY `bids_auction_item_id_foreign` (`auction_item_id`);

--
-- A tábla indexei `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- A tábla indexei `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- A tábla indexei `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- A tábla indexei `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- A tábla indexei `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- A tábla indexei `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_user_id_foreign` (`user_id`),
  ADD KEY `payments_product_id_foreign` (`product_id`);

--
-- A tábla indexei `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- A tábla indexei `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_winner_id_foreign` (`winner_id`);

--
-- A tábla indexei `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `bids`
--
ALTER TABLE `bids`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT a táblához `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `bids`
--
ALTER TABLE `bids`
  ADD CONSTRAINT `bids_auction_item_id_foreign` FOREIGN KEY (`auction_item_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `bids_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Megkötések a táblához `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_winner_id_foreign` FOREIGN KEY (`winner_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
