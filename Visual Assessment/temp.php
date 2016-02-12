?>
		<script type="text/javascript" src="<?php print $_SESSION[$guid]["absoluteURL"] ?>/lib/vis/dist/vis.js"></script>
		<link href="<?php print $_SESSION[$guid]["absoluteURL"] ?>/lib/vis/dist/vis.css" rel="stylesheet" type="text/css" />

		<style type="text/css">
			div#map {
				width: 100%;
				height: 800px;
				border: 1px solid #000;
				background-color: #ddd;
				margin-bottom: 20px ;
			}
		</style>
	
		<div id="map"></div>

		<?php
		//PREP NODE AND EDGE ARRAYS DATA
		$nodeArray=array() ;
		$edgeArray=array();
		$nodeList="" ;
		$edgeList="" ;
		$idList="" ;
		$countNodes=0 ;
		$nodeList.="{id: " . $countNodes . ", label: 'ICT & Media', color: {border:'red'}, borderWidth: 2, font:{size: 150, color:'#9786DD'}}," ;
		$countNodes++ ;
		while ($row=$result->fetch()) {
			$title=NULL ;
			if ($row["description"]!="") {
				if (strlen($row["description"])>90) {
					$title=addSlashes(substr($row["description"],0,90)) . "..." ;
				}
				else {
					$title=addSlashes($row["description"]) ;
				}
				$title="title: '" . $title . "'," ;
			}
		
			if ($row["visualAssessmentTermIDParent"]=="") {
				$nodeList.="{group: " . $row["visualAssessmentTermID"] . ", id: " . $countNodes . ", label: '" . addSlashes($row["term"]) . "', $title color: {border:'red'}, borderWidth: 2, font:{size: 150, color:'#9786DD'}}," ;
			}
			else {
				$nodeList.="{group: " . $row["visualAssessmentTermIDParent"] . ", id: " . $countNodes . ", label: '" . addSlashes($row["term"]) . "', $title borderWidth: 2, font:{size: " . (5+($row["weight"])) . ", color:'#333'}}," ;
			}
			$nodeArray[$row["visualAssessmentTermID"]][0]=$countNodes ;
			$nodeArray[$row["visualAssessmentTermID"]][1]=$row["visualAssessmentTermID"] ;
			$nodeArray[$row["visualAssessmentTermID"]][2]=$row["visualAssessmentTermIDParent"] ;
			$idList.="'" . $row["visualAssessmentTermID"] . "'," ;
			$countNodes++ ;
		}
		if ($nodeList!="") {
			$nodeList=substr($nodeList, 0, -1) ;
		}
		if ($idList!="") {
			$idList=substr($idList, 0, -1) ;
		}
	
		foreach ($nodeArray AS $node) {
			if (isset($node[2])) {
				$edge=$node[2] ;
				if ($edge!="") {
					$edgeList.="{from: " . $nodeArray[$node[1]][0] . ", to: " . $nodeArray[$edge][0] . "}," ;
				}
			}
			else {
				$edgeList.="{from: " . $nodeArray[$node[1]][0] . ", to: 0}," ;
			}
		}
		if ($edgeList!="") {
			$edgeList=substr($edgeList, 0, -1) ;
		}
		?>
		<script type="text/javascript">
			//CREATE NODE ARRAY
			var nodes = new vis.DataSet([<?php print $nodeList ; ?>]);

			//CREATE EDGET ARRAY
			var edges = new vis.DataSet([<?php print $edgeList ?>]);

			//CREATE NODE TO visualAssessmentTermID ARRAY
			var ids = new Array(<?php print $idList ?>);
		
			//CREATE NETWORK
			var container = document.getElementById('map');
			var data = {
			nodes: nodes,
			edges: edges
			};
			var options = {
				nodes: {
					borderWidth: 1,
							size:30,
					color: {
						border: '#222222',
						background: 'rgba(97,195,238,0.1)'
					},
					font:{color:'#333'},
					shadow:false,
					shape: 'text'
				},
				edges: {
					width: 0.1,
					color: '#999',
					shadow: false,
					"smooth": {
						"forceDirection": "none"
					}
				},
				interaction:{
					navigationButtons: true,				
					zoomView: false
				},
				layout: {
					randomSeed: 0.5,
					improvedLayout:true
				}
			};
			var network = new vis.Network(container, data, options);
		
			//CLICK LISTENER
			//network.on( 'click', function(properties) {
			//	var nodeNo = properties.nodes ;
			//	window.location = '<?php print $_SESSION[$guid]["absoluteURL"] ?>/index.php?q=/modules/Free Learning/units_browse_details.php&sidebar=true&visualAssessmentTermID=' + ids[nodeNo] + '&gibbonDepartmentID=&difficulty=&name=&view=';
			//});
		</script>
		<?php
