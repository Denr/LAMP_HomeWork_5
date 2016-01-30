$(document).ready(function () {
    $("#feedback").keydown(function (e) {
        var max = 200;
        var char = $("#char");
        var text = $("#feedback").val().length;
        if (text >= max) {
            if (e.keyCode === 8) {
                return;
            }
            char.html("You have reached the limit");
            e.preventDefault();
            return;
        }
        char.html("Characters left: " + (max - text));
    });
    $("#add_file").click(function () {
        $("#files_form").append("<input name='image[]' id='image' class='btn btn-purple btn top' type='file' required/>");
    });
});