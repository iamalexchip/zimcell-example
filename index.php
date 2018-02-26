<?php

require __DIR__ . '/vendor/autoload.php';
use Zerochip\ZimCell;
/*
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

/**************************/

if (isset($_POST['cellnum']))
{
	$cellnum = $_POST['cellnum'];
}

if (isset($_POST['runall']))
{
	$runall = $_POST['runall'];
}

if (isset($_POST['provider']))
{
	$provider = $_POST['provider'];
}

/**************************/
?>
<!DOCTYPE html>
<html>
<head>
	<title>Zimcell - A package for verifying providers for Zimbabwean phone numbers</title>
	<link href="/assets/css/bootstrap.css" rel="stylesheet">
	<style>
		body {
			font-size: 16px;
		}
		.card {
			display: block;
			background: #ccc;
			border-radius: 5px;
			padding: 20px;
			margin-bottom: 20px;
		}
		.table {
			background: #eee;
		}
		ul {
		    display: inline-block;
		}
	</style>
</head>
<body>

    <div class="container">

      <br>
      <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/" style="font-size: 22px; margin-top: 5px">Zimcell Demo</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
              <li><a href="https://github.com/zerochip/zimcell"><img src="/assets/images/GitHub-Mark-32px.png" /></a></li>
              <li><a href="#"><img src="/assets/images/rants-icon.jpg" /></a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

      <!-- Main component for a primary marketing message or call to action -->
      	<div class="col-md-12 card">
      		<div class="text-center">
	      		<h2>Zimcell package demo</h2>
	      		<p>This is a demo of the Zimcell package for verifying zimbabwean phone numbers.</p>

		      	<?php if (isset($cellnum)): ?>
			    	<div class="col-md-12">
				    	<hr>
			      			<?php if (isset($runall)): ?>

			      				<table class="text-left table">
			      					<thead>
			      						<th>Method</th>
			      						<th>Result</th>
			      						<th>Description</th>
			      					</thead>
			      					<tr>
			      						<td>refine</td>
			      						<td><?php echo ZimCell::refine($cellnum); ?></td>
			      						<td>removes spaces, the leading 0 and country code if present</td>
			      					</tr>
			      					<tr>
			      						<td>valid</td>
			      						<td><?php echo (ZimCell::valid($cellnum)) ? 'TRUE' : 'FALSE'; ?></td>
			      						<td>true if the cellnumber is a valid Zimbabwean phone number</td>
			      					</tr>
			      					<tr>
			      						<td>intlFormat</td>
			      						<td><?php echo ZimCell::intlFormat($cellnum); ?></td>
			      						<td>converts the phone number to international format</td>
			      					</tr>
			      					<tr>
			      						<td>getProvider</td>
			      						<td><?php echo (is_null(ZimCell::getProvider($cellnum))) ? 'Unknown' : ZimCell::getProvider($cellnum); ?></td>
			      						<td>returns the servive provider for the given number</td>
			      					</tr>
			      					<tr>
			      						<td>isEconet</td>
			      						<td><?php echo (ZimCell::isEconet($cellnum)) ? 'TRUE' : 'FALSE'; ?></td>
			      						<td>true if the number is a econet number</td>
			      					</tr>
			      					<tr>
			      						<td>isEcocash</td>
			      						<td><?php echo (ZimCell::isEcocash($cellnum)) ? 'TRUE' : 'FALSE'; ?></td>
			      						<td>true if the number is a econet number</td>
			      					</tr>
			      					<tr>
			      						<td>isTelecel</td>
			      						<td><?php echo (ZimCell::isTelecel($cellnum)) ? 'TRUE' : 'FALSE'; ?></td>
			      						<td>alternative function for isEconet</td>
			      					</tr>
			      					<tr>
			      						<td>isTelecash</td>
			      						<td><?php echo (ZimCell::isTelecash($cellnum)) ? 'TRUE' : 'FALSE'; ?></td>
			      						<td>alternative function for isTelecel</td>
			      					</tr>
			      					<tr>
			      						<td>isNetone</td>
			      						<td><?php echo (ZimCell::isNetone($cellnum)) ? 'TRUE' : 'FALSE'; ?></td>
			      						<td>true if the number is a netone number</td>
			      					</tr>
			      					<tr>
			      						<td>isOnemoney</td>
			      						<td><?php echo (ZimCell::isOnemoney($cellnum)) ? 'TRUE' : 'FALSE'; ?></td>
			      						<td>alternative function for isNetone</td>
			      					</tr>
			      				</table>

			      			<?php else: ?>

			      				<?php if (Zimcell::codes($provider)) : ?>
				      			
					      			<p><?php echo "Zimcell::is('".$provider."', '".$cellnum."')) returned "; echo (Zimcell::is($provider, $cellnum)) ? 'TRUE' : 'FALSE'; ?>					      			
					      			<p>This means <?php echo $cellnum; ?> is a <strong><?php echo (Zimcell::is($provider, $cellnum)) ? '' : 'not a '; ?>valid</strong> <?php echo $provider; ?> number.</p>

					      		<?php else: ?>

					      			<p>The provider or service you entered is not in the list of supported names</p>
					      			<p>Try one of the following:</p>
					      			<ul>
					      				<li>econet</li>
					      				<li>ecocash</li>
					      				<li>telecel</li>
					      				<li>telecash</li>
					      				<li>netone</li>
					      				<li>onemoney</li>
					      			</ul> 

					      		<?php endif; ?>
			      			
			      			<?php endif; ?>
				    	<hr>
			      	</div>
		      	<?php endif; ?>
		    </div>

	      	<form method="POST">
		        <div class="col-md-4 col-md-offset-4" style="margin-top: 20px">
				    <div class="input-group input-group-lg" style="width: 100%">
				    <?php if (!isset($runall) && isset($cellnum)): ?>
				      <input type="text" name="cellnum" class="form-control" placeholder="Enter a phone number" value="<?php echo $cellnum; ?>" required>
				    <?php else: ?>
				      <input type="text" name="cellnum" class="form-control" placeholder="Enter a phone number" required>
				    <?php endif; ?>
				    </div><!-- /input-group -->
				</div><!-- /.col-lg-6 -->

				<div id="buttons" class="col-md-12" style="margin-top: 20px">
				    <div class="text-center">
				        <button id="provider-button" class="btn btn-default btn-lg" type="button">Verify for a provider</button>
					    <button class="btn btn-default btn-lg" name="runall">Run all functions</button>
				    </div>
				</div>

				<div id="provider-input" class="col-md-4 col-md-offset-4" style="margin-top: 20px; display: none">
				    <div class="input-group">
				      <input type="text" name="provider" class="form-control" placeholder="Provider or service name">
				      <span class="input-group-btn">
				        <button class="btn btn-default">Verify</button>
				      </span>
				    </div><!-- /input-group -->
				</div><!-- /.col-lg-6 -->
			</form>
      	</div>

      	<footer class="text-center" style="padding-top: 30px">
      		<p>Coded By <a href="https://github.com/zerochip">@zerochip</a></p>
      	</footer>

    </div> <!-- /container -->
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script>

    	$("#provider-button").click(function(){
    		$("#buttons").hide();
    		$("#provider-input").show();
    	});
    
    </script>
</body>
</html>
