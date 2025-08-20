/*================
 Template Name: Admin Dashboard
 Description: Multipurpose eCommerce html template with admin dashboard. Multivendor responsive eCommerce template.
 Version: 1.0
 Author: https://themeforest.net/user/themetags
=======================*/
// TABLE OF CONTENTS
"use strict";

jQuery(function ($) {
    ("use strict");
    //preloader with sidebar active class
    $(window).ready(function () {
        //preloader
        $("#preloader").delay(100).fadeOut(1200);
    });

    if ($("#sidebar").length) {
        displayLogo(getCookie("isSideBarCollapsed") ?? "");
        $("#sidebar").hover(
            function () {
                if ($("aside.tt-sidebar.collapse").length) {
                    displayLogo("");
                }
            },
            function () {
                if ($("aside.tt-sidebar.collapse").length) {
                    displayLogo("collapse");
                }
            }
        );
        // side navbar
        document
            .querySelector(".tt-toggle-sidebar")
            .addEventListener("click", function () {
                //store the id of the collapsible element
                setCookie(
                    "isSideBarCollapsed",
                    $("aside.tt-sidebar.collapse").length ? "" : "collapse"
                );
                document.getElementById("sidebar").classList.toggle("collapse");
                displayLogo(
                    $("aside.tt-sidebar.collapse").length ? "collapse" : ""
                );
            });
    }

    if ($(".tt-side-nav").length) {
        let navCollapse = $(".tt-side-nav li .collapse");
        let navToggle = $(".tt-side-nav li [data-bs-toggle='collapse']");
        navToggle.on("click", function (e) {
            return false;
        });

        // open one menu at a time only
        navCollapse.on({
            "show.bs.collapse": function (event) {
                let parent = $(event.target).parents(".collapse.show");
                $(".tt-side-nav .collapse.show")
                    .not(event.target)
                    .not(parent)
                    .collapse("hide");
            },
        });

        // activate the menu in left side bar (Vertical Menu) based on url
        $(".tt-side-nav a").each(function () {
            let pageUrl = window.location.href.split(/[?#]/)[0];
            if (this.href == pageUrl) {
                $(this).addClass("active");
                $(this).parent().addClass("tt-menu-item-active");
                $(this).parent().parent().parent().addClass("show");
                $(this)
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .addClass("tt-menu-item-active"); // add active to li of the current link

                let firstLevelParent = $(this)
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .parent();
                if (firstLevelParent.attr("id") !== "sidebar-menu")
                    firstLevelParent.addClass("show");
                $(this)
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .addClass("tt-menu-item-active");
                let secondLevelParent = $(this)
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .parent();
                if (secondLevelParent.attr("id") !== "wrapper")
                    secondLevelParent.addClass("show");
                let upperLevelParent = $(this)
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .parent();
                if (!upperLevelParent.is("body"))
                    upperLevelParent.addClass("tt-menu-item-active");
            }
        });
    }

    $("#menu-toggle-2").on("click", function () {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled-2");
        $("#menu ul").hide();
    });

    //    dark light mood
    if ($(".tt-theme-toggle").length) {
        let setDarkMode = (active = false) => {
            let wrapper = document.querySelector(":root");
            if (active) {
                wrapper.setAttribute("data-bs-theme", "light");
                localStorage.setItem("theme", "light");
            } else {
                wrapper.setAttribute("data-bs-theme", "dark");
                localStorage.setItem("theme", "dark");
            }
        };
        let toggleDarkMode = () => {
            let theme = document
                .querySelector(":root")
                .getAttribute("data-bs-theme");
            // If the current theme is "light", we want to activate dark
            setDarkMode(theme === "dark");
        };
        let initDarkMode = () => {
            let theme = localStorage.getItem("theme", "dark");
            if (theme == "light") {
                setDarkMode(true);
            } else {
                setDarkMode(false);
            }
            let toggleButton = document.querySelector(".tt-theme-toggle");
            toggleButton.addEventListener("click", toggleDarkMode);
        };
        initDarkMode();
    }

    $(window).on("load", function () {
        let findActiveItem = $(".tt-side-nav .tt-menu-item-active .active");
        let activeOffsetTop =
            findActiveItem &&
            findActiveItem.offset() &&
            findActiveItem.offset().top - 150;
        $(".tt-sidebar-nav").animate({
            scrollTop: activeOffsetTop,
        });
    });

    // toastr js
    // Set the options that I want
    toastr.options = {
        closeButton: true,
        newestOnTop: false,
        progressBar: true,
        positionClass: "toast-top-center",
        preventDuplicates: false,
        onclick: null,
        showDuration: "3000",
        hideDuration: "1000",
        timeOut: "5000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
    };

    // data table js
    if ($(".tt-datatable").length) {
        //Only needed for the filename of export files.
        //Normally set in the title tag of your page.
        document.title = "Card View DataTable";
        // DataTable initialisation
        $(".tt-datatable").DataTable({
            dom: '<"dt-buttons"Bf><"clear">lirtp',
            paging: true,
            autoWidth: true,
            responsive: true,
            scrollCollapse: true,
            scrollY: "25vh",
            buttons: [
                "colvis",
                "copyHtml5",
                "csvHtml5",
                "excelHtml5",
                "pdfHtml5",
                "print",
            ],
            initComplete: function (settings, json) {
                $(".dt-buttons .btn-group").append(
                    '<a id="cv" class="btn btn-primary" href="#">CARD VIEW</a>'
                );
                $("#cv").on("click", function () {
                    if ($(".tt-datatable").hasClass("card")) {
                        $(".colHeader").remove();
                    } else {
                        let labels = [];
                        $(".tt-datatable thead th").each(function () {
                            labels.push($(this).text());
                        });
                        $(".tt-datatable tbody tr").each(function () {
                            $(this)
                                .find("td")
                                .each(function (column) {
                                    $(
                                        "<span class='colHeader'>" +
                                            labels[column] +
                                            ":</span>"
                                    ).prependTo($(this));
                                });
                        });
                    }
                    $(".tt-datatable").toggleClass("card");
                });
            },
        });
    }

    //    select2 js
    $(".select2").each(function () {
        $(this).select2({
            dropdownParent: $(this).parent(),
        });
    });

    //    flatpickr
    $(".date-picker").flatpickr({
        enableTime: true,
    });

    //    summernote
    $("#makeMeSummernote").summernote({
        placeholder: "Type your product description",
        toolbar: [
            ["style", ["bold"]],
            ["fontsize", ["fontsize"]],
            ["para", ["ul", "ol", "paragraph"]],
            ["height", ["height"]],
        ],
        height: window.innerHeight - 430,
        lang: 'en-US',
        imageAttributes: {
            icon: '<i class="note-icon-pencil"/>',
            figureClass: 'figureClass',
            figcaptionClass: 'captionClass',
            captionText: 'Caption Goes Here.',
            manageAspectRatio: true // true = Lock the Image Width/Height, Default to true
        },
        popover: {
            image: [
                ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],,
                ['float', ['floatLeft', 'floatRight', 'floatNone']],
                ['remove', ['removeMedia']],
                ['custom', ['imageAttributes']],
            ],
        },
    });
    $("#productDescription").summernote({
        placeholder: "Add product description",
        height: "100%",
        lang: 'en-US',
        imageAttributes: {
            icon: '<i class="note-icon-pencil"/>',
            figureClass: 'figureClass',
            figcaptionClass: 'captionClass',
            captionText: 'Caption Goes Here.',
            manageAspectRatio: true // true = Lock the Image Width/Height, Default to true
        },
        popover: {
            image: [
                ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],,
                ['float', ['floatLeft', 'floatRight', 'floatNone']],
                ['remove', ['removeMedia']],
                ['custom', ['imageAttributes']],
            ],
        },
    });

    $("#contentGenerator").summernote({
        height: "100%",
        lang: 'en-US',
        imageAttributes: {
            icon: '<i class="note-icon-pencil"/>',
            figureClass: 'figureClass',
            figcaptionClass: 'captionClass',
            captionText: 'Caption Goes Here.',
            manageAspectRatio: true // true = Lock the Image Width/Height, Default to true
        },
        popover: {
            image: [
                ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],,
                ['float', ['floatLeft', 'floatRight', 'floatNone']],
                ['remove', ['removeMedia']],
                ['custom', ['imageAttributes']],
            ],
        },
    });

    // vertical step
    $(window).on("scroll", function () {
        let scrollBarPosition = $(window).scrollTop();
        $(".tt-vertical-step ul li a").each(function () {
            let navOffset = $(this.hash).offset().top - 90;
            if (scrollBarPosition > navOffset) {
                $(this).parents("ul").find("a.active").removeClass("active");
                $(this).addClass("active");
            }
        });
    });

    $(".tt-vertical-step ul li a").each(function () {
        $(this).on("click", function (e) {
            e.preventDefault();
            let hashOffset = $(this.hash).offset().top - 85;
            $("body,html").animate(
                {
                    scrollTop: hashOffset,
                },
                500
            );
        });
    });

    // tooltip
    $("body").tooltip({ selector: '[data-bs-toggle="tooltip"]' });


    // show hide templates optional field
    $(document).ready(function () {
        $(".tt-advance-options-content").hide();
        $(".tt-advance-options").on("click", function (e) {
            $(this).find("i").toggleClass("la-minus la-plus");
            $(".tt-advance-options-content").slideToggle(100);
        });
    });
    $(".tt_editable").on("click", function () {
        let no = this.dataset.no;
        $(".tt_update_text[data-no='" + no + "']")
            .attr("contenteditable", "true")
            .focus();
    });


    $(".file-upload").each(function () {
        let FileInput = $(this).children("input");
        let FileNameOutput = $(this).children(".file-name");
        FileInput.on("change", function () {
            let FileName = this.files[0].name;
            FileNameOutput.text(FileName);
        });
    });

    // image gallery
    $(document).ready(function () {
        $(".tt-image-gallery").magnificPopup({
            delegate: "a",
            type: "image",
            mainClass: "mfp-img-mobile",
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [0, 1], // Will preload 0 - before current, and 1 after the current image
            },
            image: {
                tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                titleSrc: function (item) {
                    return (
                        item.el.attr("title") +
                        "<small>" +
                        item.el.attr("size") +
                        "</small>"
                    );
                },
            },
        });
    });

    // function initScrollToChatBottom() {
    //   let ChatDiv = $(".tt-conversation");
    //   let height = ChatDiv[0].scrollHeight;
    //   ChatDiv.scrollTop(height);
    // }
    // initScrollToChatBottom();

    $(document).ready(function () {
        $(".tt-widget-wrapper .tt-step-next").on("click", function () {
            let button = $(this);
            let currentSection = button.parents(".tt-single-fieldset");
            let currentSectionIndex = currentSection.index();
            let headerSection = $(
                ".tt-widget-wrapper fieldset.tt-single-fieldset"
            ).eq(currentSectionIndex);
            headerSection.removeClass("is-active").next().addClass("is-active");
            $(".tt-progressbar-list")
                .find(".is-active")
                .next()
                .addClass("is-active");
            $(".tt-widget-wrapper").on("submit", function () {
                e.preventDefault();
            });
            if (currentSectionIndex === 4) {
                $(document)
                    .find(".tt-widget-wrapper .tt-single-fieldset")
                    .first()
                    .addClass("is-active");
                $(document)
                    .find(".tt-progressbar-list li")
                    .first()
                    .addClass("is-active");
            }
        });
        $(".tt-widget-wrapper .tt-step-preview").on("click", function () {
            $(".tt-progressbar-list")
                .find(".is-active")
                .last()
                .removeClass("is-active");
        });
    });
});
document.addEventListener("DOMContentLoaded", function () {
    const body = document.querySelector("body");
    /**
     * Slide Up
     */
    const slideUp = (target, duration = 500) => {
        target.style.transitionProperty = "height, margin, padding";
        target.style.transitionDuration = duration + "ms";
        target.style.boxSizing = "border-box";
        target.style.height = target.offsetHeight + "px";
        target.offsetHeight;
        target.style.overflow = "hidden";
        target.style.height = 0;
        target.style.paddingTop = 0;
        target.style.paddingBottom = 0;
        target.style.marginTop = 0;
        target.style.marginBottom = 0;
        window.setTimeout(() => {
            target.style.display = "none";
            target.style.removeProperty("height");
            target.style.removeProperty("padding-top");
            target.style.removeProperty("padding-bottom");
            target.style.removeProperty("margin-top");
            target.style.removeProperty("margin-bottom");
            target.style.removeProperty("overflow");
            target.style.removeProperty("transition-duration");
            target.style.removeProperty("transition-property");
        }, duration);
    };
    /**
     * Slide Down
     */
    const slideDown = (target, duration = 500) => {
        target.style.removeProperty("display");
        let display = window.getComputedStyle(target).display;
        if (display === "none") display = "block";
        target.style.display = display;
        let height = target.offsetHeight;
        target.style.overflow = "hidden";
        target.style.height = 0;
        target.style.paddingTop = 0;
        target.style.paddingBottom = 0;
        target.style.marginTop = 0;
        target.style.marginBottom = 0;
        target.offsetHeight;
        target.style.boxSizing = "border-box";
        target.style.transitionProperty = "height, margin, padding";
        target.style.transitionDuration = duration + "ms";
        target.style.height = height + "px";
        target.style.removeProperty("padding-top");
        target.style.removeProperty("padding-bottom");
        target.style.removeProperty("margin-top");
        target.style.removeProperty("margin-bottom");
        window.setTimeout(() => {
            target.style.removeProperty("height");
            target.style.removeProperty("overflow");
            target.style.removeProperty("transition-duration");
            target.style.removeProperty("transition-property");
        }, duration);
    };
    /**
     * Slide Toggle
     */
    const slideToggle = (target, duration = 500) => {
        if (
            target.attributes.style === undefined ||
            target.style.display === "none"
        ) {
            return slideDown(target, duration);
        } else {
            return slideUp(target, duration);
        }
    };
    // Add Product Offcanvas
    const sidecanvasToggler = document.querySelectorAll(".sidecanvas-toggler");
    if (sidecanvasToggler) {
        sidecanvasToggler.forEach((e) => {
            e.addEventListener("click", () => {
                body.classList.toggle("open-sidecanvas");
            });
        });
    }
    // Table
    new basictable(".product-listing-table", {
        breakpoint: 767,
    });
    new basictable(".break-table-lg", {
        breakpoint: 1199,
    });
    // Toggle Content
    const toggleNextElement = document.querySelectorAll(".toggle-next-element");
    toggleNextElement.forEach((e) => {
        e.addEventListener("click", () => {
            const toggleNextElementIs = e.nextElementSibling;
            slideToggle(toggleNextElementIs, 500);
        });
    });
    // Enter Chat Fullscreen
    const fullscreenToggler = document.querySelector(".fullscreen-toggler");
    const fullscreenBox = document.querySelector(".fullscreen-box");
    if (fullscreenToggler && fullscreenBox) {
        fullscreenToggler.addEventListener("click", () => {
            if (!document.fullscreenElement) {
                fullscreenBox.requestFullscreen();
                $(".tt-screen-height").css("height", "calc(100vh - 120px)");
                $(".content-generator__body .note-editor").css("height", "calc(100vh - 215px)");
            } else if (document.fullscreenElement) {
                $(".tt-screen-height").css("height","calc(100vh - 380px)");
                $(".content-generator__body .note-editor").css("height", "calc(100vh - 415px)");
                document.exitFullscreen();
            }
        });
    }

    //   $(document).on("click", ".btn-reveal-pw", function (e) {
    //     $targetField = closest(".input").find(".pw-input");
    //     if ($targetField.attr("type") == "password") {
    //       $targetField.attr("type", "text");
    //     } else {
    //       $targetField.attr("type", "password");
    //     }
    //   });

    $(".toggle-password").on("click", function (e) {
        $(this).toggleClass("toggle-password");
        let input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
    let passwordField = document.querySelector(".pw-input");
    function switchVisibility() {
        if (passwordField.getAttribute("type") === "password")
            passwordField.setAttribute("type", "text");
        else passwordField.setAttribute("type", "password");
    }

    // password check
    $(".tt-check-password").each(function () {
        let eyeIcon = $(this).find(".eye-icon");
        eyeIcon.on("click", function () {
            $(this).hide();
            $(this).next().show();
            $(this).siblings("input[type='password']").attr("type", "text");
        });
        let eyeSlash = $(this).find(".eye-icon-off");
        eyeSlash.on("click", function () {
            $(this).hide();
            $(this).prev().show();
            $(this).siblings("input[type='text']").attr("type", "password");
        });
    });

    $(".offcanvas").resizable({
        handleSelector: ".splitter",
        resizeWidthFrom: "left",
        resizeHeight: false,
    });
});

// ajaxcall
function ajaxCall(
    callParams,
    successCallback,
    errorCallback,
    timeout = 200000,
    quietMillis = 100
) {
    let ajaxOption = {
        url: callParams.url,
        timeout: timeout,
        type: callParams.type || "POST", // "POST" OR "GET
        dataType: callParams.dataType || "JSON",
        data: callParams.data || {},
        cache: callParams.cache || false,
        processData: callParams.processData || false,
        contentType: callParams.contentType || false,
        complete: callParams.complete || function () {},
        success: successCallback,
        error: errorCallback,
    };

    if (!callParams.hasOwnProperty("processData")) {
        delete ajaxOption.processData;
    }
    if (!callParams.hasOwnProperty("contentType")) {
        delete ajaxOption.contentType;
    }

    if (!callParams.hasOwnProperty("cache")) {
        delete ajaxOption.cache;
    }

    if (!callParams.hasOwnProperty("complete")) {
        delete ajaxOption.complete;
    }

    $.ajax(ajaxOption);
}

function loading(selector, text = "Loading...") {
    $(selector)
        .html(
            '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>' +
                text
        )
        .prop("disabled", true);
}

function loadingInContent(selector, text = "", bg = "") {
    $(selector)
        .html(
            `
            <div class="d-flex justify-content-center align-items-center py-10 gap-1 mx-auto">
                    <div class="tt-loader">
                    <span class="tt-loader-bar-1 ${bg}"></span>
                    <span class="tt-loader-bar-2 ${bg}"></span>
                    <span class="tt-loader-bar-3 ${bg}"></span>
                    <span class="tt-loader-bar-4 ${bg}"></span>
                    <span class="tt-loader-bar-5 ${bg}"></span>
                </div> ${text}
            </div>
            `
        )
        .prop("disabled", true);
}

function loadingInTable(selector, options = {}) {
    let defaultOptions = {
        isLoading: options.isLoading || true,
        loadingText: options.type || "Loading...", // "POST" OR "GET
        colSpan: options.colSpan || 8,
        tdClass: options.tdClass || "",
        bg: options.bg || "",
        prop: options.prop || true,
        icon: options.icon || true,
    };

    let innerContent = "";
    if (defaultOptions.isLoading) {
        innerContent = "Loading...";
    } else {
        innerContent =
            '<span class="material-symbols-rounded fs-48 margin-bottom-5 lh-1">info</span>' +
            "<h5>No Data Found</h5>" +
            "<p>There is no data available.</p>";
    }

    let innerHtml = '';
    if(defaultOptions.icon) {
        innerHtml = `
            <tr>
                <td colspan="${defaultOptions.colSpan}" class="null-td ${defaultOptions.tdClass}">
                    <span class="bt-content">
                        <div class="text-center section-space-y">
                            <div class="d-flex justify-content-center align-items-center py-10 gap-1 mx-auto">
                                <div class="tt-loader">
                                <span class="tt-loader-bar-1 ${defaultOptions.bg}"></span>
                                <span class="tt-loader-bar-2 ${defaultOptions.bg}"></span>
                                <span class="tt-loader-bar-3 ${defaultOptions.bg}"></span>
                                <span class="tt-loader-bar-4 ${defaultOptions.bg}"></span>
                                <span class="tt-loader-bar-5 ${defaultOptions.bg}"></span>
                            </div> ${innerContent}
                        </div>
                        </div>
                    </span>
                </td>
            </tr>
            `;
    } else {
        innerHtml = `
            <tr>
                <td colspan="${defaultOptions.colSpan}" class="null-td ${defaultOptions.tdClass}">
                    <span class="bt-content">
                        <div class="text-center section-space-y">
                            ${innerContent}
                        </div>
                    </span>
                </td>
            </tr>
            `;
    }

    $(selector).html(innerHtml).prop("disabled", defaultOptions.prop);
}

function loadingInBtn(selector, text = "Loading...", bg = "bg-light") {
    $(selector)
        .html(
            `
            <div class="d-flex justify-content-center align-items-center">
                <div class="tt-loader tt-loader-sm">
                    <span class="tt-loader-bar-1 ${bg}"></span>
                    <span class="tt-loader-bar-2 ${bg}"></span>
                    <span class="tt-loader-bar-3 ${bg}"></span>
                    <span class="tt-loader-bar-4 ${bg}"></span>
                    <span class="tt-loader-bar-5 ${bg}"></span>
                </div>
            </div> ${text}
            `
        )
        .prop("disabled", true);
}

function resetLoading(selector, text) {
    $(selector).prop("disabled", false).html(text);
}

function hideElement(selector) {
    if (!$(selector).hasClass("d-none")) {
        $(selector).addClass("d-none");
    }
}

function removeElement(selector) {
    if ($(selector).length > 0) {
        $(selector).remove();
    }
}

function showElement(selector) {
    if ($(selector).hasClass("d-none")) {
        $(selector).removeClass("d-none");
    }
}

function showSuccess(message) {
    showElement(".message-wrapper");
    hideElement(".message-wrapper .alert.alert-danger");
    $(".message-wrapper .alert.alert-success").html(message);
}

function showError(message) {
    showElement(".message-wrapper");
    hideElement(".message-wrapper .alert.alert-success");
    $(".message-wrapper .alert.alert-danger").html(message);
}

function resetFormErrors(frmSelector) {
    hideElement(".message-wrapper");
    removeElement(frmSelector + " .invalid-feedback");
    $(frmSelector).each(function () {
        $(this).find(":input").removeClass("is-invalid");
    });
}

function showFormError(responseData, formSelector = "") {
    responseData = JSON.parse(responseData?.responseText ?? []);
    showError(responseData?.message);

    $.each(responseData?.errors ?? [], function (fieldName, errorMessage) {

        if (fieldName.match(/\.0$/)) {
            let id = fieldName.replace(/\.0$/, "");
            fieldName = id;
        }

        let fieldHtml = `<span class="invalid-feedback" role="alert">${errorMessage[0]}</span>`;
        $(formSelector + " #" + fieldName + "")
            .addClass("is-invalid")
            .after(fieldHtml);
    });
}

function resetForm(formSelector) {
    $(formSelector)
        .find("input:text, input:password, input:file, select, textarea")
        .val("");
        
    $('.select2').each(function () {
        $(this).val('').trigger('change'); // or set to default
    });
    $("#editor").summernote("code", "");
}

function changeText(txtSelector, text) {
    $(txtSelector).html(text);
}

var gFilterObj = {};
$("body").on("click", ".page-item a", function (event) {
    event.preventDefault();
    let page = parseInt($(this).attr("href").split("page=")[1]);
    gFilterObj.page = isNaN(page) ? 0 : page;
    getDataList();
});

$("body").on("change", "#per_page", function (event) {
    event.preventDefault();
    let perPage = parseInt($("#per_page").val());
    gFilterObj.perPage = isNaN(perPage) ? 20 : perPage;
    if (gFilterObj.hasOwnProperty("page")) {
        delete gFilterObj.page;
    }
    getDataList();
});

const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timerProgressBar: true,
    timer: 10000,
    didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
    },
});

// status = warning, error, success, info, and question
function toast(msg, status = "success", position = "top-end") {
    Toast.fire({
        icon: status,
        title: `<span class="toast-msg">${msg}</span>`,
        showCloseButton: true,
        position,
        customClass: {
            closeButton: "tt-sw-close-button",
            icon: "tt-sw-icon",
        },
    });
}

function centerToast(
    msg,
    status = "success",
    confirmBTNClass = "",
    closeBTNClass = ""
) {
    Swal.fire({
        title:
            String(status) === "success"
                ? "Success!"
                : "<strong>Oops! Something went wrong.</strong>",
        icon: status,
        text: msg,
        showCloseButton: true,
        confirmButtonText: "Close",
        confirmButtonAriaLabel: "Close",
        customClass: {
            closeButton: closeBTNClass,
            confirmButton: confirmBTNClass,
        },
    });
}

var alertOptions = {
    showCloseButton: true,
    customClass: {
        title: "tt-sw-title",
        icon: "your-icon-class",
    },
    willOpen: function (ele) {
        $(ele)
            .find("button.swal2-confirm")
            .removeClass("swal2-confirm swal2-styled")
            .addClass("btn btn-sm btn-primary me-2");
        $(ele)
            .find("button.swal2-deny")
            .removeClass("swal2-deny swal2-styled")
            .addClass("btn btn-sm btn-secondary");
    },
};
function swAlert(opts) {
    Swal.fire(Object.assign({}, alertOptions, opts));
}
function swConfirm(opts, callback) {
    Swal.fire(Object.assign({}, alertOptions, opts)).then(callback);
}

/**
 * ################################
 * ####   Select Image Start   ####
 * ################################
 * */
window.host = window.location.protocol + "//" + window.location.host;
$("#selectPDF").on("change", function (e) {
    const file = this.files[0];
    const thumbContainer = $(".tt-vision-thumb");
    thumbContainer.html("");

    // Update the path to the PDF icon accordingly

    // Check if a file is selected
    if (file) {
        // Display the selected PDF file's name along with an icon
        let pdfSvg = window.host + "/assets/img/pdf-icon.svg";
        var innerHTML = `Selected PDF: ${file.name} <img src="${pdfSvg}" loading="lazy" alt="Icon Not Found." />`;
    } else {
        // Display a message if no PDF is selected
        var innerHTML = "No PDF selected";
    }
    thumbContainer.html(innerHTML);
});

$("#selectImages").on("change", function (e) {
    const files = e.target.files;
    const thumbContainer = $(".tt-vision-thumb");

    // Loop through selected files
    for (const file of files) {
        if (file.type.startsWith("image/")) {
            const reader = new FileReader();

            // Read the image file
            reader.onload = function (event) {
                const imageSrc = event.target.result;

                // Create the image HTML
                const imageHtml = `
                <div class="avatar avatar-md">
                    <img class="rounded-circle"
                         src="${imageSrc}"
                         alt="avatar"
                         loading="lazy"
                    />
                    <span class="tt-remove tt-file-remove" data-remove-div-class="avatar">
                        <i data-feather="trash" class="icon-14"></i>
                    </span>
                </div>
            `;

                // Append the image HTML to the container
                thumbContainer.append(imageHtml);
                feather.replace();
            };

            // Read the image as data URL
            reader.readAsDataURL(file);
        }
    }
});

// Remove image when "tt-remove" is clicked
$(document).on("click", ".tt-file-remove", function (e) {
    let removeDivClass = "avatar";

    let dynamicRemoveDivClass = $(this).data("remove-div-class");

    if (dynamicRemoveDivClass) {
        removeDivClass = dynamicRemoveDivClass;
    }

    // Get the parent div
    let parentDiv = $(this).closest(`.${removeDivClass}`);

    // Remove the parent div
    parentDiv.remove();
});

/**
 * ################################
 * ####   Select Image END     ####
 * ################################
 * */

function slugify(str) {
    return str
        .toLowerCase()
        .trim()
        .replace(/[^\w\s-]/g, "")
        .replace(/[\s_-]+/g, "-")
        .replace(/^-+|-+$/g, "");
}

function setCookie(name, value, hours) {
    var expires = "";
    if (hours) {
        var date = new Date();
        date.setTime(date.getTime() + hours * 60 * 60 * 1000);
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(";");
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == " ") c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}
function eraseCookie(name) {
    document.cookie =
        name + "=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;";
}

function formatText(text) {
    return text.replace(/(?:\r\n|\r|\n)/g, "<br>");
}

function convertToHtml(text) {
    return window.markdownit({
        html: true,
        breaks: true,
        linkify: true,
        typographer: true
      }).render(text);//.replace("<table>", "<table class='table table-border'>").replace("<p>", "<p class='mb-0'>");
}

function initScrollToChatBottom() {
    let ChatDiv = $(".tt-conversation");
    let height = ChatDiv[0]?.scrollHeight;
    ChatDiv.scrollTop(height);
}

function resizeTableColumn() {
    $("td,th")
        .css({
            /* required to allow resizer embedding */
            position: "relative",
        })
        /* check .resizer CSS */
        .prepend("<div class='resizer'></div>")
        .resizable({
            resizeHeight: false,
            // we use the column as handle and filter
            // by the contained .resizer element
            handleSelector: "",
            onDragStart: function (e, $el, opt) {
                // only drag resizer
                if (!$(e.target).hasClass("resizer")) return false;
                return true;
            },
        });
}

// resizeTableColumn();

var globalHTMLContent = "";

function saveSettings(options) {
    let entity = options.entity;

    $("#loadingModal").modal("show");

    let callParams= {};
    callParams.type   = "POST";
    callParams.url    = options.url;
    callParams._token = options._token;

    callParams.data = {
        type: "checkbox",
        value: options.value,
        entity: options.entity,
        _token: options._token,
    };

    ajaxCall(
        callParams,
        function (result) {
            $("#loadingModal").modal("hide");
            toast(result.message);
        },
        function (err, type, httpStatus) {
            $("#loadingModal").modal("hide");
            toast(err.responseJSON.message, "error");
        }
    );
}

function getHtmlContentsByClassSelector(selector) {
    return $(`.${selector}`).html();
}

// summernote
$(".editor").each(function (el) {
    var $this = $(this);
    var buttons = $this.data("buttons");
    var minHeight = $this.data("min-height");
    var generateContentMinHeight = $this.data("content-min-height");
    var placeholder = $this.attr("placeholder");
    var format = $this.data("format");

    buttons = !buttons
        ? [
              ["font", ["bold", "underline", "italic", "clear"]],
              ["fontname", ["fontname"]],
              ["para", ["ul", "ol", "paragraph"]],
              ["style", ["style"]],
              ["fontsize", ["fontsize"]],
              ["color", ["color"]],
              ["insert", ["link", "picture", "video"]],
              ["view", ["undo", "redo"]],
          ]
        : buttons;
    placeholder = !placeholder ? "" : placeholder;
    minHeight = !minHeight ? 150 : minHeight;
    minHeight = !generateContentMinHeight
        ? minHeight
        : window.innerHeight - 460;

    format = typeof format == "undefined" ? false : format;

    $this.summernote({
        toolbar: buttons,
        placeholder: placeholder,
        height: minHeight,
        codeviewFilter: false,
        codeviewIframeFilter: true,
        disableDragAndDrop: true,
        fontSizes: [
            "8",
            "9",
            "10",
            "11",
            "12",
            "13",
            "14",
            "15",
            "16",
            "17",
            "18",
            "19",
            "20",
            "21",
            "22",
            "23",
            "24",
            "36",
            "48",
            "64",
        ],
        lang: 'en-US',
        imageAttributes: {
            icon: '<i class="note-icon-pencil"/>',
            figureClass: 'figureClass',
            figcaptionClass: 'captionClass',
            captionText: 'Caption Goes Here.',
            manageAspectRatio: true // true = Lock the Image Width/Height, Default to true
        },
        popover: {
            image: [
                ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],,
                ['float', ['floatLeft', 'floatRight', 'floatNone']],
                ['remove', ['removeMedia']],
                ['custom', ['imageAttributes']],
            ],
        },
        callbacks: {
            onImageUpload: function (files) {
                var url = " {{ route('file-upload') }}"; //path is defined as data attribute for  textarea
                sendFile(files[0], url, $(this));
            },
        },
    });

    var nativeHtmlBuilderFunc = $this.summernote(
        "module",
        "videoDialog"
    ).createVideoNode;

    $this.summernote("module", "videoDialog").createVideoNode = function (url) {
        var wrap = $(
            '<div class="embed-responsive embed-responsive-16by9"></div>'
        );
        var html = nativeHtmlBuilderFunc(url);
        html = $(html).addClass("embed-responsive-item");
        return wrap.append(html)[0];
    };
});

// summernote file upload
function sendFile(file, url, editor) {
    var data = new FormData();
    data.append("file", file);
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
        },
        data: data,
        type: "POST",
        url: url,
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.status == true) {
                editor.summernote("insertImage", response.file);
            } else if (response.status == false) {
                console.log(response.msg);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {},
    });
}

function displayLogo(isSideBarCollapsed) {
    if (isSideBarCollapsed.length) {
        hideElement(".tt-brand-logo");
        showElement(".tt-brand-favicon");
    } else {
        hideElement(".tt-brand-favicon");
        showElement(".tt-brand-logo");
    }
}
// non numeric filter
function nonNumericFilter(evt) {
    evt = evt || window.event;
    var charCode = evt.which || evt.keyCode;
    var charStr = String.fromCharCode(charCode);
    if (
        (isNaN(charStr) && charCode != 46) ||
        charCode === 32 ||
        charCode === 13 ||
        (charCode === 46 && evt.currentTarget.innerText.includes("."))
    ) {
        evt.preventDefault();
    }
}

$(() => {
    feather.replace();
});

function addMyChatMessage(message, avatarImage) {
    let htmlContent = `
        <div class="d-flex justify-content-end mt-4 tt-message-wrap tt-message-me fade-in">
            <div class="d-flex flex-column align-items-end">
                <div class="d-flex align-items-start">
                    <div class="me-3 p-3 rounded-3 text-end mw-450 tt-message-text">${message}</div>
                    <div class="avatar avatar-md flex-shrink-0">
                        <img class="rounded-circle" src="${avatarImage}" alt=" avatar" loading="lazy">
                    </div>
                </div>
            </div>
        </div>
    `;

    return htmlContent;
}
function clearFormatData(copyText) {

    copyText = copyText.replaceAll(/(?:\r\n|\r|\n)/g, '');
    copyText = copyText.replaceAll('                        ', ' ');
    copyText = copyText.replaceAll('     ', ' ');
    copyText = copyText.replaceAll('    ', '');
    copyText = copyText.replaceAll('<br>', '\n');
    copyText = copyText.replaceAll('<span>', '');
    copyText = copyText.replaceAll('</span>', '');
    return copyText;
}
