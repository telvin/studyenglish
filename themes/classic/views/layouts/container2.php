<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<body class="html">

<div class="wrapper">
<!-- header -->
<header class="header">
    <div class="shell">
        <div class="header-top">
            <h1 id="logo"><a href="#">Digy</a></h1>
            <nav id="navigation">
                <a href="#" class="nav-btn">Home<span></span></a>
                <ul>
                    <li class="active home"><a href="#">Home</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Projects</a></li>
                    <li><a href="#">Solutions</a></li>
                    <li><a href="#">Jobs</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Contacts</a></li>
                </ul>
            </nav>
            <div class="cl">&nbsp;</div>
        </div>
    </div>
</header>
<!-- end of header -->
<!-- shell -->
<div class="shell">
    <!-- main -->
    <div class="main">

        <?php echo $content; ?>

    </div>
    <!-- end of main -->
</div>
<!-- end of shell -->
<!-- footer -->
<div id="footer">
    <!-- shell -->
    <div class="shell">
        <!-- footer-cols -->
        <div class="footer-cols">
            <div class="col">
                <h2>SERVICES</h2>
                <ul>
                    <li><a href="#">Nullam euismod quam vel</a></li>
                    <li><a href="#">Quisque nec lacuss volutpat</a></li>
                    <li><a href="#">Aenean bibendum lacus varius </a></li>
                    <li><a href="#">Pellentesque sed nulla nec </a></li>
                    <li><a href="#">Donec a velit nisi, ac dignissim</a></li>
                </ul>
            </div>

            <div class="col">
                <h2>SOLUTIONS</h2>
                <ul>
                    <li><a href="#">Quisque nec lacuss volutpat</a></li>
                    <li><a href="#">Aenean bibendum lacus varius </a></li>
                    <li><a href="#">Nullam euismod quam vel</a></li>
                    <li><a href="#">Pellentesque sed nulla nec </a></li>
                    <li><a href="#">Donec a velit nisi, ac dignissim </a></li>
                </ul>
            </div>

            <div class="col">
                <h2>BLOG</h2>
                <ul>
                    <li><a href="#">Quisque nec lacuss volutpat</a></li>
                    <li><a href="#">Aenean bibendum lacus varius </a></li>
                    <li><a href="#">Nullam euismod quam vel</a></li>
                    <li><a href="#">Pellentesque sed nulla nec </a></li>
                    <li><a href="#">Donec a velit nisi, ac dignissim </a></li>
                </ul>
            </div>

            <div class="col">
                <h2>CONTACT us</h2>

                <p>Email: <a href="#">info@websitename.com</a></p>
                <p>Phone: 655-606-605</p>
                <p>Address: East Pixel Bld. 99, </p>
                <p>Template City, 9000</p>
            </div>
            <div class="cl">&nbsp;</div>
        </div>
        <!-- end of footer-cols -->
        <div class="footer-bottom">
            <div class="footer-nav">
                <ul>
                    <li><a hrerf="#">Home</a></li>
                    <li><a hrerf="#">Services</a></li>
                    <li><a hrerf="#">Projects</a></li>
                    <li><a hrerf="#">Solutions</a></li>
                    <li><a hrerf="#">Jobs</a></li>
                    <li><a hrerf="#">Blog</a></li>
                    <li><a hrerf="#">Contacts</a></li>
                </ul>
            </div>
            <p class="copy">Copyright &copy; 2012<span>|</span>Undercontrol by: <a href="http://abc.com" target="_blank">abc</a></p>
            <div class="cl">&nbsp;</div>
        </div>
    </div>
    <!-- end of shell -->
</div>
<!-- footer -->
</div>


<?php $this->endContent(); ?>
