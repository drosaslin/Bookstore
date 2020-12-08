<?php
    require 'access.php';
    include_once('databaseconnection.php');
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#FED084">
        <title>Trace List | Pick-a-book</title>
        <?php include'head.php';?>
        <style type="text/css">

        th{
            font-size: 16px;
            padding: 5px;
            font-weight: bold;
            text-align: center;
            margin: 10px;
        }

        td{
            font-size: 14px;
            text-align: center;
            padding: 5px 10px;
            margin: 10px;
        }

        th,td{
            border-bottom: 1px solid #ddd;
        }

        tr:hover{
            background-color: #d6d8db;
        }

        table{
            width: 90%;
        }

        input{
            margin: auto 5px;
        }

        </style>
    </head>
    <body id="homepage" style="padding-top:60px;">
        <?php include'nav.php'; ?>
        <div class="container" align="center" style="bottom:0; top:0; height:100%; max-height:100%;" id="fadein">
            <section class="box_text">
                <h3 style="text-align: left; padding:10px; margin:0;">Trace List</h3>
                <table align="center">
                    <tr>
                        <th>Order#</th>
                        <th>Total cost</th>
                        <th>Date ordered</th>
                        <th></th>
                    </tr>
                    <tr>
                        <?php
                            $username = $_SESSION['user'];
                            $query = "SELECT OrderListID, cost, DATE_FORMAT(Date_Time, '%M %D %Y') AS date
                                      FROM orderlist
                                      WHERE State != 'Completed' AND MemberID = (SELECT MemberID FROM member WHERE Username = '$username');";
                            $result = mysqli_query($con,$query);
                            //display the data
                            while ($rows = mysqli_fetch_assoc($result))
                            {
                                echo "<tr>";
                                echo "<td>". $rows['OrderListID'] . "</td>";
                                echo "<td>$". $rows['cost'] . "</td>";
                                echo "<td>". $rows['date'] . "</td>";
                                echo'<form action="order_details.php" method="POST" target="_blank">';
                                echo'<input type="hidden" name="orderID" value='.$rows['OrderListID'].'>';
                                echo'<td><input type ="submit" name="orderDetails" value="Details"/></td>';
                                echo'</form>';
                                echo "</tr>";
                             }
                         ?>
                    </tr>
                </table>
            </section>
        </div>
        <?php include'footer.php'; ?>
    </body>
</html>
<script>
    $("[data-toggle=popover]").popover();
</script>
<script>
    $('document').ready(function(){
        $('[data-login-button], [data-logout-button]').click(function(){
        $('[data-login-form], [data-login-user]').toggleClass('state-hidden');
        $('[data-header]').toggleClass('state-logged-in');
        });
    });
</script>
