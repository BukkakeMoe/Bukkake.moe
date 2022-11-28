<?php 
require_once("includes/header.php");
require_once("includes/classes/VideoDetailsFormProvider.php");
if(!$usernameLoggedIn){
    header ("Location: signIn");
}
?>
<link href="https://releases.transloadit.com/uppy/v2.4.1/uppy.min.css" rel="stylesheet">
<style>
/* Tooltip container */
.tooltip {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black; /* If you want dots under the hoverable text */
}

/* Tooltip text */
.tooltip .tooltiptext {
  visibility: visible;
  width: 120px;
  background-color: black;
  color: #fff;
  text-align: center;
  padding: 5px 0;
  border-radius: 6px;
  top: -5px;
  right: 105%;
  /* Position the tooltip text - see examples below! */
  position: absolute;
  z-index: 1;
}
.check-boxes {
  overflow:hidden;
}
.cat_label {
    width: 120px;
    display: block;
    float: left;
    cursor: pointer;
    padding: 6px 0;
    margin: 1px;
    font-size: 1em;
    overflow: hidden;
    text-align: center;
    font-weight: 400;
    background-color: #393c3d;
    color: #ddd;
}
.check-boxes label:hover{
    background-color: #db4437!important;
    color: #ddd;
}
.check-boxes input{
  display: none;
}
.check-boxes input[type=checkbox]:checked + label {
  background-color: #db4437;
  outline: 0;
}

.uppy-StatusBar-progress{background-color: #db4437;} .uppy-DragDrop-container{background-color:#393c3d;} .uppy-StatusBar-statusSecondary{color:#d1d1d1;} .uppy-StatusBar{background-color:#393c3d;} .uppy-StatusBar-statusPrimary{color:#db4437;}</style>
<!-- Load Uppy JS bundle. -->
<script src="https://releases.transloadit.com/uppy/v2.4.1/uppy.min.js"></script>

	<section class="contact-area mb-80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <!-- Section Heading -->
                    <div class="section-heading style-2">
                    	<br>
                        <h4>Upload Video</h4>
                        <div class="line"></div>
                    </div>
                    <!-- Contact Form Area -->
                    <div class="contact-form-area mt-50">
                        <?php
                            $formProvider = new VideoDetailsFormProvider($con);
                            echo $formProvider->createUploadForm2();
                        ?>
                    </div>
                    <p>By uploading content you agree our <a href='/tos'>Terms Of Service</a>

                   <!-- <div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="loadingModal" aria-hidden="true" data-backdrop="static" data-keyboard='false'>
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <img src="img/pleasewait2.gif">
                        </div>
                      </div>
                    </div>-->

                </div>
            </div>
        </div>
    </section>
	




<script>
  function formatBytes(a,b=2,k=1024){with(Math){let d=floor(log(a)/log(k));return 0==a?"0 Bytes":parseFloat((a/pow(k,d)).toFixed(max(0,b)))+" "+["Bytes","KB","MB","GB","TB","PB","EB","ZB","YB"][d]}}

const { Core } = Uppy
const { XHRUpload } = Uppy
const { StatusBar } = Uppy
const { DragDrop  } = Uppy

const uppy = new Uppy.Core({ debug: true,
 autoProceed: true,
  restrictions: {
    maxFileSize: 536870912,
	maxNumberOfFiles: 1,
    minNumberOfFiles: 1,
	allowedFileTypes: ['.mp4'] 
  },
 locale:{},
 })
 uppy.on('error', (error) => {
  console.error(error.stack)
})
uppy.on('restriction-failed', (file, error) => {
  // do some customized logic like showing system notice to users
  if(file.size > 536870912){
    alert('Upload limt is 500MB. uploaded file is '+formatBytes(file.size))
  }
  console.log(formatBytes(file.size));
})


uppy.use(DragDrop, {
  target: '.fileUpload .for-DragDrop',
  
})
uppy.use(StatusBar, {
  id: 'StatusBar',
  target: '.fileUpload .for-ProgressBar',
  showProgressDetails: true,
  hideAfterFinish: false,
  locale: {},
})
uppy.use(XHRUpload, {
  endpoint: 'https://milk.bukkake.moe/upload',
  formData: true,
  fieldName: 'thefile',
  timeout:0,
})

// And display uploaded files
uppy.on('upload-success', (file, response) => {
  const url = 'https://milk.bukkake.moe/videos/'+String(response.body['video'])
  const fileName = file.name

  const li = document.createElement('li')
  const a = document.createElement('a')
  a.href = url
  a.target = '_blank'
  a.appendChild(document.createTextNode(fileName))
  li.appendChild(a)
  document.getElementById('video_url').value ='https://milk.bukkake.moe/videos/'+String(response.body['video'])
  document.getElementById('video_thumbnail').value ='https://milk.bukkake.moe/thumbnails/'+String(response.body['thumb'])
  document.getElementById('duration').value = String(response.body['duration']).replace(/\n/g, '')
  document.getElementById('fileUpload').innerHTML = '<video controls style="width: 100%; height: 300px; object-fit: cover;" > <source src="'+url+'" type="video/mp4"></video>';
  document.querySelector('.fileUpload').appendChild(li)
  document.getElementsByName('uploadButton')[0].style = "display:block";

})


</script>
<script src="js/scripts/uploadScripts.js?v=f32c002sxx5d"></script>

<script>
$('input[type=checkbox]').change(function(e){
   if ($('input[name*="categoryInput[]"]:checked').length > 8) {
        $(this).prop('checked', false)
        
   }
})
//var xpath = "//label[text()='Bukkake Original']"; 
//var matchingElement = document.evaluate(xpath, document, null, XPathResult.FIRST_ORDERED_NODE_TYPE, null).singleNodeValue;
  // choose target dropdown


  document.getElementsByName('uploadButton')[0].style = "display:none";
  var input = document.getElementById( 'funScript' );
  input.addEventListener( 'change', showFileName );
  function showFileName( event ) {
    var ex = input.value.split('.').pop();
    var funSearch =  input.value.substring(0, input.value.lastIndexOf('.')) || input.value;
    funSearch = funSearch.replace(/^.*\\/, "");
    $.post('includes/classes/searchFunscripts.php', { funscript: funSearch }, function(result) { 
      console.log(funSearch);
      console.log(result);
      if(result != ''){
        console.log(result);
        document.getElementById('statusFS').innerHTML += '<div class="d-flex justify-content-center">'+result+"</div>";
        document.getElementById('statusFS').outerHTML += '<h5 class="d-flex justify-content-center" style="color:white;white-space: pre-line;">We found a similar matching script</h5> ';
        
      } 
    });
    if(ex =='funscript' | ex == 'csv'){
      if(ex == 'csv'){
        document.getElementById('statusFS').innerHTML = `<a href='https://bukkake.moe/wiki/index.html#/guide?id=credit' target="_blank"><h4 style="color:red;">!! Heads up! you're uploading a CSV file, this doesn't contain credit info. Click me to find out more. !!</h4><a> `;
    
      }else{
        document.getElementById('statusFS').innerHTML = `
    <a style="color:green;white-space: pre-line;" >`+input.value.split(/(\\|\/)/g).pop()+`</a>`;
      }
    
  }else{
    document.getElementById('statusFS').innerHTML = `
    <i style="color:red;" class="fas fa-exclamation">&nbsp;Not a script, supported file types are CSV and FunScript&nbsp;</i><i style="color:red;" class="fas fa-exclamation"></i>`;
    input.value = '';
  }
  }
  /*
function upload(file) {
  let xhr = new XMLHttpRequest();
  // listen for upload progress
  xhr.upload.onprogress = function(event) {
    let percent = Math.round(100 * event.loaded / event.total);
    console.log(`File is ${percent} uploaded.`);
	document.getElementById('status').innerHTML = `Video is ${percent} uploaded.`;
  };

  // handle error
  xhr.upload.onerror = function() {
    console.log(`Error during the upload: ${xhr.responseText}.`);
  };

  // upload completed successfully
  xhr.onload = function() {
	document.getElementById('video_file').value = '';
  document.getElementById('video_url').value ='https://milk.bukkake.moe/videos/'+JSON.parse(xhr.responseText)['video']
  document.getElementById('video_thumbnail').value ='https://milk.bukkake.moe/thumbnails/'+JSON.parse(xhr.responseText)['thumb']
  document.getElementById('duration').value = JSON.parse(xhr.responseText)['duration']
  console.log(JSON.parse(xhr.responseText)['duration']);

  document.getElementsByName('uploadButton')[0].style = "display:block";

  console.log('Upload completed successfully.');
  };
 
	xhr.open('POST', 'https://milk.bukkake.moe/upload.php',true);
	var formData = new FormData();
	formData.append("thefile", file, file.name);
	xhr.send(formData);
}*/
</script>

    


<?php require_once("includes/footer.php"); ?>
