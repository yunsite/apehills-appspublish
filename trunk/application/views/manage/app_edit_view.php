<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>App Manage List</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'style/manage/reset.css' ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'style/manage/style.css' ?>" />
<script type="text/javascript" src="<?php echo base_url().'javascript/manage/jquery-1.7.1.min.js'; ?>"></script>
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
                    <a href="<?php echo site_url('manage/app/add'); ?>">Add</a>
                </div>

                <div class="add">
                    <form action="<?php echo site_url('manage/app/do_edit'); ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="hidden" name="old_icon_addr" value="<?php echo $icon_addr; ?>" />
                        <table cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td class="add-lt">Name:</td>
                                    <td class="add-rt"><input class="txtip1" type="text" name="name" value="<?php echo $name; ?>" must /></td>
                                </tr>
                                <tr>
                                    <td class="add-lt">ICON:</td>
                                    <td class="add-rt">
                                        <p><img src="<?php echo base_url().'assets/images/appicon/'.$icon_addr; ?>" width="300" /></p>
                                        <p><input type="file" name="iconfile" /></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="add-lt">Link:</td>
                                    <td class="add-rt"><input class="txtip1" type="text" name="link_addr" value="<?php echo $link_addr; ?>" /></td>
                                </tr>
                                <tr>
                                    <td class="add-lt">Position(value):</td>
                                    <td class="add-rt"><input class="txtip1" type="text" name="position" value="<?php echo $position; ?>" /></td>
                                </tr>
                                <tr>
                                    <td class="add-lt">Show(?):</td>
                                    <td class="add-rt">
                                        <label for="show-yes">Yes</label>
                                        <input type="radio" name="is_show" id="show-yes" <?php if($is_show == 1) { echo 'checked="true"'; } ?> />&nbsp;
                                        <label for="show-no">No</label>
                                        <input type="radio" name="is_show" id="show-no" <?php if($is_show == 0) { echo 'checked="true"'; } ?> />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="add-lt">Description:</td>
                                    <td class="add-rt"><textarea rows="5" class="taip1" type="text" name="des" ><?php echo $des; ?></textarea></td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="add-submitwrap"><input type="submit" value="submit" /></p>
                    </form>
                </div>  <!-- add end -->

            </div>  <!-- list end -->
        </div>  <!-- main end -->

        <div class="footer">Copyright by ApeHills Inc. All Rights Reserved.</div>  <!-- footer end -->
    </div>
</body>
</html>


