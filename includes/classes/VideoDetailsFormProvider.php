<?php

class VideoDetailsFormProvider{

	private $con;

	public function __construct($con){
		$this->con = $con;
	}

	public function createUploadForm(){
		$fileInput = $this->createFileInput();
		$scriptInput = $this->createFunscriptInput();
		$titleInput = $this->createTitleInput(null);
		$descriptionInput = $this->createDescriptionInput(null);
		$privacyInput = $this->createPrivacyInput(null);
		$categoriesInput = $this->createCategoriesInput(null);
		$uploadButton = $this->createUploadButton();
		return "<form action='processing' method='POST' enctype='multipart/form-data'>
					$titleInput
					$descriptionInput
					$fileInput
					$scriptInput
					$privacyInput
					$categoriesInput
					$uploadButton
					<input type='hidden' value='' id='video_url' name='video_url'>
            		<input type='hidden' value='' id='video_thumbnail' name='video_thumbnail'>
					<input type='hidden' value='' id='cloud_id' name='cloud_id'>
					<input type='hidden' value='' id='duration' name='duration'>
				</form>";
	}
		public function createUploadForm2(){
		$fileInput = $this->createFileInput();
		$uploadChoice = $this->createUploadChoice();
		$scriptInput = $this->createFunscriptInput();
		$urlInput = $this->createURLFileUpload();
		$titleInput = $this->createTitleInput(null);
		$descriptionInput = $this->createDescriptionInput(null);
		$privacyInput = $this->createPrivacyInput(null);
		$categoriesInput = $this->createCategoriesInput2(null);
		$createReq = $this->createCheckBox();
		$uploadButton = $this->createUploadButton();
		return "<form action='processing' method='POST' enctype='multipart/form-data'>
					$titleInput
					$descriptionInput
					$fileInput
					$urlInput
					$uploadChoice
					$scriptInput
					$privacyInput
					$categoriesInput
					$createReq
					$uploadButton
					<input type='hidden' value='' id='video_url' name='video_url'>
            		<input type='hidden' value='' id='video_thumbnail' name='video_thumbnail'>
					<input type='hidden' value='' id='cloud_id' name='cloud_id'>
					<input type='hidden' value='' id='duration' name='duration'>
				</form>";
	}
 
	public function createEditDetailsForm($video){
		$titleInput = $this->createTitleInput($video->getTitle());
		$descriptionInput = $this->createDescriptionInput($video->getDescription());
		$scriptInput = $this->editFunscriptInput();
		$privacyInput = $this->createPrivacyInput($video->getPrivacy());
		$categoriesInput = $this->createCategoriesInput2(null);
		$saveButton = $this->createSaveButton();
		$deleteButton = $this->createDeleteButton();
		$intensityValue = $video->getIntensity();
		return "<form method='POST' enctype='multipart/form-data'>
					$titleInput
					$descriptionInput
					$scriptInput
					$privacyInput
					$categoriesInput
					$saveButton
					$deleteButton
					<input type='hidden' value='$intensityValue' id='video_intensity' name='video_intensity'>

				</form>";
	}
private function createCheckBox(){
	return "<div class='form-group'>
	<input type='checkbox' id='req' name='req'>
	<label for='req'><h6>Agree that you have permission and have provided credit to this script or have made it yourself.</h6></label>
	<br>
	<a href='https://bukkake.moe/wiki/index.html#/guide?id=credit' target='_blank'>More info here <a/>
  </div>";
}
private function createURLFileUpload(){
	return '<div class="form-group" id="urlUpload">
				<div class="input-group mb-3">
				<input id="urlInput" type="text" class="form-control" placeholder="Porn URL (only spankbang.com for now)" aria-label="Porn URL" aria-describedby="basic-addon2">
					<div class="input-group-append">
					<button class="btn btn-success" onclick="processURL(document.getElementById(`urlInput`).value);" type="button">Go</button>
					</div>
				</div>
			</div>';
}
private function createUploadChoice(){
	return '<div class="row justify-content-md-center"" id="uploadChoice">

	<div class="col-md-auto text-center">
	<a href="#" onClick="f();"><i class="fa-solid fa-file-video fa-2xl"></i></a>
	<p>File Upload</p>

  </div>
  <div class="col-md-auto text-center">
  <a href="#" onClick="u();"><i class="fas fa-link fa-2xl"></i></a>	
  <p>URL Upload</p>
  </div>
</div>
<script>
document.getElementById("fileUpload").style.display = "none";
document.getElementById("urlUpload").style.display = "none";

function f(){
	alert("File uploads are currently disabled due to storage being full. Use URL upload instead");
	//document.getElementById("uploadChoice").style.display = "none";
	//document.getElementById("fileUpload").style.display = "block";
}
function u(){
	document.getElementById("uploadChoice").style.display = "none";
	document.getElementById("urlUpload").style.display = "block";
}
</script>
';
}
private function createFileInput(){
		return "<div class='form-group'>
				<section class='fileUpload' id='fileUpload'>

				  <!-- Target DOM node #1 -->
				  <div class='for-DragDrop'></div>

				  <!-- Progress bar #1 -->
				  <div class='for-ProgressBar'></div>

				  <!-- Uploaded files list #1 -->
				  <div class='uploaded-files'>
					<ol></ol>
				  </div>
				</div>
			  
							<input type='file' style='display:none;' id='video_file' onchange='upload(this.files[0])' name='upload_widget_opener' accept='.mp4'/>


					</div>";
				/*	  	  <label type='button' class='btn vizew-btns' for='upload_widget_opener' >Upload Video</label>
					  <input type='file' style='display:none;' id='upload_widget_opener' onchange='upload(this.files[0])' name='upload_widget_opener' accept='.mp4' required/>
					  
				  	</div>
				</div>";*/
	}
		
	private function editFunscriptInput(){
		return "<div class='input-group mb-3'>
				  	<div class='custom-file'>
					  <label style='width: 100%;' class='btn btn-dark btn-file'>
							Upload New Script <input type='file' hidden  id='funScript' name='funScript' accept='.csv, .funscript'/>

					</label>
					</div>
				</div>
				<p class='d-flex justify-content-center' id='statusFS'></p>
				";
			/*		  <label type='button' class='btn vizew-btns' for='funScript' >Upload Script</label>

					  <input type='file' style='display:none;' id='funScript' name='funScript' accept='.csv, .funscript' required/>
				  	</div>
				</div>";*/
	}
	
	private function createFunscriptInput(){
		return "<div class='input-group mb-3'>
				  	<div class='custom-file'>
					  <label style='width: 100%;' class='btn btn-dark btn-file'>
							Upload Script <input type='file' hidden  id='funScript' name='funScript' accept='.csv, .funscript' required/>

					</label>
					</div>
				</div>
				<p class='d-flex justify-content-center' id='statusFS'></p>
				";
			/*		  <label type='button' class='btn vizew-btns' for='funScript' >Upload Script</label>

					  <input type='file' style='display:none;' id='funScript' name='funScript' accept='.csv, .funscript' required/>
				  	</div>
				</div>";*/
	}
	
	

	private function createTitleInput($value){
		if($value == null) $value = "";
		return "<div class='form-group'>
                    <label for='name'>Title</label>
                    <input type='text' class='form-control' id='titleInput' name='titleInput' value='$value' required minlength='10' autocomplete='off'>
                </div>";
	}

	private function createDescriptionInput($value){
		if($value == null) $value = "";
		return "<div class='form-group'>
                    <label for='description'>Description (Use # For tags)</label>
                    <textarea style='resize: vertical;' name='descriptionInput' class='form-control' id='description' rows='3'>$value</textarea>
                </div>";
	}

	private function createPrivacyInput($value){
		if($value == null) $value = "";

		$privateSelected = ($value == 1) ? "selected='selected'" : "";
		$publicSelected = ($value == 0) ? "selected='selected'" : "";
		return "<div class='form-group' hidden>
					<select class='form-control' id='sel1' name='privacyInput'>
						<option value='0' $publicSelected>Public</option>
				    	<option value='1' $privateSelected>Private</option>
					</select>
				</div>";
	}
	private function createCategoriesInput($value){
		if($value == null) $value = "";
		$query = $this->con->prepare("SELECT * FROM categories");
		$query->execute();

		$html = "<div class='form-group' name='catInput'>
		<label for='categoryInput'>Category (Choose up to 8)</label>

		<div>
					<select name='categoryInput[]'  title='Category' class='selectpicker' data-size='5' aria-label='size 3 select example' multiple>";

		while($row = $query->fetch(PDO::FETCH_ASSOC)){
			$id = $row["id"];
			$name = $row["name"];

			$selected = ($id == $value) ? "selected='selected'" : "";

			$html .= "<option value='$id' $selected >$name</option>";
		}

		$html .= "</select>
				</div>
				</div>";

		return $html;
	}

	private function createCategoriesInput2($value){
		if($value == null) $value = "";
		$query = $this->con->prepare("SELECT * FROM categories ORDER BY name");
		$query->execute();

		$html = "<div class='form-group' name='catInput'><label for='categoryInput'>Category (Choose up to 8)</label>


					<div class='check-boxes' id='category_list' title='Category'>";

		while($row = $query->fetch(PDO::FETCH_ASSOC)){
			$id = $row["id"];
			$name = $row["name"];

			$selected = ($id == $value) ? "selected='selected'" : "";
			
			$html .= " <input type='checkbox' name='categoryInput[]' value='$id' $selected id='$id'>
			<label class='cat_label' for='$id'>$name</label>";
		}

		$html .= "
				</div>
				</div>
				<div></div>";

		return $html;
	}

	private function createUploadButton(){
		return "<div class='d-flex justify-content-center'><button data-toggle='modal' data-target='#loadingModal' class='btn vizew-btn mt-30' type='submit' name='uploadButton'>Upload</button></div>";
	}

	private function createSaveButton(){
		return "<button data-toggle='modal' data-target='#loadingModal' class='btn vizew-btn mt-30' type='submit' name='saveButton'>Save</button>";
	}

	private function createDeleteButton(){
		return "<button data-toggle='modal' data-target='#loadingModal' class='btn vizew-btn mt-30' type='submit' name='deleteButton'>Delete this video</button>";
	}
}


?>