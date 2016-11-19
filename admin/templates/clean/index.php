<?php ?>
<html>
<meta name="viewport" content="width=device-width, user-scalable=no" />
	<head><!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="/admin/templates/clean/css/dashboard.css"></link>
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
		</head>
		<body>
		<?php if (property_exists (CMS::Instance()->content_config, 'nochrome') ):?>
			<?php if (CMS::Instance()->has_messages()):?>
			<div class="container-fluid"><div class="row"><div class="col-xs-12">
				<?php CMS::Instance()->display_messages(); ?>
			</div></div></div>
			<?php endif; ?>
			<?php include_once (CMS::Instance()->content_location . DS . 'index.php');?>
		<?php else: ?>
    <nav class="navbar navbar-inverse navbar-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><?php echo CMS::Instance()->config->sitename; ?></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo CMS::Instance()->config->basepath; ?>/admin/home">Overview</a></li>
            <li><a href="<?php echo CMS::Instance()->config->basepath; ?>/admin/pageadmin">Pages</a></li>
			      <li><a href="<?php echo CMS::Instance()->config->basepath; ?>/admin/content">Content</a></li>
            <li><a href="<?php echo CMS::Instance()->config->basepath; ?>/admin/widgets">Widgets</a></li>
            <li><a href="<?php echo CMS::Instance()->config->basepath; ?>/admin/users">Users</a></li>
            <li><a href="<?php echo CMS::Instance()->config->basepath; ?>/admin/plugins">Plugins</a></li>
            <li><a href="<?php echo CMS::Instance()->config->basepath; ?>/admin/logout">Logout</a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>
        </div>
      </div>
    </nav>
	

    <div class="container">
      <div class="row">
        <!-- <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="/admin/home">Overview <span class="sr-only">(current)</span></a></li>
            <li><a href="/admin/content">Content</a></li>
            <li><a href="/admin/users">Users</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li><a href="">Nav item</a></li>
            <li><a href="">Nav item again</a></li>
            <li><a href="">One more nav</a></li>
            <li><a href="">Another nav item</a></li>
            <li><a href="">More navigation</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li><a href="">Nav item again</a></li>
            <li><a href="">One more nav</a></li>
            <li><a href="">Another nav item</a></li>
          </ul>
        </div>-->
        <!--<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">-->
        <div class="col-sm-12 col-md-12   main">
			<?php if (CMS::Instance()->has_messages()):?>
			<div class="row">
				<?php CMS::Instance()->display_messages(); ?>
			</div>
			<?php endif; ?>
      
		  <?php  include_once (CMS::Instance()->content_location . DS . 'index.php');?>

          
        </div>
      </div>
    </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<?php endif; // chrome check ?>
</body>
</html>


