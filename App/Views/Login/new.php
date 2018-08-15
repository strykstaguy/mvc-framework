<h3>Log in</h3>

<div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
        <form name="login" id="login" method="post" action="/login/create">
            <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                    <label for="inputEmail">Email address</label>
                    <input type="email" id="inputEmail" name="email" placeholder="Email address" class="form-control" />
                </div>
            </div>
            <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                    <label for="inputPassword">Password</label>
                    <input type="password" id="inputPassword" name="password" placeholder="Password" class="form-control" />
                </div>
            </div>
            <br>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Log in</button>
                <a href="/password/forgot" class="btn btn-default">Forgot password?</a>
            </div>
        </form>
    </div>
</div>