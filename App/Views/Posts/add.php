<h3>Add Post</h3>

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <form name="sentMessage" id="contactForm" method="post" action="/posts/update">
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls">
                        <label>Content</label>
                        <textarea class="form-control" name="content" required></textarea>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <button type="text" class="btn btn-primary" name="submit">Add Post</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    if (!empty($data))
    {
        print("<pre>".print_r($data,true)."</pre>");
    }
?>