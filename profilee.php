<div class="profile">
    <img class="profile__avatarka" src="<?= htmlspecialchars($user['avatar']) ?>" alt="Аватарка пользователя">
    <h1 class="profile__name"><?= htmlspecialchars($user['name']) ?></h1>
    <p class="profile__bio"><?= htmlspecialchars($user['bio'] ?? '') ?></p>
    <div class="profole__count">
        <img src="images/count_post.png" alt="Количество постов" class="profole__count__image">
        <p class="profole__count__text">6 постов</p>
    </div>
    <div class="profile__fotos">
        <?php if (!empty($userPhotos)): ?>
            <?php foreach ($userPhotos as $photo): ?>
                <img class="profile_foto" src="<?= htmlspecialchars($photo['image']) ?>" alt="Фото пользователя">
            <?php endforeach; ?>
        <?php else: ?>
            <p>У пользователя пока нет фотографий.</p>
        <?php endif; ?>
    </div>
</div>