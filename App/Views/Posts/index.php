<h3>Posts</h3>

<ul>
    <?php foreach ($data as $post): ?>
        <li>
            <h2><?= $post['title'];?></h2>
            <p><?= $post['content'];?></p>
        </li>
    <?php endforeach; ?>
</ul>