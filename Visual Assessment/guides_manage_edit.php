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

if (isActionAccessible($guid, $connection2, '/modules/Visual Assessment/guides_manage_edit.php') == false) {
    //Acess denied
    echo "<div class='error'>";
    echo __($guid, 'You do not have access to this action.');
    echo '</div>';
} else {
    //Get action with highest precendence
    $highestAction = getHighestGroupedAction($guid, $_GET['q'], $connection2);
    if ($highestAction == false) { echo "<div class='error'>";
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
            echo "<div class='trailHead'><a href='".$_SESSION[$guid]['absoluteURL']."'>".__($guid, 'Home')."</a> > <a href='".$_SESSION[$guid]['absoluteURL'].'/index.php?q=/modules/'.getModuleName($_GET['q']).'/'.getModuleEntry($_GET['q'], $connection2, $guid)."'>".__($guid, getModuleName($_GET['q']))."</a> > <a href='".$_SESSION[$guid]['absoluteURL'].'/index.php?q=/modules/'.getModuleName($_GET['q'])."/guides_manage.php&search=$search&filter2=$filter2'>".__($guid, 'Manage Visual Assessment Guides')."</a> > </div><div class='trailEnd'>".__($guid, 'Edit Visual Assessment Guide').'</div>';
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
                    $data = array('visualAssessmentGuideID' => $visualAssessmentGuideID);
                    $sql = 'SELECT * FROM visualAssessmentGuide WHERE visualAssessmentGuideID=:visualAssessmentGuideID';
                    $result = $connection2->prepare($sql);
                    $result->execute($data);
                } catch (PDOException $e) {
                    echo "<div class='error'>".$e->getMessage().'</div>';
                }

                if ($result->rowCount() != 1) {
                    echo "<div class='error'>";
                    echo __($guid, 'The specified record does not exist.');
                    echo '</div>';
                } else {
                    //Let's go!
                    $row = $result->fetch();

                    if ($search != '' or $filter2 != '') {
                        echo "<div class='linkTop'>";
                        echo "<a href='".$_SESSION[$guid]['absoluteURL']."/index.php?q=/modules/Visual Assessment/guides_manage.php&search=$search&filter2=$filter2'>".__($guid, 'Back to Search Results').'</a>';
                        echo '</div>';
                    }
                    ?>
					<form method="post" action="<?php echo $_SESSION[$guid]['absoluteURL'].'/modules/'.$_SESSION[$guid]['module']."/guides_manage_editProcess.php?visualAssessmentGuideID=$visualAssessmentGuideID&search=$search&filter2=$filter2" ?>">
						<table class='smallIntBorder' cellspacing='0' style="width: 100%">
							<tr class='break'>
								<td colspan=2>
									<h3><?php echo __($guid, 'Visual Assessment Guide Basics') ?></h3>
								</td>
							</tr>
							<tr>
								<td style='width: 275px'>
									<b><?php echo __($guid, 'Scope') ?> *</b><br/>
									<span style="font-size: 90%"><i></i></span>
								</td>
								<td class="right">
									<input readonly name="scope" id="scope" value="<?php echo $row['scope'] ?>" type="text" style="width: 300px">
								</td>
							</tr>

							<?php
                            if ($row['scope'] == 'Learning Area') {
                                try {
                                    $dataLearningArea = array('gibbonDepartmentID' => $row['gibbonDepartmentID']);
                                    $sqlLearningArea = 'SELECT * FROM gibbonDepartment WHERE gibbonDepartmentID=:gibbonDepartmentID';
                                    $resultLearningArea = $connection2->prepare($sqlLearningArea);
                                    $resultLearningArea->execute($dataLearningArea);
                                } catch (PDOException $e) {
                                    echo "<div class='error'>".$e->getMessage().'</div>';
                                }
                                if ($resultLearningArea->rowCount() == 1) {
                                    $rowLearningAreas = $resultLearningArea->fetch();
                                }
                                ?>
								<tr>
									<td>
										<b><?php echo __($guid, 'Learning Area') ?> *</b><br/>
										<span style="font-size: 90%"><i></i></span>
									</td>
									<td class="right">
										<input readonly name="department" id="department" value="<?php echo $rowLearningAreas['name'] ?>" type="text" style="width: 300px">
										<input name="gibbonDepartmentID" id="gibbonDepartmentID" value="<?php echo $row['gibbonDepartmentID'] ?>" type="hidden" style="width: 300px">
									</td>
								</tr>
								<?php

                            }
                    		?>

							<tr>
								<td>
									<b><?php echo __($guid, 'Name') ?> *</b><br/>
								</td>
								<td class="right">
									<input name="name" id="name" maxlength=50 value="<?php echo $row['name'] ?>" type="text" style="width: 300px">
									<script type="text/javascript">
										var name2=new LiveValidation('name');
										name2.add(Validate.Presence);
									</script>
								</td>
							</tr>
							<tr>
								<td>
									<b><?php echo __($guid, 'Active') ?> *</b><br/>
									<span style="font-size: 90%"><i></i></span>
								</td>
								<td class="right">
									<select name="active" id="active" style="width: 302px">
										<option <?php if ($row['active'] == 'Y') { echo 'selected'; } ?> value="Y"><?php echo __($guid, 'Yes') ?></option>
										<option <?php if ($row['active'] == 'N') { echo 'selected'; } ?> value="N"><?php echo __($guid, 'No') ?></option>
									</select>
								</td>
							</tr>

							<tr>
								<td>
									<b><?php echo __($guid, 'Category') ?></b><br/>
								</td>
								<td class="right">
									<input name="category" id="category" maxlength=100 value="<?php echo $row['category'] ?>" type="text" style="width: 300px">
									<script type="text/javascript">
										$(function() {
											var availableTags=[
												<?php
                                                try {
                                                    $dataAuto = array();
                                                    $sqlAuto = 'SELECT DISTINCT category FROM visualAssessmentGuide ORDER BY category';
                                                    $resultAuto = $connection2->prepare($sqlAuto);
                                                    $resultAuto->execute($dataAuto);
                                                } catch (PDOException $e) {
                                                }
												while ($rowAuto = $resultAuto->fetch()) {
													echo '"'.$rowAuto['category'].'", ';
												}
												?>
											];
											$( "#category" ).autocomplete({source: availableTags});
										});
									</script>
								</td>
							</tr>
							<tr>
								<td>
									<b><?php echo __($guid, 'Description') ?></b><br/>
								</td>
								<td class="right">
									<textarea name='description' id='description' rows=5 style='width: 300px'><?php echo $row['description'] ?></textarea>
								</td>
							</tr>
							<tr>
								<td>
									<b><?php echo __($guid, 'Year Groups') ?></b><br/>
								</td>
								<td class="right">
									<?php
                                    $yearGroups = getYearGroups($connection2);
									if ($yearGroups == '') {
										echo '<i>'.__($guid, 'No year groups available.').'</i>';
									} else {
										for ($i = 0; $i < count($yearGroups); $i = $i + 2) {
											$checked = '';
											if (is_numeric(strpos($row['gibbonYearGroupIDList'], $yearGroups[$i]))) {
												$checked = 'checked ';
											}
											echo __($guid, $yearGroups[($i + 1)])." <input $checked type='checkbox' name='gibbonYearGroupIDCheck".($i) / 2 ."'><br/>";
											echo "<input type='hidden' name='gibbonYearGroupID".($i) / 2 ."' value='".$yearGroups[$i]."'>";
										}
									}
									?>
									<input type="hidden" name="count" value="<?php echo(count($yearGroups)) / 2 ?>">
								</td>
							</tr>
							<tr class='break'>
								<td colspan=2>
									<h3><?php echo __($guid, 'Visual Assessment Guide Design') ?></h3>
								</td>
							</tr>
							<?php
                            //Get terms in current guide
                            try {
                                $data2 = array('visualAssessmentGuideID' => $visualAssessmentGuideID);
                                $sql2 = 'SELECT * FROM visualAssessmentTerm WHERE visualAssessmentGuideID=:visualAssessmentGuideID ORDER BY term';
                                $result2 = $connection2->prepare($sql2);
                                $result2->execute($data2);
                            } catch (PDOException $e) {
                                echo "<tr class='break'>";
                                echo '<td colspan=2>';
                                echo "<div class='error'>".$e->getMessage().'</div>';
                                echo '</td>';
                                echo '</tr>';
                            }

							if ($result2->rowCount() < 1) {
								echo '<tr>';
								echo '<td colspan=2>';
								echo "<div class='error'>";
								echo __($guid, 'There are no records to display.');
								echo '</div>';
								echo '</td>';
								echo '</tr>';
							} else {
								//Create array of terms
								$row2All = $result2->fetchAll();

								//Parse array to work out number of parent nodes
								$parentCount = 0;
								$parents = array();
								foreach ($row2All as $row2) {
									if ($row2['visualAssessmentTermIDParent'] == '') {
										$parents[$parentCount][0] = $row2['visualAssessmentTermID'];
										$parents[$parentCount][1] = $row2['term'];
										++$parentCount;
									}
								}
								if ($parentCount < 1) {
									echo '<tr>';
									echo '<td colspan=2>';
									echo "<div class='error'>";
									echo __($guid, 'There are no records to display.');
									echo '</div>';
									echo '</td>';
									echo '</tr>';
								} else {
									echo '<tr>';
									echo '<td colspan=2>';
									$allowOutcomeEditing = getSettingByScope($connection2, 'Planner', 'allowOutcomeEditing');
									$categories = array();
									$categoryCount = 0;
									?>
									<style>
										#block { list-style-type: none; margin: 0; padding: 0; width: 100%; }
										#block div.ui-state-default { margin: 0 0px 5px 0px; padding: 5px; font-size: 100%; min-height: 58px; }
										div.ui-state-default_dud { margin: 5px 0px 5px 0px; padding: 5px; font-size: 100%; min-height: 58px; }
										html>body #block li { min-height: 58px; line-height: 1.2em; }
										.block-ui-state-highlight { margin-bottom: 5px; min-height: 58px; line-height: 1.2em; width: 100%; }
										block-ui-state-highlight {border: 1px solid #fcd3a1; background: #fbf8ee url(images/ui-bg_glass_55_fbf8ee_1x400.png) 50% 50% repeat-x; color: #444444; }
										li { list-style-type: none }
										ul.parent { margin-left: 0px ; }
										ul.child { margin-left: 45px ; }
									</style>
									<script>
										$(function() {
											$( "#block" ).sortable({
												placeholder: "block-ui-state-highlight",
												axis: 'y',
												item: 'li'
											});
										});
									</script>
									<div class="block" id="block" style='width: 100%; padding: 5px 0px 0px 0px; min-height: 66px'>
										<?php
										makeTermBlocks($guid, $connection2, $row2All, null, 0, null);
										?>
									</div>
								</td>
							</tr>
						<?php
                        }
                    }
                    ?>
						<tr>
							<td>
								<span style="font-size: 90%"><i>* <?php echo __($guid, 'denotes a required field'); ?></i></span>
							</td>
							<td class="right">
								<input type="hidden" name="address" value="<?php echo $_SESSION[$guid]['address'] ?>">
								<input type="submit" value="<?php echo __($guid, 'Submit'); ?>">
							</td>
						</tr>
					</table>
					<?php

                }
            }
        }
    }
}
?>
