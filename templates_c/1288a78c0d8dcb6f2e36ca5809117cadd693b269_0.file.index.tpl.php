<?php
/* Smarty version 3.1.30, created on 2018-02-26 22:49:54
  from "/Users/dlocal/Dropbox/Facultad/Ort/Taller de programacion/repo/taller-de-programacion/templates/index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a948102147499_24753840',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1288a78c0d8dcb6f2e36ca5809117cadd693b269' => 
    array (
      0 => '/Users/dlocal/Dropbox/Facultad/Ort/Taller de programacion/repo/taller-de-programacion/templates/index.tpl',
      1 => 1519681787,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a948102147499_24753840 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php echo '<script'; ?>
 type="text/javascript" src="js/jquery-3.3.1.min.js"><?php echo '</script'; ?>
>

    </head>
<body>
   <div class="rightButton">
        <button onclick="document.location.href='login.php'" style="width:auto;">Iniciar sesión</button>
    </div>

    <div class="">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['publicaciones']->value, 'publicacion');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['publicacion']->value) {
?>
            <div class="">
                <div style="border:1px solid black;">
                    <img class = "imageContainer" src="images/blank.png"  id="" name="">
                    <a href="publicacion.php?id=<?php echo $_smarty_tpl->tpl_vars['publicacion']->value['id'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['publicacion']->value['titulo'];?>
 </a><br />
                    <?php ob_start();
echo mb_strlen($_smarty_tpl->tpl_vars['publicacion']->value['descripcion'], 'UTF-8');
$_prefixVariable1=ob_get_clean();
if ($_prefixVariable1 >= 150) {?>
                        <?php echo substr($_smarty_tpl->tpl_vars['publicacion']->value['descripcion'],0,150);?>
...
                    <?php } else { ?>
                        <?php echo $_smarty_tpl->tpl_vars['publicacion']->value['descripcion'];?>

                    <?php }?>
                </div>
            </div>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

    </div>

</body>
</html>
<?php }
}
