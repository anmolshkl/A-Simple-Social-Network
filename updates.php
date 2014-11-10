<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Updates</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
      <style>
        body {
            background-color: transparent;
        }
        #newStatus {
            position: relative;
            margin: 10px;
        }
        .status-row {
            padding: 3px;
            background: url("images/pat7.gif") repeat;

        }
        .btn {
            margin-bottom: 5px;
        }
        .well {
            background-color: #FFFFFF;
        }
          
      </style>
  </head>
  <body>
      <div class="container">
          <div class="row well status-row">
              <form method="POST" name="statusForm" id="statusForm" action="dao/updatesDAO.php" class="form-vertical">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <textarea text="" class="form-control" name="newStatus" id="newStatus" placeholder="What's on your mind?">
                            </textarea>
                            <input value="Update" class="btn btn-primary pull-right" type="submit" action="dao/updatesDAO.php" method="POST" />
                        </div>
                    </div>
          </div>
              
        <div class="row">
            <div class="col-xs-8 updates">
            </div>
        </div>
      </div>
      
      
      <script>
        var i;
        $(document).ready(function() {
            $('#newStatus').val('');
            $.getJSON("dao/updatesDAO.php",function(data){
                for(i=0;i < data.length; i++) {
                    var obj = data[i];
                    $('<div/>', {
                        class: 'ind-updates well',
                        html: "<a class ='bigger' href='profile-view.php?userToRetrieve="+obj.username+ "&target='iframe'>"+obj.username+"</a>"+"<hr>"+obj.update+"<br>"+"<hr>"
                    }).appendTo('.updates');
                }
                $('<input/>', {
                        type: 'hidden',
                        class: 'frame-num',
                        value: i
                    }).appendTo('.updates');
            });
        });
    </script>  
  </body>
</html>