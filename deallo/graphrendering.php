<?php
	//Graph rendering
	$graphChart = new FusionCharts("line", "ex1", "100%", 400, "graphmode", "json", '{  
	"chart": {
		"caption": "Total Revenues by Months",
		"xAxisName": "Month",
        "yAxisName": "Total Revenue (In RM)",
		"xAxisNameFontSize": "12",
		"yAxisNameFontSize": "12",
		"bgcolor": "FFFFFF",
		"showalternatehgridcolor": "0",
		"plotbordercolor": "008ee4",
		"plotborderthickness": "3",
		"showvalues": "0",
		"divlinecolor": "CCCCCC",
		"showcanvasborder": "0",
		"tooltipbgcolor": "00396d",
		"tooltipcolor": "FFFFFF",
		"tooltipbordercolor": "00396d",
		"numdivlines": "2",
		"yaxisvaluespadding": "20",
		"anchorbgcolor": "008ee4",
		"anchorborderthickness": "0",
		"showshadow": "0",
		"anchorradius": "4",
		"chartrightmargin": "25",
		"canvasborderalpha": "0",
		"showborder": "0"
    },
    "data": [
        {
            "label": "' . ((empty($SalesMonth[11])) ? '' : $SalesMonth[11]) . '/' . ((empty($SalesYear[11])) ? '' : $SalesYear[11]) . '",
            "value": "' . ((empty($TotalSales[11])) ? '0' : $TotalSales[11]) . '",
            ' . ((empty($SalesMonth[11])) ? '' : (($HighestSaleMonth == $SalesMonth[11]) ? '"anchorradius": "7",
            "tooltext": "Historical high, '. $SalesMonth[11] . "/" . $SalesYear[11] . ", RM" .$TotalSales[11] .'",' : '')) . '
            "color": "008ee4",
            "stepSkipped": false,
            "appliedSmartLabel": true
        },
        {
            "label": "' . ((empty($SalesMonth[10])) ? '' : $SalesMonth[10]) . '/' . ((empty($SalesYear[10])) ? '' : $SalesYear[10]) . '",
            "value": "' . ((empty($TotalSales[10])) ? '0' : $TotalSales[10]) . '",
            "color": "008ee4",
            ' . ((empty($SalesMonth[10])) ? '' : (($HighestSaleMonth == $SalesMonth[10]) ? '"anchorradius": "7",
            "tooltext": "Historical high, '. $SalesMonth[10] . "/" . $SalesYear[10] . ", RM" .$TotalSales[10] .'",' : '')) . '
            "stepSkipped": false,
            "appliedSmartLabel": true
        },
        {
            "label": "' . ((empty($SalesMonth[9])) ? '' : $SalesMonth[9]) . '/' . ((empty($SalesYear[9])) ? '' : $SalesYear[9]) . '",
            "value": "' . ((empty($TotalSales[9])) ? '0' : $TotalSales[9]) . '",
            "color": "008ee4",
            ' . ((empty($SalesMonth[9])) ? '' : (($HighestSaleMonth == $SalesMonth[9]) ? '"anchorradius": "7",
            "tooltext": "Historical high, '. $SalesMonth[9] . "/" . $SalesYear[9] . ", RM" .$TotalSales[9] .'",' : '')) . '
            "stepSkipped": false,
            "appliedSmartLabel": true
        },
        {
            "label": "' . ((empty($SalesMonth[8])) ? '' : $SalesMonth[8]) . '/' . ((empty($SalesYear[8])) ? '' : $SalesYear[8]) . '",
            "value": "' . ((empty($TotalSales[8])) ? '0' : $TotalSales[8]) . '",
            "color": "008ee4",
            ' . ((empty($SalesMonth[8])) ? '' : (($HighestSaleMonth == $SalesMonth[8]) ? '"anchorradius": "7",
            "tooltext": "Historical high, '. $SalesMonth[8] . "/" . $SalesYear[8] . ", RM" .$TotalSales[8] .'",' : '')) . '
            "stepSkipped": false,
            "appliedSmartLabel": true
        },
        {
            "label": "' . ((empty($SalesMonth[7])) ? '' : $SalesMonth[7]) . '/' . ((empty($SalesYear[7])) ? '' : $SalesYear[7]) . '",
            "value": "' . ((empty($TotalSales[7])) ? '0' : $TotalSales[7]) . '",
            "color": "008ee4",
            ' . ((empty($SalesMonth[7])) ? '' : (($HighestSaleMonth == $SalesMonth[7]) ? '"anchorradius": "7",
            "tooltext": "Historical high, '. $SalesMonth[7] . "/" . $SalesYear[7] . ", RM" .$TotalSales[7] .'",' : '')) . '
            "stepSkipped": false,
            "appliedSmartLabel": true
        }
        ,
        {
            "label": "' . ((empty($SalesMonth[6])) ? '' : $SalesMonth[6]) . '/' . ((empty($SalesYear[6])) ? '' : $SalesYear[6]) . '",
            "value": "' . ((empty($TotalSales[6])) ? '0' : $TotalSales[6]) . '",
            "color": "008ee4",
            ' . ((empty($SalesMonth[6])) ? '' : (($HighestSaleMonth == $SalesMonth[6]) ? '"anchorradius": "7",
            "tooltext": "Historical high, '. $SalesMonth[6] . "/" . $SalesYear[6] . ", RM" .$TotalSales[6] .'",' : '')) . '
            "stepSkipped": false,
            "appliedSmartLabel": true
        }
        ,
        {
            "label": "' . ((empty($SalesMonth[5])) ? '' : $SalesMonth[5]) . '/' . ((empty($SalesYear[5])) ? '' : $SalesYear[5]) . '",
            "value": "' . ((empty($TotalSales[5])) ? '0' : $TotalSales[5]) . '",
            "color": "008ee4",
            ' . ((empty($SalesMonth[5])) ? '' : (($HighestSaleMonth == $SalesMonth[5]) ? '"anchorradius": "7",
            "tooltext": "Historical high, '. $SalesMonth[5] . "/" . $SalesYear[5] . ", RM" .$TotalSales[5] .'",' : '')) . '
            "stepSkipped": false,
            "appliedSmartLabel": true
        }
        ,
        {
            "label": "' . ((empty($SalesMonth[4])) ? '' : $SalesMonth[4]) . '/' . ((empty($SalesYear[4])) ? '' : $SalesYear[4]) . '",
            "value": "' . ((empty($TotalSales[4])) ? '0' : $TotalSales[4]) . '",
            "color": "008ee4",
            ' . ((empty($SalesMonth[4])) ? '' : (($HighestSaleMonth == $SalesMonth[4]) ? '"anchorradius": "7",
            "tooltext": "Historical high, '. $SalesMonth[4] . "/" . $SalesYear[4] . ", RM" .$TotalSales[4] .'",' : '')) . '
            "stepSkipped": false,
            "appliedSmartLabel": true
        }
        ,
        {
            "label": "' . ((empty($SalesMonth[3])) ? '' : $SalesMonth[3]) . '/' . ((empty($SalesYear[3])) ? '' : $SalesYear[3]) . '",
            "value": "' . ((empty($TotalSales[3])) ? '0' : $TotalSales[3]) . '",
            "color": "008ee4",
            ' . ((empty($SalesMonth[3])) ? '' : (($HighestSaleMonth == $SalesMonth[3]) ? '"anchorradius": "7",
            "tooltext": "Historical high, '. $SalesMonth[3] . "/" . $SalesYear[3] . ", RM" .$TotalSales[3] .'",' : '')) . '
            "stepSkipped": false,
            "appliedSmartLabel": true
        }
        ,
        {
            "label": "' . ((empty($SalesMonth[2])) ? '' : $SalesMonth[2]) . '/' . ((empty($SalesYear[2])) ? '' : $SalesYear[2]) . '",
            "value": "' . ((empty($TotalSales[2])) ? '0' : $TotalSales[2]) . '",
            "color": "008ee4",
            ' . ((empty($SalesMonth[2])) ? '' : (($HighestSaleMonth == $SalesMonth[2]) ? '"anchorradius": "7",
            "tooltext": "Historical high, '. $SalesMonth[2] . "/" . $SalesYear[2] . ", RM" .$TotalSales[2] .'",' : '')) . '
            "stepSkipped": false,
            "appliedSmartLabel": true
        }
        ,
        {
            "label": "' . ((empty($SalesMonth[1])) ? '' : $SalesMonth[1]) . '/' . ((empty($SalesYear[1])) ? '' : $SalesYear[1]) . '",
            "value": "' . ((empty($TotalSales[1])) ? '0' : $TotalSales[1]) . '",
            "color": "008ee4",
            ' . ((empty($SalesMonth[1])) ? '' : (($HighestSaleMonth == $SalesMonth[1]) ? '"anchorradius": "7",
            "tooltext": "Historical high, '. $SalesMonth[1] . "/" . $SalesYear[1] . ", RM" .$TotalSales[1] .'",' : '')) . '
            "stepSkipped": false,
            "appliedSmartLabel": true
        }
        ,
        {
            "label": "' . ((empty($SalesMonth[0])) ? '' : $SalesMonth[0]) . '/' . ((empty($SalesYear[0])) ? '' : $SalesYear[0]) . '",
            "value": "' . ((empty($TotalSales[0])) ? '0' : $TotalSales[0]) . '",
            "color": "008ee4",
            ' . ((empty($SalesMonth[0])) ? '' : (($HighestSaleMonth == $SalesMonth[0]) ? '"anchorradius": "7",
            "tooltext": "Historical high, '. $SalesMonth[0] . "/" . $SalesYear[0] . ", RM" .$TotalSales[0] .'",' : '')) . '
            "stepSkipped": false,
            "appliedSmartLabel": true
        }
    ]
        }');

		$columnChart = new FusionCharts("column2d", "ex2", "100%", 400, "columnmode", "json", '{  
	"chart": {
		"caption": "Total Revenues by Months",
		"xAxisName": "Month",
        "yAxisName": "Total Revenue (In RM)",
		"xAxisNameFontSize": "12",
		"yAxisNameFontSize": "12",
		"theme": "ocean",
		"bgcolor": "FFFFFF"
    },
    "data": [
        {
            "label": "' . ((empty($SalesMonth[11])) ? '' : $SalesMonth[11]) . '/' . ((empty($SalesYear[11])) ? '' : $SalesYear[11]) . '",
            "value": "' . ((empty($TotalSales[11])) ? '' : $TotalSales[11]) . '",
            "color": "008ee4"

        },
        {
            "label": "' . ((empty($SalesMonth[10])) ? '' : $SalesMonth[10]) . '/' . ((empty($SalesYear[10])) ? '' : $SalesYear[10]) . '",
            "value": "' . ((empty($TotalSales[10])) ? '' : $TotalSales[10]) . '",
            "color": "008ee4"
        },
        {
            "label": "' . ((empty($SalesMonth[9])) ? '' : $SalesMonth[9]) . '/' . ((empty($SalesYear[9])) ? '' : $SalesYear[9]) . '",
            "value": "' . ((empty($TotalSales[9])) ? '' : $TotalSales[9]) . '",
            "color": "008ee4"
        },
        {
            "label": "' . ((empty($SalesMonth[8])) ? '' : $SalesMonth[8]) . '/' . ((empty($SalesYear[8])) ? '' : $SalesYear[8]) . '",
            "value": "' . ((empty($TotalSales[8])) ? '' : $TotalSales[8]) . '",
            "color": "008ee4"
        },
        {
            "label": "' . ((empty($SalesMonth[7])) ? '' : $SalesMonth[7]) . '/' . ((empty($SalesYear[7])) ? '' : $SalesYear[7]) . '",
            "value": "' . ((empty($TotalSales[7])) ? '' : $TotalSales[7]) . '",
            "color": "008ee4"
        }
        ,
        {
            "label": "' . ((empty($SalesMonth[6])) ? '' : $SalesMonth[6]) . '/' . ((empty($SalesYear[6])) ? '' : $SalesYear[6]) . '",
            "value": "' . ((empty($TotalSales[6])) ? '' : $TotalSales[6]) . '",
            "color": "008ee4"
        }
        ,
        {
            "label": "' . ((empty($SalesMonth[5])) ? '' : $SalesMonth[5]) . '/' . ((empty($SalesYear[5])) ? '' : $SalesYear[5]) . '",
            "value": "' . ((empty($TotalSales[5])) ? '' : $TotalSales[5]) . '",
            "color": "008ee4"
        }
        ,
        {
            "label": "' . ((empty($SalesMonth[4])) ? '' : $SalesMonth[4]) . '/' . ((empty($SalesYear[4])) ? '' : $SalesYear[4]) . '",
            "value": "' . ((empty($TotalSales[4])) ? '' : $TotalSales[4]) . '",
            "color": "008ee4"
        }
        ,
        {
            "label": "' . ((empty($SalesMonth[3])) ? '' : $SalesMonth[3]) . '/' . ((empty($SalesYear[3])) ? '' : $SalesYear[3]) . '",
            "value": "' . ((empty($TotalSales[3])) ? '' : $TotalSales[3]) . '",
            "color": "008ee4"
        }
        ,
        {
            "label": "' . ((empty($SalesMonth[2])) ? '' : $SalesMonth[2]) . '/' . ((empty($SalesYear[2])) ? '' : $SalesYear[2]) . '",
            "value": "' . ((empty($TotalSales[2])) ? '' : $TotalSales[2]) . '",
            "color": "008ee4"
        }
        ,
        {
            "label": "' . ((empty($SalesMonth[1])) ? '' : $SalesMonth[1]) . '/' . ((empty($SalesYear[1])) ? '' : $SalesYear[1]) . '",
            "value": "' . ((empty($TotalSales[1])) ? '' : $TotalSales[1]) . '",
            "color": "008ee4"
        }
        ,
        {
            "label": "' . ((empty($SalesMonth[0])) ? '' : $SalesMonth[0]) . '/' . ((empty($SalesYear[0])) ? '' : $SalesYear[0]) . '",
            "value": "' . ((empty($TotalSales[0])) ? '' : $TotalSales[0]) . '",
            "color": "008ee4"
        }
    ]
        }');
        $graphChart->render();
		$columnChart->render();
    
?>