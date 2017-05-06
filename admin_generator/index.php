<!-- the head -->
<?php include 'head.php'; ?>
<body>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <center><h1>Please select a database: </h1></center>
            <hr>
            <form action="home" method="POST" role="form" id="form">
                <div class="form-group">
                    <label for="">Database Name: </label>
                    <select id="databases" class="form-control" required="required">
                        <!-- the databases will be appended here -->
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

</body>
<!-- the javasript sources -->
<?php include 'footer.php'; ?>
<script type="text/javascript">
    
    // get databases
    $.post('../public/custom_query/', {
        sql: 'SHOW DATABASES'
    }, function(data){
        // parse the data
        data = $.parseJSON(data);
        $.each(data, function(i, value){
            $("#databases").append('<option value="' + value.Database + '">' + value.Database + '</option>')
        });
    });

    $("#form").submit(function(e){
        sessionStorage.database = $("#databases").val();
        window.location = 'home';
        e.preventDefault();
    });
</script>