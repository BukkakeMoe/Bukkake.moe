
<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<title>URL builder</title>
	<link rel="shortcut icon" type="image/png" href="image/favicon.png" />
</head>

<body>
	<div class="container">
		<h1>
			No Video Playback
		</h1>
		<p>A simple site that lets you input a script with a black video for playback.</p>
		<form action="urlvideo.html" method="get" target="_blank">
			<div class="form-group">
				<label for="key">Connection Key</label>
				<input type="text" name="key" class="form-control" id="key" placeholder="Connection key to your Handy" value="">
			</div>
			<div style='display:none;' class="form-group">
				<label for="videoUrl">Video url</label>
				<input type="text" name="videourl" class="form-control" id="videoUrl" placeholder="Video url" value="https://bukkake.ml/videos/black.mp4">
			</div>
			<div class="form-group">
				<label for="scriptUrl">Script url (must be in CSV format. Use <a href="https://bukkake.moe/tools/convert.html" target="_BLANK">this tool</a> to convert from funscript to CSV), upload to https://catbox.moe/ after.</label>
				<input type="text" name="scripturl" class="form-control" id="scriptUrl" placeholder="Script url" value="https://sweettecheu.s3.eu-central-1.amazonaws.com/scripts/admin/dataset.csv">
			</div>
			<div style="display:none;" class="form-group">
				<label for="format">Format</label>
				<select class="form-control"  name="format" id="format">
					<option>MONO_FLAT</option>
					<option>STEREO_180_LR</option>
					<option>STEREO_180_LR_SPHERICAL</option>
					<option>STEREO_180_TB_SPHERICAL</option>
					<option>STEREO_360_TB</option>
					<option>MONO_360</option>
					<option>STEREO_FLAT_LR</option>
					<option>STEREO_FLAT_LR_SQUARE</option>
					<option>STEREO_FLAT_TB</option>
					<option>STEREO_FLAT_TB_SQUARE</option>
				</select>
			</div>
			<div style="display:none;"class="form-group">
				<label for="fps">FPS</label>
				<select class="form-control" name="fps" id="fps">
					<option>30</option>
					<option>60</option>
					<option>90</option>
					<option>120</option>
					<option>240</option>
					<option>24</option>
				</select>
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>

	<script src="https://code.jquery.com/jquery-3.3.1.min.js"
		integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT"
		crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
		integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
		crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
		integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
		crossorigin="anonymous"></script>

	<script>

	</script>
</body>

</html>