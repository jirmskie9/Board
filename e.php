
<!DOCTYPE html>
<html lang="en">
  <!--<![endif]-->
  <!-- start: HEAD -->
    <head>
        
        <title>PHP Script Live Demo | Expense Management | Web Project Builder</title>
        <!-- start: META -->
        
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta content="Web Project builder offer Live demo of Expense Management a php scripts" name="description" />
        <meta content="php crud builder, php code generator, codeigniter generator, management system generator, custom project builder" name="author" />
        <!-- end: META -->
        <!-- start: GOOGLE FONTS -->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
        <link href="https://www.webprojectbuilder.com/assets/plugins/themify-icons/themify-icons.min.css">
        <!-- end: GOOGLE FONTS -->
        <!-- start: MAIN CSS -->
        <link rel="stylesheet" href="https://www.webprojectbuilder.com/assets/plugins/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
        <!-- end: MAIN CSS -->
        <!-- start: CLIP-TWO CSS -->
        <link rel="stylesheet" href="https://www.webprojectbuilder.com/assets/css/styles.css">
        <link rel="stylesheet" href="https://www.webprojectbuilder.com/assets/css/style.css">
        <link rel="stylesheet" href="https://www.webprojectbuilder.com/assets/css/bootstrap-iconpicker.css">
        <link href="https://www.webprojectbuilder.com/assets/css/themify-icons/themify-icons.css" rel="stylesheet" media="screen">

        <!-- end: CLIP-TWO CSS -->
        <!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
        <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
        <link rel="stylesheet" href="https://www.webprojectbuilder.com/assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css">

        <link rel="shortcut icon" href="https://www.webprojectbuilder.com/assets/img/login/favicon.ico" />
        <link rel="stylesheet" href="https://www.webprojectbuilder.com/assets/css/jquery-confirm.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
        <link rel="stylesheet" href="https://www.webprojectbuilder.com/assets/plugins/select2/select2.css">
        <link rel="stylesheet" href="https://www.webprojectbuilder.com/assets/css/preview.css">

        <link rel="stylesheet" href="https://www.webprojectbuilder.com/assets/css/newdesign/bootstrap.css">
        <link rel="stylesheet" href="https://www.webprojectbuilder.com/assets/css/newdesign/stylesheet.css">
        <link rel="stylesheet" href="https://www.webprojectbuilder.com/assets/css/newdesign/responsive.css">
        <link rel="stylesheet" href="https://www.webprojectbuilder.com/assets/css/newdesign/owl.carousel.min.css">
        <link rel="stylesheet" href="https://www.webprojectbuilder.com/assets/css/newdesign/owl.theme.default.min.css">
        <!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
        <link rel="stylesheet" href="https://www.webprojectbuilder.com/assets/plugins/crumble/css/grumble.min.css">
        <link rel="stylesheet" href="https://www.webprojectbuilder.com/assets/plugins/crumble/css/crumble.css">

        <script src="https://www.webprojectbuilder.com//assets/js/jquery.min.js"></script>
        <script src="https://www.webprojectbuilder.com//assets/js/jquery-ui.js"></script>
        <script type="text/javascript">
            jQuery.browser = {};
            (function () {
                jQuery.browser.msie = false;
                jQuery.browser.version = 0;
                if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
                    jQuery.browser.msie = true;
                    jQuery.browser.version = RegExp.$1;
                }
            })();
        </script>

<script src="https://js.pusher.com/7.0.3/pusher.min.js"></script>

<script>
 // Enable pusher logging - don't include this in production
 Pusher.logToConsole = true;

 var pusher = new Pusher('af09d02d0962f5401cf1', {
   cluster: 'mt1'
 });

 var channel = pusher.subscribe('my-channel');
 channel.bind('my-event', function(data) {
   window.location = "https://www.webprojectbuilder.com/user/logout_user";
   //alert(JSON.stringify(data));
 });
</script>

        <div id="overlay"></div>
        <!-- only few minut-->
    </head>
<!-- end: HEAD -->
    <body data-base-url="https://www.webprojectbuilder.com/" class="editcrud ami">
        <div id="app" class="mydemopage">
            <!-- / sidebar -->
            <div class="app-content">
                <!-- start: TOP NAVBAR --><nav class="navbar navbar-default navbar-fixed-top demoview mka-preview-header" id="navigation">
  <div class="container"> 
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#defaultNavbar1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
      <a href="https://www.webprojectbuilder.com/" class="navbar-brand cust-logo"> 
        <img class="logionlogo" src="https://www.webprojectbuilder.com/assets/img/login/wpb-logo.png">
      </a>
    </div>
    <div class="collapse navbar-collapse" id="defaultNavbar1">

       <ul class="nav navbar-nav navbar-right myfl_left">
  <li class="active"> <a href="javascript:;" class="btn btn-success btn-sm" onclick="parent.history.back();"> <i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a> </li>
  <li class="active"><a  href="https://www.webprojectbuilder.com/customize/" data-title="Sign In" class="btn btn-success btn-sm"><i class="fa fa-cog"></i>Customize</a></li>
  <!-- <li> <span class="show_help" title="Show help"><img src="" width="40" alt=""></span> </li> -->
</ul>

  
              
     
              


    </div>
                        <!-- end: NAVBAR HEADER -->
                        <!-- start: NAVBAR COLLAPSE -->
    <div class="navbar-collapse">


            <!-- Modal -->
            

            <ul class="nav navbar-right">
                            
                              
                            
              <!-- <a href="" class="btn btn-success btn-sm ">View Details <i class="fa fa-wpforms"></i></a> -->
              <!-- <a href="https://www.webprojectbuilder.com/account/createFromPreBuild/1" data-title="Sign In" class="btn btn-success margin-top-15"><i class="fa fa-cog"></i> Customize</a> -->
                          </ul>
          </div>
          </div><!--container-->
          <!-- end: NAVBAR COLLAPSE -->
                  </nav>

        <!-- end: TOP NAVBAR -->
      </div>

<style>
 #overlay {
   background-image: url(https://www.webprojectbuilder.com//assets/images/loadingmain.gif);
   position: fixed;
   z-index: 999999999;
   left: 0;
   bottom: 0;
   right: 0;
   background-repeat: no-repeat;
   background-position: center;
   top: 0;
   background-color: rgba(255, 255, 255, 0.72);
   background-size: 60px;
 }
</style>

<style>


</style>
  <div class="main-content my-content">
  <div class="overlay" id="sidebar_overlay"></div>
    <iframe id="myiframe" class="full-screen-preview__frame" src="https://www.webprojectbuilder.com/cruds/1/1/expense_management" style="height: 100%" frameborder="0"></iframe>
  </div>
</div>

<script>
  $(document).ready(function(){

    

    mka_menuSelected('projects');
    $('body').addClass('full-screen-preview');
    $('header').find('div.navbar').addClass('preview__header');
    calcHeight();

    $('.right-m').on('click', function() {
      $('.settings').toggleClass('active');
      $(this).toggleClass('active');
      $('#sidebar_overlay').toggle();
    });
    $('.right-m').click(function(event){
      event.stopPropagation();
    });
    $('.settings').click(function(event){
      event.stopPropagation();
    });
    $('body').click(function(event){
      $('.settings').removeClass('active');
      $('#sidebar_overlay').hide();
    });

$('.right-m').click(function(event){
      event.stopPropagation();
    });
    $('.priject-row').on('click', function() {
      var id = $(this).attr('data-project-id');
      var rel = "https://www.webprojectbuilder.com/account/demoProject?project_id=";
      window.location.href = rel + '' + id;
    }); 
$('li.right-m.active').click(function(event){
      $('.settings').removeClass('active');
      $(this).removeClass('active');
      $('#sidebar_overlay').hide();
    });

  })
  var chk = 1;
  $("#myiframe").load(function(){
    
    $c = $('#myiframe').contents();
    $c.find('body.login-page').find('input[name="email"]').val('admin@admin.com');
    $c.find('body.login-page').find('input[name="password"]').val('123456');
    if(chk == 1) {
        $c.find('body.login-page').find('button[type="submit"]').trigger('click');
    }
    setTimeout(function() {
      chk = 0;
    }, 5000);

    $c.find('input[type="file"]').attr('disabled', true);
    if($c.find('input[type="file"]').parents('div.fileUpload').length > 0){
      $c.find('input[type="file"]').parents('div.fileUpload').after('<br><span class="help-text text-red">Upload is disabled in demo mode</span>');  
    } else {
      $c.find('input[type="file"]').after('<span class="help-text text-red">Upload is disabled in demo mode</span>');
    }
    if($c.find('input[type="password"]').parents('body.login-page').length > 0){
      
    } else {
      $c.find('input[type="password"]').attr('disabled', true);
      $c.find('input[type="password"]').after('<span class="help-text text-red">password is disabled in demo mode</span>');
    }
    $c.find('div.content-wrapper').on('click', '.modalButton, .modalButtonUser', function(){
      setTimeout(function(){
        $c.find('input[type="file"]').attr('disabled', true);
        if($c.find('input[type="file"]').parents('div.fileUpload').length > 0){
          $c.find('input[type="file"]').parents('div.fileUpload').after('<span class="help-text text-red">Upload is disabled in demo mode</span>');  
        } else {
          $c.find('input[type="file"]').after('<span class="help-text text-red">Upload is disabled in demo mode</span>');
        }
      },900);
    });
    setTimeout(function() {
      $('#overlay').fadeOut();
    }, 1000);
   // $c.find('body').css('height', '105%');
    //$c.find('body').css('overflow-x', 'scroll');
    //$c.find('div.content-wrapper').css('min-height', $c.find('.main-sidebar').height() - 56);

      $c.find('div.tabbable').find('ul#myTab4').find('li').on('click', function() {
        $('div.main-content').css( "top", "0px");
        setTimeout(function() {
          $('div.main-content').css( "top", "67px");
        }, 300);
      });
  })

      //function to fix height of iframe!
  var calcHeight = function() {
    var headerDimensions = $('header').find('div.navbar').height();
    $('.full-screen-preview__frame').height(($(window).height() - headerDimensions) - 5);
  }


  $(window).resize(function() {
    calcHeight();
  }).load(function() {
    calcHeight();
  });
    
</script>
<!-- Modal -->
          

<script>
  /*$(document).ready(function(){
   
    $('body').on('click', '.my-btn-linked', function() {
      window.open($(this).attr('rel'), '', 'width=500,height=450');
    });

  })*/

  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-89268766-1', 'auto');
  ga('send', 'pageview');

  setTimeout(function(){ga('send', 'event', 'Control', 'Bounce Rate')},30000);

    window.smartlook||(function(d) {
    var o=smartlook=function(){ o.api.push(arguments)},h=d.getElementsByTagName('head')[0];
    var c=d.createElement('script');o.api=new Array();c.async=true;c.type='text/javascript';
    c.charset='utf-8';c.src='//rec.smartlook.com/recorder.js';h.appendChild(c);
    })(document);
    smartlook('init', 'd715eb6c619b0688476f56d87f51f4be05726d31');
  </script>








<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="confirmation_modal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Confirmation </h4>
            </div>
            <div class="modal-body">
                <br>
                <p><strong>Available download credit : </strong> <span class="badge">0</span> </p>
                <p><strong>Required download credit : </strong> <span class="badge">1</span> </p>
            </div>
            <div class="modal-footer">
                <a type="button" href="javascript:;" data-project-id="1" class="btn btn-primary download-confirmed"> <i class="fa fa-download"></i> Download</a>
                                    <br>
                    <br>
                    You can download this <a href="https://www.webprojectbuilder.com/sample_CI_php_script.zip" title="sample code"> Sample Code</a>
                            </div>
        </div>
    </div>
</div>



<div id="editprotitle" class="modal animated fadeIn mymodal" role="dialog">
  <div class="modal__container">
    <div class="modal__content">

       <div class="modal-lg">

          <div class="modal-body main_body singlefield">
             <div class="">
          <button type="button" class="close all" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h3 class="mainTitle">Project Name</h3>
        </div>
               <p><input type="text" class="form-control editprotitle preventSpclChar" name="editcrudtitle /">
               <input data-project-id="" type="button" class="editproname newdbtn" value="Update"></p>
            </div>
        </div>
        </div>
        </div>
        </div>


<div id="myModal" class="modal animated fadeIn mymodal" role="dialog">
  <div class="modal__container">
    <div class="modal__content">

      <div class="modal-lg">
        <div class="modal-body main_body">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <div class="text-center logopltext">
            <h3>Modules</h3>
          </div>
          <!-- <div class="seprator"></div> -->
          <div class="col-sm-12 text-left center_divE">
            <h4>Custom Module</h4>
          </div>
          <div class="col-lg-12 center_divE left_minus">
            <div class="row">
              <div class="col-md-12">
                <div class="col-sm-4 each_featuret m-t-20">
                  <div class="each_feature text-center">
                    <div class="TableFormModal cursor_link">
                      <div class="cursor-pointer"><img src="https://www.webprojectbuilder.com/assets/images/Web-project-builder-Home-page_23.png" class="img-responsive">
                        <h4>TABLE & FORM BUILDER</h4>
                      </div>
                    </div>
                    <span class="tooltip">?</span>
                  </div>
                  <p>Provides user-friendly interface to create Custom Form and Data Table which includes the functionality of Add, Edit, Delete.</p>
                </div>

                <div class="col-sm-4 each_featuret m-t-20">
                  <div class="each_feature text-center">
                    <div class="DeshboardModal cursor_link">
                      <div class="cursor-pointer">
                        <img src="https://www.webprojectbuilder.com/assets/images/Web-project-builder-Home-page_26.png" class="img-responsive">
                        <h4>DASHBOARD BUILDER</h4>
                      </div>
                    </div>
                    <span class="tooltip">?</span>
                  </div>
                  <p>Provides interface to choose from various dashboard components such as graphs, Info box to represent data effectively on your custom dashboard.</p>
                </div>
              </div>

                  <!-- <div class="col-sm-4 each_featuret">
                       <div class="each_feature">
                          <div class="show_authentication cursor_link"><div class="cursor-pointer"><img src="assets/images/Web-project-builder-Home-page_20.png" class="img-responsive">
                          <h4>USER MANAGEMENT</h4>

                      </div>

                    </div><span class="tooltip">?</span></div>
                    <p>User Management provides the functionality of User Login, Register, Forgot Password, Roles &amp; Permission, Manage Users, SMTP Emails, General Settings.</p>
                  </div> -->





            </div>
          </div>
          <div class="seprator"></div>
          <div class="col-sm-12 text-left margin-top-20 center_divE">
            <h4>Ready Module</h4>
          </div>
          <div class="col-lg-12 center_divE left_minus">
            <div class="row">
              <div class="col-md-12">
                <div class="col-sm-4 each_featuret m-t-20">
                  <div class="each_feature btn">
                    <div class="ReadyModulesButton cursor-link" rel="invoice"><div class="cursor-pointer">
                        <a class="mybutton btn-md btn btn-primary waves-effect amDisable"><i class="fa fa-picture-o" aria-hidden="true"></i></a>
                        <h4>INVOICE</h4>
                    </div>
                    </div>

                  </div>
                </div>
                <div class="col-sm-4 each_featuret m-t-20">
                  <div class="each_feature btn">
                    <div class="ReadyModulesButton cursor-link" rel="events"><div class="cursor-pointer">
                        <a class="mybutton btn-md btn btn-primary waves-effect amDisable"><i class="fa fa-calendar" aria-hidden="true"></i></a>
                        <h4>Events</h4>
                    </div>
                    </div>

                  </div>
                </div>
              </div>

              </div>
          </div>

                    </div>
            </div>
            </div>
            </div>
        </div>



        <div id="ModuleBuilderModal" class="modal animated fadeIn mymodal" role="dialog">
            <div class="modal-lg">
            <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="glyphicon glyphicon-chevron-left myprev prev_modal_header"></span>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Modal Header</h4>
                    </div>
                    <div class="modal-body">
                        <a class="btn-md btn btn-primary waves-effect amDisable TableFormModal">Table & Form Builder</a>
                        <a class="btn-md btn btn-primary waves-effect amDisable DeshboardModal">Dashboard</a>
                    </div>
                    <div class="modal-footer"></div>
                </div>
            </div>
        </div>


        <div id="TableFormModal" class="modal animated fadeIn mymodal rightmenu_viewM fix_p_head" role="dialog">
          <div class="modal__container">
            <div class="modal__content">
            <div class="mka-overlay blind"></div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <div class="modal-lg">
            <div class="modal-body main_body">
              <div class="col-sm-12 viewre"></div>
            </div>
            <span class="mka-preview-btn" id="preview-btn">Preview</span>
            <div class="crud_view_parent mka-main-prev-div newd col-md-6">
                  <section id="page-title" class="fix_p_head_section">
                      <div class="container">
                          <div class="row">
                            <div class="col-sm-7">
                              <br>
                              <h3 class="mainTitle"> Form Preview </h3><br><br>
                            </div>
                          </div>
                      </div>
                  </section>
                 <!--  <div class="fix_pop_head"></div> -->
                  <div class="btn-group pradio" data-toggle="buttons">
                      <!-- <div class="btn-groupp clearfix">
                        <ul><li class="active"><label  href="#1a" data-toggle="tab" class="btn btn-primary btn-sm">Form
                        </label></li><li>
                        <label href="#2a" data-toggle="tab"class="btn btn-primary btn-sm">Table
                        </label></li></ul>
                      </div> -->
                       <fieldset>
                          <legend>Form Preview</legend>
                          <div class="vieditcrut"></div>
                       </fieldset>
                      <!-- <div class="tab-pane active" id="1a">
                      </div> -->
                      <!-- <div class="tab-pane" id="2a">
                        <fieldset>
                            <legend>Table</legend>
                            <div class=""></div>
                         </fieldset>
                      </div> -->
                  </div>
                </div>
            </div>
            </div>
          </div>
        </div>



        <div id="DeshboardModal_addcomp" class="modal animated fadeIn mymodal" role="dialog">
            <div class="modal__container">
            <div class="modal__content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div class="modal-lg">
                    <div class="modal-body main_body">
                          <div class="col-sm-11 pull-right">
                            <h3 class="mainTitle">Dashboard (Builder) Component Type</h3>
                          </div>
                        <div class="col-lg-12 selectop dashboard_view_addcomp"></div>
                    </div>
                </div>
            </div>
            </div>
        </div>


 <!--        <div id="EditDeshBord" class="modal fadeInRight mymodal" role="dialog">
     <div class="modal-lg">
         Modal content
         <div class="modal-content">
             <div class="modal-header">
                 <span class="glyphicon glyphicon-chevron-left myprev prev_deshbord"></span>
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title">Update Dashboard Component</h4>
             </div>
             <div class="modal-body">
                 <div id="" role="tabpanel" class="tab-pane animated fadeIn mymodal">
                     <div class="editdeshbordview"></div>
                 </div>
             </div>
             <div class="modal-footer"></div>
         </div>
     </div>
 </div>
  -->
        <div id="ModuleBuilder" class="dd modal fade" role="dialog">
            <div class="modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Module Builder</h4>
                    </div>
                    <div class="modal-body">
                        <ul class="nav nav-tabs tab-nav-right" role="tablist">
                            <li role="presentation" class="active"><a data-toggle="tab" href="#home_sub">Table & Form Builder</a></li>
                            <li role="presentation"><a class="dashboard_viewbtn" data-toggle="tab" href="#menu1_sub">Dashboard</a></li>
                        </ul>
                    </div>
                    <div class="modal-footer"></div>
                </div>
            </div>
        </div>

<div id="ReadyModules" class="modal animated fadeIn mymodal" role="dialog">
  <div class="modal__container">
    <div class="modal__content">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <div class="text-center logopltext">
              <h2>Ready Modules</h2>
          </div>
            <div class="modal-body main_body">
                <div id="menu1" role="tabpanel" class="tab-pane animated fadeIn mymodal">
                    <div class="invice_view"></div>
                </div>
            </div>
        </div>
    </div>
  </div>

<!--         <div id="show_authentication_modal" class="modal animated fadeIn mymodal" role="dialog">
    <div class="modal-lg">
        Modal content
        <div class="modal-content">
            <div class="modal-header">
                <span class="glyphicon glyphicon-chevron-left myprev prev_authmodal"></span>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Authentication Module</h4>
            </div>
            <div class="modal-body">
                <div class="show_authentication_view"></div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div> -->

<!--   <div id="downloadpage" class="modal animated fadeIn mymodal" role="dialog">
    <div class="modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="glyphicon glyphicon-chevron-left myprev prev_dwnldmodal"></span>
                <button type="button" class="close prev_dwnldmodal" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">MY DOWNLOADS</h4>
            </div>
            <div class="modal-body">
                <div id="menu1" role="tabpanel" class="tab-pane animated fadeIn mymodal">
                    <div class="show_downloadpage_view"></div>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div> -->


<div id="rightmenu_view" class="modal animated fadeIn mymodal" role="dialog">
  <div class="modal__container">
    <div class="modal__content">
    <button type="button" class="close all" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
       <div class="modal-lg">
          <div class="modal-body main_body">
                <div class="rightmenu_view"></div>
          </div>
       </div>
    </div>
  </div>
</div>

  <div class="modal fade footer_loginmodal mymodal" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal__container mka-con-modal">
      <div class="modal__content">
        <div class="modal-lg">
          <div class="modal-body main_body">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <div class="text-center logopltext">
              <h3>Account Activation Required</h3>
            </div>
            <div class="mka-body">
              <span>
                <p class="m-t-20 text-center">A verification link has been sent to <code></code>. please check and verify your account.</p>
              </span>
            </div>
              <div class="acc-btn-grp">
                <a type="button" href="https://www.webprojectbuilder.com/user/send_varificartion_mail" class="btn mka-btn-wide  resend-mail-btn">Resend Email</a>
                <button type="button" class="btn mka-btn-wide  change-email-btn">Change Email</button>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>


        <script>
var selectedSFilter = function(sel) {
  $('#checkbox3').attr('checked', 'checked');
  addOptionInFilterSelect(sel);
  $('.sel-field-div').fadeIn('slow');
}

var addOptionInFilterSelect = function(sel) {
  $('select[name="data_type[]"]').each(function() {
    $nob = $(this);
    if($nob.val() == 'date') {
      $t = $nob.parents('.row-div').find('input[name="title[]"]').val();
      if($t != '') {
        $selected = '';
        if(sel != '' && sel == $t) {
          $selected = 'selected';
        }
        $('#sel_filed').append('<option '+$selected+' value="'+$t+'">'+$t+'</option>');
      }
    }
  })
}

var update_rows  = function(){
  $('li.ui-state-default').each(function(k,v){
    $obj = $(this);
    $num = $obj.find('select[name="data_type[]"]').attr('id').match(/\d+/);
    $obj.find("[id*='_"+ $num +"']").each(function() {
      $str = $(this).attr('id').match(/[a-zA-Z_]*/);
      $(this).attr('id', $str + k);
    });
    $obj.find("[name*='_"+ $num +"']").each(function() {
      $str1 = $(this).attr('name').match(/[a-zA-Z_]*/);
      $(this).attr('name', $str1 + k);
    });
    $obj.find("[name*='["+ $num +"]']").each(function() {
      $str1 = $(this).attr('name').match(/[a-zA-Z_]*/);
      $(this).attr('name', $str1 + '[' + k + ']');
    });
  });
  $('input[type="radio"]').each(function(k,v) {
    if($(this).parents('label').hasClass('active')) {
      v.click();
    }
  });
}


  $(document).ready(function(){

    $('.logg-other-user').on('click', function() {
      chng_user($(this).attr('data-email'), $(this).attr('data-pass'));
      $('.log-in-btn-main').find('button').first().text('Logged in as ' + $(this).text());
    });


    $('body').on('click', '#preview-btn', function() {
      changeClassHtml();
      $(this).toggleClass('mka-pk');
      $('.mka-main-prev-div').toggleClass('blind-t');
      $('.mka-overlay').toggleClass('blind');
      /*$('.modal__content').scroll();
      $(".modal__content").animate({
        scrollTop: 0
      }, 200);*/
    });

    $('.mka-overlay').on('click', function() {
      $('.mka-overlay').addClass('blind');
      $('.mka-main-prev-div').removeClass('blind-t');
      $('#preview-btn').removeClass('mka-pk');
    });

    $('body').on('change', '.ch-com-type', function() {
        $src = 'https://www.webprojectbuilder.com/' + 'assets/images/' + $(this).val() + '.png';
        $('.com-sample').find('img').attr('src', $src);
        $('body').find('.com-sample').removeClass('info_box');
        $('body').find('.com-sample').removeClass('list_box');
        $('body').find('.com-sample').removeClass('bar_chart');
        $('body').find('.com-sample').addClass($(this).val());
        if($(this).val() == 'info_box') {
            $('#addnewdeshbord').find('input[name="title"]').parents('div.form-group').show();
            $('#addnewdeshbord').find('input[name="com_color"]').parents('div.form-group').show();
            $('#addnewdeshbord').find('#iconButton').parents('div.form-group').show();
            $('#addnewdeshbord').find('select[name="com_crud"]').parents('div.form-group').show();
            $('#addnewdeshbord').find('select[name="action"]').parents('div.form-group').show();
        } else if( $(this).val() == 'list_box' ) {
            $('#addnewdeshbord').find('input[name="title"]').parents('div.form-group').show();
            $('#addnewdeshbord').find('input[name="com_color"]').parents('div.form-group').hide();
            $('#addnewdeshbord').find('#iconButton').parents('div.form-group').hide();
            $('#addnewdeshbord').find('select[name="com_crud"]').parents('div.form-group').show();
            $('#addnewdeshbord').find('select[name="action"]').parents('div.form-group').show();
        } else if( $(this).val() == 'bar_chart' ) {
            $('#addnewdeshbord').find('input[name="title"]').parents('div.form-group').show();
            $('#addnewdeshbord').find('input[name="com_color"]').parents('div.form-group').hide();
            $('#addnewdeshbord').find('#iconButton').parents('div.form-group').hide();
            $('#addnewdeshbord').find('select[name="com_crud"]').parents('div.form-group').show();
            $('#addnewdeshbord').find('select[name="action"]').parents('div.form-group').show();
        }
    });

    disableSeletedColumn('');

  $('.show-tab').on('click', function() {
    var count_id_len = $('p[id="msg"]').text();
    console.log(count_id_len);
    if(count_id_len != ''){
      return false;
    } else {
    $('#myTab1').find('li').removeClass('active');
    $('#' + $(this).attr('rel')).addClass('active');
    $('.tab-content').find('.tab-pane').removeClass('active in');
    $($('#' + $(this).attr('rel')).find('a').attr('href')).addClass('active in');
  }
  })

  /*$('#checkformsubmit').on("click", function (e) {

    });*/
/*
  $('body').on('change', 'select[name="data_type[]"]', function() {
    $obj = $(this);
    $va = $obj.parents('div.row-div').find('input[name="title[]"]').val();
    if($obj.val() == 'date') {
      if($va != ''){
        $('#sel_filed').append('<option value="'+$va+'">'+$va+'</option>');
      } else {
        $('#sel_filed').append('<option value=""></option>');
        $intv = setInterval(function() {
          $nval = $obj.parents('div.row-div').find('input[name="title[]"]').val();
          if($nval != ''){
            $('#sel_filed').find('option:last').text($nval).attr('value', $nval);
            clearInterval($intv);
          }
        }, 9000);
      }
    } else {
      $('#sel_filed').find('option').each(function() {
        if($(this).text() == $va){
          $(this).remove();
        }
      })
    }

  });*/

 /* $('body').on('change', '#checkbox3', function() {
    $obj = $(this);
    $('#sel_filed').html('<option value="">Select a field</option>');
    $('span.not-text').remove();
    if($obj.is(':checked')){
      addOptionInFilterSelect('');
      if($('#sel_filed').find('option').length <= 1) {
        $('#checkbox3').removeAttr('checked');
        $('.sel-field-div').hide();
        $('.sel-field-div').parent().append('<span class="not-text">There are no date type field available.</span>');
      }  else {
        $('.sel-field-div').fadeIn('slow');
      }
    } else {
      $('.sel-field-div').fadeOut('slow');
    }
  })*/
/*<div class="col-md-4"> <strong> Edit Form </strong> <br><div class="btn-group" data-toggle="buttons"><label class="btn btn-primary btn-sm"><input type="radio" name="show_in_form_update['+x+']" value="yes" checked > Yes</label> <label class="btn btn-primary btn-sm"><input type="radio" name="show_in_form_update['+x+']" value="no" > No </label></div> </div>*/
   // $('.row .row-div').draggable();
  $('body').on('click', '.add-more-row', function() {
      var max_fields      = 100; //maximum input boxes allowed
      var x = $('.row-div').length;
      if($('.row-div').length < max_fields){
        $('#sortable').append('<li class="ui-state-default">'+
  '<span class="sortable-btn" title="Sort Fields"><i class="fa fa-arrows fa-lg" aria-hidden="true"></i></span>'+
  '<div class="row row-div">'+
    '<div class="col-md-12">'+
      '<div class="col-md-3">'+
        '<div class="form-group">'+
          '<select name="data_type[]" id="data_type_'+x+'" class="type-change js-example-basic-single js-states form-control" >'+
            '<optgroup label="Field Type">'+
              '<option value="text">Text </option>'+
              '<option value="email">Email </option>'+
              '<option value="text_area">Text Area </option>'+
              '<option value="numbers">Numbers  </option>'+
              '<option value="flot-numbers">Decimal Numbers </option>'+
              '<option value="options">Options </option>'+
              '<option value="radio">Radio Buttons </option>'+
              '<option value="checkbox">Check Boxes </option>'+
              '<option value="date">Date </option>'+
              '<option value="Uploadfile">Files Upload</option>'+
              '<option value="password">Password</option>'+
            '</optgroup>'+
            '<optgroup label="Content Heading">'+
              '<option value="Heading">Heading</option>'+
            '</optgroup>'+
            '<optgroup label="Relation Ship(Join)">'+
              '<option value="optionsReletion">Relation Modules</option>'+
            '</optgroup>'+
          '</select>'+
          '<div id="optreletion_'+x+'"></div>'+
        '</div>'+
      '</div>'+
      '<div class="col-md-2">'+
        '<div class="form-group">'+
          '<input type="hidden" placeholder="" name="old_colom[]" class="form-control" value="new_field">'+
          '<input type="hidden" name="pre_define_field[]" value="0">'+
          '<input type="text" placeholder="Title" class="form-control cloneHtmlTextForm preventSpclChar checkValue" maxlength="30" name="title[]" required>'+
        '</div>'+
      '</div>'+
      '<div class="col-md-2 show-in-main-div">'+
        '<div class="btn-group" data-toggle="buttons">'+
          '<label class="btn btn-primary btn-sm">'+
            '<input type="radio" name="is_reuired['+x+']" value="yes" checked> Yes '+
          '</label>'+
          '<label class="btn btn-primary btn-sm">'+
            '<input type="radio" name="is_reuired['+x+']" value="no" > No '+
          '</label>'+
        '</div>'+
      '</div>'+
      '<div class="col-md-2 show-in-main-div">'+
        '<div class="btn-group" data-toggle="buttons">'+
          '<label class="btn btn-primary btn-sm">'+
            '<input type="radio" name="show_in_grid['+x+']" value="yes" checked> Yes '+
          '</label> '+
          '<label class="btn btn-primary btn-sm">'+
            '<input type="radio" name="show_in_grid['+x+']" value="no" > No '+
          '</label>'+
        '</div>'+
      '</div>'+
      '<div class="col-md-2 show-in-main-div">'+
        '<div class="btn-group" data-toggle="buttons">'+
          '<label class="btn btn-primary btn-sm">'+
            '<input type="radio" name="show_in_form['+x+']" value="yes" checked> Yes '+
          '</label>'+
          '<label class="btn btn-primary btn-sm">'+
            '<input type="radio" name="show_in_form['+x+']" value="no" > No '+
          '</label>'+
        '</div>'+
      '</div>'+
      '<div class="col-md-1">'+
        '<div class="checkbox clip-check check-primary">'+
          '<input type="checkbox" class="mka-use-flter" id="fileter'+x+'" value="1">'+
          '<label for="fileter'+x+'"></label>'+
          '<input type="hidden" name="use_as_filter[]" value="0">'+
        '</div>'+
      '</div>'+
    '</div>'+
    '<div class="mka-cl-btn">'+
      '<a href="javascript:;" class="remove_field form-group delete-row btn btn-red mtop"><i class="fa fa-close"></i></a>'+
    '</div>'+
  '</div>'+
'</li>');
      }
      changeToggelButton();
    });
  $('body').on("click",".remove_field", function(e){ //user click on remove text
      e.preventDefault();
      $obj = $(this);
      $(this).parent('div').addClass('remove-row');
      var col_name = $(this).attr('col_name');
      var table_name = $(this).attr('table_name');
      var feild_id = $(this).attr('feild_id');
            $.confirm({
                title: 'Confirm!',
                content: 'Really want to delete!',
                confirmButtonClass: 'btn-info',
                cancelButtonClass: 'btn-danger',
                confirm: function () {
                    $obj.parents('li.ui-state-default').remove();
                    var $hiddenInput = $('<input/>',{type:'hidden',value:col_name,name:'delete[]'});
                    $hiddenInput.appendTo('#form');
                    setTimeout(function() {
                      update_rows();
                    }, 300)
                }
            });
    })

    $(document).on("change" ,'.checkValue', function() {
      $( this ).removeClass( "checkValue" );
      $( this ).addClass( "checkValue1" );
      var obj1 =  $(this).val();
      //var formid = $("#form").val();
      var res = checknameDuplicate("#form", obj1);
      $( this ).removeClass( "checkValue1" );
      $( this ).addClass( "checkValue" );
    });

    $('body').on('change', 'select.type-change', function (e) {
        var option = this.value;
        var option_id = this.id;
        var arr = option_id.split('_');
        var index = (parseInt(arr[2])-1);
        var index_1 = parseInt(arr[2]);
        if(option == 'options'){
            $('#optreletion_'+index_1).html('');
            $('#optreletion_'+index_1).html('<div class="join_rel"><textarea required  class="type-options preventSpclChar " name="type_options_'+index_1+'"></textarea><span class="red help_text_'+option_id+'">Add one option in row(add in New Line)</span></div>');
        }
        else if(option == 'radio'){
            $('#optreletion_'+index_1).html('');
            $('#optreletion_'+index_1).html('<div class="join_rel"><textarea required  class="type-options preventSpclChar" name="type_radios_'+index_1+'"></textarea><span class="red help_text_'+option_id+'">Add one option in row(add in New Line)</span></div>');
        }
        else if(option == 'checkbox'){
            $('#optreletion_'+index_1).html('');
            $('#optreletion_'+index_1).html('<div class="join_rel"><textarea required  class="type-options preventSpclChar" name="type_checkbox_'+index_1+'"></textarea><span class="red help_text_'+option_id+'">Add one option in row(add in New Line)</span></div>');
        }

        else if(option == 'text_area'){
            $('#optreletion_'+index_1).html('');
            $('#optreletion_'+index_1).html('<div class="join_rel"><input type="number" value="3" name="type_textarea_rows_'+index_1+'" class=""><span class="red help_text_'+option_id+'">Rows in textarea</span></div>');
        }
        else if(option == 'Uploadfile')
        {
          $('#optreletion_'+index_1).html('');
          $('#optreletion_'+index_1).html('<div  class="join_rel"><textarea required  class="files_type" name="files_type_'+index_1+'"></textarea><span class="red help_text_'+option_id+'">Exp : jpg,doc etc..</span><label><input type="checkbox" value="multiple" name="upload_checkbox_'+index_1+'"> multiple upload </label> </div>');
            }/*
        else if(option == 'Html')
        {
          $('#optreletion_'+index_1).html('');
          $('#optreletion_'+index_1).html('<div  class="join_rel"><textarea required  class="files_type form-control" name="Html_'+index_1+'"></textarea><span class="red help_text_'+option_id+'">Exp.(Html)</span></div>');
            }
        else if(option == 'Heading')
        {
          $('#optreletion_'+index_1).html('');
          $('#optreletion_'+index_1).html('<div  class="join_rel"><textarea required  class="files_type form-control" name="Heading_'+index_1+'"></textarea><span class="red help_text_'+option_id+'">Exp.(Heading Info.)</span></div>');
        }*/
    else if(option == 'optionsReletion')
    {
          var optreletion_1 = $('#optreletion').html();
          var optreletion = optreletion_1.replace(new RegExp('index_1',"g"),index_1);
          $('#optreletion_'+index_1).html(optreletion);

        }
    else
    {
            $('#optreletion_'+index_1).html('');
        }

      if(option == 'Uploadfile' || option == 'password' || option == 'Heading' ) {
        $(this).parents('.row-div').first().find('input.mka-use-flter').prop('checked', false).trigger('change');
        $(this).parents('.row-div').first().find('input[name="use_as_filter[]"]').val('0');
      }
    });

    $('body').on('change', 'select.tableColom', function() {
      $('select.tableColom').find('option').attr('disabled', false);
      //$val = $(this).val();
      disableSeletedColumn('');
      //$(this).find('option[value="'+$val+'"]').attr('disabled', false);
    });

    $(document).on('change', '.enablefilter', function(){
      var index = $(this).attr('data-index');
      if($(this).is(':checked')) {
        var url_page = "https://www.webprojectbuilder.com/account/getModuleName";
        $.ajax({
          type: "POST",
          url: url_page,
          data: {
            table: $('#Modules_name_'+index).find(":selected").val(),
            project_id: ''
          },
          success: function (data) {
            $('#filter_to_'+index).html(data).show();
            setTimeout(function() {
              $('select.filter_to').find('option').attr('disabled', false);
              disableSeletedColumn('');
            }, 300);
            $('#filter_by_'+index).show();
            $('#filter_to_label_'+index).show();
            $('#filter_by_label_'+index).show();
            $('#enablemultiAssign_'+index).show();
            $('#multiAssigntext_'+index).show();
          }
        });
      } else {
        $('#filter_to_'+index).html('').hide();
        $('#filter_by_'+index).val('').hide();
        $('#filter_to_label_'+index).hide();
        $('#filter_by_label_'+index).hide();
        $('#enablemultiAssign_'+index).hide();
        $('#multiAssigntext_'+index).hide();
      }
    });

    setTimeout(function(){
      var addIconclass = $('span.cs-placeholder').text();
      $('span.cs-placeholder').addClass(addIconclass);
    }, 1000);


    $(document).on('click', '.cs-options ul li', function (e) {
          var obj = $(this);
      $('.cs-placeholder').attr('class','').addClass('cs-placeholder');
      var option = obj.attr('class');
      $('.cs-placeholder').addClass(option);
    });


        $('body').on('change', 'select[name="action"]', function() {
            $('.save-btn').prop('disabled', true);
            get_crud_fields($(this), '');
        });

        $('body').on('change', 'select[name="com_crud"]', function() {
            $('.save-btn').prop('disabled', false);
            $('select[name="action"]').trigger('change');
        });

        $(document).on('change', '.condition_fields', function() {
            var fieldname = $(this).val();
            var relation = $(this).find(':selected').data('relation');
            var relational_table = $(this).find(':selected').data('relation_table');
            var relation_where = $(this).find(':selected').data('relation_where');
            var relation_from = $(this).find(':selected').data('relation_from');
            if(relation == 'optionsReletion'){
                $(this).parent('.col-md-4').parent('.row').find('.is_relation').val('yes');
                $(this).parent('.col-md-4').parent('.row').find('.relational_table').val(relational_table);
                $(this).parent('.col-md-4').parent('.row').find('.relation_where').val(relation_where);
                $(this).parent('.col-md-4').parent('.row').find('.relation_from').val(relation_from);
            }else{
                $(this).parent('.col-md-4').parent('.row').find('.is_relation').val('no');
                $(this).parent('.col-md-4').parent('.row').find('.relational_table').val('');
                $(this).parent('.col-md-4').parent('.row').find('.relation_where').val('');
                $(this).parent('.col-md-4').parent('.row').find('.relation_from').val('');
            }
        });

        $('body').on('click', '.add-row', function(){
            $html = $(this).parents('div.crd_field').html();
            $(this).parents('div.crd_field').after('<div class="form-group crd_field added">'+$html+'</div>');
            $('.added')
            .find('button.add-row')
            .addClass('rm-div')
            .removeClass('add-row')
            .html('<i class="fa fa-minus"></i>')
            .removeClass('btn-primary')
            .addClass('btn-danger');

            $('.added').find('.condition_fields').val('');
            $('.added').find('.con_operators').val('');

            $('.added').find('.is_relation').val('no');
            $('.added').find('.relational_table').val('');
            $('.added').find('.relation_where').val('');
            $('.added').removeClass('added');
        })

        $('body').on('click', '.rm-div', function(){
            $(this).parents('div.crd_field').remove();
        });

        $('body').on('click', '.add-bar-row', function() {
            $obj = $(this).parents('.bar-main-div');
            $rel = parseInt($(this).parents('.bar_label').attr('rel'));
            $rel += 1;
            $obj.append('<div class="mka"><div class="form-group bar_label" rel="'+$rel+'">'+$(this).parents('.bar_label').html()+'</div></div>')
            .find('.add-bar-row')
            .last()
            .addClass('rm-bar-div')
            .removeClass('add-bar-row')
            .addClass('btn-danger')
            .removeClass('btn-primary')
            .find('i.fa')
            .addClass('fa-minus')
            .removeClass('fa-plus')
            .parents('div.mka')
            .find('label.control-label')
            .text('Bar Label '+ $rel + ':');

            $(this).parents('.bar_label').attr('rel', $rel);

            $obj.find('div.mka').last().append('<div class="form-group crd_field">'+$(this).parents('.bar_label').siblings('.crd_field').first().html()+'</div>');

            add_bar_index();
        });

        $('body').on('click', '.rm-bar-div', function() {
          $(this).parents('div.mka').remove();
        })



    $('body').on('click', '.edit-titleN', function(){
      $('#editprotitle').show();
      var proname = $(this).parent().find('.priject-row').text();
      var proid = $(this).parent().find('.priject-row').attr('data-project-id');
      setTimeout(function(){
         $('body').find('#editprotitle').find('.editprotitle').val(proname);
         $('body').find('#editprotitle').find('.editproname').attr('data-project-id',proid);
      },100);
    });

    $('body').on('click','.editproname', function(){
      $obj = $(this);
      $project_id = $obj.attr('data-project-id');
      $title_n = $('body').find('#editprotitle').find('.editprotitle').val();
      $title_new =  $.trim($title_n);
      $('#overlay').show();
      $.ajax({
        url: 'https://www.webprojectbuilder.com/' + 'account/updateProjectTitle',
        method: 'post',
        data:{
          project_id : $project_id,
          title_n : $title_new
        }
      }).done(function(data){
        if(data) {
          $('#overlay').hide();
          $('ul.overflowscroll').find('span[data-project-id="'+$project_id+'"]').text($title_new);
          $('#editprotitle').hide();
          $obj.removeAttr('contenteditable');
          window.location.reload();
        }
      });
    });

  $('body').on('click', '.save_deshbord', function(e){
    $m = $(this).parents('form#addnewdeshbord');
    /* Form validation */
    $m.find('input[required], select[required]').each(function() {
      $o = $(this);
      $o.parents('.form-group').first().removeClass('has-error');
      $o.siblings('span.text-danger').remove()
      if( $o.val() == '' ) {
        if( $o.siblings('span.text-danger').length <= 0 ) {
          $o.after('<span class="text-danger">This field is required<span>');
          $o.parents('.form-group').first().addClass('has-error');
        }
      }
    });
    if($m.find('select[name="action"]').val() == 'sum') {
      $ty = $m.find('select[name="crd_field"] option:selected').attr('data-relation');
      if( $ty != 'numbers' && $ty != 'flot-numbers' ) {
        $m.find('select[name="crd_field"]').after('<span class="text-danger"> please select integer type field..<span>');
        $m.find('select[name="crd_field"]').parents('.form-group').first().addClass('has-error');
      }
    }
    /* Form validation End */

    if( $m.find('.has-error').length == 0 ) {
      $('#overlay').show();
      var comp_type = $(this).find('a').attr('comp_type');
      var project_id = '1';
      $.ajax({
            url: 'https://www.webprojectbuilder.com/account/componenet_view',
            method:'post',
            data:$('form#addnewdeshbord').serialize(),
      }).done(function(data) {
        $('#DeshboardModal').modal('hide');
        $('.mymodal').modal('hide');
        $('#overlay').hide();
        $('#myiframe')[0].contentWindow.location.reload(true);
      });
    }
  });

  
  $('body').on('click', '#header-con-btn', function() {
    $(this).toggleClass('h-active');
    $('.main-header-p').toggleClass('h-active');
    if($(this).hasClass('h-active')) {
      customization_btn($('#myiframe').contents());
    } else {
      remove_customization_btn($('#myiframe').contents());
    }
  });

  setInterval(function() {
    if(!$('#header-con-btn').hasClass('h-active')) {
      $('#header-con-btn').find('.img-text').toggleClass('tada');
    }
  }, 2500);
});

function remove_customization_btn($c) {
  $c.find('div.menu').find('li').each(function() {
    if($(this).find('a').first().hasClass('EditCrud')){
      $(this).find('a').first().removeAttr('style');
      $(this).find('a').first().siblings('a').remove();
    }
  });

  $c.find('div.EditDeshbord').each(function() {
    $(this).find('a.waves-effect').remove();
  });
  $c.find('span.mka-com-add').html('');
}

function customization_btn($c) {
  $c.find('div.menu').find('li').each(function() {
  if($(this).find('a').hasClass('EditCrud')){
    $(this).find('a').attr('style', "width: 72%! important");
      $m = $(this).find('a').after('<a class="right0 waves-effect amDisable EditCrud" title="Edit Module" data-crud_id="'+ $(this).find('a').attr('data-crud_id') +'"><i class="material-icons font-19">mode_edit</i></a>').next('a').css({
          "padding": "7px",
          "border-radius": "49%",
          "box-shadow": "1px 1px 13px -5px",
          "color": "#007aff"
    })

      if($(this).find('a').first().find('span').text() != 'Users') {

        $m.after('<a class="right0 waves-effect del-crud-mka" href="javascript:;" data-project-id="1" data-crud-id="'+$(this).find('a').attr('data-crud_id')+'" title="Delete Module"  data-crud_id="'+ $(this).find('a').attr('data-crud_id') +'"><i class="material-icons font-19">delete</i></a>').next('a').css({
            "padding": "7px",
            "border-radius": "49%",
            "box-shadow": "1px 1px 13px -5px",
            "color": "#f44336"
        });
      }

    }
  });

      $c.find('div.EditDeshbord').each(function() {
      $m = $(this).append('<a data-deshbid_id="'+ $(this).attr('data-deshbid_id') +'"  data-deshbid_type="'+ $(this).attr('data-deshbid_type') +'"  class="right0 waves-effect" onclick="return confirm(\'Are you sure you want to delete this Component?\');" href="https://www.webprojectbuilder.com/account/rm_componenet/'+ $(this).attr('data-deshbid_id') +'/1" target="_parent" ><i class="material-icons font-19" style="color:rgb(244, 67, 54)!important;">delete</i></a>').find('a').css({
              "padding": "5px 5px 0px 4px",
              "border-radius": "49%",
              "box-shadow": "0px 0px 8px 3px",
              "color": "#f44336",
              "background": "rgb(238, 238, 238)",
              "top": "2px",
              "right": "1px",
              "position": "absolute",
              "z-index": "999"
        })
      //if(!$(this).hasClass('del-only')) {
        $m.after('<a data-deshbid_id="'+ $(this).attr('data-deshbid_id') +'"  data-deshbid_type="'+ $(this).attr('data-deshbid_type') +'"  class="right0 waves-effect amDisable EditDeshbord"><i class="material-icons font-19" style="color:rgb(0, 122, 255)!important;">mode_edit</i></a>').next('a.EditDeshbord').css({
                "padding": "5px 5px 0px 5px",
                "border-radius": "49%",
                "box-shadow": "0px 0px 8px 3px",
                "color": "#007aff",
                "background": "rgb(238, 238, 238)",
                "top": "2px",
                "right": "35px",
                "z-index": "999"
          });
      //}
    });

    $c.find('span.mka-com-add').html('<i class="material-icons" title="Add component" style="font-size: 79px;position: relative;box-shadow: 0px 0px 14px 1px #b9b5b5;background-color: #039ae4;color: #fff;cursor: pointer;">add_box</i>');

}


function Modules_names(val,index){
    var url_page = "https://www.webprojectbuilder.com/account/getModuleName";
    $.ajax({
        type: "POST",
        url: url_page,
        data: {
          table: val,
          project_id: ''
        },
        success: function (data) {
              $('#tableColom_'+index).html(data);
              setTimeout(function() {
                $('select.tableColom').find('option').attr('disabled', false);
                disableSeletedColumn('');
              });
              $('#enablefilter_'+index).removeAttr('disabled');
              $('#enablefilter_'+index).removeAttr('checked');
              $('#filter_to_'+index).html('').hide();
              $('#filter_by_'+index).val('').hide();
              $('#filter_to_label_'+index).hide();
              $('#filter_by_label_'+index).hide();
              $('#enablemultiAssign_'+index).hide();
              $('#multiAssigntext_'+index).hide();
            }
        });

        return false;
  }
function changeClassHtml(e) {
    var allvalue = $('#form').serialize();
        $.ajax({
            url : "https://www.webprojectbuilder.com/account/ViewHtmlForm",
            data: allvalue,
            }).done(function(data) {
            $("#TableFormModal").find(".vieditcrut").html(data);
        });
}
$(document).find('body').on('click', 'li.ui-state-default .row.row-div', function(){
  changeClassHtml();
});
$(document).find('body').on('click', '.add-more-row', function(){
  changeClassHtml();
});

function checknameDuplicate(formid,obj1){
  $(formid).find('.checkValue').each(function(){
    var obj2 =  $(this).val();
    if(obj1.toLowerCase() == obj2.toLowerCase()) {
      $(".checkValue1").val('');
      alert('Lable name can not be same');
      return false;
    }
    return true;
  })
}

function AvoidSpace(event) {
    if (event.which == 32) {
      return false;
    }
  }


  function Call(crudtname){
    $('#msg').text('');
    data = crudtname;
    $pr_arr = ['user', 'setting', 'about', 'templates', 'application'];
    if($.inArray(crudtname.toLowerCase(), $pr_arr) > 0){
      $('#msg').text('Some module names are reserved by us like (user, setting, about, templates, application).');
      $('#msg').addClass('text-red');
      $('#crudname').val('').focus();
    } else {
      $.ajax({
        url: "https://www.webprojectbuilder.com/account/check_name?txtval="+data+"&table=crud&column=title&project_id=1",
        success: function(data) {
          if(data != ''){
            $('#msg').text(data);
            $('#msg').addClass('text-red');
            $('#crudname').val('').focus();
            return false;
          }
        }
      });
    }
  }

 var chng_user = function(email, pass) {
    $c = $('#myiframe').contents();
    $Logouturl = $c.find('.info-container').find('ul.dropdown-menu').find('li:last').find('a').attr('href');
    $('#myiframe').attr('src', $Logouturl);
    var interval = setInterval(function() {
      if($c.find('.login-page').length > 0) {
        $c.find('.login-page').find('input[name="email"]').val(email);
        $c.find('.login-page').find('input[name="password"]').val(pass);
        $c.find('.login-page').find('button.btn-block').trigger('click');
        clearInterval(interval);
      }
    }, 900);

 }
</script>

        <script src="https://www.webprojectbuilder.com/assets/js/bootstrap.min.js"></script>
        <script src="https://www.webprojectbuilder.com/assets/js/bootstrap-hover-dropdown.min.js"></script>
        <script src="https://www.webprojectbuilder.com/assets/js/iconset-glyphicon.min.js"></script>
        <script src="https://www.webprojectbuilder.com/assets/js/bootstrap-iconpicker.min.js"></script>
        <script src="https://www.webprojectbuilder.com/assets/js/jquery.sticky-kit.min.js"></script>
        <script src="https://www.webprojectbuilder.com/assets/js/jquery.appear.js"></script>
        <script src="https://www.webprojectbuilder.com/assets/plugins/slick.js/slick/slick.min.js"></script>
        <script src="https://www.webprojectbuilder.com/assets/plugins/swiper/dist/js/swiper.jquery.min.js"></script>
        <script src="https://www.webprojectbuilder.com/assets/plugins/jquery.stellar/jquery.stellar.min.js"></script>
        <script src="https://www.webprojectbuilder.com/assets/js/jquery.countTo.js"></script>
        <script src="https://www.webprojectbuilder.com/assets/plugins/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
        <script src="https://www.webprojectbuilder.com/assets/js/home/main.js"></script>
        <script src="https://www.webprojectbuilder.com/assets/js/jquery.validate.min.js"></script>
        <script src="https://www.webprojectbuilder.com/assets/js/form-validation.js"></script>
        <script src="https://www.webprojectbuilder.com/assets/plugins/select2/select2.min.js"></script>
        <script src="https://www.webprojectbuilder.com/assets/js/modernizr.js"></script>
        <script src="https://www.webprojectbuilder.com/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
        <script src="https://www.webprojectbuilder.com/assets/js/jquery.cookie.js"></script>
        <script src="https://www.webprojectbuilder.com/assets/js/jquery.dataTables.min.js"></script>
        <script src="https://www.webprojectbuilder.com/assets/js/jquery.toaster.js"></script>
        <script src="https://www.webprojectbuilder.com/assets/js/jquery-confirm.js"></script>
        <script src="https://www.webprojectbuilder.com/assets/js/custom.js"></script>
        <script src="https://www.webprojectbuilder.com/assets/js/rating.js"></script>
        <script src="https://www.webprojectbuilder.com/assets/plugins/crumble/js/jquery.grumble.min.js"></script>
        <script src="https://www.webprojectbuilder.com/assets/plugins/crumble/js/jquery.crumble.js"></script>
        <script src="https://www.webprojectbuilder.com/assets/js/clipboard.js"></script>


        <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-89268766-1', 'auto');
        ga('send', 'pageview');

        setTimeout(function(){ga('send', 'event', 'Control', 'Bounce Rate')},30000);
      </script>
      </body>
</html>