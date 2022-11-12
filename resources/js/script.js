$(document).ready(function () {
    $(".board-btn").each(function () {
        $(this).click(function () {
            $(this).toggleClass("bg-orange text-white");
        });
    });
});
