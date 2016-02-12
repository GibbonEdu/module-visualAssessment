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
	$style="straight" ;
	if (isset($_GET["style"])) {
		$style=$_GET["style"] ;
	}
	
	//Get terms in current guide
	try {
		$data=array("visualAssessmentGuideID"=>$visualAssessmentGuideID) ;
		$sql="SELECT * FROM visualAssessmentTerm WHERE visualAssessmentGuideID=:visualAssessmentGuideID ORDER BY term" ; 
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
			print "<script type=\"text/javascript\" src=\"./modules/Visual Assessment/js/d3/d3.min.js\"></script>" ;
	
			$myjson="{\"name\": \"\"" ;
			$myjson.=getChildren($rowAll, "") ;
			$myjson.="}" ;
			?>
			
			<div style='text-align: center; text-transform: uppercase; font-size: 25px; margin-top: 25px; margin-bottom: 10px; color: #4883B5'>
				Information & Communication Technology<br/>
				<div style='text-transform: none; font-size: 60%'>
					<?php
						if ($style=="straight") {
							print "Straight | <a href='./index.php?q=/modules/Visual Assessment/guides_manage.php&sidebar=false&style=round'>Round</a>" ;
						}
						else {
							print "<a href='./index.php?q=/modules/Visual Assessment/guides_manage.php&sidebar=false&style=straight'>Straight</a> | Round" ;
						}
					?>
				</div>
			</div>
			
			<?php
			if ($style=="straight") {
				?>
				<div id='tree' style='text-align: center; width: 100%; height: 2000px ; margin: 0 auto; font-weight: normal'></div>
				<style>
					.node circle {
					  fill: #fff;
					  stroke: steelblue;
					  stroke-width: 1.5px;
					}
					.node {
					  font: 11px arial;
					}
					.link {
					  fill: none;
					  stroke: #ddd;
					  stroke-width: 1.5px;
					}
					[data-name="0"] text {
					  font-weight: bold ;
					  text-decoration: underline ;
					  fill: #9885DD;
					  font-size: 16px ;
					}
					[data-name="1"] text {
					  font-weight: bold ;
					}
				</style>
				<script>
					var width = 960,
						height = 2000;
					var tree = d3.layout.tree()
						.size([height, width - 160]);
					var diagonal = d3.svg.diagonal()
						.projection(function(d) { return [d.y, d.x]; });
					var svg = d3.select("#tree").append("svg")
						.attr("width", width)
						.attr("height", height)
					  .append("g")
						.attr("transform", "translate(40,0)");
					var myjson='<?php print preg_replace( "/\r|\n/", "", $myjson );  ?>' ;
					root = JSON.parse( myjson ); 
					var nodes = tree.nodes(root),
						links = tree.links(nodes);
					var link = svg.selectAll("path.link")
						.data(links)
						.enter().append("path")
						.attr("class", "link")
						.attr("d", diagonal);
					var node = svg.selectAll("g.node")
						.data(nodes)
						.enter().append("g")
						.attr("class", "node")
						.attr("transform", function(d) { return "translate(" + d.y + "," + d.x + ")"; })
						.attr("id", function(d) { return d.class; })
						.attr("data-name", function(d) { return d.level; })
					node.append("circle")
						.attr("r", 4.5);

					node.append("text")
						.attr("dx", function(d) { return d.children ? -8 : 8; })
						.attr("dy", 3)
						.attr("text-anchor", function(d) { return d.children ? "end" : "start"; })
						.text(function(d) { return d.name; });
					d3.select(self.frameElement).style("height", height + "px");
				</script>
				<?php
			}
			else if ($style=="round") {
				?>
				<div id='tree' style='text-align: center; width: 100%; height: 1000px ; margin: 0 auto; font-weight: normal'></div>
				<style>
					.node circle {
					  fill: #fff;
					  stroke: steelblue;
					  stroke-width: 1.5px;
					}
					.node {
					  font: 11px arial;
					}
					.link {
					  fill: none;
					  stroke: #ddd;
					  stroke-width: 1.5px;
					}
					[data-name="0"] text {
					  font-weight: bold ;
					  text-decoration: underline ;
					  fill: #9885DD;
					}
					[data-name="1"] text {
					  font-weight: bold ;
					}
				</style>
				<script>
					var diameter = 1000;
					var tree = d3.layout.tree()
						.size([360, diameter / 2 - 120])
						.separation(function(a, b) { return (a.parent == b.parent ? 1 : 2) / a.depth; });
					var diagonal = d3.svg.diagonal.radial()
						.projection(function(d) { return [d.y, d.x / 180 * Math.PI]; });
					var svg = d3.select("#tree").append("svg")
						.attr("width", diameter)
						.attr("height", diameter)
						.append("g")
						.attr("transform", "translate(" + diameter / 2 + "," + diameter / 2 + ")");
					var myjson='<?php print preg_replace( "/\r|\n/", "", $myjson );  ?>' ;
					root = JSON.parse( myjson ); 
					var nodes = tree.nodes(root),
						links = tree.links(nodes);
					var link = svg.selectAll(".link")
						.data(links)
						.enter().append("path")
						.attr("class", "link")
						.attr("d", diagonal);
					var node = svg.selectAll(".node")
						.data(nodes)
						.enter().append("g")
						.attr("class", "node")
						.attr("transform", function(d) { return "rotate(" + (d.x - 90) + ")translate(" + d.y + ")"; })
						.attr("id", function(d) { return d.class; })
						.attr("data-name", function(d) { return d.level; })
					node.append("circle")
					  .attr("r", 4.5);
					node.append("text")
					  .attr("dy", ".31em")
					  .attr("text-anchor", function(d) { return d.x < 180 ? "start" : "end"; })
					  .attr("transform", function(d) { return d.x < 180 ? "translate(8)" : "rotate(180)translate(-8)"; })
					  .text(function(d) { return d.name; });
					d3.select(self.frameElement).style("height", diameter - 150 + "px");
				</script>
				<?php
			}
		}
	}
}
?>