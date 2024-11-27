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

    var editor = "#blog-editor-container .editor";
    var blogFeatureImage = $("#blog-feature-image");
    var blogImageText = document.getElementById("blog-image-text");
    var blogImageInput = $("#blogCustomFile");

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
                ["link",
                // "image", "video",
                "formula"],
                ["clean"],
            ],
        },
        theme: "snow",
    });

    //input data to controller
    $("body").on("submit","#form-input-portfolio",function(e){
        e.preventDefault();
        var formData = new FormData();
        // ngambil data dari Quill Editor
        var content = blogEditor.root.innerHTML;

        formData.append("title", $("portofolio-create-title").val());
        formData.append("meta_tag", $("portofolio-create-meta").val());
        formData.append("short_desc", $("portofolio-create-short-desc").val());
        formData.append("content", content);
        formData.append("image", blogCustomFile.files[0]);

        $.ajax({
            method: "POST",
            url: "/portofolio/store",
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
