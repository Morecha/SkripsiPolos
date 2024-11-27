/*=========================================================================================
    File Name: form-file-uploader.js
    Description: dropzone
    --------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

Dropzone.autoDiscover = false;

$(function () {
  'use strict';

  var singleFile = $('#dpz-single-file');
  var multipleFiles = $('#dpz-multiple-files');
  var buttonSelect = $('#dpz-btn-select-files');
  var limitFiles = $('#dpz-file-limits');
  var acceptFiles = $('#dpz-accept-files');
  var removeThumb = $('#dpz-remove-thumb');
  var removeAllThumbs = $('#dpz-remove-all-thumb');
  var mydropzone = $('#galeryUpload');

  // Basic example
  singleFile.dropzone({
    paramName: 'file', // The name that will be used to transfer the file
    clickable: '#select-files',
    maxFiles: 1
  });

  // Multiple Files
  multipleFiles.dropzone({
    paramName: 'file', // The name that will be used to transfer the file
    maxFilesize: 0.5, // MB
    clickable: true
  });

  // Use Button To Select Files
  buttonSelect.dropzone({
    clickable: '#select-files' // Define the element that should be used as click trigger to select files.
  });

  // Limit File Size and No. Of Files
  limitFiles.dropzone({
    paramName: 'file', // The name that will be used to transfer the file
    maxFilesize: 0.5, // MB
    maxFiles: 5,
    maxThumbnailFilesize: 1 // MB
  });

  // Accepted Only Files
  acceptFiles.dropzone({
    paramName: 'file', // The name that will be used to transfer the file
    maxFilesize: 1, // MB
    acceptedFiles: 'image/*'
  });

  //Remove Thumbnail
  removeThumb.dropzone({
    paramName: 'file', // The name that will be used to transfer the file
    maxFilesize: 1, // MB
    addRemoveLinks: true,
    dictRemoveFile: ' Trash'
  });

  // Remove All Thumbnails
  removeAllThumbs.dropzone({
    paramName: 'file', // The name that will be used to transfer the file
    maxFilesize: 1, // MB
    init: function () {
      // Using a closure.
      var _this = this;

      // Setup the observer for the button.
      $('#clear-dropzone').on('click', function () {
        // Using "_this" here, because "this" doesn't point to the dropzone anymore
        _this.removeAllFiles();
        // If you want to cancel uploads as well, you
        // could also call _this.removeAllFiles(true);
      });
    }
  });

//   mydropzone.dropzone({
//     paramName:"image",
//     maxFilesize: maxFilesizeVal, // MB
//     maxFiles: maxFilesVal,
//     resizeQuality: 1.0,
//     acceptedFiles: ".jpeg,.jpg,.png,.webp",
//     addRemoveLinks: false,
//     timeout: 60000,
//     dictFallbackMessage: "Your browser doesn't support drag and drop file uploads.",
//     dictFileTooBig: "File is too big. Max filesize: "+maxFilesizeVal+"MB.",
//     dictInvalidFileType: "Invalid file type. Only JPG, JPEG, PNG and GIF files are allowed.",
//     dictMaxFilesExceeded: "You can only upload up to "+maxFilesVal+" files.",
//     init: function () {
//       // Using a closure.
//       var _this = this;
//       // Setup the observer for the button.
//       $('#clear-dropzone').on('click', function () {
//         // Using "_this" here, because "this" doesn't point to the dropzone anymore
//         _this.removeAllFiles();
//         // If you want to cancel uploads as well, you
//         // could also call _this.removeAllFiles(true);
//       });
//     },
//     maxfilesexceeded: function(file) {
//         this.removeFile(file);
//         // this.removeAllFiles();
//     },
//     sending: function (file, xhr, formData) {
//         $('#message').text('Image Uploading...');
//     },
//     success: function (file, response) {
//         $('#message').text(response.success);
//         console.log(response.success);
//         console.log(response);
//     },
//     error: function (file, response) {
//         $('#message').text('Something Went Wrong! '+response);
//         console.log(response);
//         return false;
//     }
//   });
});
