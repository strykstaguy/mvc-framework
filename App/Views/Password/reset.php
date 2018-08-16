<script src="/js/hideShowPassword.min.js"></script>
<script src="/js/app.js"></script>

<script>
    $(document).ready(function() {
        /**
         * Validate the form
         */
        $('#formPassword').validate({
            rules: {
                password: {
                    required: true,
                    minlength: 6,
                    validPassword: true
                }
            }
        });


        /**
         * Show password toggle button
         */
        $('#inputPassword').hideShowPassword({
            show: false,
            innerToggle: 'focus'
        });
    });
</script>

<h1>Reset password</h1>


<form method="post" id="formPassword" action="/password/reset-password">

    <input type="hidden" name="token" value="{{ token }}" />

    <div class="form-group">
        <label for="inputPassword">Password</label>
        <input type="password" id="inputPassword" name="password" placeholder="Password" required class="form-control" />
    </div>

    <button type="submit" class="btn btn-default">Reset password</button>

</form>