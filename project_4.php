<?php
require_once 'basedate.php';

function getAllPosts(PDO $connection): array {
    $query = <<<SQL
        SELECT 
            user.id, user.name, user.avatar, 
            post.id, post.user_id, post.images, post.likes, post.texts, post.created_at
        FROM 
            user
        INNER JOIN 
            post ON user.id = post.user_id
    SQL;

    try {
        $statement = $connection->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Ошибка при выполнении запроса: ' . $e->getMessage();
        return [];
    }
}

function formatTimestamp($timestamp) {
    $timeDifference = $timestamp;
    if ($timeDifference < 60) {
        if ($timeDifference == 1) {
            return $timeDifference . ' секунду назад'; 
        } elseif ($timeDifference < 5) {
            return $timeDifference . ' секунды назад'; 
        } else {
            return $timeDifference . ' секунд назад';
        }
    } elseif ($timeDifference < 3600) {
        if ($timeDifference / 60 == 1) {
            return floor($timeDifference / 60) . ' минуту назад';
        } elseif ($timeDifference / 60 < 5) {
            return floor($timeDifference / 60) . ' минуты назад';
        } else {
            return floor($timeDifference / 60) . ' минут назад';
        }
    } elseif ($timeDifference < 86400) {
        if ($timeDifference / 3600 == 1) {
            return floor($timeDifference / 3600) . ' час назад';
        } elseif ($timeDifference / 3600 < 5) {
            return floor($timeDifference / 3600) . ' часа назад';
        } else {
            return floor($timeDifference / 3600) . ' часов назад';
        }
    } elseif ($timeDifference < 604800) {
        if ($timeDifference / 86400 == 1) {
            return floor($timeDifference / 86400) . ' день назад';
        } elseif ($timeDifference < 5) {
            return floor($timeDifference / 86400) . ' дня назад';
        } else {
            return floor($timeDifference / 86400) . ' дней назад';
        }
    } elseif ($timeDifference < 2419200) {
        if ($timeDifference / 604800 == 1) {
            return floor($timeDifference / 604800) . ' неделю назад';
        } elseif ($timeDifference < 5) {
            return floor($timeDifference / 604800) . ' недели назад';
        } else {
            return floor($timeDifference / 604800) . ' недель назад';
        }
    } elseif ($timeDifference < 29030400) {
        if ($timeDifference / 2419200 == 1) {
            return floor($timeDifference / 2419200) . ' месяц назад';
        } elseif ($timeDifference < 5) {
            return floor($timeDifference / 2419200) . ' месяца назад';
        } else {
            return floor($timeDifference / 2419200) . ' месяцев назад';
        } 
    } else {
        if ($timeDifference / 29030400 == 1) {
            return floor($timeDifference / 29030400) . ' год назад';
        } elseif ($timeDifference < 5) {
            return floor($timeDifference / 29030400) . ' года назад';
        } else {
            return floor($timeDifference / 29030400) . ' лет назад';
            echo time();
        } 
    }
}

try {
    $posts = getAllPosts($pdo);
    if (empty($posts)) {
        echo "Нет доступных постов.";
        exit;
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()], JSON_UNESCAPED_UNICODE);
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Новостная лента</title>
    <link href="styles/style__home.css" rel="stylesheet">
    <link href="styles/fonts.css" type="text/css" rel="stylesheet">
</head>
<body>
    <div class="main-button">
        <a href="http://localhost/2task.php">
            <img src="images/home.png" alt="Домик" class="home">
        </a>
        <a href="http://localhost/3task.php">
            <img src="images/user.png" alt="Пользователь" class="user">
        </a>
        <img src="images/plus.png" alt="Плюс" class="plus">
    </div>
    <?php if (empty($posts)): ?>
        <p>Нет постов для отображения.</p>
    <?php else: ?>
        <?php foreach ($posts as $post): ?>
            <div class="post">
                <div class="post__user">
                    <div class="post__info-user-id">
                        <img class="post__user__avatarka" src="<?= htmlspecialchars($post['avatar'] ?? '') ?>" alt="Аватарка пользователя">
                        <h2 class="post__user__author"><?= htmlspecialchars($post['name'] ?? 'Неизвестный пользователь') ?></h2>
                    </div>
                    <img src="images/pen.png" alt="Ручка" class="post__user__pen">
                </div>
                <div class="post__content" >
                    <?php if ($post['user_id'] == 1): ?>
                        <img src="images/slider-button.png" alt="Стрелка" class="post__content__arrow">
                        <img src="images/indicator.png" alt="Количество фотографий" class="post__content__count">
                    <?php endif ?>
                    <img class="post__content__image" src="<?= htmlspecialchars($post['images'] ?? '') ?>" alt="Фото поста">
                </div>
                <button class="post__likes">
                    <img src="images/like.png" alt="Лайк" class="like">
                    <?= htmlspecialchars($post['likes'] ?? 0) ?>
                </button>
                <?php if (!empty($post['texts'])): ?>
                    <p class="post__text1"><?= htmlspecialchars($post['texts']) ?></p>
                <?php endif; ?>
                <p class="post__text2"><?= htmlspecialchars(formatTimestamp((int)$post['created_at'])) ?></p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>