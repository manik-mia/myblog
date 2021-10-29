
// ----------------------------jQuery---------------------------------------
$(document).ready(function () {
  $('#data-table').DataTable();
  $('.dataTables_length').addClass('bs-select');
});
/********************Raw Javascript*****************/

/******************** Accordion **********************/

// const accordion=document.querySelectorAll(".accordion");
// accordion.forEach(item=>{
//   item.addEventListener('click',()=>{
    
//     const accordionContent=document.querySelector(".accordion-content");
//     console.log(accordionContent.classList.toggle('active'));
//   });
// })

var acc = document.getElementsByClassName("accordion-title");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}

/******************** Feature Image Preview **********************/

const inputFile=document.getElementById("feature-image");
const previewCon=document.getElementById("image-preview");
const previewImage=previewCon.querySelector("#preview-image");
inputFile.addEventListener("change",function(){
  const file=this.files[0];
  if(file){
    const reader= new FileReader();
    previewImage.style.display="block";
    reader.addEventListener("load",function() {
      console.log(this);
      previewImage.setAttribute("src",this.result);
    });
    reader.readAsDataURL(file);
  }else{
    previewImage.style.display=null;
    previewImage.setAttribute("src",'');
  }
});
/******************** TinyMce ***********************/

// tinymce.init({
//     selector:'textarea',
//     plugins: 'image code lists advlist anchor preview fullpage emoticons lists importcss insertdatetime searchreplace table wordcount tabfocus bbcode',
//     content_css: '/style.css',
//     toolbar: 'undo redo | link image | code | anchor | preview | fullpage | emoticons | numlist bullist | insertdatetime | searchreplace | table tabledelete | wordcount',
//     advlist_bullet_styles: 'square',
//     advlist_number_styles: 'lower-alpha',
//     a11y_advanced_options: true,
//     images_upload_url: '/upload',
//     image_title: true,
//     automatic_uploads: true,
//     file_picker_types: 'image',
//   /* and here's our custom image picker*/
//     file_picker_callback: function (cb, value, meta) {
//         var input = document.createElement('input');
//         input.setAttribute('type', 'file');
//         input.setAttribute('accept', 'image/*');

//         input.onchange = function () {
//             var file = this.files[0];

//             var reader = new FileReader();
//             reader.onload = function () {

//             var id = 'blobid' + (new Date()).getTime();
//             var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
//             var base64 = reader.result.split(',')[1];
//             var blobInfo = blobCache.create(id, file, base64);
//             blobCache.add(blobInfo);

//         /* call the callback and populate the Title field with the file name */
//             cb(blobInfo.blobUri(), { title: file.name });
//         };
//         reader.readAsDataURL(file);
//     };

//     input.click();
//     },
//     content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
//});
tinymce.init({
  selector: 'textarea',

  image_class_list: [
  {title: 'img-responsive', value: 'img-responsive'},
  ],
  height: 500,
  setup: function (editor) {
      editor.on('init change', function () {
          editor.save();
      });
  },
  plugins: [
      "advlist autolink lists link image charmap print preview anchor",
      "searchreplace visualblocks code fullscreen",
      "insertdatetime media table contextmenu paste imagetools"
  ],
  toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image ",

  image_title: true,
  automatic_uploads: true,
  images_upload_url: '/upload',
  file_picker_types: 'image',
  images_upload_credentials: true,
  file_picker_callback: function(cb, value, meta) {
    var input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('accept', 'image/*');
    input.onchange = function() {
        var file = this.files[0];

        var reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function () {
            var id = 'blobid' + (new Date()).getTime();
            var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
            var base64 = reader.result.split(',')[1];
            var blobInfo = blobCache.create(id, file, base64);
            blobCache.add(blobInfo);
            cb(blobInfo.blobUri(), { title: file.name });
        };
    };
    input.click();
  }
});