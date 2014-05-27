		</div> <!-- end content -->	

		<footer class="clear">
			
			<p class="copy">&copy; 2014 Greenwell Bank</p>
			
			<div id="time">
				<script type="text/javascript">
					document.write ('<p><span id="date-time">', new Date().toLocaleString(), '<\/span><\/p>')
					if (document.getElementById) onload = function () {
						setInterval ("document.getElementById ('date-time').firstChild.data = new Date().toLocaleString()", 50)
					}
				</script>

			</div><!-- end time -->
		</footer>	
	</div> <!-- end wrapper -->
</body>
</html>
