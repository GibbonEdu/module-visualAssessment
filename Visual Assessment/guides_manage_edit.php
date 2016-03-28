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

@session_start() ;

//Module includes
include "./modules/" . $_SESSION[$guid]["module"] . "/moduleFunctions.php" ;

//Search & Filters
$search=NULL ;
if (isset($_GET["search"])) {
	$search=$_GET["search"] ;
}
$filter2=NULL ;
if (isset($_GET["filter2"])) {
	$filter2=$_GET["filter2"] ;
}

if (isActionAccessible($guid, $connection2, "/modules/Visual Assessment/guides_manage_edit.php")==FALSE) {
	//Acess denied
	print "<div class='error'>" ;
		print __($guid, "You do not have access to this action.") ;
	print "</div>" ;
}
else {
	//Get action with highest precendence
	$highestAction=getHighestGroupedAction($guid, $_GET["q"], $connection2) ;
	if ($highestAction==FALSE) {
		print "<div class='error'>" ;
		print __($guid, "The highest grouped action cannot be determined.") ;
		print "</div>" ;
	}
	else {
		if ($highestAction!="Manage Assessment Guides_all" AND $highestAction!="Manage Assessment Guides_myDepartments") {
			print "<div class='error'>" ;
				print __($guid, "You do not have access to this action.") ;
			print "</div>" ;
		}
		else {
			//Proceed!
			print "<div class='trail'>" ;
			print "<div class='trailHead'><a href='" . $_SESSION[$guid]["absoluteURL"] . "'>" . __($guid, "Home") . "</a> > <a href='" . $_SESSION[$guid]["absoluteURL"] . "/index.php?q=/modules/" . getModuleName($_GET["q"]) . "/" . getModuleEntry($_GET["q"], $connection2, $guid) . "'>" . __($guid, getModuleName($_GET["q"])) . "</a> > <a href='" . $_SESSION[$guid]["absoluteURL"] . "/index.php?q=/modules/" . getModuleName($_GET["q"]) . "/guides_manage.php&search=$search&filter2=$filter2'>" . __($guid, 'Manage Visual Assessment Guides') . "</a> > </div><div class='trailEnd'>" . __($guid, 'Edit Visual Assessment Guide') . "</div>" ;
			print "</div>" ;
			
			if (isset($_GET["updateReturn"])) { $updateReturn=$_GET["updateReturn"] ; } else { $updateReturn="" ; }
			$updateReturnMessage="" ;
			$class="error" ;
			if (!($updateReturn=="")) {
				if ($updateReturn=="fail0") {
					$updateReturnMessage=__($guid, "Your request failed because you do not have access to this action.") ;	
				}
				else if ($updateReturn=="fail1") {
					$updateReturnMessage=__($guid, "Your request failed because your inputs were invalid.") ;	
				}
				else if ($updateReturn=="fail2") {
					$updateReturnMessage=__($guid, "Your request failed due to a database error.") ;	
				}
				else if ($updateReturn=="fail3") {
					$updateReturnMessage=__($guid, "Your request failed because your inputs were invalid.") ;	
				}
				else if ($updateReturn=="success0") {
					$updateReturnMessage=__($guid, "Your request was completed successfully.") ;	
					$class="success" ;
				}
				print "<div class='$class'>" ;
					print $updateReturnMessage;
				print "</div>" ;
			} 
			
			if (isset($_GET["addReturn"])) { $addReturn=$_GET["addReturn"] ; } else { $addReturn="" ; }
			$addReturnMessage="" ;
			$class="error" ;
			if (!($addReturn=="")) {
				if ($addReturn=="success0") {
					$addReturnMessage=__($guid, "Your request was completed successfully.") ;	
					$class="success" ;
				}
				print "<div class='$class'>" ;
					print $addReturnMessage;
				print "</div>" ;
			} 
			
			if (isset($_GET["columnDeleteReturn"])) { $columnDeleteReturn=$_GET["columnDeleteReturn"] ; } else { $columnDeleteReturn="" ; }
			$columnDeleteReturnMessage="" ;
			$class="error" ;
			if (!($columnDeleteReturn=="")) {
				if ($columnDeleteReturn=="fail0") {
					$columnDeleteReturnMessage=__($guid, "Your request failed because you do not have access to this action.") ;	
				}
				else if ($columnDeleteReturn=="fail1") {
					$columnDeleteReturnMessage=__($guid, "Your request failed because your inputs were invalid.") ;	
				}
				else if ($columnDeleteReturn=="fail2") {
					$columnDeleteReturnMessage=__($guid, "Your request failed due to a database error.") ;	
				}
				else if ($columnDeleteReturn=="fail3") {
					$columnDeleteReturnMessage=__($guid, "Your request failed because your inputs were invalid.") ;	
				}
				else if ($columnDeleteReturn=="success0") {
					$columnDeleteReturnMessage=__($guid, "Your request was completed successfully.") ;	
					$class="success" ;
				}
				print "<div class='$class'>" ;
					print $columnDeleteReturnMessage;
				print "</div>" ;
			} 
			
			if (isset($_GET["rowDeleteReturn"])) { $rowDeleteReturn=$_GET["rowDeleteReturn"] ; } else { $rowDeleteReturn="" ; }
			$rowDeleteReturnMessage="" ;
			$class="error" ;
			if (!($rowDeleteReturn=="")) {
				if ($rowDeleteReturn=="fail0") {
					$rowDeleteReturnMessage=__($guid, "Your request failed because you do not have access to this action.") ;	
				}
				else if ($rowDeleteReturn=="fail1") {
					$rowDeleteReturnMessage=__($guid, "Your request failed because your inputs were invalid.") ;	
				}
				else if ($rowDeleteReturn=="fail2") {
					$rowDeleteReturnMessage=__($guid, "Your request failed due to a database error.") ;	
				}
				else if ($rowDeleteReturn=="fail3") {
					$rowDeleteReturnMessage=__($guid, "Your request failed because your inputs were invalid.") ;	
				}
				else if ($rowDeleteReturn=="success0") {
					$rowDeleteReturnMessage=__($guid, "Your request was completed successfully.") ;	
					$class="success" ;
				}
				print "<div class='$class'>" ;
					print $rowDeleteReturnMessage;
				print "</div>" ;
			} 
			
			if (isset($_GET["cellEditReturn"])) { $cellEditReturn=$_GET["cellEditReturn"] ; } else { $cellEditReturn="" ; }
			$cellEditReturnMessage="" ;
			$class="error" ;
			if (!($cellEditReturn=="")) {
				if ($cellEditReturn=="fail0") {
					$cellEditReturnMessage=__($guid, "Your request failed because you do not have access to this action.") ;	
				}
				else if ($cellEditReturn=="fail1") {
					$cellEditReturnMessage=__($guid, "Your request failed because your inputs were invalid.") ;	
				}
				else if ($cellEditReturn=="fail2") {
					$cellEditReturnMessage=__($guid, "Your request failed due to a database error.") ;	
				}
				else if ($cellEditReturn=="fail3") {
					$cellEditReturnMessage=__($guid, "Your request failed because your inputs were invalid.") ;	
				}
				else if ($cellEditReturn=="fail5") {
					$cellEditReturnMessage=__($guid, "Your request was successful, but some data was not properly saved.") ;	
				}
				else if ($cellEditReturn=="success0") {
					$cellEditReturnMessage=__($guid, "Your request was completed successfully.") ;	
					$class="success" ;
				}
				print "<div class='$class'>" ;
					print $cellEditReturnMessage;
				print "</div>" ;
			} 
			
			//Check if school year specified
			$visualAssessmentGuideID=$_GET["visualAssessmentGuideID"];
			if ($visualAssessmentGuideID=="") {
				print "<div class='error'>" ;
					print __($guid, "You have not specified one or more required parameters.") ;
				print "</div>" ;
			}
			else {
				try {
					$data=array("visualAssessmentGuideID"=>$visualAssessmentGuideID); 
					$sql="SELECT * FROM visualAssessmentGuide WHERE visualAssessmentGuideID=:visualAssessmentGuideID" ;
					$result=$connection2->prepare($sql);
					$result->execute($data);
				}
				catch(PDOException $e) { 
					print "<div class='error'>" . $e->getMessage() . "</div>" ; 
				}
				
				if ($result->rowCount()!=1) {
					print "<div class='error'>" ;
						print __($guid, "The specified record does not exist.") ;
					print "</div>" ;
				}
				else {
					//Let's go!
					$row=$result->fetch() ;
					
					if ($search!="" OR $filter2!="") {
						print "<div class='linkTop'>" ;
							print "<a href='" . $_SESSION[$guid]["absoluteURL"] . "/index.php?q=/modules/Visual Assessment/guides_manage.php&search=$search&filter2=$filter2'>" . __($guid, 'Back to Search Results') . "</a>" ;
						print "</div>" ;
					}
					?>
					<form method="post" action="<?php print $_SESSION[$guid]["absoluteURL"] . "/modules/" . $_SESSION[$guid]["module"] . "/guides_manage_editProcess.php?visualAssessmentGuideID=$visualAssessmentGuideID&search=$search&filter2=$filter2" ?>">
						<table class='smallIntBorder' cellspacing='0' style="width: 100%">	
							<tr class='break'>
								<td colspan=2>
									<h3><?php print __($guid, 'Visual Assessment Guide Basics') ?></h3>
								</td>
							</tr>
							<tr>
								<td style='width: 275px'> 
									<b><?php print __($guid, 'Scope') ?> *</b><br/>
									<span style="font-size: 90%"><i></i></span>
								</td>
								<td class="right">
									<input readonly name="scope" id="scope" value="<?php print $row["scope"] ?>" type="text" style="width: 300px">
								</td>
							</tr>
							
							<?php
							if ($row["scope"]=="Learning Area") {
								try {
									$dataLearningArea=array("gibbonDepartmentID"=>$row["gibbonDepartmentID"]); 
									$sqlLearningArea="SELECT * FROM gibbonDepartment WHERE gibbonDepartmentID=:gibbonDepartmentID" ;
									$resultLearningArea=$connection2->prepare($sqlLearningArea);
									$resultLearningArea->execute($dataLearningArea);
								}
								catch(PDOException $e) { 
									print "<div class='error'>" . $e->getMessage() . "</div>" ; 
								}
								if ($resultLearningArea->rowCount()==1) {
									$rowLearningAreas=$resultLearningArea->fetch() ;
								}
								?>
								<tr>
									<td> 
										<b><?php print __($guid, 'Learning Area') ?> *</b><br/>
										<span style="font-size: 90%"><i></i></span>
									</td>
									<td class="right">
										<input readonly name="department" id="department" value="<?php print $rowLearningAreas["name"] ?>" type="text" style="width: 300px">
										<input name="gibbonDepartmentID" id="gibbonDepartmentID" value="<?php print $row["gibbonDepartmentID"] ?>" type="hidden" style="width: 300px">
									</td>
								</tr>
								<?php
							}
							?>
							
							
							<tr>
								<td> 
									<b><?php print __($guid, 'Name') ?> *</b><br/>
								</td>
								<td class="right">
									<input name="name" id="name" maxlength=50 value="<?php print $row["name"] ?>" type="text" style="width: 300px">
									<script type="text/javascript">
										var name2=new LiveValidation('name');
										name2.add(Validate.Presence);
									</script>
								</td>
							</tr>
							<tr>
								<td> 
									<b><?php print __($guid, 'Active') ?> *</b><br/>
									<span style="font-size: 90%"><i></i></span>
								</td>
								<td class="right">
									<select name="active" id="active" style="width: 302px">
										<option <?php if ($row["active"]=="Y") { print "selected" ; } ?> value="Y"><?php print __($guid, 'Yes') ?></option>
										<option <?php if ($row["active"]=="N") { print "selected" ; } ?> value="N"><?php print __($guid, 'No') ?></option>
									</select>
								</td>
							</tr>
							
							<tr>
								<td> 
									<b><?php print __($guid, 'Category') ?></b><br/>
								</td>
								<td class="right">
									<input name="category" id="category" maxlength=100 value="<?php print $row["category"] ?>" type="text" style="width: 300px">
									<script type="text/javascript">
										$(function() {
											var availableTags=[
												<?php
												try {
													$dataAuto=array(); 
													$sqlAuto="SELECT DISTINCT category FROM visualAssessmentGuide ORDER BY category" ;
													$resultAuto=$connection2->prepare($sqlAuto);
													$resultAuto->execute($dataAuto);
												}
												catch(PDOException $e) { }
												while ($rowAuto=$resultAuto->fetch()) {
													print "\"" . $rowAuto["category"] . "\", " ;
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
									<b><?php print __($guid, 'Description') ?></b><br/>
								</td>
								<td class="right">
									<textarea name='description' id='description' rows=5 style='width: 300px'><?php print $row["description"] ?></textarea>
								</td>
							</tr>
							<tr>
								<td> 
									<b><?php print __($guid, 'Year Groups') ?></b><br/>
								</td>
								<td class="right">
									<?php 
									$yearGroups=getYearGroups($connection2) ;
									if ($yearGroups=="") {
										print "<i>" . __($guid, 'No year groups available.') . "</i>" ;
									}
									else {
										for ($i=0; $i<count($yearGroups); $i=$i+2) {
											$checked="" ;
											if (is_numeric(strpos($row["gibbonYearGroupIDList"], $yearGroups[$i]))) {
												$checked="checked " ;
											}
											print __($guid, $yearGroups[($i+1)]) . " <input $checked type='checkbox' name='gibbonYearGroupIDCheck" . ($i)/2 . "'><br/>" ; 
											print "<input type='hidden' name='gibbonYearGroupID" . ($i)/2 . "' value='" . $yearGroups[$i] . "'>" ;
										}
									}
									?>
									<input type="hidden" name="count" value="<?php print (count($yearGroups))/2 ?>">
								</td>
							</tr>
							<tr class='break'>
								<td colspan=2>
									<h3><?php print __($guid, 'Visual Assessment Guide Design') ?></h3>
								</td>
							</tr>
							<?php
							//Get terms in current guide
							try {
								$data2=array("visualAssessmentGuideID"=>$visualAssessmentGuideID) ;
								$sql2="SELECT * FROM visualAssessmentTerm WHERE visualAssessmentGuideID=:visualAssessmentGuideID ORDER BY term" ; 
								$result2=$connection2->prepare($sql2);
								$result2->execute($data2);
							}
							catch(PDOException $e) { 
								print "<tr class='break'>" ;
									print "<td colspan=2>" ;
										print "<div class='error'>" . $e->getMessage() . "</div>" ; 
									print "</td>" ;
								print "</tr>" ;
							}

							if ($result2->rowCount()<1) {
								print "<tr>" ;
									print "<td colspan=2>" ;
										print "<div class='error'>" ;
										print _("There are no records to display.") ;
										print "</div>" ;
									print "</td>" ;
								print "</tr>" ;
							
							}
							else {
								//Create array of terms
								$row2All=$result2->fetchAll() ;
	
								//Parse array to work out number of parent nodes
								$parentCount=0 ;
								$parents=array() ;
								foreach ($row2All AS $row2) {
									if ($row2["visualAssessmentTermIDParent"]=="") {
										$parents[$parentCount][0]=$row2["visualAssessmentTermID"] ;
										$parents[$parentCount][1]=$row2["term"] ;
										$parentCount++ ;
									}
								}
								if ($parentCount<1) {
									print "<tr>" ;
										print "<td colspan=2>" ;
											print "<div class='error'>" ;
											print _("There are no records to display.") ;
											print "</div>" ;
										print "</td>" ;
									print "</tr>" ;
								}
								else {
									print "<tr>" ;
										print "<td colspan=2>" ;
											$allowOutcomeEditing=getSettingByScope($connection2, "Planner", "allowOutcomeEditing") ;
											$categories=array() ;
											$categoryCount=0 ;
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
												makeTermBlocks($guid, $connection2, $row2All, NULL, 0, NULL) ;
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
								<span style="font-size: 90%"><i>* <?php print __($guid, "denotes a required field") ; ?></i></span>
							</td>
							<td class="right">
								<input type="hidden" name="address" value="<?php print $_SESSION[$guid]["address"] ?>">
								<input type="submit" value="<?php print __($guid, "Submit") ; ?>">
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