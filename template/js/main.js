$(document).ready(function () {
    $(".form-signin").on("submit", function (e) {
        $.ajax({
            type: 'POST',
            url: 'register',
            data: {
                email: $("#inputEmail").val(),
                password: $("#inputPassword").val()
            },
            success: function(response){
                if (response.status == false) {
                    $(".error").text(response.data);
                }
            },
            dataType: "json"
        });
        e.preventDefault();
    });

    $(".delete-task").click(function () {
        console.log($(this).closest(".task").data("id"));
        $.ajax({
            type: 'POST',
            url: 'delete',
            data: {
                id: $(this).closest(".task").data("id")
            },
            success: function(response){
                location.reload();
            },
            dataType: "json"
        });
    });

    $(".delete-subtask").click(function () {
        console.log($(this).closest(".subtask").data("id"));
        $.ajax({
            type: 'POST',
            url: 'deletesub',
            data: {
                id: $(this).closest(".subtask").data("id")
            },
            success: function(response){
                location.reload();
            },
            dataType: "json"
        });
    });

    $(".add-task").click(function () {
        $(".modal-element").attr('data-type', 'add');
    });

    $(".add-subtask").click(function () {
        $(".modal-element").attr('data-type', 'addsub');
        $(".modal-element").attr('data-id', $(this).closest('.task').data('id'));
    });

    $(".modal-button").click(function () {
        if ($(this).closest(".modal").find(".modal-element").data("type") == 'add') {
            $.ajax({
                type: 'POST',
                url: 'addtask',
                data: {
                    header: $(this).closest(".modal").find(".header").val(),
                    text: $(this).closest(".modal").find(".text").val(),
                    status: $(this).closest(".modal").find(".task-status select").val(),
                    date: $(this).closest(".modal").find(".date").val()
                },
                success: function(response){
                    location.reload();
                },
                dataType: "json"
            });
        } else if ($(this).closest(".modal").find(".modal-element").data("type") == 'addsub') {
            $.ajax({
                type: 'POST',
                url: 'addsub',
                data: {
                    header: $(this).closest(".modal").find(".header").val(),
                    text: $(this).closest(".modal").find(".text").val(),
                    status: $(this).closest(".modal").find(".task-status select").val(),
                    date: $(this).closest(".modal").find(".date").val(),
                    parent: $(this).closest(".modal").find(".modal-element").data("id")
                },
                success: function(response){
                    location.reload();
                },
                dataType: "json"
            });
        }
    });

    $(".update-task").click(function () {
        $.ajax({
            type: 'POST',
            url: 'update',
            data: {
                id: $(this).closest(".task").data("id"),
                header: $(this).closest(".task").find(".task-title input").val(),
                text: $(this).closest(".task").find(".task-text input").val(),
                status: $(this).closest(".task").find(".task-status select").val(),
                date: $(this).closest(".task").find(" .task-date input").val(),
            },
            success: function(response){
                location.reload();
            },
            dataType: "json"
        });
    });

    $(".update-subtask").click(function () {
        $.ajax({
            type: 'POST',
            url: 'updatesub',
            data: {
                id: $(this).closest(".subtask").data("id"),
                header: $(this).closest(".subtask").find(".subtask-title input").val(),
                text: $(this).closest(".subtask").find(".subtask-text input").val(),
                status: $(this).closest(".subtask").find(".subtask-status select").val(),
                date: $(this).closest(".subtask").find(" .subtask-date input").val(),
                parent: $(this).closest(".subtask").data("parent")
            },
            success: function(response){
                location.reload();
            },
            dataType: "json"
        });
    });
});
