<!-- the head -->
<?php include 'head.php'; ?>
<body>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h1>Tables of the selected database</h1>

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Table Name</th>
                        <th>Table Rows</th>
                        <th>Auto Increment Value</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="tables">
                    <!-- tables appended here -->
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
<!-- the javasript sources -->
<?php include 'footer.php'; ?>
<script type="text/javascript">
    // get selected database name
    var database = sessionStorage.getItem('database');
    $("#database_name").html(database);
    // get databases
    $.post('../public/custom_query/', {
        sql: "SELECT TABLE_NAME, TABLE_ROWS, AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = '" + database + "'"
    }, function(data){
        // parse the data
        data = $.parseJSON(data);
        $.each(data, function(i, value){
            console.log(value.TABLE_NAME);
            $("#tables").append('\
                <tr>\
                    <td>'+ value.TABLE_NAME +'</td>\
                    <td>'+ value.TABLE_ROWS +'</td>\
                    <td>'+ value.AUTO_INCREMENT +'</td>\
                    <td>\
                        <a class="btn btn-success btn-sm" data-toggle="modal" href="#modal_'+ i +'">View Routes</a>\
                        <div class="modal fade" id="modal_'+ i +'">\
                            <div class="modal-dialog modal-lg">\
                                <div class="modal-content">\
                                    <div class="modal-header">\
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>\
                                        <center><h4 class="modal-title">'+ value.TABLE_NAME+'</h4></center>\
                                    </div>\
                                    <div class="modal-body">\
                                        <table class="table table-bordered table-hover">\
                                            <thead>\
                                                <tr>\
                                                    <th>Name</th>\
                                                    <th>Method</th>\
                                                    <th>Route</th>\
                                                </tr>\
                                            </thead>\
                                            <tbody>\
                                                <tr>\
                                                    <td><button type="button" class="btn btn-success btn-xs">Read All</td>\
                                                    <td>GET</td>\
                                                    <td>'+ location.protocol + "//" + window.location.hostname +'/ez-crud/public/'+value.TABLE_NAME+'</td>\
                                                </tr>\
                                                <tr>\
                                                    <td><button type="button" class="btn btn-success btn-xs">Read ByID</td>\
                                                    <td>GET</td>\
                                                    <td>'+ location.protocol + "//" + window.location.hostname +'/ez-crud/public/'+value.TABLE_NAME+'/1</td>\
                                                </tr>\
                                            </tbody>\
                                        </table>\
                                    </div>\
                                </div>\
                            </div>\
                        </div>\
                    </td>\
                </tr>')
        });
    });
</script>