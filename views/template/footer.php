<?php if(!defined('INDEX')) die('Direct access is prohibited!');?>
		<div class="container">

			<hr>

			<footer>
				<p>© Binary <?php echo date('Y');?></p>
			</footer>
		</div> <!-- /container -->

		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="assets/js/jquery-1.11.2.min.js"></script>
		<!-- Latest compiled and minified JavaScript -->
		<script src="assets/js/bootstrap.min.js"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<script src="assets/js/ie10-viewport-bug-workaround.js"></script>
		
		<!-- Load javascript files -->
		<script>var urlParams = <?php echo json_encode($_GET, JSON_HEX_TAG);?>;</script>
		<script>
		$(document).ready(function(){			
			$.getScript("assets/js/"+urlParams['page']+".js", function(){
				console.log(urlParams['page']+' loaded');
			});
		});
		</script>
	</body>
</html>