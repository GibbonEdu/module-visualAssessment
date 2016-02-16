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
	
	//Check existence of current guide
	try {
		$data=array("visualAssessmentGuideID"=>$visualAssessmentGuideID) ;
		$sql="SELECT * FROM visualAssessmentGuide WHERE visualAssessmentGuideID=:visualAssessmentGuideID" ; 
		$result=$connection2->prepare($sql);
		$result->execute($data);
	}
	catch(PDOException $e) { 
		print "<div class='error'>" . $e->getMessage() . "</div>" ; 
	}
	
	if ($result->rowCount()!=1) {
		print "<div class='error'>" ;
		print _("There are no records to display.") ;
		print "</div>" ;
	}
	else {
		$row=$result->fetch() ;
		
		print "<div style='text-align: center; text-transform: uppercase; font-size: 25px; margin-top: 25px; margin-bottom: 0px; color: #4883B5'>" ;
			print $row["name"] . "<br/>" ;
			print "<div style='font-size: 65%; font-style: italic; color: #666; text-transform: none'>" ;
				print $row["description"] ;
			print "</div>" ;
		print "</div>" ;
	
		//Get terms in current guide
		try {
			$data2=array("visualAssessmentGuideID"=>$visualAssessmentGuideID) ;
			$sql2="SELECT * FROM visualAssessmentTerm WHERE visualAssessmentGuideID=:visualAssessmentGuideID ORDER BY term" ; 
			$result2=$connection2->prepare($sql2);
			$result2->execute($data2);
		}
		catch(PDOException $e) { 
			print "<div class='error'>" . $e->getMessage() . "</div>" ; 
		}
	
		if ($result2->rowCount()<1) {
			print "<div class='error'>" ;
			print _("There are no records to display.") ;
			print "</div>" ;
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
				print "<div class='error'>" ;
				print _("There are no records to display.") ;
				print "</div>" ;
			}
			else {
				print "<script type=\"text/javascript\" src=\"./modules/Visual Assessment/js/d3/d3.min.js\"></script>" ;
			
				$myjson="{\"name\": \"\"" ;
				$myjson.=getChildren($row2All, "") ;
				$myjson.="}" ;
				
			
				?>
				<div id='tree' style='padding-top: 120px; border: 1px solid #000; background: #BADBFB url("./modules/Visual Assessment/img/bg.png") no-repeat right top; text-align: center; width: 1000px; height: 1020px ; margin: 30px auto; font-weight: normal'></div>
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
					  stroke: rgba(255,255,255,0.8);
					  stroke-width: 1.5px;
					}
					[data-name="0"] text {
					  font-weight: bold ;
					  fill: #000;
					  font-size: 160% ;
					}
					[data-name="1"] text {
					  font-weight: bold ;
					  font-size: 118% ;
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
						.text(function(d) { return d.name; })
						.attr("title", function(d) { return d.title; })
						.call(wrap, 100);  
					d3.select(self.frameElement).style("height", diameter - 150 + "px");
				
					function wrap(text, width) {
						text.each(function() {
							var text = d3.select(this),
								words = text.text().split(/\s+/).reverse(),
								word,
								line = [],
								lineNumber = 0,
								lineHeight = 0.7, // ems
								y = text.attr("y"),
								dy = parseFloat(text.attr("dy")),
								tspan = text.text(null).append("tspan").attr("x", 0).attr("y", y).attr("dy", dy + "em");
							while (word = words.pop()) {
								line.push(word);
								tspan.text(line.join(" "));
								if (tspan.node().getComputedTextLength() > width) {
									line.pop();
									tspan.text(line.join(" "));
									line = [word];
									tspan = text.append("tspan").attr("x", 0).attr("y", y).attr("dy", ++lineNumber * lineHeight + dy + "em").text(word);
							  	}
							}
						});
					}
				</script>
				<?php
			}
		}
	}
}
?>