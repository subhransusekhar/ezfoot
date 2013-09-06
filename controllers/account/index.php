<?php
class Account_Index extends Controller{
    function Account_Index(){
        //needed to excecute the parent contructor
        parent::Controller();
    }
    
    function doBefore(){
        $this->site_title = "Home";                $this->addAction('action_head', array($this, 'addToHead'));
    }
	function addToHead(){		?>			<script type="text/javascript">var chart;$(document).ready(function() {	chart = new Highcharts.Chart({		chart: {			renderTo: 'highchart-dailyhit-container',			defaultSeriesType: 'line',			marginRight: 130,			marginBottom: 25		},		credits: false,		title: {			text: 'Daily Hits',			x: -20 		},		subtitle: {			text: 'zurl.in',			x: -20		},		xAxis: {			categories: ['00:00', '01:00', '02:00', '03:00', '04:00', '05:00', 			             '06:00', '07:00', '08:00', '09:00', '10:00', '11:00', 			             '12:00', '13:00', '14:00', '15:00', '16:00', '17:00',			             '18:00', '19:00', '20:00', '21:00', '22:00', '23:00',			             '00:00'],			labels: {rotation:45},			gridLineWidth: 1		},		yAxis: {			title: {				text: 'Hit Count'			},			plotLines: [{				value: 0,				width: 1,				color: '#808080'			}]		},		tooltip: {			formatter: function() {					return this.y +'<b>'+ this.series.name +'</b>';			}		},		legend: {			layout: 'vertical',			align: 'right',			verticalAlign: 'top',			x: -10,			y: 100,			borderWidth: 0		},		series: [{			name: 'Hit',			data: [<?php $this->printCount()?>]		}]	});});		</script>		<?php 	}
    function doDefault(){
        
    }
	function printCount(){		global $moduleObjs;		if(!empty($moduleObjs['mod_tracker']))			$data = $moduleObjs['mod_tracker']->getGetDailyHits();				if($data){			$cnt = '';			foreach($data as $d){				$cnt .= $d .",";			}			$cnt = trim($cnt, ',');			echo $cnt;		}	}
    function doAfter(){
        $this->setView("account/index",true);
    }
}