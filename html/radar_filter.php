<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript">
</script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="../main.css">

<!--  <link rel="stylesheet" href="/resources/demos/style.css">-->
<script>
$(document).ready(function() {
$(".dropdown dt a").on('click', function() {
  $(".dropdown dd ul").slideToggle('fast');
});

$(".dropdown dd ul li a").on('click', function() {
  $(".dropdown dd ul").hide();
});

function getSelectedValue(id) {
  return $("#" + id).find("dt a span.value").html();
}

$(document).bind('click', function(e) {
  var $clicked = $(e.target);
  if (!$clicked.parents().hasClass("dropdown")) $(".dropdown dd ul").hide();
});

$('.mutliSelect input[type="checkbox"]').on('click', function() {

  var title = $(this).closest('.mutliSelect').find('input[type="checkbox"]').val(),
    title = $(this).val() + ",";

  if ($(this).is(':checked')) {
    var html = '<span title="' + title + '">' + title + '</span>';
    $('.multiSel').append(html);
    $(".hida").hide();
  } else {
    $('span[title="' + title + '"]').remove();
    var ret = $(".hida");
    $('.dropdown dt a').append(ret);

  }
});
});

  $( function() {
    var handle = $( "#custom-handle" );
    $( "#slider" ).slider({
      min: 0,
      max: 100,
      create: function() {
        handle.text( $( this ).slider( "value" ) );
      },
      slide: function( event, ui ) {
        handle.text( ui.value + "km");
      }
    });
  } );
$( function() {
    var handle = $( "#custom-handle2" );
    $( "#slider2" ).slider({
      min: 0,
      max: 24,
      create: function() {
        handle.text( $( this ).slider( "value" ) );
      },
      slide: function( event, ui ) {
        handle.text( ui.value + "hr/s");
      }
    });
  } );
  
</script>
<style>
    *{
        font-family: arial;
    }
  .dropdown {
/*
    position: absolute;
    top:50%;

    transform: translateY(-50%);
      */
  }

  a {
    color: #fff;
  }

  .dropdown dd,
  .dropdown dt {
    margin: 0px;
    padding: 0px;
  }

  .dropdown ul {
    margin: -1px 0 0 0;
  }

  .dropdown dd {
    position: relative;
  }

  .dropdown a,
  .dropdown a:visited {
    color: #fff;
    text-decoration: none;
    outline: none;
    font-size: 12px;
  }

  .dropdown dt a {
    background-color: #4F6877;
    display: block;
/*    padding: 8px 20px 5px 10px;*/
    min-height: 25px;
    line-height: 24px;
    overflow: hidden;
    border: 0;
    width: 100%;
  }

  .dropdown dt a span,
  .multiSel span {
    cursor: pointer;
    display: inline-block;
    padding: 0 3px 2px 0;
  }

  .dropdown dd ul {
    background-color: #4F6877;
    border: 0;
    color: #fff;
    display: none;
    left: 0px;
    padding: 2px 15px 2px 5px;
    position: absolute;
    top: 2px;
    width: 100%;
    list-style: none;
    height: 100px;
    overflow: auto;
  }

  .dropdown span.value {
    display: none;
  }

  .dropdown dd ul li a {
    padding: 5px;
    display: block;
  }

  .dropdown dd ul li a:hover {
    background-color: #fff;
  }

  #filter {
    background-color:#0090ca;
    width: 100%;
    border: 0;
    padding: 10px 0;
    margin: 5px 0;
    text-align: center;
    color: #fff;
    font-weight: bold;
  }
 .input_diff {
    background-color: #4F6877;
     border: none;
     min-height: 25px;
    line-height: 24px;
     color: white !important;
     width: 100%;
    }
      #custom-handle {
    width: 3em;
    height: 1.6em;
    top: 50%;
    margin-top: -.8em;
    text-align: center;
    line-height: 1.6em;
  }
#custom-handle2 {
    width: 3em;
    height: 1.6em;
    top: 50%;
    margin-top: -.8em;
    text-align: center;
    line-height: 1.6em;
  }
    #slider_container{
      width: 87%; 
        margin-left: 2%;
        text-align: center;
    }
    .hida{
        width: 100%;
    }

</style>
<body>
    <div class="container">
		<img class="logo-image" src="../img/serendipity_logo-PNG.png" alt="serendipity">
		<div class="wrapper">
<form style="width:100%;">
 
<input class="input_diff" type="text" placeholder="LAT" value=""><br/><br/>
<input class="input_diff" type="text" placeholder="LONG" value=""><br/><br/>  
    
  <div id="slider_container">
<div id="slider">
  <div id="custom-handle" class="ui-slider-handle"></div>
</div><br/>
    <div id="slider2">
  <div id="custom-handle2" class="ui-slider-handle"></div>
</div>
    
</div> 
<dl class="dropdown"> 
  
    <dt>
    <a href="#">
      <span class="hida">SELECT CATEGORY</span>    
      <p class="multiSel"></p>  
    </a>
    </dt>
  
    <dd>
        <div class="mutliSelect">
            <ul>
                <li>
                    <input type="checkbox" value="Food" />Food</li>
                <li>
                    <input type="checkbox" value="Transport" />Transport</li>
                <li>
                    <input type="checkbox" value="Accomodation" />Accomodation</li>
                <li>
                    <input type="checkbox" value="Sports" />Sports</li>
                <li>
                    <input type="checkbox" value="Music" />Music</li>
            </ul>
        </div>
    </dd>
  <button id="filter">Filter</button>
</dl>
    

</form>

</div>
	</div>
</body>