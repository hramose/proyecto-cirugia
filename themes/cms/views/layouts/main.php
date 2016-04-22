<!DOCTYPE html>
<html lang="es">
  <head>
  
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="language" content="es" />
    
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SMADIA">
    <meta name="author" content="Ricardo Magaña">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
 

    <!--
    <link href='http://fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
    -->


    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
	<?php
	  $baseUrl = Yii::app()->theme->baseUrl; 
	  $cs = Yii::app()->getClientScript();
	  Yii::app()->clientScript->registerCoreScript('jquery');
	?>
    <script src="<?php echo $baseUrl;?>/js/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl;?>/js/dist/sweetalert.css">
    <!-- Fav and Touch and touch icons -->
    <link rel="shortcut icon" href="<?php echo $baseUrl;?>/img/icons/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $baseUrl;?>/img/icons/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $baseUrl;?>/img/icons/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo $baseUrl;?>/img/icons/apple-touch-icon-57-precomposed.png">
	<?php  
	  $cs->registerCssFile($baseUrl.'/css/bootstrap.min.css');
	  $cs->registerCssFile($baseUrl.'/css/bootstrap-responsive.min.css');
	  $cs->registerCssFile($baseUrl.'/css/abound.css');
	  //$cs->registerCssFile($baseUrl.'/css/style-blue.css');
	  ?>
      <!-- styles for style switcher -->
      	<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl;?>/css/style-purple.css" />
        <link rel="alternate stylesheet" type="text/css" media="screen" title="style2" href="<?php echo $baseUrl;?>/css/style-brown.css" />
        <link rel="alternate stylesheet" type="text/css" media="screen" title="style3" href="<?php echo $baseUrl;?>/css/style-green.css" />
        <link rel="alternate stylesheet" type="text/css" media="screen" title="style4" href="<?php echo $baseUrl;?>/css/style-grey.css" />
        <link rel="alternate stylesheet" type="text/css" media="screen" title="style5" href="<?php echo $baseUrl;?>/css/style-orange.css" />
        <link rel="alternate stylesheet" type="text/css" media="screen" title="style6" href="<?php echo $baseUrl;?>/css/style-red.css" />
        <link rel="alternate stylesheet" type="text/css" media="screen" title="style7" href="<?php echo $baseUrl;?>/css/style-blue.css" />
	<?php
      $cs->registerScriptFile($baseUrl.'/js/bootstrap.min.js');
	  $cs->registerScriptFile($baseUrl.'/js/plugins/jquery.sparkline.js');
	  $cs->registerScriptFile($baseUrl.'/js/plugins/jquery.flot.min.js');
	  $cs->registerScriptFile($baseUrl.'/js/plugins/jquery.flot.pie.min.js');
	  $cs->registerScriptFile($baseUrl.'/js/charts.js');
	  $cs->registerScriptFile($baseUrl.'/js/plugins/jquery.knob.js');
	  $cs->registerScriptFile($baseUrl.'/js/plugins/jquery.masonry.min.js');
      $cs->registerScriptFile($baseUrl.'/js/styleswitcher.js');
	  $cs->registerScriptFile($baseUrl.'/js/styleswitcher.js');
	?>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!--<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
    <script src="<?php echo $baseUrl;?>/js/jquery.js"></script>-->

    <!--<script src="<?php echo $baseUrl;?>/js/bootstrap-transition.js"></script>
    <script src="<?php echo $baseUrl;?>/js/bootstrap-alert.js"></script>
    <script src="<?php echo $baseUrl;?>/js/bootstrap-modal.js"></script>-->
    <!--<script src="<?php echo $baseUrl;?>/js/bootstrap-dropdown.js"></script>-->
    <!--<script src="<?php echo $baseUrl;?>/js/bootstrap-scrollspy.js"></script>
    <script src="<?php echo $baseUrl;?>/js/bootstrap-tab.js"></script>-->
    <script src="<?php echo $baseUrl;?>/js/bootstrap-tooltip2.js"></script>
    <!--<script src="<?php echo $baseUrl;?>/js/bootstrap-popover.js"></script>
    <script src="<?php echo $baseUrl;?>/js/bootstrap-button.js"></script>
    <script src="<?php echo $baseUrl;?>/js/bootstrap-collapse.js"></script>
    <script src="<?php echo $baseUrl;?>/js/bootstrap-carousel.js"></script>
    <script src="<?php echo $baseUrl;?>/js/bootstrap-typeahead.js"></script>
    <script src="<?php echo $baseUrl;?>/js/bootstrap-affix.js"></script>-->

    <script src="<?php echo $baseUrl;?>/js/holder/holder.js"></script>
    <script src="<?php echo $baseUrl;?>/js/google-code-prettify/prettify.js"></script>

    <script src="<?php echo $baseUrl;?>/js/application.js"></script>
  </head>

<body>

<section id="navigation-main">   
<!-- Require the navigation -->
<?php require_once('tpl_navigation.php')?>
</section><!-- /#navigation-main -->

<section class="main-body">
    
    
    <div class="container-fluid">

        <?php
            $flashMessages = Yii::app()->user->getFlashes();
            if($flashMessages){
                foreach($flashMessages as $key => $messages){
                    echo '<div class="alert alert-' . $key . '"><button type="button" class="close" data-dismiss="alert">&times;</button><h4>Mensaje: </h4>' . $messages . "</div>\n";
                }
            }
        ?>


            <!-- Include content pages -->
            <?php echo $content; ?>
    </div>

</section>

<!-- Require the footer -->
<?php //require_once('tpl_footer.php')?>

  </body>
</html>

<?php

//Yii::app()->clientScript->registerScript(
//    'myHideEffect',
//    '$(".info").animate({opacity: 1.0}, 10000).slideUp("slow");',
//    CClientScript::POS_READY
//    );
?>