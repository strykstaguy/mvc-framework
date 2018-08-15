<h3>Posts</h3>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Title</th>
            <th>Content</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $post): ?>
        <tr>
            <td><?= $post['title'];?></td>
            <td><?= $post['content'];?></td>
            <td>

                <div class="btn-group">
                    <a href="/posts/edit/<?= $post['id'];?>" class="btn btn-sm btn-default">Edit</a>
                    <a href="/posts/delete/<?= $post['id'];?>" class="btn btn-sm btn-danger">Delete</a>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>