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
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

@session_start() ;

//Module includes
include "./modules/" . $_SESSION[$guid]["module"] . "/moduleFunctions.php" ;

if (isActionAccessible($guid, $connection2, "/modules/Visual Assessment/guides_manage.php")==FALSE) {
	//Acess denied
	print "<div class='error'>" ;
		print "You do not have access to this action." ;
	print "</div>" ;
}
else {
	print "<div class='trail'>" ;
	print "<div class='trailHead'><a href='" . $_SESSION[$guid]["absoluteURL"] . "'>" . _("Home") . "</a> > <a href='" . $_SESSION[$guid]["absoluteURL"] . "/index.php?q=/modules/" . getModuleName($_GET["q"]) . "/" . getModuleEntry($_GET["q"], $connection2, $guid) . "'>" . getModuleName($_GET["q"]) . "</a> > </div><div class='trailEnd'>" . _('Manage Guides') . "</div>" ;
	print "</div>" ;

	$visualAssessmentGuideID=1 ;
	
	//Get terms in current guide
	try {
		$data=array("visualAssessmentGuideID"=>$visualAssessmentGuideID) ;
		$sql="SELECT * FROM visualAssessmentTerm WHERE visualAssessmentGuideID=:visualAssessmentGuideID ORDER BY visualAssessmentTermID" ; 
		$result=$connection2->prepare($sql);
		$result->execute($data);
	}
	catch(PDOException $e) { 
		print "<div class='error'>" . $e->getMessage() . "</div>" ; 
	}
	
	if ($result->rowCount()<1) {
		print "<div class='error'>" ;
		print _("There are no records to display.") ;
		print "</div>" ;
	}
	else {
		//Create array of terms
		$rowAll=$result->fetchAll() ;
		
		//Parse array to work out number of parent nodes
		$parentCount=0 ;
		$parents=array() ;
		foreach ($rowAll AS $row) {
			if ($row["visualAssessmentTermIDParent"]=="") {
				$parents[$parentCount][0]=$row["visualAssessmentTermID"] ;
				$parents[$parentCount][1]=$row["term"] ;
				$parentCount++ ;
			}
		}
		if ($parentCount<1) {
			print "<div class='error'>" ;
			print _("There are no records to display.") ;
			print "</div>" ;
		}
		else {
			print "<link rel=\"stylesheet\" type=\"text/css\" href=\"./modules/Visual Assessment/js/jqcloud/jqcloud/jqcloud.css\" />" ;
			print "<script type=\"text/javascript\" src=\"./modules/Visual Assessment/js/jqcloud/jqcloud/jqcloud.min.js\"></script>" ;
	
			//Create table to hold clouds
			print "<table class='blank' cellspacing='0' style='width:100%; margin-top: 20px'>" ;
				$count=0 ;
				$columns=1 ;
		
				for ($i=0; $i<$parentCount; $i++) {
					//CREATE CLOUD
					?>
					<script type="text/javascript">
						var word_list<?php print $i ?> = [
							<?php
							foreach ($rowAll AS $row) {
								if ($row["visualAssessmentTermIDParent"]==$parents[$i][0]) {
									print "{text: \"" . $row["term"] . "\", weight: '" . ($row["weight"]) . "'}," ;
								}
							}
							?>
							
						];
						$(function() {							
							$("#cloud<?php print $i ?>").jQCloud(word_list<?php print $i ?>);
						});
					</script>
					<?php
					print "<div id='cloud$i' style='width: 100%; height: 300px; background-color: #eee; border: 1px solid black'>" ;
						print "<div style='color: #aaa; font-size: 40px'>" . $parents[$i][1] . "</div>" ;
					print "</div><br/>" ;
			
					if ($count%$columns==($columns-1)) {
						print "</tr>" ;
					}
					$count++ ;
				}
		
				for ($i=0;$i<$columns-($count%$columns);$i++) {
					print "<td></td>" ;
				}
		
				if ($count%$columns!=0) {
					print "</tr>" ;
				}
			print "</table>" ;	
		}
	}
}
?>