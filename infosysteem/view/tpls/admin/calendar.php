<!DOCTYPE html>
<html>
    <head>
        <title>AIS - Logs</title>
        <?php include_once("includes/link.php"); ?>
    </head>
    <script language="javascript" type="text/javascript">
        function resizeIframe(obj) {
            obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';

        }
    </script>
    <body class="page-header-fixed bg-1">
    <?php include_once("includes/topNavigatie.php"); ?>
        <div class="container-fluid clearfix">
                <div class="widget-content clearfix">
                        <main>
                            <div class="col-lg-12">
                                <iframe id="iframe" onload='javascript:resizeIframe(this);' src="http://192.168.178.50/www/info-calendar/" scrolling="no" style="width:100%;" frameborder="0"/>
                            </div>
                        </main>
                </div>
            </div>

    </body>
</html>