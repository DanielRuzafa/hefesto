<?php global $current_user; get_currentuserinfo();?>
<!DOCTYPE html>
<html <?php body_class(); ?>>

    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <meta content="width=device-width,initial-scale=1" name="viewport">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="robots" content="noindex, nofollow">


        <title><?php wp_title(''); ?></title>


        <!-- Favicons -->
        <link rel="icon" type="image/png" href="<?php bloginfo('template_url'); ?>/images/favicon-32x32.png" sizes="32x32" />
        <link rel="icon" type="image/png" href="<?php bloginfo('template_url'); ?>/images/favicon-16x16.png" sizes="16x16" />
        <link rel="shortcut icon" href="<?php bloginfo('template_url');?>/images/favicon.ico" type="image/x-icon" >
                
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/jquery-ui.min.css">
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">

        <!--Para usar font awesome: este archivo y la carpeta webfonts-->
        <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/all.min.css">


        <?php wp_head(); ?>

    </head>

    <body>



        <header class="group">
            <div id="top">
                <div class="container group">
                    <div class="partLeft">
                        <a class="nameUser" href="<?php bloginfo('url');?>/">HEFESTO</a>
                    </div>
                    <div class="partRight">
                       
                        <?php if ($current_user->ID > 0) { ?>

                            <?php if($current_user->roles[0]== "subscriber"){ ?>
                                <a class="nameUser" href="<?php bloginfo('url');?>/grupo/">Área privada</a>

                            <?php } else { ?>
                                <a class="nameUser" href="<?php bloginfo('url');?>/administrador-grupo/">Área privada</a>
                            <?php } ?>
                            <span class="spaceButtons"> | </span>
                            <a href="<?php echo wp_logout_url(home_url()); ?>">Salir</a>

                        <?php } else { ?>

                        <?php } ?>                       
                    </div>
                </div>

            </div>


        </header>
        <p class="hiddenUrl"><?php bloginfo('url');?></p>