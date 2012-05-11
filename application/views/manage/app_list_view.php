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
    $( '[needask]' ).click(function(e){
        if( !confirm('Sure About Delete?') )
            return false;
    }); 

    $trs = $( '.apps tr' );
    $trs.each(function(){
        $( this ).data( 'background-color', $(this).css('background-color') );
    });
    $trs.bind( 'mouseenter', function(e){
        $( this ).css( 'background-color', '#ffe476' );
    });
    $trs.bind( 'mouseleave', function(e){
        $( this ).css( 'background-color', $(this).data('background-color') );
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
                    <a class="cur" href="<?php echo site_url('manage/app/index'); ?>">List</a>
                    <a href="<?php echo site_url('manage/app/add'); ?>">Add</a>
                </div>

                <div class="apps">
                    <table cellpadding="0" cellspacing="0">
                        <thead>
                            <tr>
                                <td class="apps-id">ID</td>
                                <td class="apps-position">Position</td>
                                <td>Name</td>
                                <td>Img</td>
                                <td>Des</td>
                                <td class="apps-link">Link</td>
                                <td class="apps-edit">Edit</td>
                                <td class="apps-delete">Delete</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            <?php foreach($apps as $row): ?>
                            <tr class="<?php $i++; if($i%2 === 0){ echo 'apps-even'; } else { echo 'apps-odd'; } ?>" >
                                <td class="apps-id"><?php echo $row->id; ?></td>
                                <td class="apps-position"><?php echo $row->position; ?></td>
                                <td><?php echo $row->name; ?></td>
                                <td>
                                    <a href="<?php $_tmp_url = base_url().'assets/images/appicon/'.$row->icon_addr; echo $_tmp_url; ?>" target="#">
                                        <img src="<?php  echo $_tmp_url; ?>" width="20" />
                                    </a>
                                </td>
                                <td><?php echo $row->des; ?></td>
                                <td class="apps-link"><?php if(strlen($row->link_addr) > 0): ?><a class="a1" href="<?php echo $row->link_addr; ?>" target="_blank">Link</a><?php endif ?></td>
                                <td class="apps-edit"><a class="a1" href="<?php echo site_url('manage/app/edit').'/'.$row->id; ?>">Edit</a></td>
                                <td class="apps-delete"><a class="a1" needask href="<?php echo site_url('manage/app/delete').'/'.$row->id; ?>">Delete</a></td>
                            </tr>
                            <?php endforeach ?>
                        </tbody> 
                    </table> 
                </div>  <!-- app end -->
            </div>  <!-- list end -->
        </div>  <!-- main end -->

        <div class="footer">Copyright by ApeHills Inc. All Rights Reserved.</div>  <!-- footer end -->
    </div>
</body>
</html>
