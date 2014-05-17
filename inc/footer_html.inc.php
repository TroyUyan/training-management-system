		</div> <!-- end content -->	

		<footer class="clear">
			<div class="line">
			</div><!-- end line -->
			
			<p class="copy">&copy; 2014 Greenwell Bank</p>
			<div class="time">
				<script type="text/javascript">
					//add date
					var currentDate = new Date()
					var day = currentDate.getDate()
					var month = currentDate.getMonth() + 1
					var year = currentDate.getFullYear()
					document.write("<p><strong>" + month + "/" + day + "/" + year + "</strong></p>")
					//add time
					var currentTime = new Date()
					var hours = currentTime.getHours()
					var minutes = currentTime.getMinutes()

					if (minutes < 10)
					minutes = "0" + minutes

					var suffix = "AM";
					if (hours >= 12) {
					suffix = "PM";
					hours = hours - 12;
					}
					if (hours == 0) {
					hours = 12;
					}

					document.write("<p><strong>" + hours + ":" + minutes + " " + suffix + "</strong></p>")				
				</script>

			</div><!-- end time -->
		</footer>	
	</div> <!-- end wrapper -->
</body>
</html>
