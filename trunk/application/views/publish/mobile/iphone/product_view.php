<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <title></title>
    <link rel="stylesheet"  href="<?php echo base_url().'style/publish/reset.css' ?>" />
    <link rel="stylesheet"  href="<?php echo base_url().'style/publish/style.css' ?>" />
    <script type="text/javascript" src="<?php echo base_url().'javascript/publish/jquery-1.7.1.min.js' ?>"></script>
    <script type="text/javascript" src="<?php echo base_url().'javascript/publish/index.js' ?>"></script>
    <script type="text/javascript" src="<?php echo base_url().'javascript/publish/widgets.js' ?>"></script>
</head>

<body>
    <!--div id="loading" class="loading">
        loading...
    </div-->

    <div id="wrap" class="wrap">
        <div id="header" class="header">
            <!--a class="logo" href="#" target="_blank"><img src="<?php echo base_url().'images/publish/img_01.png' ?>" width="164" height="61" /></a>
            <a class="btn-close" href="javascript:void(0);"><img src="<?php echo base_url().'images/publish/img_02.png' ?>" width="58" /></a-->
        </div>  <!-- header end -->

        <div id="main" class="main">
            <div id="slider" class="slider">
                <div id="sliderIn" ah-role="sliderIn" class="slider-in slider-in-auto-eff clearfix" style="">
                    <?php foreach($ads as $ad): ?>
                        <a href="<?php echo $ad->link_addr; ?>" target="_blank" ah-role="sliderItem"><img src="<?php echo base_url().'assets/images/ad/'.$ad->pic_addr; ?>" /></a>
                    <?php endforeach ?>
                </div>
            </div>  <!-- slider end -->

            <div id="viewer" class="viewer">
                <div id="viewerIn" class="viewer-in clearfix">

                    <?php $i = 0; ?>

                    <?php foreach($apps as $app): ?>

                        <?php $i++; if($i%2 == 1): ?>
                        <div class="viewer-item">
                            <p><a href="<?php echo $app->link_addr; ?>" target="_blank"><img src="<?php echo base_url().'assets/images/appicon/'.$app->icon_addr; ?>" /></a></p>
                        <?php else: ?>
                            <p><a href="<?php echo $app->link_addr; ?>" target="_blank"><img src="<?php echo base_url().'assets/images/appicon/'.$app->icon_addr; ?>" /></a></p>
                        </div>
                        <?php endif ?>

                    <?php endforeach ?>

                    <?php if($i%2 == 1): ?>
                        </div>
                    <?php endif ?>

                </div>  <!-- viewer in end -->
            </div>  <!-- items end -->
        </div>  <!-- main end -->

        <div id="footer" class="footer">
            <table cellpadding="0" cellspacing="0">
                <tbody>
                    <tr>
                        <td>
                            <a href="http://www.facebook.com/ApeHills" ><img src="<?php echo base_url().'images/publish/' ?>facebook_icon.png" /></a>
                        </td>
                        <td>
                            <a href="http://twitter.com/#!/ApeHills" ><img src="<?php echo base_url().'images/publish/' ?>twitter_icon.png" /></a>
                        </td>
                        <td>
                            <a href="http://apehills.com" ><img src="<?php echo base_url().'images/publish/' ?>ah_icon.png" /></a>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>  <!-- footer end -->
    </div>

</body>
</html>

