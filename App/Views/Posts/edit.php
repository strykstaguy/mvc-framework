<h3>Edit Post</h3>

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <form name="editPost" id="editPost" method="post" action="/posts/update">
                <input type="hidden" id="id" value="<?php echo $post->id ;?>" name="id"/>
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls">
                        <label>Title</label>
                        <input type="text" class="form-control" value ="<?php echo $post->title ;?>" name="title" required>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls">
                        <label>Content</label>
                        <textarea class="form-control" name="content" required><?php echo $post->content ;?></textarea>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <button type="text" class="btn btn-primary" name="edit">Save Post</button>
                    <a href="/posts" class="btn btn-default">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>


<?php
if (!empty($post))
{
    print("<pre>".print_r($post,true)."</pre>");
}
?>