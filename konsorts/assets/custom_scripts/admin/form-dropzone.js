var FormDropzone = function () {

    return {
        //main function to initiate the module
        init: function () {
            var unique_id = $("input[name='file_upload_unique_id']").val();
            Dropzone.options.myDropzone = {
                dictDefaultMessage: "",
                acceptedFiles: '.jpg,.png,.jpeg,.gif',
                maxFilesize: 1, // MB
                init: function () {
                    this.on("addedfile", function (file) {

                        // Create the remove button
                        var removeButton = Dropzone.createElement("<a href='javascript:;'' class='btn red btn-sm btn-block'>Remove</a>");

                        // Capture the Dropzone instance as closure.
                        var _this = this;

                        // Listen to the click event
                        removeButton.addEventListener("click", function (e) {
                            // Make sure the button click doesn't submit the form:
                            e.preventDefault();
                            e.stopPropagation();

                            // Remove the file preview.
                            DeleteDropzoneFile(unique_id , file.name);
                             _this.removeFile(file);
                            // If you want to the delete the file on the server as well,
                            // you can do the AJAX request here.
                        });

                        // Add the button to the file preview element.
                        file.previewElement.appendChild(removeButton);

                        // default dropzone checks
                        if (file.size > this.options.maxFilesize * 1024 * 1024) {
                            swal({
                                title: "Invalid!",
                                text: "Invalid file! Please upload file which is less than 1 mb.",
                                type: "error",
                            });
                            this.removeFile(file);
                        }
//                        else if (!Dropzone.isValidFile(file, this.options.acceptedFiles)) {
//                            return done(this.options.dictInvalidFileType);
//                        } else if ((this.options.maxFiles != null) && this.getAcceptedFiles().length >= this.options.maxFiles) {
//                            done(this.options.dictMaxFilesExceeded.replace("{[{maxFiles}]}", this.options.maxFiles));
//                            return this.emit("maxfilesexceeded", file);
//                        } else if (isDuplicate === true) {
//                            // output my error string for duplicates
//                            return done(this.options.dictDuplicate);
//                        } else {
//                            return this.options.accept.call(this, file, done);
//                        }


                    });
                }
            }
        }
    };
}();

jQuery(document).ready(function () {
    FormDropzone.init();
});