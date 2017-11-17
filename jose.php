<?php

if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `data_clinical_prostate` WHERE CONCAT(`PATIENT_ID`, `SAMPLE_ID`, `TISSUE_SITE`, `DOUBLING_TIME_DAYS`) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);

}
 else {
    $query = "SELECT * FROM `data_clinical_prostate`";
    $search_result = filterTable($query);
}

// function to connect and execute the query
function filterTable($query)
{
    $connect = mysqli_connect("localhost", "root", "root", "ExpressionDB");
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>PHP HTML TABLE DATA SEARCH</title>
        <style>
            table,tr,th,td
            {
                border: 1px solid black;
            }
        </style>
    </head>
    <body>

        <form action="jose.php" method="post">
            <input type="text" name="valueToSearch" placeholder="Value To Search"><br><br>
            <input type="submit" name="search" value="Filter"><br><br>

            <table>
                <tr>
                    <th>PATIENT_ID</th>
                    <th>SAMPLE_ID</th>
                    <th>TISSUE_SITE</th>
                    <th>DOUBLING_TIME_DAYS</th>
                </tr>

      <!-- populate table from mysql database -->
                <?php while($row = mysqli_fetch_array($search_result)):?>
                <tr>
                    <td><?php echo $row['PATIENT_ID'];?></td>
                    <td><?php echo $row['SAMPLE_ID'];?></td>
                    <td><?php echo $row['TISSUE_SITE'];?></td>
                    <td><?php echo $row['DOUBLING_TIME_DAYS'];?></td>
                    <td><?php echo $row['PRIOR_THERAPY'];?></td>
                    <td><?php echo $row['STUDIES'];?></td>
                    <td><?php echo $row['KPS'];?></td>
                    <td><?php echo $row['HGB_(g/dl)'];?></td>
                    <td><?php echo $row['ALB_(g/dl)'];?></td>
                    <td><?php echo $row['PSA_(ng/DL)'];?></td>
                    <td><?php echo $row['ALP_(U/L)'];?></td>
                    <td><?php echo $row['LDH_(U/L)'];?></td>
                    <td><?php echo $row['CANCER_TYPE'];?></td>
                    <td><?php echo $row['CANCER_TYPE_DETAILED'];?></td>
                </tr>
                <?php endwhile;?>
            </table>
        </form>

    </body>
</html>
