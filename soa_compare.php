<!doctype html>
<html lang="en">
<head>
    <!-- Global definitions -->
    <script src="json_data/global.js" type="text/javascript"></script>

    <!-- Global evaluation -->
    <script src="json_data/global_eval_all.js" type="text/javascript"></script>
    <script src="json_data/global_eval_val.js" type="text/javascript"></script>
    <script src="json_data/global_eval_train.js" type="text/javascript"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400,300' rel='stylesheet' type='text/css'> -->
    <link href='https://fonts.googleapis.com/css?family=Raleway:100,300,500' rel='stylesheet' type='text/css'>
    <meta name="description" content="DAVIS, Densely Annotated VIdeo Segmentation">

    <title>DAVIS: Densely Annotated VIdeo Segmentation</title>
    <link rel="stylesheet" href="https://yui-s.yahooapis.com/pure/0.6.0/pure-min.css">
    <!--[if lte IE 8]>
        <link rel="stylesheet" href="css/layouts/side-menu-old-ie.css">
    <![endif]-->
    <!--[if gt IE 8]><!-->
        <link rel="stylesheet" href="css/layouts/side-menu.css">
    <!--<![endif]-->
    
    <!-- Table -->
    <link rel="stylesheet" href="css/style_tab.css">

    <!-- Buttons -->
    <link rel="stylesheet" type="text/css" href="css/buttons/component.css" />

    <!--Includes-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <!-- load the d3.js library -->    
    <script src="https://d3js.org/d3.v3.min.js"></script>
    <style type="text/css">
        .axis path{
            fill: none;
            stroke: black;
            stroke-width: 2;
            shape-rendering: crispEdges;
        }

        .axis line {
            fill: none;
            stroke: black;
            stroke-width: 1;
            shape-rendering: crispEdges;
        }

        a.lk:link {text-decoration:none;}
        a.lk:hover {text-decoration:none;}
    </style>
</head>


<body>
<div id="layout">
    <!-- Menu toggle -->
    <a href="#menu" id="menuLink" class="menu-link">
        <!-- Hamburger icon -->
        <span></span>
    </a>

    <div id="menu">
        <div class="pure-menu">

            <ul class="pure-menu-list">
                <li><a href="index.html" class="pure-menu-link">Home</a></li>
                <li><a class="pure-menu-link pure-menu-selected">Benchmark</a></li>
                <li><a href="browse.php" class="pure-menu-link">Explore</a></li>
                <li><a href="code.html" class="pure-menu-link">Download</a></li>
            </ul>
        </div>
    </div>

    <div id="main">
        <div class="header">
            <h1>Benchmark Video Object Segmentation on DAVIS</h1>
            <h2>Quantitatively compare state-of-the-art image segmentation techniques</h2>
        </div>

        <!-- Buttons  -->
        <div class="pure-g" style="margin-left: 5%;margin-right: 5%;">
            <div class="pure-u-1-4"> 
             <div style="font-family: 'Raleway', sans-serif;text-align:left;font-weight: 300;margin-top:40px;margin-bottom:3px;">
            Select the type of table:
            </div>
            </div>
            <div class="pure-u-1-4" style="text-align:center;font-family: 'Raleway', sans-serif; font-weight: 300;">  
                <button id="global" onclick="switch_to_table('global',curr_subset)" class="btn btn-6 btn-6a" style="width: 95%;margin-top:30px;">Global Comparison Table</button>
            </div>
            <div class="pure-u-1-4" style="text-align:center;font-family: 'Raleway', sans-serif; font-weight: 300;">
                <button id="J" onclick="switch_to_table('J',curr_subset)" class="btn btn-6 btn-6a" style="width: 95%;margin-top:30px;">Jaccard (J) Per-Sequence</button>
            </div>
            <div class="pure-u-1-4" style="text-align:center;font-family: 'Raleway', sans-serif; font-weight: 300;">  
                <button  id="F" onclick="switch_to_table('F',curr_subset)" class="btn btn-6 btn-6a" style="width: 95%;margin-top:30px;">Boundary (F) Per-Sequence</button>
            </div>
        </div>

        <!-- SubButtons  -->
        <div class="pure-g" style="margin-left: 5%;margin-right: 5%;">
            <div class="pure-u-1-4"> 
                         <div style="font-family: 'Raleway', sans-serif;text-align:left;font-weight: 300;margin-top:12px;margin-bottom:3px;">
            <span style="color:red">NEW!</span> Select the dataset subset:
            </div>
            </div>
            <div class="pure-u-1-4" style="text-align:center;font-family: 'Raleway', sans-serif; font-weight: 300;">  
                <button id="subset_val" onclick="switch_to_table(curr_table,'val')" class="btn btn-6 btn-6a" style="width: 95%;margin-top:3px;">Validation</button>
            </div>
            <div class="pure-u-1-4" style="text-align:center;font-family: 'Raleway', sans-serif; font-weight: 300;">
                <button id="subset_train" onclick="switch_to_table(curr_table,'train')" class="btn btn-6 btn-6a" style="width: 95%;margin-top:3px;">Training</button>
            </div>
            <div class="pure-u-1-4" style="text-align:center;font-family: 'Raleway', sans-serif; font-weight: 300;">  
                <button  id="subset_all" onclick="switch_to_table(curr_table,'all')" class="btn btn-6 btn-6a" style="width: 95%;margin-top:3px;">All</button>
            </div>
        </div>

        <div style="margin: auto;max-width: 1200px;">
             <div id="text_top" style="font-family: 'Raleway', sans-serif;font-weight: 300;text-align:center;margin-left: 10%;margin-right: 10%;margin-top:20px;margin-bottom:0px;">
             </div>
             <div style="font-family: 'Raleway', sans-serif;text-align:center;font-weight: 300;margin-left: 10%;margin-right: 10%;margin-top:3px;margin-bottom:15px;">
             <i>Semi-supervised techniques are depicted in <span style="color:red">red</span>, unsupervised in <span style="color:green;">green</span>, and preprocessing methods in <span style="color:blue;">blue</span>.</i>
             </div>
        </div> 

        <div class="pure-g">
            <div class="pure-u-1-1">
              <table id='tab' width='90%' style="border-spacing: 40px 10px; font-family: 'Raleway', sans-serif;margin-left: 5%;margin-right: 5%;margin-bottom:40px;">
              </table>
            </div>
        </div>

        <div style="margin: auto;max-width: 1200px;">
             <div style="font-family: 'Raleway', sans-serif;font-weight: 300;margin-left: 10%;margin-right: 10%;margin-bottom:70px;">

                <h3 style="margin-top:30px;margin-bottom:10px;">Legend</h3>
                <ul id="legend_text">
                </ul>
                <br><br>
                <i>Is your technique missing although it's published and the code is public? <a href='mailto:perazzif@inf.ethz.ch,jponttuset@vision.ee.ethz.ch'>Let us know</a>  and we'll add it.</i>                
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    // Set values different to the ones by default, to 'force' the change
    var curr_table  = "J";
    var curr_subset = "train";
    var curr_eval;

    function switch_to_table(new_table,new_subset)
    {
        if (new_table!=curr_table)
        {
            document.getElementById(curr_table).style.background = "transparent";
            document.getElementById(new_table).style.background = "#e7eae8";
            curr_table = new_table;
            if (new_table=='J')
                document.getElementById("text_top").innerHTML = "Mean Jaccard index (J) of all techniques on each of the sequences independently.<br>Click on the name of a techique to sort the sequences with respect to the performance of that technique.";
            else if (new_table=='F')
                document.getElementById("text_top").innerHTML = "Mean Boundary measure (F) of all techniques on each of the sequences independently.<br>Click on the name of a techique to sort the sequences with respect to the performance of that technique.";
            else if (new_table=='global')
                document.getElementById("text_top").innerHTML = "";
        }

        if (new_subset!=curr_subset)
        {
            document.getElementById("subset_"+curr_subset).style.background = "transparent";
            document.getElementById("subset_"+new_subset).style.background = "#e7eae8";
            curr_subset = new_subset;

            // Change to current subset
            curr_eval   = window["global_eval_" + curr_subset];
        }

        // Apply the changes
        show_table(curr_table,curr_subset,"tab","None");

    }

    function switch_to_subset(id)
    {
        curr_subset = id;
    }

    function mean(values)
    {
        var sum = 0;
        for( var i = 0; i < values.length; i++ ){
            sum += parseFloat( values[i]);
        }

        var avg = sum/values.length;
        return avg.toFixed(3);
    }

    function show_table(meas, subset, html_id, sort_by)
    {

        // Select the techniques that have results on a give subset
        var which_tecs = [];
        for(var i = 0; i < techniques.length; i++)
            if (tech_props[techniques[i]].sets.indexOf(subset)>=0)
                which_tecs.push(techniques[i]);

        if (meas=="J" || meas=="F")
        {
            // Header
            var tab_html = "<tr><th onclick=\"click_method('None')\" class='seq_header' style='width: 170px;'><span style='cursor:n-resize;'>Sequence</span></th>"
            for(var i = 0; i < which_tecs.length; i++)
            {
                // Add vertical lines in the transition between types of techniques
                var st = '';
                if (i>0)
                    if (tech_props[which_tecs[i]].type!=tech_props[which_tecs[i-1]].type)
                        st = "style='border-left: 3px solid white;'";
                tab_html = tab_html + "<th onclick=\"click_method('"+which_tecs[i]+"')\" class='"+tech_props[which_tecs[i]].type+"' "+st+"><span style='cursor:n-resize;'>" + tech_props[which_tecs[i]].display_name + "</span></th>";
            }            
            tab_html = tab_html + "</tr>";

            // Which sequences to show
            curr_seqs = seq_lists[subset];

            // Get the maximum at each row
            var max_ids = {};
            for(var j = 0; j < curr_seqs.length; j++)
            {
                max_ids[curr_seqs[j]] = {};
                for(var k = 0; k < tech_types.length; k++)
                    max_ids[curr_seqs[j]][tech_types[k]] = {max_val: 0, max_id: 0};
            }

            for(var i = 0; i < curr_seqs.length; i++)
                for(var j = 0; j < which_tecs.length; j++)
                    if (mean(all_eval[which_tecs[j]][curr_seqs[i]][meas])>max_ids[curr_seqs[i]][tech_props[which_tecs[j]].type].max_val)
                    {
                        max_ids[curr_seqs[i]][tech_props[which_tecs[j]].type].max_val = mean(all_eval[which_tecs[j]][curr_seqs[i]][meas]);
                        max_ids[curr_seqs[i]][tech_props[which_tecs[j]].type].max_id  = j;
                    }

            // Define the order by default            
            var seq_order = []
            for (var i = 0; i < curr_seqs.length; ++i)
                seq_order.push(i);

            // If the user clicked to a method
            if (sort_by!='None')
            {
                // Get the values of a certain method
                var meth_values = []
                for(var i = 0; i < curr_seqs.length; i++)
                    meth_values.push(mean(all_eval[sort_by][curr_seqs[i]][meas]));

                // Sort sequences 
                sortWithIndeces(meth_values);
                seq_order = meth_values.sortIndices;
            }


            // Jaccard or Boundary measure
            for(var i = 0; i < curr_seqs.length; i++)
            {
                tab_html = tab_html + "<tr><td class='sequences' style='width: 170px;'>"+curr_seqs[seq_order[i]]+"</td>"
                for(var j = 0; j < which_tecs.length; j++)
                {
                    // Highlight the maximum
                    if (max_ids[curr_seqs[seq_order[i]]][tech_props[which_tecs[j]].type].max_id==j)
                        cl = 'highlight';
                    else
                        cl = 'elements';

                    // Add vertical lines in the transition between types of techniques
                    var st = '';
                    if (j>0)
                        if (tech_props[which_tecs[j]].type!=tech_props[which_tecs[j-1]].type)
                            st = "style='border-left: 3px solid white;'";

                    // Actually add the row
                    tab_html = tab_html + "<td class='"+cl+"' "+st+">" + mean(all_eval[which_tecs[j]][curr_seqs[seq_order[i]]][meas]) + "</td>";
                }
                tab_html = tab_html + "</tr>";
            }

            // Fill in the table
            document.getElementById(html_id).innerHTML = tab_html;
        }
        else
        {
            // Header
            var tab_html = "<tr><th class='seq_header' style='width: 170px;border-bottom: 1px solid gray;border-top: 1px solid gray;'>Measure</th>"
            for(var i = 0; i < which_tecs.length; i++)
            {
                // Add vertical lines in the transition betyween types of techniques
                var st = '';
                if (i>0)
                    if (tech_props[which_tecs[i]].type!=tech_props[which_tecs[i-1]].type)
                        st = "border-left: 3px solid white;";
                tab_html = tab_html + "<th class='"+tech_props[which_tecs[i]].type+"' style='border-bottom: 1px solid gray;border-top: 1px solid gray;"+st+"'>" + tech_props[which_tecs[i]].display_name + "</th>";
            }
            tab_html = tab_html + "</tr>";

            // Show one line per measure
            var meas = ["Jmean", "Jrecall", "Jdecay", "Fmean", "Frecall", "Fdecay", "T"];
            var meas_up = [1, 1, 0, 1, 1, 0, 0];
            var meas_show = ["J Mean &uarr;", "J Recall &uarr;", "J Decay &darr;", "F Mean &uarr;", "F Recall &uarr;", "F Decay &darr;", "T (GT "+curr_eval.Tgt+") &darr;"];
            for(var i = 0; i < meas.length; i++)
            {
                // Get the maximum at each row
                var max_ids = {};
                for(var j = 0; j < tech_types.length; j++)
                    max_ids[tech_types[j]] = {max_val: 1-meas_up[i], max_id: 0};
                for(var j = 0; j < which_tecs.length; j++)
                    if (    ((meas_up[i]==1) && (curr_eval[which_tecs[j]][meas[i]]>max_ids[tech_props[which_tecs[j]].type].max_val))
                         || ((meas_up[i]==0) && (curr_eval[which_tecs[j]][meas[i]]<max_ids[tech_props[which_tecs[j]].type].max_val)) )
                    {
                        max_ids[tech_props[which_tecs[j]].type].max_val = curr_eval[which_tecs[j]][meas[i]];
                        max_ids[tech_props[which_tecs[j]].type].max_id  = j;
                    }

                // Add horizontal lines in the different type of measures
                var st1 = ''
                if (i==2 || i==5 || i==6)
                    st1 = "border-bottom: 1px solid gray;";

                // Display it
                tab_html = tab_html + "<tr><td class='measures' style='width: 170px;"+st1+"'>"+meas_show[i]+"</td>"
                for(var j = 0; j < which_tecs.length; j++)
                {
                    // Highlight the maximum
                    if (max_ids[tech_props[which_tecs[j]].type].max_id==j)
                        cl = 'highlight';
                    else
                        cl = 'elements';

                    // Add vertical lines in the transition between types of techniques
                    var st2 = '';
                    if (j>0)
                        if (tech_props[which_tecs[j]].type!=tech_props[which_tecs[j-1]].type)
                            st2 = "border-left: 3px solid white;";

                    // Actually add the row
                    tab_html = tab_html + "<td class='"+cl+"' style='"+ st1 + st2 +"'>" + curr_eval[which_tecs[j]][meas[i]] + "</td>";
                }
                tab_html = tab_html + "</tr>";
            }

            // Fill in the table
            document.getElementById(html_id).innerHTML = tab_html;
        }
    }

    function click_method(meth_id)
    {
        show_table(curr_table, curr_subset, "tab", meth_id); 
    }

    function sortWithIndeces(toSort)
    {
        for (var i = 0; i < toSort.length; i++)
        {
            toSort[i] = [toSort[i], i];
        }
        toSort.sort(function(left, right) {
                return left[0] > right[0] ? -1 : 1;
            });
        toSort.sortIndices = [];
        for (var j = 0; j < toSort.length; j++)
        {
            toSort.sortIndices.push(toSort[j][1]);
            toSort[j] = toSort[j][0];
        }
        return toSort;
    }

    // Read all evaluation files on parallel
    var all_eval = {};
    var all_ajax = [];
    for(var ii = 0; ii < techniques.length; ii++)
    {
        all_ajax.push($.ajax({
              url: "json_data/raw_eval/"+techniques[ii]+"_davis.json",
              dataType: 'json',
              success: function(data) {
                all_eval[data.id] = data;
                }
            }));
    }


    // Wait until all done
    $.when.apply($, all_ajax).done(function() {
        // Fill the table and set the button color and the top text
        switch_to_table('global','all')
    });
    
    
    // Create the text of the legend
    var leg_text = "";
    for(var i = 0; i < techniques.length; i++)
    {
        tc = techniques[i];
        leg_text = leg_text + "<li><b>" + tech_props[techniques[i]].display_name + "</b>: <a href='" + techn_papers[tc].url + "' class='lk' target='_blank'>" + techn_papers[tc].title
        leg_text = leg_text + "</a>. " + "<i>" + techn_papers[tc].authors[0] + "</i>"
        for(var j = 1; j < techn_papers[tc].authors.length; j++)
            leg_text = leg_text + ", <i>" + techn_papers[tc].authors[j] + "</i>"
        if ('conference' in techn_papers[tc])
            leg_text = leg_text + ", " + techn_papers[tc].conference + " " + techn_papers[tc].year.toString()
        leg_text = leg_text + ".</li>"
    }
    

    // Fill legend
    document.getElementById("legend_text").innerHTML = leg_text;
</script>

<script src="js/ui.js"></script>


</body>

</html>


