<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">

      <!-- Global definitions -->
    <script src="json_data/global.js" type="text/javascript"></script>

    <!-- Buttons -->
    <link rel="stylesheet" type="text/css" href="css/buttons/component.css" />

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

      <style type="text/css">
    .wrap {
       overflow: hidden;
       margin: 10px;
    }
    .horizontalbox {
       float: left;
       position: relative;
       width: 20%;
       padding-bottom: 11.9%;
    }
    .boxInner {
       position: absolute;
       left: 10px;
       right: 10px;
       top: 10px;
       bottom: 10px;
       overflow: hidden;
    }
    .boxInner img {
       width: 100%;
    }
    .boxInner .titleBox {
       position: absolute;
       bottom: 0;
       left: 0;
       right: 0;
       margin-bottom: -50px;
       background: #000;
       background: rgba(0, 0, 0, 0.5);
       color: #FFF;
       padding: 10px;
       font-size: 90%;
       text-align: center;
       font-family: 'Raleway', sans-serif;
       -webkit-transition: all 0.3s ease-out;
       -moz-transition: all 0.3s ease-out;
       -o-transition: all 0.3s ease-out;
       transition: all 0.3s ease-out;
    }
    .no-touch .boxInner:hover .titleBox, .touch .boxInner.touchFocus .titleBox {
       margin-bottom: 0;
    }
    @media only screen and (max-width : 480px) {
       .horizontalbox {
          width: 50%;
          padding-bottom: 30.1%;
       }
    }
    @media only screen and (max-width : 1050px) and (min-width : 481px) {
       .horizontalbox {
          width: 33.3%;
          padding-bottom: 19.7%;
       }
    }
    @media only screen and (max-width : 1290px) and (min-width : 1051px) {
       .horizontalbox {
          width: 25%;
          padding-bottom: 14.9%;
       }

    }
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
                <li><a href="soa_compare.php" class="pure-menu-link">Benchmark</a></li>
                <li><a class="pure-menu-link pure-menu-selected">Explore</a></li>
                <li><a href="code.html" class="pure-menu-link">Download</a></li>
            </ul>
        </div>
    </div>

    <div id="main">
        <div class="header">
            <h1>Explore the State of the Art</h1>
            <h2>Qualitatively browse the results</h2>
        </div>

        <!-- SubButtons  -->
        <div class="pure-g" style="margin-left: 5%;margin-right: 5%;margin-top:20px;">
            <div class="pure-u-1-4"> 
                         <div style="font-family: 'Raleway', sans-serif;text-align:left;font-weight: 300;margin-top:12px;margin-bottom:3px;">
            <span style="color:red">NEW!</span> Select the dataset subset:
            </div>
            </div>
            <div class="pure-u-1-4" style="text-align:center;font-family: 'Raleway', sans-serif; font-weight: 300;">  
                <button id="subset_val" onclick="switch_to_subset('val')" class="btn btn-6 btn-6a" style="width: 95%;margin-top:3px;">Validation</button>
            </div>
            <div class="pure-u-1-4" style="text-align:center;font-family: 'Raleway', sans-serif; font-weight: 300;">
                <button id="subset_train" onclick="switch_to_subset('train')" class="btn btn-6 btn-6a" style="width: 95%;margin-top:3px;">Training</button>
            </div>
            <div class="pure-u-1-4" style="text-align:center;font-family: 'Raleway', sans-serif; font-weight: 300;">  
                <button  id="subset_all" onclick="switch_to_subset('all')" class="btn btn-6 btn-6a" style="width: 95%;margin-top:3px;">All</button>
            </div>
        </div>

        <div class="pure-g">
            <div class="pure-u-1-1" style="font-family: 'Raleway', sans-serif; margin-top: 20px;">
              <center>And select the sequence you would like to explore.</center>
            </div>
        </div>


        <div class="no-touch"> 
          <div id="horiz_container" class="wrap">
  
          </div>
        </div>

      <script type="text/javascript" src="https://code.jquery.com/jquery-1.8.3.js"></script>
      <script type="text/javascript">
          $(function(){
               // See if this is a touch device
               if ('ontouchstart' in window)
               {
                  // Set the correct body class
                  $('body').removeClass('no-touch').addClass('touch');
                 
                  // Add the touch toggle to show text
                  $('div.boxInner img').click(function(){
                     $(this).closest('.boxInner').toggleClass('touchFocus');
                  });
               }
          });


          var curr_subset = 'train';

          function switch_to_subset(new_subset)
          {
              document.getElementById("subset_"+curr_subset).style.background = "transparent";
              document.getElementById("subset_"+new_subset).style.background = "#e7eae8";

              curr_subset = new_subset;

              console.log("Switching to: "+curr_subset)
              console.log("Switching to: "+seq_lists[curr_subset])

              // Call the actual code to show the images
              show_images("horiz_container",seq_lists[curr_subset])
          }
          
          function show_images(div_id,seq_list)
          {
              var new_html = "";
              for (var i=0; i<seq_list.length; i++)
              {
                              console.log("Adding: "+seq_list[i])

                   new_html = new_html + '<div class="horizontalbox"><div class="boxInner"><a href="one_result.php?seq_id='+seq_list[i]+'"><img src="'+im_url+ seq_list[i] +'/00000.jpg"/></a><div class="titleBox">'+seq_list[i]+'</div></div></div>'
              }
              console.log(new_html);
              document.getElementById(div_id).innerHTML = new_html;
          }


          // Call the switch function that activates everything
          switch_to_subset('all')
      
      </script>
  </div>
</div>





<script src="js/ui.js"></script>
    

</body>

</html>

