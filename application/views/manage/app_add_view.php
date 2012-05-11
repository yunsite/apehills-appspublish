<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>App Manage List</title>
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
        <div class="header clearfix">
            <div class="flt">App Manage</div>
            <div class="frt">Hi <?php echo $username; ?>! ApeHills Inc.</div>
        </div>

        <div class="main clearfix">
            <div class="nav">
                <a class="cur" href="<?php echo site_url('manage/app'); ?>">App</a>
                <a href="<?php echo site_url('manage/ad'); ?>">Ad</a>
            </div>  <!-- nav end -->

            <div class="list">
                <div class="list-nav">
                    <a href="<?php echo site_url('manage/app/index'); ?>">List</a>
                    <a class="cur" href="<?php echo site_url('manage/app/add'); ?>">Add</a>
                </div>

                <div class="add">
                    <form action="<?php echo site_url('manage/app/do_add'); ?>" method="post" enctype="multipart/form-data">
                        <table cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td class="add-lt">Name:</td>
                                    <td class="add-rt"><input class="txtip1" type="text" name="name" must /></td>
                                </tr>
                                <tr>
                                    <td class="add-lt">ICON:</td>
                                    <td class="add-rt"><input type="file" name="iconfile" /></td>
                                </tr>
                                <tr>
                                    <td class="add-lt">Link:</td>
                                    <td class="add-rt"><input class="txtip1" type="text" name="link_addr" must /></td>
                                </tr>
                                <tr>
                                    <td class="add-lt">Position(value):</td>
                                    <td class="add-rt"><input class="txtip1" type="text" name="position" /></td>
                                </tr>
                                <tr>
                                    <td class="add-lt">Show(?):</td>
                                    <td class="add-rt">
                                        <label for="show-yes">Yes</label>
                                        <input type="radio" name="is_show" id="show-yes" checked="true" />&nbsp;
                                        <label for="show-no">No</label>
                                        <input type="radio" name="is_show" id="show-no" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="add-lt">Description:</td>
                                    <td class="add-rt"><textarea rows="5" class="taip1" type="text" name="des" ></textarea></td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="add-submitwrap"><input id="submit" type="submit" value="submit" /></p>
                    </form>
                </div>  <!-- add end -->

            </div>  <!-- list end -->
        </div>  <!-- main end -->

        <div class="footer">Copyright by ApeHills Inc. All Rights Reserved.</div>  <!-- footer end -->
    </div>
</body>
</html>

