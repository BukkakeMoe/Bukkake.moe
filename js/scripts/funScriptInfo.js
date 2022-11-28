var a = 0;
var inten = [];
var act = [];
const average = (array) => array.reduce((a, b) => a + b) / array.length;



window.addEventListener('load', function() {
    var upload = document.getElementById('fileInput');
    var submit = document.getElementById('formid');

    // Make sure the DOM element exists
    if (upload) 
    {
        submit.addEventListener('submit', function() {
        // Make sure a file was selected
        if (upload.files.length > 0) 
        {
          var reader = new FileReader(); // File reader to read the file 

          // This event listener will happen when the reader has read the file
          reader.addEventListener('load', function() {
            var result = JSON.parse(reader.result); // Parse the result into an object 
            console.log(result);
            for (let actions in result['actions']) {
                inten.push(1000 * Math.abs(result['actions'][a+1]['pos'] - result['actions'][a]['pos']) / Math.abs(result['actions'][a + 1]['at'] - result['actions'][a]['at']));
            
                a++;
                //console.log(result['actions'][a++]['at']);
            }
          });
          
          reader.readAsText(upload.files[0]); // Read the uploaded file'
          //
        }
        alert(average(inten));

       

    });
    }
  });