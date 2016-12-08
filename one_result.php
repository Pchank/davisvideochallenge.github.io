<!doctype html>
<html lang="en">
<head>
    <!-- Global definitions -->
    <script src="json_data/global.js" type="text/javascript"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400,300' rel='stylesheet' type='text/css'> -->
    <link href='https://fonts.googleapis.com/css?family=Raleway:100,300' rel='stylesheet' type='text/css'>
    <meta name="description" content="DAVIS, Densely Annotated VIdeo Segmentation">

    <title>DAVIS: Densely Annotated VIdeo Segmentation</title>
    <link rel="stylesheet" href="https://yui-s.yahooapis.com/pure/0.6.0/pure-min.css">
    <!--[if lte IE 8]>
        <link rel="stylesheet" href="css/layouts/side-menu-old-ie.css">
    <![endif]-->
    <!--[if gt IE 8]><!-->
    <link rel="stylesheet" href="css/layouts/side-menu.css">
    <!--<![endif]-->
    
    <!--Includes-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <!-- Buttons -->
    <link rel="stylesheet" type="text/css" href="css/buttons/component.css" />

  <style type="text/css">

      .boxTitle {
        font-family: 'Raleway', sans-serif;
        font-weight: 300;
        font-size: 90%;
        margin-top: 2px;
        margin-bottom: 15px;
      }

        a.lk:link {text-decoration:none;}
        a.lk:hover {text-decoration:none;}
    </style>
</head>


<body>
<div id="layout">
    <!-- Menu toggle -->
    <a href="#menu" id="menuLink" class="menu-link">
        <span></span>
    </a>

   <div id="menu">
        <div class="pure-menu">

            <ul class="pure-menu-list">
                <li><a href="index.html" class="pure-menu-link">Home</a></li>
                <li><a href="soa_compare.php" class="pure-menu-link">Benchmark</a></li>
                <li><a class="pure-menu-link pure-menu-selected">Explore</a></li>
                <li><a href="code.html" class="pure-menu-link">Download</a></li>
            </ul>
        </div>
    </div>

    <div id="main">
        <div class="header">
            <h1>Explore the State of the Art</h1>
            <h2>Browse all partitions from the studied techniques</h2>
        </div>

        <div class="pure-g" style="margin-left: 5%;margin-right: 5%;margin-top: 20px;">
            <div class="pure-u-1-4"> 
                <div style="vertical-align: middle;font-family: 'Raleway', sans-serif;text-align:left;font-weight: 300;margin-top:3px;margin-bottom:3px;margin-right:10%;">
                    <span style="color:red">NEW!</span> Select the techniques that you'd like to display:
                </div>
            </div>
            <div class="pure-u-3-4" id="technique_selector">

            </div>
        </div>

        <div class="pure-g">
            <div class="pure-u-1-1" style="font-family: 'Raleway', sans-serif; margin-top: 30px;  font-weight: 300;">
              <center style="font-size: 120%;margin-bottom: 10px;">Sequence: <span id="seq_name"></span>.</center>
              <center style="margin-bottom: 20px;">Move to <a onclick="decrease()">previous</a> or <a onclick="increase()">next</a> frame (you can also use left and right arrows). <a href="browse.php">Back to sequence index</a>.</center>
            </div>
        </div>
        <div class="pure-g">
              <div class="pure-u-1-6">
              </div>
              <div class="pure-u-1-3">
                  <div style="padding:5px;text-align:center;">
                  <img id="im_container" style="width: 100%; outline: 2px solid black; outline-offset: -1px;"/>
                  <div class="boxTitle">Frame: <span id="im_text"></span></div>
                  </div>
              </div>
              <div class="pure-u-1-3" style="position: relative;">
                  <div style="padding:5px;text-align:center;">
                  <img id="im_gt" style="width: 100%; outline: 2px solid black; outline-offset: -1px;"/>
                  <div class="boxTitle">Ground Truth</div>
                  </div>
              </div>
              <div class="pure-u-1-6">
              </div>
        </div>

        <div style="margin: auto;max-width: 1200px;">
             <div style="font-family: 'Raleway', sans-serif;margin-left:15px;margin-right:10px; font-weight: 300;">
             <div style="text-align: center;margin-top:20px;">
             <center style="font-size: 120%;margin-bottom:10px;">Segmentations obtained by state-of-the-art techniques</center>
             <center>Semi-supervised techniques are depicted in <span style="color:red">red</span>, unsupervised in <span style="color:green;">green</span>, and preprocessing methods in <span style="color:blue;">blue</span>.</center>
             </div>  
             </div> 
        </div> 
        <div id="res_container" class="pure-g" style="margin-bottom: 40px;margin-top: 10px;">
        
        </div>

        <div style="margin: auto;max-width: 1200px;">
             <div style="font-family: 'Raleway', sans-serif;margin-left:15px;margin-right:10px;margin-bottom:70px;  font-weight: 300;">

                <h3 style="margin-top:30px;margin-bottom:1px;">Legend</h3>
                <ul id="legend_text">
                </ul>

                <i>Is your technique missing although it's published and the code is public? <a href='mailto:perazzif@inf.ethz.ch;jponttuset@vision.ee.ethz.ch'>Let us know</a>  and we'll add it.</i>                
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">


    // Frame number
    var frame_num = 1;

    // Get a sequence id from the PHP url if set
    var seq_id = '<?php 
      if (isset($_GET['seq_id']))
      {
        $seq_id=$_GET['seq_id'];
        echo $seq_id;
      }
      else
      {
        echo "bear";
      }
      ?>';


    // In which set is this sequence
    var which_set = '';
    if (seq_lists['train'].indexOf(seq_id)>-1)
        which_set = 'train';
    else
        which_set = 'val';

    // Select the techniques that have results on a given subset
    var which_tecs = [];
    for(var i = 0; i < techniques.length; i++)
        if (tech_props[techniques[i]].sets.indexOf(which_set)>=0)
            which_tecs.push(techniques[i]);

    // Create buttons to select techniques
    var res_html = "";
    for(var ii = 0; ii < which_tecs.length; ii++)
    {
        // Do we show the button? Only if we have the results in that sequence
        if (tech_props[which_tecs[ii]].sets.indexOf(which_set)>-1)
        {
            if (shown_techniques.indexOf(which_tecs[ii])>-1)
                button_style = "background: #e7eae8;";
            else
                button_style = "background: transparent;";

            res_html = res_html + '<div class="pure-u-1-6"><button id="button_'+which_tecs[ii]+'" onclick="change_technique(\''+which_tecs[ii]+'\')" class="btn btn-6 btn-6a" style="width: 95%;margin-top:3px; padding-left:0px; padding-right:0px;min-width:0px; text-align:center; font-family: \'Raleway\', sans-serif; font-weight: 300;font-size: 80%;'+button_style+'">'+tech_props[which_tecs[ii]].display_name+'</button></div>';
        }
    }
    document.getElementById("technique_selector").innerHTML = res_html;

    // Put images in the header
    allocate_header();
    
    // Allocate all results
    allocate_all();

    // Load all evaluations from file
    var all_eval = {};
    for(var ii = 0; ii < techniques.length; ii++) {
        all_eval[techniques[ii]] = $.getJSON( "json_data/raw_eval/"+techniques[ii]+"_davis.json");
    }

    // Set the footnotes when the JSON is loaded
    for(var ii = 0; ii < techniques.length; ii++)
    {
        all_eval[techniques[ii]].complete(function(data)
        {
            tmp = JSON.parse(data.responseText);
            all_eval[tmp.id] = tmp;
            if (shown_techniques.indexOf(tmp.id)>-1)
                set_footnote(tmp.id);
        });
    }

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

    // Set keydown functions
    $(document).keydown(function(e){
        if (e.which==37)
            decrease();
        else if (e.which==39)
            increase();
    });


    // ###########################################################################################
    //  Function implementations
    // ###########################################################################################

    function change_technique(tec) {

        // Is it currently seelcted?
        var idx = shown_techniques.indexOf(tec);
        if (idx>-1)  // Yes
        {
            // Switch button state to unselected
            document.getElementById("button_"+tec).style.background = "transparent";

            // Remove it from the list of selected
            shown_techniques.splice(idx, 1);

        }
        else  // Now
        {
            // Switch button state to selected
            document.getElementById("button_"+tec).style.background = "#e7eae8";

            // Add it to the list of selected
            shown_techniques.push(tec);
        }
        

        // Re-allocate all results
        allocate_all();

        // Change all images
        update_all();
    }

    function decrease() {
        if(frame_num>1)
            frame_num--;
        else
            frame_num=seq_nframes[seq_id.replace("-", "")]-2;  

        // Change all images
        update_all();
    }

    function increase() {
        if(frame_num<seq_nframes[seq_id.replace("-", "")]-2)
            frame_num++;
        else
            frame_num=1;

        // Change all images
        update_all();
    }

    function pad(num)
    {
        var s = "00000" + num;
        return s.substr(s.length-5);
    }


    function set_footnote(tec)
    {
        document.getElementById('title_'+tec).innerHTML = '<b>' + tech_props[tec].display_name + '</b> - J=' + all_eval[tec][seq_id].J[frame_num-1] + ' - F=' + all_eval[tec][seq_id].F[frame_num-1];

    }

    function allocate_header()
    {
        // Set the image
        document.getElementById('im_container').src=im_url+ seq_id +'/'+pad(frame_num)+'.jpg';

        // Set the ground truth        
        document.getElementById('im_gt').src=res_url+'gt/'+seq_id +'/'+pad(frame_num)+'.jpg';
        
        // Change frame number
        document.getElementById('im_text').innerHTML = pad(frame_num);

        // Change sequence name in the title
        document.getElementById('seq_name').innerHTML = seq_id;
    }

    function allocate_all()
    {
        var res_html = "";
        for(var ii = 0; ii < shown_techniques.length; ii++)
        {
            res_html = res_html + '<div class="pure-u-1-3" style="position: relative;"><div style="padding:5px;text-align:center;"><img class="img" id="im_'+shown_techniques[ii]+'" alt="" style="width: 100%; outline: 2px solid black; outline-offset: -1px;"/ src="'+res_url+tech_props[shown_techniques[ii]].im_url+'/'+seq_id +'/'+pad(frame_num)+'.jpg"><div class="boxTitle" id="title_' + shown_techniques[ii] + '"></div></div></div>';
        }
        document.getElementById("res_container").innerHTML = res_html;
    }


    function update_all()
    {

        // Set the image
        document.getElementById('im_container').src=im_url+ seq_id +'/'+pad(frame_num)+'.jpg';

        // Set the ground truth        
        document.getElementById('im_gt').src=res_url+'gt/'+seq_id +'/'+pad(frame_num)+'.jpg';
        
        // Change all images
        for(ii=0; ii<shown_techniques.length; ii++)
        {
           document.getElementById('im_'+shown_techniques[ii]).src = res_url+tech_props[shown_techniques[ii]].im_url+'/'+seq_id +'/'+pad(frame_num)+'.jpg';
           set_footnote(shown_techniques[ii]);
        } 

        // Change frame number
        document.getElementById('im_text').innerHTML = pad(frame_num);

        // Change sequence name in the title
        document.getElementById('seq_name').innerHTML = seq_id;
    }


</script>


<script src="js/ui.js"></script>


</body>

</html>

