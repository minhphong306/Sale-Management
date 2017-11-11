<html>
    <head>
        <link rel="stylesheet" type="text/css" href="library/slick-1.8.0/slick/slick.css"/>
        <link rel="stylesheet" type="text/css" href="library/slick-1.8.0/slick/slick-theme.css"/>

        <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script type="text/javascript" src="library/slick-1.8.0/slick/slick.min.js"></script>

        <style>
            .your-class{
                width: 600px;
                height: 600px;
                align-content: center;
            }
            body{
                background-color: #00ff66
            }
        </style>
    </head>

    <body>
        <div class="your-class" style="width: 760px; height: 480px;">
            <div><img src="images/product/1.jpg" alt=""/></div>
            <div><img src="images/product/2.jpg" alt=""/></div>
            <div><img src="images/product/1.jpg" alt=""/></div>
            <div><img src="images/product/2.jpg" alt=""/></div>
            <div><img src="images/product/1.jpg" alt=""/></div>
            <div><img src="images/product/2.jpg" alt=""/></div>
            <div><img src="images/product/1.jpg" alt=""/></div>
            <div><img src="images/product/2.jpg" alt=""/></div>
        </div>

        <script>
            $(document).ready(function () {
                $('.your-class').slick({
                    autoplay: true,
                    autoplaySpeed: 1000,
                    dots: true,
                });
            });

        </script>



      

    </body>
</html>