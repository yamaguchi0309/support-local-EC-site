-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:8889
-- 生成日時: 2023 年 11 月 05 日 03:32
-- サーバのバージョン： 5.7.39
-- PHP のバージョン: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `nagasaki-shop`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admintest@gmail.com', NULL, '$2y$10$/Q8k1NCyWLD0QB51X/Ldfu/NVbI.RrdvGDVPevPVX1vpjj5ftPBha', NULL, '2023-10-19 15:43:43', '2023-10-19 15:43:43');

-- --------------------------------------------------------

--
-- テーブルの構造 `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `memo` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `memo` text COLLATE utf8mb4_unicode_ci,
  `del_flg` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `contacts`
--

INSERT INTO `contacts` (`id`, `user_id`, `comment`, `memo`, `del_flg`, `created_at`, `updated_at`) VALUES
(12, 1, 'デモ問い合わせ', NULL, 1, '2023-11-04 06:54:49', '2023-11-04 06:54:49'),
(13, 1, 'デモお問合せ', NULL, 1, '2023-11-04 07:32:45', '2023-11-04 07:32:45');

-- --------------------------------------------------------

--
-- テーブルの構造 `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `tax` float NOT NULL,
  `stock` int(11) NOT NULL,
  `is_selling` tinyint(1) NOT NULL COMMENT '1:販売、0:停止',
  `item_img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `memo` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `items`
--

INSERT INTO `items` (`id`, `name`, `description`, `price`, `tax`, `stock`, `is_selling`, `item_img`, `memo`, `created_at`, `updated_at`) VALUES
(1, '九十九島産 長崎ハーブ鯖 お刺身 150g', '人が食しても様々な効能があるハーブ（ナツメグ、オレガノ、シナモン、ジンジャー）を配合した飼料を与え、\r\nその身は新鮮で臭みがなく、脂のりがとてもよく、生食でも安心して食べていただける鯖です。\r\n瞬間冷凍して鮮度そのままにお届けします。', 1500, 1.08, 10, 1, 'fish_九十九島産 長崎ハーブ鯖 お刺身 150g.png', 'タグ：魚、鮮魚、刺身、海産、海産物', '2023-10-19 15:51:46', '2023-11-04 06:40:35'),
(2, '長崎和牛サーロインステーキ 180g×3枚', '長崎和牛サーロインステーキをご自宅でお楽しみください。\r\n程よくさしの入った長崎和牛のA5等級のロース肉を使用しているので、やわらかくて美味しいステーキができます。', 10000, 1.08, 0, 1, 'meet_長崎和牛サーロインステーキ 180g×3枚.jpeg', 'タグ：肉', '2023-10-19 15:56:32', '2023-11-04 05:40:39'),
(3, '九十九島せんぺい 12枚入り', '2010年より14年連続モンドセレクション最高金賞受賞！\r\nパリッとした独特の食感と、ピーナツの香ばしさでいつも変わらぬ美味しさ。\r\n創業当時より守り続けた材料・製法で、職人の手により一枚一枚丁寧に作られています。\r\n是非ご賞味ください。', 1000, 1.08, 100, 1, 'sweets_九十九島せんぺい 12枚入り.jpeg', 'タグ：お菓子、おかし、ピーナッツ、金賞', '2023-10-19 16:20:48', '2023-11-01 14:26:26'),
(4, '三川内焼 唐子絵飯碗大小', '三川内焼を代表する絵柄で、小ぶりの飯碗です。\r\n・サイズ：大11.3×6.1 cm、小10.8×5.7cm　・重量：約145g 約129g', 6000, 1.08, 0, 1, 'item_三川内焼 唐子絵飯碗大小.jpeg', 'タグ：焼き物、焼物、茶碗', '2023-10-19 16:24:28', '2023-11-04 05:40:58'),
(5, '冷凍ちゃんぽん4人前 箱入', '長崎の味が手軽に楽しめるおススメギフト\r\n具材もついた冷凍ちゃんぽんは、お鍋1つでカンタン調理。はじめて作られる方へも安心してお送りいただけます。', 3600, 1.08, 20, 1, 'food_冷凍ちゃんぽん4人前 箱入.jpeg', 'タグ：食品、冷凍', '2023-10-19 16:40:24', '2023-11-01 14:28:49'),
(6, 'レンジで長崎皿うどん1人前 袋入', 'すぐ食べられる簡単調理の決定版\r\n電子レンジでチンするだけ!忙しい共働きのお母さんや、お留守番のお子様に重宝すること間違いなしです。\r\nまた、野菜不足や栄養バランスが気になる大切な方へ、ご高齢の方へ、思いやりの気持ちを込めて贈ってみませんか。', 800, 1.08, 20, 1, 'food_レンジで長崎皿うどん1人前 袋入.jpeg', 'タグ：食品、冷凍', '2023-10-19 17:48:02', '2023-11-01 14:29:21'),
(7, '文明堂 長崎カステラ 1号10切入×1本入', 'ざらめ糖を底面に残した定番の長崎カステラです。\r\n10切れにカットしていますので、すぐにお召し上がりいただけます。\r\n創業から常に研鑽・改良を重ね、長崎にカステラありと言わしめた文明堂自慢の一品です。\r\n原材料にこだわり抜いた、手作りならではの味わいをぜひご賞味ください。', 2000, 1.08, 100, 1, 'sweets_文明堂 長崎カステラ 1号10切入×1本入.jpeg', 'タグ：お菓子、おかし、食品', '2023-10-19 17:48:02', '2023-11-01 14:29:50'),
(8, '平戸和牛100%ハンバーグ  200g×5個', '平戸和牛を使用したハンバーグは、子どもからお年寄りまで、平戸市民の晩ごはんに大人気。\r\n肉汁たっぷりのジューシーなハンバーグです。1つ１つ手作業で仕上げています。\r\n冷凍庫にあると、忙しい日の晩ごはんにも心強いですよ！　\r\nフライパンで弱火でじっくり両面を焼いて、お楽しみください。', 4000, 1.08, 10, 1, 'meet_平戸和牛ハンバーグ 200g×5個.png', 'タグ：肉、冷凍', '2023-10-19 17:48:02', '2023-11-01 14:30:30'),
(9, '平戸産活きウチワエビ 1kg(5-8尾)', '全国から注目の「ウチワエビ」。\r\nここ20年で急速に全国に知られた九州のウチワエビ。\r\n以前は長崎県民を中心とする九州の魚好き、えび好きだけが密かに楽しんでいたのですが・・・今は九州でも手に入りにくいほどの人気に！', 6000, 1.08, 0, 1, 'fish_平戸産活きウチワエビ 1kg(5-8尾).jpeg', 'タグ：魚、新鮮、海老、えび、海産、海産物', '2023-10-19 17:48:02', '2023-11-04 06:43:33'),
(10, '華蓮 生食用殻付き牡蠣 10個(50-80g/1個)', '日本一と言われる真牡蠣をお届け！\r\n実入りもしっかりとしており、非常に美味です。ご家庭、パーティー、BBQなどでぜひご利用下さい！', 6000, 1.08, 10, 1, 'fish_華蓮 生食用殻付き牡蠣 10個(50-80g1個).jpg', 'タグ：魚、カキ、生牡蠣、海産、海産物', '2023-10-19 17:48:02', '2023-11-04 06:40:35'),
(11, '佐世保独楽 競技用同型特大2個セット', '国際的にも有名となった佐世保の伝統的工芸品「佐世保独楽」。\r\n県産材で、佐世保独楽職人三代目「山本貞右衞門」が伝統技法で一つひとつ手作りしています。 「佐世保独楽 新春こま回し大会」に使用される競技用独楽と同型です。\r\nお二人で独楽回しを楽しんで頂きたいとの思いから、２個セットにしました。', 7000, 1.08, 100, 1, 'item_佐世保独楽 競技用同型特大2個セット.jpeg', 'タグ：おもちゃ、オモチャ、こま、遊び', '2023-10-19 17:48:02', '2023-11-01 14:32:26'),
(12, '佐世保名物 長崎和牛レモンステーキ 360g(2～3人前)', '佐世保名物「レモンステーキ」をご自宅でお楽しみください。\r\n長崎和牛のA4等級以上のロース肉を使用しているのでやわらかくて美味しいステーキができます。', 8000, 1.08, 10, 1, 'meet_佐世保名物 長崎和牛レモンステーキ 360g(2～3人前).jpeg', 'タグ：肉、レモン', '2023-10-19 17:48:02', '2023-11-01 14:33:02'),
(13, '長崎胡麻とうふ詰め合わせ 8個入', '長崎に古くから伝わる郷土食。\r\n豆腐の様で、原料も大豆由来の豆乳を使いますが、豆腐がにがりで固めるのに対し、タピオカ澱粉を使用、まるでなめらかプリンのよう。豆乳の甘さをタピオカ澱粉がしっかりと閉じ込めた味わいを、胡麻だれやわさび醤油で賞味します。舌に広がる独特の食感と味わいをお楽しみください。', 3000, 1.08, 10, 1, 'food_長崎胡麻とうふ詰め合わせ 8個入.jpg', 'タグ：食品、とうふ、名物、ごま、ゴマ', '2023-10-19 17:48:02', '2023-11-01 14:33:39'),
(14, '五島椿本舗 天然椿油 120ml', '椿油は、髪・頭皮・肌など全身に使える多機能オイル。\r\n職人の技術と経験から丁寧に搾り出された純度100％の椿油をマッサージするように優しく身体や髪にすりこんで使います。\r\nお肌の保湿成分に近いオレイン酸を多く含むため、髪や肌になじむため毎日ご使用いただくことができます。', 2500, 1.08, 10, 1, 'item_五島椿本舗 天然椿油 120ml.jpeg', 'タグ：五島、オイル、つばき、ツバキ、美容', '2023-10-19 17:48:02', '2023-11-01 14:34:26');

-- --------------------------------------------------------

--
-- テーブルの構造 `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(10, '2014_10_12_000000_create_users_table', 1),
(11, '2014_10_12_100000_create_password_resets_table', 1),
(12, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(13, '2023_10_12_153745_create__items_table', 1),
(14, '2023_10_12_153844_create__contacts_table', 1),
(15, '2023_10_12_153845_create__orders_table', 1),
(16, '2023_10_12_153914_create__carts_table', 1),
(17, '2023_10_12_153916_create__orders__items_table', 1),
(18, '2023_10_15_144249_create_admins_table', 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_num` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_tel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_postcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `postage` int(11) NOT NULL,
  `payment_method` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `memo` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_num`, `shipping_tel`, `shipping_postcode`, `shipping_address`, `amount`, `postage`, `payment_method`, `payment_status`, `order_status`, `shipping_status`, `memo`, `created_at`, `updated_at`) VALUES
(30, 1, '231104I7642', '09012345678', '0000000', '東京都千代田区千代田１−１　千代田マンション１０２号室', 6940, 1000, '0', '1', '2', '3', '配送先住所変更：１０１号室→102号室', '2023-11-04 07:31:13', '2023-11-04 07:41:12');

-- --------------------------------------------------------

--
-- テーブルの構造 `orders_items`
--

CREATE TABLE `orders_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `orders_items`
--

INSERT INTO `orders_items` (`id`, `order_id`, `item_id`, `quantity`, `created_at`, `updated_at`) VALUES
(50, 30, 1, 3, '2023-11-04 07:31:13', '2023-11-04 07:31:13'),
(51, 30, 3, 1, '2023-11-04 07:31:13', '2023-11-04 07:31:13');

-- --------------------------------------------------------

--
-- テーブルの構造 `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kana` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `tel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` tinyint(4) DEFAULT NULL,
  `belongs` int(11) DEFAULT '1',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `memo` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `name`, `kana`, `email`, `email_verified_at`, `tel`, `postcode`, `address`, `birthday`, `age`, `gender`, `belongs`, `password`, `memo`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'user', 'ユーザー', 'usertest@gmail.com', NULL, '09012345678', '0000000', '東京都千代田区千代田１−１　千代田マンション１０１号室', '1993-03-09', 30, 0, 1, '$2y$10$sGOk2Y/degKb3yStNYi4G.phuD.tzcNU2MAQKEBY5RmrDNLwLdN2i', 'めもてすと', NULL, '2023-10-20 11:42:17', '2023-11-01 12:33:46');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- テーブルのインデックス `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_item_id_foreign` (`item_id`);

--
-- テーブルのインデックス `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contacts_user_id_foreign` (`user_id`);

--
-- テーブルのインデックス `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- テーブルのインデックス `orders_items`
--
ALTER TABLE `orders_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_items_order_id_foreign` (`order_id`),
  ADD KEY `orders_items_item_id_foreign` (`item_id`);

--
-- テーブルのインデックス `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- テーブルのインデックス `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- テーブルの AUTO_INCREMENT `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- テーブルの AUTO_INCREMENT `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- テーブルの AUTO_INCREMENT `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- テーブルの AUTO_INCREMENT `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- テーブルの AUTO_INCREMENT `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- テーブルの AUTO_INCREMENT `orders_items`
--
ALTER TABLE `orders_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- テーブルの AUTO_INCREMENT `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- テーブルの制約 `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- テーブルの制約 `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- テーブルの制約 `orders_items`
--
ALTER TABLE `orders_items`
  ADD CONSTRAINT `orders_items_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `orders_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
