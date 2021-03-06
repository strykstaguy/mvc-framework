<script src="/js/hideShowPassword.min.js"></script>
<script src="/js/app.js"></script>

<script>
    $(document).ready(function() {

        /**
         * Validate the form
         */
        $('#formSignup').validate({
            rules: {
                name: 'required',
                email: {
                    required: true,
                    email: true,
                    remote: '/account/validate-email'
                },
                password: {
                    required: true,
                    minlength: 6,
                    validPassword: true
                }
            },
            messages: {
                email: {
                    remote: 'email already taken'
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

<h1>Sign up</h1>


<form method="post" action="/signup/create" id="formSignup">

    <div class="form-group">
        <label for="inputName">Name</label>
        <input id="inputName" name="name" placeholder="Name" required class="form-control" />
    </div>
    <div class="form-group">
        <label for="inputEmail">Email address</label>
        <input id="inputEmail" name="email" placeholder="email address" required type="email" class="form-control" />
    </div>
    <div class="form-group">
        <label for="inputPassword">Password</label>
        <input type="password" id="inputPassword" name="password" placeholder="Password" required class="form-control" />
    </div>

    <button type="submit" class="btn btn-default">Sign up</button>

</form>