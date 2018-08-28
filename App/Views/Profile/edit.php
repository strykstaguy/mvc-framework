<script src="/js/hideShowPassword.min.js"></script>
<script src="/js/app.js"></script>

<script>
    $(document).ready(function() {

        var userId = '<?php echo $user->id;?>';

        /**
         * Validate the form
         */
        $('#formProfile').validate({
            rules: {
                name: 'required',
                email: {
                    required: true,
                    email: true,
                    remote: {
                        url: '/account/validate-email',
                        data: {
                            ignore_id: function() {
                                return userId;
                            }
                        }
                    }
                },
                password: {
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


<h1>Profile</h1>
<form method="post" id="formProfile" action="/profile/update">

    <div class="form-group">
        <label for="inputName">Name</label>
        <input id="inputName" name="name" placeholder="Name" value="<?php echo $user->name ;?>" required class="form-control" />
    </div>
    <div class="form-group">
        <label for="inputEmail">Email address</label>
        <input id="inputEmail" name="email" placeholder="email address" value="<?php echo $user->email ?>" required type="email" class="form-control" />
    </div>
    <div class="form-group">
        <label for="inputPassword">Password</label>
        <input type="password" id="inputPassword" name="password" placeholder="Password" aria-describedby="helpBlock" class="form-control" />
        <span id="helpBlock" class="help-block">Leave blank to keep current password</span>
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
    <a href="/profile/view" class="btn btn-default">Cancel</a>

</form>