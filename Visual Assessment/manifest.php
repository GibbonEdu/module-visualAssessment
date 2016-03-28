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

//This file describes the module, including database tables

//Basic variables
$name="Visual Assessment" ;
$description="Visual Assessment is a Gibbon implementation of the Visual Assessment Guide approach to assessing student learning. For more, see http://rossparker.org/visual-assessment-guide." ;
$entryURL="guides_manage.php" ;
$type="Additional" ;
$category="Assess" ; 
$version="0.1.00" ; 
$author="Ross Parker" ; 
$url="http://rossparker.org" ;

//Module tables & gibbonSettings entries
$moduleTables[0]="CREATE TABLE `visualAssessmentGuide` ( `visualAssessmentGuideID` int(8) unsigned zerofill NOT NULL AUTO_INCREMENT, `name` varchar(50) NOT NULL, `category` varchar(50) NOT NULL, `description` text NOT NULL, `active` enum('Y','N') NOT NULL, `scope` enum('School','Learning Area') NOT NULL, `gibbonDepartmentID` int(4) unsigned zerofill DEFAULT NULL, `gibbonYearGroupIDList` varchar(255) NOT NULL, `gibbonPersonIDCreator` int(8) unsigned zerofill NOT NULL, PRIMARY KEY (`visualAssessmentGuideID`) ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
$moduleTables[1]="CREATE TABLE `visualAssessmentTerm` (  `visualAssessmentTermID` int(12) unsigned zerofill NOT NULL AUTO_INCREMENT,  `visualAssessmentGuideID` int(10) unsigned zerofill NOT NULL,  `term` varchar(20) NOT NULL,  `description` text NOT NULL,  `weight` int(2) NULL DEFAULT NULL, `visualAssessmentTermIDParent` int(14) unsigned zerofill  NULL DEFAULT NULL, PRIMARY KEY (`visualAssessmentTermID`)) ENGINE=MyISAM DEFAULT CHARSET=utf8;" ; 
$moduleTables[2]="CREATE TABLE `visualAssessmentAttainment` ( `visualAssessmentAttainmentID` int(14) unsigned zerofill NOT NULL AUTO_INCREMENT, `visualAssessmentTermID` int(12) unsigned zerofill NOT NULL, `gibbonPersonID` int(10) unsigned zerofill NOT NULL, `attainment` enum('1','2','3') DEFAULT NULL, `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`visualAssessmentAttainmentID`) ) ENGINE=MyISAM DEFAULT CHARSET=utf8;" ;

//Action rows 
$actionRows[0]["name"]="Manage Assessment Guides_all" ; 
$actionRows[0]["precedence"]="1"; 
$actionRows[0]["category"]="" ; 
$actionRows[0]["description"]="Allows a user to add, edit and delete individual guides school wide." ;
$actionRows[0]["URLList"]="guides_manage.php, guides_manage_add.php, guides_manage_edit.php, guides_manage_delete.php, guides_manage_view.php" ;
$actionRows[0]["entryURL"]="guides_manage.php" ;
$actionRows[0]["defaultPermissionAdmin"]="Y" ; 
$actionRows[0]["defaultPermissionTeacher"]="N" ; 
$actionRows[0]["defaultPermissionStudent"]="N" ; 
$actionRows[0]["defaultPermissionParent"]="N" ; 
$actionRows[0]["defaultPermissionSupport"]="N" ; 
$actionRows[0]["categoryPermissionStaff"]="Y" ; 
$actionRows[0]["categoryPermissionStudent"]="N" ;
$actionRows[0]["categoryPermissionParent"]="N" ; 
$actionRows[0]["categoryPermissionOther"]="N" ; 

$actionRows[1]["name"]="Manage Assessment Guides_myDepartments" ; 
$actionRows[1]["precedence"]="0"; 
$actionRows[1]["category"]="" ; 
$actionRows[1]["description"]="Allows a user to add, edit and delete individual guides with their department." ;
$actionRows[1]["URLList"]="guides_manage.php, guides_manage_add.php, guides_manage_edit.php, guides_manage_delete, guides_manage_view.php" ;
$actionRows[1]["entryURL"]="guides_manage.php" ;
$actionRows[1]["defaultPermissionAdmin"]="N" ; 
$actionRows[1]["defaultPermissionTeacher"]="Y" ; 
$actionRows[1]["defaultPermissionStudent"]="N" ; 
$actionRows[1]["defaultPermissionParent"]="N" ; 
$actionRows[1]["defaultPermissionSupport"]="N" ; 
$actionRows[1]["categoryPermissionStaff"]="Y" ; 
$actionRows[1]["categoryPermissionStudent"]="N" ;
$actionRows[1]["categoryPermissionParent"]="N" ; 
$actionRows[1]["categoryPermissionOther"]="N" ; 
?>