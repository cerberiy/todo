<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../template/css/main.css">
</head>
<body class="bg-light">
<div class="container">
    <div class="row">
        <ul class="todo-list list-group box-shadow">
            <?php foreach ($tasks as $task) { ?>
                <li class="list-group-item todo-list-item task" data-id="<?php echo $task['id'] ?>">
                    <div class="task-header d-flex row">
                        <div class="task-title col-lg-6 border-right">
                            <input class="text-center" value="<?php echo $task['head'] ?>">
                        </div>
                        <div class="task-date col-lg-3 border-right">
                            <input class="text-center" value="<?php echo $task['date'] ?>">
                        </div>
                        <div class="task-status col-lg-3">
                            <select class="mdb-select md-form">
                                <option value="0" <?= $task['status'] == '0' ? ' selected="selected"' : '';?>>TO-DO</option>
                                <option value="1" <?= $task['status'] == '1' ? ' selected="selected"' : '';?>>DONE</option>
                            </select>
                        </div>
                    </div>
                    <div class="task-text">
                        <input type="text" rows="4" cols="50" value="<?php echo $task['body'] ?>">
                    </div>
                    <div class="task-buttons">
                        <button type="button" class="btn btn-danger delete-task">Delete</button>
                        <button type="button" class="btn btn-warning update-task">Update</button>
                        <button type="button" class="btn btn-info change-status-task">Change status</button>
                        <button type="button" class="btn btn-success add-subtask" data-toggle="modal" data-target="#exampleModal">Add subtask</button>
                    </div>
                </li>
                <?php foreach ($task['subtask'] as $subtask) { ?>
                    <li class="list-group-item subtask" data-id="<?php echo $subtask['id'] ?>" data-parent="<?php echo $task['id'] ?>">
                        <div class="subtask-header row">
                            <div class="subtask-title col-lg-6 border-right">
                                <input class="text-center" value="<?php echo $subtask['head'] ?>">
                            </div>
                            <div class="subtask-date col-lg-3 border-right">
                                <input class="text-center" value="<?php echo $subtask['date'] ?>">
                            </div>
                            <div class="subtask-status col-lg-3">
                                <select class="mdb-select md-form">
                                    <option value="0" <?= $subtask['status'] == '0' ? ' selected="selected"' : '';?>>TO-DO</option>
                                    <option value="1" <?= $subtask['status'] == '1' ? ' selected="selected"' : '';?>>DONE</option>
                                </select>
                            </div>
                        </div>
                        <div class="subtask-text">
                            <input type="text" rows="4" cols="50" class="" value="<?php echo $subtask['body'] ?>">
                        </div>
                        <div class="task-buttons">
                            <button type="button" class="btn btn-warning update-subtask">Update</button>
                            <button type="button" class="btn btn-info change-status-task">Change status</button>
                            <button type="button" class="btn btn-danger delete-subtask">Delete</button>
                        </div>
                    </li>
                <?php } ?>
            <?php } ?>
        </ul>
    </div>
    <div class="row">
        <div class="add-new-task">
            <div class="button-container">
                <button type="button" class="btn btn-success add-task" data-toggle="modal" data-target="#exampleModal">Add</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <li class="list-group-item todo-list-item task modal-element" data-id="" data-type="">
                    <div class="task-header d-flex row">
                        <div class="task-title col-lg-6 border-right">
                            <input class="text-center header" value="" placeholder="HEADER">
                        </div>
                        <div class="task-date col-lg-3 border-right">
                            <input class="text-center date" value="" placeholder="DATE">
                        </div>
                        <div class="task-status col-lg-3">
                            <select class="mdb-select md-form">
                                <option value="0">TO-DO</option>
                                <option value="1">DONE</option>
                            </select>
                        </div>
                    </div>
                    <div class="task-text">
                        <input value="" placeholder="TEXT" class="text">
                    </div>
                </li>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary modal-button">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="overlay">test</div>
</body>
<script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="../../template/js/main.js"></script>
</html>
