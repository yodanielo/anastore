<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo ($params["pagetitle"] ? $params["pagetitle"] . " | " : "") . $params["sitename"]; ?></title>
        <meta name="Description" content="<?php echo $params["sitedescription"]; ?>" />
        <meta name="author" content="<?php echo $params["author"]; ?>" />
        <meta name="owner" content="<?php echo $params["owner"]; ?>" />
        <meta name="robots" content="index, follow" />
        <link rel="icon" href="" type="image/x-icon" />
        <?php
        if (count($params["css"]) > 0) {
            foreach ($params["css"] as $key => $sc) {
                if (substr($sc, 0, 7) == "http://" || substr($sc, 0, 8) == "https://")
                    echo '<link rel="stylesheet" type="text/css" href="' . $sc . '" />' . "\n";
                else
                    echo '<link rel="stylesheet" type="text/css" href="' . site_url('css/' . $sc) . '" />' . "\n";
            }
        }
        ?>
        <link rel="stylesheet" type="text/css" href="<?= site_url("css/nav.css") ?>" />
        <!--[if IE ]>
        <link rel="stylesheet" type="text/css" href="<?= site_url("css/ie.css") ?>" />
        <![endif]-->
        <!--[if lte IE 7]>
        <link rel="stylesheet" type="text/css" href="<?= site_url("css/ie7.css") ?>" />
        <![endif]-->
        <script type="text/javascript">siteurl="<?= site_url() ?>";</script>
        <?php
        if (count($params["scripts"]) > 0) {
            foreach ($params["scripts"] as $key => $sc) {
                if (substr($sc, 0, 7) == "http://" || substr($sc, 0, 8) == "https://")
                    echo '<script type="text/javascript" src="' . $sc . '"></script>' . "\n";
                else
                    echo '<script type="text/javascript" src="' . site_url('js/' . $sc) . '"></script>' . "\n";
            }
        }
        ?>
        <script type="text/javascript" src="<?= site_url("js/generales.js") ?>"></script>
    </head>
    <body>
        <header class="cuerpobody ajustable">
            <img id="logo" src="<?= site_url("img/logo.png") ?>" alt="Panel de Control"/>
            <div id="cuadrocuenta">
                Hola <?=$_SESSION["anasariego"]["username"]?><br/>
                <a href="<?=  site_url("login")?>">Salir</a>
            </div>
            <?php
            if($params["mensaje"]){
                ?>
            <div class="cuadroapartado" id="mensajeprincipal">
                <div class="cuadroapartadotitle">Mensaje Importante</div>
                <div class="cuadroapartadocuerpo"><?=$params["mensaje"]?></div>
            </div>
                <?php
            }
            ?>
        </header>
        <div class="cuerpobody ajustable row-fluid">
            <div id="leftpanel" class="span3">
                <div class="cuadroapartado">
                    <div class="cuadroapartadotitle">Dashboard</div>
                    <div class="cuadroapartadocuerpo">
                        <ul class="nav nav-list">
                            <li class="active"><a href="<?=  site_url("")?>">Ventas</a></li>
                            <li><a href="<?=  site_url("pedidos")?>">Pedidos Atendidos</a></li>
                            <li><a href="<?=  site_url("pedidos/pendientes")?>">Pedidos Pendientes</a></li>
                            <li><a href="<?=  site_url("pedidos/cancelados")?>">Pedidos cancelados</a></li>
                            <li class="divider"></li>
                            <li><a href="<?=  site_url("productos")?>">Productos</a></li>
                            <li><a href="<?=  site_url("productos/categorias")?>">Categorias</a></li>
                        </ul>
                    </div>
                </div>
                <div id="panelcalendario" class="cuadroapartado">
                    
                </div>
            </div>
            <div id="rightpanel" class="span9">
                