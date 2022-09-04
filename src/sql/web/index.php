<?php

$mysqli = new mysqli("localhost", "root", "1234", "shop_db");
?>
<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="style.css">
  <title>SQL Homework</title>
 </head>
 <body>
 <nav class="accordion arrows">
     <header class="box">
         <label for="acc-close" class="box-title">SQL Homework</label>
     </header>
     <input type="radio" name="accordion" id="cb2" />
     <section class="box">
         <label class="box-title" for="cb2">Orders</label>
         <label class="box-close" for="acc-close"></label>
         <div class="box-content">
             <table>
                 <thead>
                 <tr>
                     <td>Order's ID</td>
                     <td>Client's name</td>
                     <td>Order</td>
                     <td>Count</td>
                     <td>Price</td>
                     <td>Total</td>
                     <td>City</td>
                     <td>Nova Poshta</td>
                     <td>Phone number</td>
                     <td>Status</td>
                     <td>Manager</td>
                 </tr>
                 </thead>
                 <tbody>
                 <?php
                 $sqlOrder = "SELECT * FROM shop_db.order;";
                 $result = $mysqli->query($sqlOrder);
                 while ($row = $result->fetch_assoc())
                 {
                     $sqlClient = "SELECT * FROM shop_db.client WHERE `id` = " . $row['client'] . ";";
                     $resultClient = $mysqli->query($sqlClient);
                     $rowClient = $resultClient->fetch_assoc();

                     $sqlProduct = "SELECT * FROM shop_db.product WHERE `id` = " . $row['product'] . ";";
                     $resultProduct = $mysqli->query($sqlProduct);
                     $rowProduct = $resultProduct->fetch_assoc();

                     $sqlStatus = "SELECT * FROM shop_db.status WHERE `id` = " . $row['status'] . ";";
                     $resultStatus = $mysqli->query($sqlStatus);
                     $rowStatus = $resultStatus->fetch_assoc();

                     $sqlStaff = "SELECT * FROM shop_db.staff WHERE `role` = " . $row['manager'] . ";";
                     $resultStaff = $mysqli->query($sqlStaff);
                     $rowStaff = $resultStaff->fetch_assoc();


                     echo '<tr>';
                         echo '<td>'  . $row['id'] . '</td>';
                         echo '<td>' . $rowClient['name'] . ' ' . $rowClient['last_name'] . '</td>';
                         echo '<td>'  . $rowProduct['name'] . '</td>';
                         echo '<td>'  . $row['count'] . '</td>';
                         echo '<td>'  . $rowProduct['price'] . '</td>';
                         echo '<td>'  . $row['count'] * $rowProduct['price'] . '</td>';
                         echo '<td>'  . $row['city'] . '</td>';
                         echo '<td>'  . $row['nova_poshta'] . '</td>';
                         echo '<td>+380'  . $rowClient['phone'] . '</td>';
                         echo '<td>'  . $rowStatus['status'] . '</td>';
                         echo '<td>' . $rowStaff['name'] . ' ' . $rowStaff['last_name'] . '</td>';
                     echo '</tr>';
                 } ?>
                 </tbody>
             </table>
        </div>
     </section>
    <input type="radio" name="accordion" id="acc-close" />
 </nav>
 </body>
</html>