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

$visualAssessmentGuideID = $_GET['visualAssessmentGuideID'];
$URL = $_SESSION[$guid]['absoluteURL'].'/index.php?q=/modules/'.getModuleName($_POST['address'])."/guides_manage_edit.php&visualAssessmentGuideID=$visualAssessmentGuideID&search=$search&filter2=$filter2";

if (isActionAccessible($guid, $connection2, '/modules/Visual Assessment/guides_manage_edit.php') == false) {
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
            //Check if school year specified
            if ($visualAssessmentGuideID == '') {
                //Fail1
                $URL .= '&return=error1';
                header("Location: {$URL}");
            } else {
                try {
                    if ($highestAction == 'Manage Assessment Guides_all') {
                        $data = array('visualAssessmentGuideID' => $visualAssessmentGuideID);
                        $sql = 'SELECT * FROM visualAssessmentGuide WHERE visualAssessmentGuideID=:visualAssessmentGuideID';
                    } elseif ($highestAction == 'Manage Assessment Guides_myDepartments') {
                        $data = array('visualAssessmentGuideID' => $visualAssessmentGuideID, 'gibbonPersonID' => $_SESSION[$guid]['gibbonPersonID']);
                        $sql = "SELECT * FROM visualAssessmentGuide JOIN gibbonDepartment ON (visualAssessmentGuide.gibbonDepartmentID=gibbonDepartment.gibbonDepartmentID) JOIN gibbonDepartmentStaff ON (gibbonDepartmentStaff.gibbonDepartmentID=gibbonDepartment.gibbonDepartmentID) AND NOT visualAssessmentGuide.gibbonDepartmentID IS NULL WHERE visualAssessmentGuideID=:visualAssessmentGuideID AND (role='Coordinator' OR role='Teacher (Curriculum)') AND gibbonPersonID=:gibbonPersonID AND scope='Learning Area'";
                    }
                    $result = $connection2->prepare($sql);
                    $result->execute($data);
                } catch (PDOException $e) {
                    //Fail2
                    $URL .= '&return=error2';
                    header("Location: {$URL}");
                    exit();
                }

                if ($result->rowCount() != 1) {
                    //Fail 2
                    $URL .= '&return=error2';
                    header("Location: {$URL}");
                } else {
                    //Proceed!
                    $scope = $_POST['scope'];
                    $gibbonDepartmentID = null;
                    if ($scope == 'Learning Area') {
                        $gibbonDepartmentID = $_POST['gibbonDepartmentID'];
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
                        //Write to database
                        try {
                            $data = array('scope' => $scope, 'gibbonDepartmentID' => $gibbonDepartmentID, 'name' => $name, 'active' => $active, 'category' => $category, 'description' => $description, 'gibbonYearGroupIDList' => $gibbonYearGroupIDList, 'visualAssessmentGuideID' => $visualAssessmentGuideID);
                            $sql = 'UPDATE visualAssessmentGuide SET scope=:scope, gibbonDepartmentID=:gibbonDepartmentID, name=:name, active=:active, category=:category, description=:description, gibbonYearGroupIDList=:gibbonYearGroupIDList WHERE visualAssessmentGuideID=:visualAssessmentGuideID';
                            $result = $connection2->prepare($sql);
                            $result->execute($data);
                        } catch (PDOException $e) {
                            //Fail 2
                            $URL .= '&return=error2';
                            header("Location: {$URL}");
                            exit();
                        }

                        //Success 0
                        $URL .= '&return=success0';
                        header("Location: {$URL}");
                    }
                }
            }
        }
    }
}
