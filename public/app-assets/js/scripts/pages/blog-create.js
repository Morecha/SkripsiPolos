/*=========================================================================================
	File Name: blog-edit.js
	Description: Blog edit field select2 and quill editor JS
	----------------------------------------------------------------------------------------
	Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
	Author: PIXINVENT
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/
(function (window, document, $) {
    "use strict";

    var select = $(".select2");
    var editor = "#blog-editor-container .editor";
    var blogFeatureImage = $("#blog-feature-image");
    var blogImageText = document.getElementById("blog-image-text");
    var blogImageInput = $("#blogCustomFile");

    // Basic Select2 select
    select.each(function () {
        var $this = $(this);
        $this.wrap('<div class="position-relative"></div>');
        $this.select2({
            // the following code is used to disable x-scrollbar when click in select input and
            // take 100% width in responsive also
            placeholder: "Select your tags here",
            dropdownAutoWidth: true,
            width: "100%",
            dropdownParent: $this.parent(),
        });
    });

    // Snow Editor
    var Font = Quill.import("formats/font");
    Font.whitelist = ["sofia", "slabo", "roboto", "inconsolata", "ubuntu"];
    Quill.register(Font, true);

    var blogEditor = new Quill(editor, {
        bounds: editor,
        modules: {
            formula: true,
            syntax: true,
            toolbar: [
                [
                    {
                        font: [],
                    },
                    {
                        size: [],
                    },
                ],
                ["bold", "italic", "underline", "strike"],
                [
                    {
                        color: [],
                    },
                    {
                        background: [],
                    },
                ],
                [
                    {
                        script: "super",
                    },
                    {
                        script: "sub",
                    },
                ],
                [
                    {
                        header: "1",
                    },
                    {
                        header: "2",
                    },
                    "blockquote",
                    "code-block",
                ],
                [
                    {
                        list: "ordered",
                    },
                    {
                        list: "bullet",
                    },
                    {
                        indent: "-1",
                    },
                    {
                        indent: "+1",
                    },
                ],
                [
                    "direction",
                    {
                        align: [],
                    },
                ],
                ["link", "formula"],
                ["clean"],
            ],
        },
        theme: "snow",
    });

    // Custom image handler
    var imageInput = document.getElementById("imageInput");
    blogEditor.getModule("toolbar").addHandler("image", function () {
        imageInput.click();
    });

    imageInput.addEventListener("change", function () {
        if (imageInput.files && imageInput.files[0]) {
            var formData = new FormData();
            formData.append("image", imageInput.files[0]);

            // for (var pair of formData.entries()) {
            //     console.log(pair[0] + ', ' + pair[1]);
            // }
            // AJAX request to handle image upload
            $.ajax({
                url: "/blog/store-image", // Replace with your server endpoint
                method: "POST",
                processData: false,
                contentType: false,
                data: formData,
                success: function (response) {
                    if (response.success) {
                        // Insert the uploaded image into the editor
                        console.log(response.imageUrl);
                        var range = blogEditor.getSelection();
                        blogEditor.insertEmbed(
                            range.index,
                            "image",
                            response.imageUrl,
                            Quill.sources.USER
                        );
                    } else {
                        console.error("Image upload failed.");
                    }
                },
                error: function (error) {
                    console.error("Image upload failed:", error);
                },
            });
        }
    });

    // Blog Insert
    $("body").on("submit", "#form-input-blog", function (e) {
        e.preventDefault();
        var formData = new FormData();
        var quillContent = blogEditor.root.innerHTML; // Get HTML content

        formData.append("quillContent", quillContent);
        formData.append("blogTitle", $("#blog-edit-title").val());
        formData.append("blogMetaTag", $("#blog-edit-meta-tag").val());
        formData.append("blogStatus", $("#blog-status").val());
        formData.append("blogShortDesc", $("#blog-short-desc").val());
        formData.append("image_feature", blogCustomFile.files[0]);

        // Get selected values from the Select2 multiple
        var selectedTags = $("#blog-edit-tag").val();

        // Append each selected tag to the FormData
        if (selectedTags) {
            for (var i = 0; i < selectedTags.length; i++) {
                formData.append("blogTag[]", selectedTags[i]);
            }
        }

        $.ajax({
            method: "POST",
            url: "/blog/store",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log("Success:", response);
                window.location.href = "/blog";
            },
            error: function (xhr, status, error) {
                console.log("Failed:", xhr.responseText); // Log the full response
            },
        });
    });

    // Change featured image
    if (blogImageInput.length) {
        $(blogImageInput).on("change", function (e) {
            var reader = new FileReader(),
                files = e.target.files;
            reader.onload = function () {
                if (blogFeatureImage.length) {
                    blogFeatureImage.attr("src", reader.result);
                }
            };
            reader.readAsDataURL(files[0]);
            blogImageText.innerHTML = blogImageInput.val();
        });
    }
})(window, document, jQuery);
