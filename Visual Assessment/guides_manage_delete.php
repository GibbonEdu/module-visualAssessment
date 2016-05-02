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

@session_start();

//Module includes
include './modules/'.$_SESSION[$guid]['module'].'/moduleFunctions.php';

//Search & Filters
$search = null;
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}
$filter2 = null;
if (isset($_GET['filter2'])) {
    $filter2 = $_GET['filter2'];
}

if (isActionAccessible($guid, $connection2, '/modules/Visual Assessment/guides_manage_delete.php') == false) {
    //Acess denied
    echo "<div class='error'>";
    echo __($guid, 'You do not have access to this action.');
    echo '</div>';
} else {
    //Get action with highest precendence
    $highestAction = getHighestGroupedAction($guid, $_GET['q'], $connection2);
    if ($highestAction == false) {
        echo "<div class='error'>";
        echo __($guid, 'The highest grouped action cannot be determined.');
        echo '</div>';
    } else {
        if ($highestAction != 'Manage Assessment Guides_all' and $highestAction != 'Manage Assessment Guides_myDepartments') {
            echo "<div class='error'>";
            echo __($guid, 'You do not have access to this action.');
            echo '</div>';
        } else {
            //Proceed!
            echo "<div class='trail'>";
            echo "<div class='trailHead'><a href='".$_SESSION[$guid]['absoluteURL']."'>".__($guid, 'Home')."</a> > <a href='".$_SESSION[$guid]['absoluteURL'].'/index.php?q=/modules/'.getModuleName($_GET['q']).'/'.getModuleEntry($_GET['q'], $connection2, $guid)."'>".__($guid, getModuleName($_GET['q']))."</a> > <a href='".$_SESSION[$guid]['absoluteURL'].'/index.php?q=/modules/'.getModuleName($_GET['q'])."/guides_manage.php&search=$search&filter2=$filter2'>".__($guid, 'Manage Visual Assessment Guides')."</a> > </div><div class='trailEnd'>".__($guid, 'Delete Visual Assessment Guide').'</div>';
            echo '</div>';

            if (isset($_GET['return'])) {
                returnProcess($guid, $_GET['return'], null, null);
            }

            //Check if school year specified
            $visualAssessmentGuideID = $_GET['visualAssessmentGuideID'];
            if ($visualAssessmentGuideID == '') {
                echo "<div class='error'>";
                echo __($guid, 'You have not specified one or more required parameters.');
                echo '</div>';
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
                    echo "<div class='error'>".$e->getMessage().'</div>';
                }

                if ($result->rowCount() != 1) {
                    echo "<div class='error'>";
                    echo __($guid, 'The selected record does not exist, or you do not have access to it.');
                    echo '</div>';
                } else {
                    //Let's go!
                    $row = $result->fetch();

                    ?>
					<form method="post" action="<?php echo $_SESSION[$guid]['absoluteURL'].'/modules/'.$_SESSION[$guid]['module']."/guides_manage_deleteProcess.php?visualAssessmentGuideID=$visualAssessmentGuideID&search=$search&filter2=$filter2" ?>">
						<table class='smallIntBorder' cellspacing='0' style="width: 100%">
							<tr>
								<td>
									<b><?php echo __($guid, 'Are you sure you want to delete this record?');
                    ?></b><br/>
									<span style="font-size: 90%; color: #cc0000"><i><?php echo __($guid, 'This operation cannot be undone, and may lead to loss of vital data in your system. PROCEED WITH CAUTION!');
                    ?></i></span>
								</td>
								<td class="right">

								</td>
							</tr>
							<tr>
								<td>
									<input name="visualAssessmentGuideID" id="visualAssessmentGuideID" value="<?php echo $visualAssessmentGuideID ?>" type="hidden">
									<input type="hidden" name="address" value="<?php echo $_SESSION[$guid]['address'] ?>">
									<input type="submit" value="<?php echo __($guid, 'Yes');
                    ?>">
								</td>
								<td class="right">

								</td>
							</tr>
						</table>
					</form>
					<?php

                }
            }
        }
    }
}
?>
