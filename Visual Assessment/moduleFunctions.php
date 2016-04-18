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

//$format can be "json" or "array", and determines the results that are returned
function getChildren($rowAll, $visualAssessmentTermIDParent, $level=0, $studentResults=NULL) {
	$childrenCount=0 ;
	
	$json="" ;
	$jsonInt="" ;

	$json=$json=",\"children\": [" ;

	foreach ($rowAll AS $row) {
		if ($row["visualAssessmentTermIDParent"]==$visualAssessmentTermIDParent) {
			$childrenCount++ ;
			$title=addslashes($row["term"]) ;
			if ($row["description"]!="") {
				$title=addslashes($row["term"]) . " - " . addslashes($row["description"]) ;
			}
			$jsonInt.="{\"name\": \"" . $row["term"] . "\", \"class\": \"" . $row["visualAssessmentTermID"] . "\", \"level\": \"" . $level . "\", \"title\": \"" . $title . "\"" ;
			if ($studentResults!=NULL) {
				foreach ($studentResults AS $studentResult) {
					if ($studentResult["visualAssessmentTermID"]==$row["visualAssessmentTermID"]) {
						$jsonInt.=", \"attainment\": \"" . "attainment" . $studentResult["attainment"] . "\"" ;
						exit() ;
					}
				}
			}
		
			$jsonInt.=getChildren($rowAll, $row["visualAssessmentTermID"], ($level+1), $studentResults) ;
			$jsonInt.="}," ;
		}
	}

	if ($jsonInt!="") {
		$jsonInt=substr($jsonInt, 0, -1) ;
	}
	$json.=$jsonInt ;
	$json.="]" ;	
	
	return $json ;
}

function makeTermBlocks($guid, $connection2, $rowAll, $visualAssessmentTermIDParent, $level=0, $studentResults=NULL) {
	$count=0 ;
	
	$class="class='parent'" ;
	if ($level!=0) {
		$class="class='child'" ;
	}
	foreach ($rowAll AS $row) {
		if ($row["visualAssessmentTermIDParent"]==$visualAssessmentTermIDParent) {
			print "<ul $class>" ;
				makeTermBlock($guid, $connection2, $row["visualAssessmentTermID"], $row["term"], $row["description"], $row["weight"], $row["visualAssessmentTermIDParent"], $outerBlock=TRUE) ;
				makeTermBlocks($guid, $connection2, $rowAll, $row["visualAssessmentTermID"], ($level+1), NULL) . "<br/>" ;
			print "</ul>" ;
			$count++ ;
		}
	}
	
}

//Make the display for a block, according to the input provided, where $visualAssessmentTermID is a unique number appended to the block's field ids.
//Mode can be add, edit
function makeTermBlock($guid, $connection2, $i, $term, $description="", $weight="", $visualAssessmentTermIDParent="") {
	print "<li id='blockOuter$i' class='blockOuter'><div>" ;
	?>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#block<?php print $i ?>").css("height","72px")

				$('#delete<?php print $i ?>').unbind('click').click(function() {
					if (confirm("Are you sure you want to delete this record?")) {
						$('#blockOuter<?php print $i ?>').fadeOut(600, function(){ $('#block<?php print $i ?>').remove(); });
					}
				});
			});
		</script>
		<div class='hiddenReveal' style='border: 1px solid #d8dcdf; margin: 0 0 5px' id="block<?php print $i ?>" style='padding: 0px'>
			<table class='blank' cellspacing='0' style='width: 100%'>
				<tr>
					<td style='width: 70%'>
						<input name='order[]' type='hidden' value='<?php print $i ?>'>
						<input maxlength=20 id='term<?php print $i ?>' name='term<?php print $i ?>' type='text' style='float: none; border: 1px dotted #aaa; background: none; margin-left: 3px;  margin-top: 0px; font-size: 140%; font-weight: bold; width: 350px' value='<?php print htmlPrep($term) ?>'>
						<input maxlength=2 id='weight<?php print $i ?>' name='weight<?php print $i ?>' type='text' style='float: none; border: 1px dotted #aaa; background: none; margin-left: 3px; margin-top: 0px; font-size: 110%; font-style: italic; width: 95px' value='<?php print htmlPrep($weight) ?>'><br/>
						<input id='description<?php print $i ?>' name='description<?php print $i ?>' type='text' style='float: none; border: 1px dotted #aaa; background: none; margin-left: 3px; margin-top: 2px; font-size: 110%; font-style: italic; width: 454px' value='<?php print htmlPrep($description) ?>'>
					</td>
					<td style='text-align: right; width: 30%'>
						<div style='margin-bottom: 5px'>
							<?php
							print "<img id='delete$i' title='" . __($guid, 'Delete') . "' src='./themes/" . $_SESSION[$guid]["gibbonThemeName"] . "/img/garbage.png'/> " ;
							?>
						</div>
					</td>
				</tr>
			</table>
		</div>
	</div></li>
	<?php
}
			
?>
