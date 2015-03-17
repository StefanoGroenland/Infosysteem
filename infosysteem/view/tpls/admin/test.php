<!DOCTYPE html>
<html>  
    <head>
        <title>
            AIS - Dashboard
        </title>
        <?php include_once("includes/link.php"); ?>
        <script language="javascript" type="text/javascript">
            function resizeIframe(obj) {
                obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';

            }
        </script>
    </head>
    <body class="page-header-fixed bg-1">
        <!-- Navigation -->
        <?php include_once("includes/topNavigatie.php"); ?>
        <!-- End Navigation -->

        <div class="row">
            <div class="col-lg-12">
                <div class="widget-container fluid-height clearfix">
                    <div class="heading bgcolor3">
                        <div class="dashboard-button"></div>&nbsp;&nbsp;&nbsp;&nbsp;Agenda
                    </div>
                    <div class="widget-content padded clearfix">
                        <div class="col-lg-12">
                            <div class="widget-content clearfix">
                                <iframe id="iframe" onload='javascript:resizeIframe(this);' src="http://94.208.116.208/www/info-calendar/" scrolling="no" style="width:1260px;" >

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>