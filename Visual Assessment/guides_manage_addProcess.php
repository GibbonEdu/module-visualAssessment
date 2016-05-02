<?php
/*
Gibbon, Flexible & Open School System
Copyright (C) 2010, Ross Parker

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.
*/

include '../../functions.php';
include '../../config.php';

include './moduleFunctions.php';

//New PDO DB connection
try {
    $connection2 = new PDO("mysql:host=$databaseServer;dbname=$databaseName;charset=utf8", $databaseUsername, $databasePassword);
    $connection2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connection2->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo $e->getMessage();
}

@session_start();

//Set timezone from session variable
date_default_timezone_set($_SESSION[$guid]['timezone']);

//Search & Filters
$search = null;
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}
$filter2 = null;
if (isset($_GET['filter2'])) {
    $filter2 = $_GET['filter2'];
}

$URL = $_SESSION[$guid]['absoluteURL'].'/index.php?q=/modules/'.getModuleName($_POST['address'])."/guides_manage_add.php&search=$search&filter2=$filter2";

if (isActionAccessible($guid, $connection2, '/modules/Visual Assessment/guides_manage_add.php') == false) {
    //Fail 0
    $URL .= '&return=error0';
    header("Location: {$URL}");
} else {
    $highestAction = getHighestGroupedAction($guid, $_POST['address'], $connection2);
    if ($highestAction == false) {
        //Fail2
        $URL .= '&return=error2';
        header("Location: {$URL}");
    } else {
        if ($highestAction != 'Manage Assessment Guides_all' and $highestAction != 'Manage Assessment Guides_myDepartments') {
            //Fail 0
            $URL .= '&return=error0';
            header("Location: {$URL}");
        } else {
            //Proceed!
            $scope = $_POST['scope'];
            if ($scope == 'Learning Area') {
                $gibbonDepartmentID = $_POST['gibbonDepartmentID'];
            } else {
                $gibbonDepartmentID = null;
            }
            $name = $_POST['name'];
            $active = $_POST['active'];
            $category = $_POST['category'];
            $description = $_POST['description'];
            $gibbonYearGroupIDList = '';
            for ($i = 0; $i < $_POST['count']; ++$i) {
                if (isset($_POST["gibbonYearGroupIDCheck$i"])) {
                    if ($_POST["gibbonYearGroupIDCheck$i"] == 'on') {
                        $gibbonYearGroupIDList = $gibbonYearGroupIDList.$_POST["gibbonYearGroupID$i"].',';
                    }
                }
            }
            $gibbonYearGroupIDList = substr($gibbonYearGroupIDList, 0, (strlen($gibbonYearGroupIDList) - 1));

            if ($scope == '' or ($scope == 'Learning Area' and $gibbonDepartmentID == '') or $name == '' or $active == '') {
                //Fail 3
                $URL .= '&return=error3';
                header("Location: {$URL}");
            } else {
                //Lock table
                try {
                    $sql = 'LOCK TABLES visualAssessmentGuide WRITE';
                    $result = $connection2->query($sql);
                } catch (PDOException $e) {
                    //Fail 2
                    $URL .= '&return=error2';
                    header("Location: {$URL}");
                    exit();
                }

                //Get next autoincrement
                try {
                    $sqlAI = "SHOW TABLE STATUS LIKE 'visualAssessmentGuide'";
                    $resultAI = $connection2->query($sqlAI);
                } catch (PDOException $e) {
                    //Fail 2
                    $URL .= '&return=error2';
                    header("Location: {$URL}");
                    exit();
                }

                $rowAI = $resultAI->fetch();
                $AI = str_pad($rowAI['Auto_increment'], 8, '0', STR_PAD_LEFT);

                if ($AI == '') {
                    //Fail 2
                    $URL .= '&return=error2';
                    header("Location: {$URL}");
                } else {
                    //Write to database
                    try {
                        $data = array('scope' => $scope, 'gibbonDepartmentID' => $gibbonDepartmentID, 'name' => $name, 'active' => $active, 'category' => $category, 'description' => $description, 'gibbonYearGroupIDList' => $gibbonYearGroupIDList, 'gibbonPersonIDCreator' => $_SESSION[$guid]['gibbonPersonID']);
                        $sql = 'INSERT INTO visualAssessmentGuide SET scope=:scope, gibbonDepartmentID=:gibbonDepartmentID, name=:name, active=:active, category=:category, description=:description, gibbonYearGroupIDList=:gibbonYearGroupIDList, gibbonPersonIDCreator=:gibbonPersonIDCreator';
                        $result = $connection2->prepare($sql);
                        $result->execute($data);
                    } catch (PDOException $e) {
                        //Fail 2
                        $URL .= '&return=error2';
                        header("Location: {$URL}");
                        exit();
                    }

                    $AI = str_pad($connection2->lastInsertID(), 6, '0', STR_PAD_LEFT);

                    //Unlock module table
                    try {
                        $sql = 'UNLOCK TABLES';
                        $result = $connection2->query($sql);
                    } catch (PDOException $e) {
                        //Fail 2
                        $URL .= '&return=error2';
                        header("Location: {$URL}");
                        exit();
                    }

                    //Success 0
                    $URL = $URL.'&return=success0&editID='.$AI;
                    header("Location: {$URL}");
                }
            }
        }
    }
}
