<?php require_once("database/DBConnection.php"); ?>
<?php require_once ("Sessions.php"); ?>
<?php require_once ("Functions.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Comments</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/jquery-3.3.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap/css/AdminStyle.css">
</head>
<body>
<div class="container-fluid">
    <div class="row">

        <!--Sidebar-->
        <div class="col-sm-2">
            <h2>Admin Panel</h2>
            <ul id="Side_Menu" class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="Dashboard.php">
                        <span class="glyphicon glyphicon-home"></span>&nbspDashboard</a></i>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="NewPost.php">
                        <span class="glyphicon glyphicon-file"></span>&nbspNew Post</a></i>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Posts.php">
                        <span class="glyphicon glyphicon-book"></span>&nbspPosts</a></i>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Categories.php">
                        <span class="glyphicon glyphicon-th-list"></span>&nbspCategories</a></i>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Admins.php">
                        <span class="glyphicon glyphicon-user"></span>&nbspManage Admins</a></i>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="Comments.php">
                        <span class="glyphicon glyphicon-comment"></span>&nbspComments</a></i>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Blog.php" target="_blank">
                        <span class="glyphicon glyphicon-equalizer"></span>&nbspView Site</a></i>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <span class="glyphicon glyphicon-off"></span>&nbspLogout</a></i>
                </li>
            </ul>
        </div>
        <!--Sidebar-->

        <div class="col-sm-10">
            <h4>Un-Approved Comments</h4>
            <div>
                <?php
                echo Message();
                echo SuccessMessage();
                ?>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Comment</th>
                        <th>Approve</th>
                        <th>Delete</th>
                        <th>Details</th>
                    </tr>
                    <?php
                        global $DBConnect;
                        $Query = "SELECT * FROM comments WHERE status='OFF' ORDER BY datetime DESC";
                        $Execute=mysqli_query($DBConnect,$Query);
                        $SrNo=0;
                        while ($DataRows = mysqli_fetch_array($Execute)){
                            $CommentID = $DataRows["id"];
                            $CommentDate = $DataRows["datetime"];
                            $CommenterName = $DataRows["name"];
                            $Comment = $DataRows["comment"];
                            $PostId = $DataRows["post_id"];
                            $SrNo++;

                            if(strlen($CommentDate)>15){
                                $CommentDate = substr($CommentDate,0,15).'...';
                            }
                    ?>
                    <tr>
                        <td><?php echo $SrNo; ?></td>
                        <td><?php echo $CommenterName;?></td>
                        <td><?php echo $CommentDate;?></td>
                        <td><?php echo $Comment;?></td>
                        <td><a href="ApproveComment.php?id=<?php echo $CommentID;?>">
                            <span class="btn btn-success">Approve</span></a></td>
                        <td><a href="DeleteComment.php?id=<?php echo $CommentID;?>">
                                <span class="btn btn-danger">Delete</span></a></td>
                        <td><a href="Single.php?id=<?php echo $PostId;?>" target="_blank">
                                <span class="btn btn-primary">Preview</span></a></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
            <hr>
            <!--Approved Comments-->
            <h4>Approved Comments</h4>
            <div>
                <?php
                echo Message();
                echo SuccessMessage();
                ?>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Comment</th>
                        <th>Approved By</th>
                        <th>Delete</th>
                        <th>Details</th>
                    </tr>
                    <?php
                        global $DBConnect;
                        $Query = "SELECT * FROM comments WHERE status='ON'";
                        $Execute=mysqli_query($DBConnect,$Query);
                        $SrNo=0;
                        $Admin = "Safnaj";
                        while ($DataRows = mysqli_fetch_array($Execute)){
                            $CommentID = $DataRows["id"];
                            $CommentDate = $DataRows["datetime"];
                            $CommenterName = $DataRows["name"];
                            $Comment = $DataRows["comment"];
                            $PostId = $DataRows["post_id"];
                            $SrNo++;

                            if(strlen($CommentDate)>15){
                                $CommentDate = substr($CommentDate,0,15).'...';
                            }
                            if(strlen($Comment)>35){
                                $Comment = substr($Comment,0,15).'...';
                            }
                        ?>
                        <tr>
                            <td><?php echo $SrNo; ?></td>
                            <td><?php echo $CommenterName;?></td>
                            <td><?php echo $CommentDate;?></td>
                            <td><?php echo $Comment;?></td>
                            <td><?php echo $Admin;?></td>
                            <td><a href="DeleteComment.php?id=<?php echo $CommentID;?>">
                                    <span class="btn btn-danger">Delete</span></a>
                            </td>
                            <td><a href="Single.php?id=<?php echo $PostId;?>" target="_blank">
                                    <span class="btn btn-primary">Preview</span></a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>

    <!--Footer-->
    <div id="Footer">
        <p>Developed By Ahamed Safnaj | &copy2019 -- All Right Reserved</p>
    </div>
    <!--Footer-->

</div>
</body>
</html>
