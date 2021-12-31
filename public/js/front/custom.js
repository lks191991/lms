$(document).ready(function () {
    $(".mega-menu-tree > .dropdown-item > i").click(function (e) {
        e.preventDefault();
        $(this).parent().toggleClass("show-submenu");
    });
});