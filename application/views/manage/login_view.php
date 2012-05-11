<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'style/manage/reset.css' ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'style/manage/style.css' ?>" />
<script type="text/javascript" src="<?php echo base_url().'javascript/manage/jquery-1.7.1.min.js'; ?>"></script>
<script type="text/javascript">
$(function(){
    var $must = $( 'input[must]' );

    $must.each(function(){
        $( this ).data( 'border-color', $(this).css('border-color') );
    });
    $( '#submit' ).click(function(e){
        $must.each(function(){
            $me = $( this );
            if( $me.val() == '' ) {
                $me.css( {'border-color': '#ff8d55', 'background-color': '#ffffe8' }); 
                $me.bind( 'focus', function(e){
                    var $me = $( this );
                    $me.css( {'border-color': $me.data('border-color') , 'background-color': '#fff' }); 

                    $me.unbind( e );
                });

                e.preventDefault();
            }
        });
    });
});
</script>
</head>
<body>
    <div class="wrap">
        <div class="login">
            <div class="login-in">
                <form method="POST" action="<?php echo site_url('manage/login/check'); ?>">
                <table cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td class="login-lt">Username:</td>
                            <td class="login-rt"><input class="txtip1" type="text" name="username" must/></td>
                        </tr>
                        <tr>
                            <td class="login-lt">Password:</td>
                            <td class="login-rt"><input class="txtip1" type="password" name="password" must/></td>
                        </tr>
                    </tbody>
                </table>
                <p class="login-submitwrap"><input type="submit" id="submit" name="submit" value="Login"/></p>
                </form>
            </div>  <!-- login in end -->
        </div>  <!-- login end -->
    </div>
</body>
</html>


