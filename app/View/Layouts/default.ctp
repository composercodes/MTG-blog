<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- META TAGS -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- TEMPLATE TITLE -->
        <title>MTG Blog</title>
        <!-- STYLESHEET FILES -->
		<?php echo $this->Html->charset(); ?>
		<title>
			<?php echo $cakeDescription ?>:
			<?php echo $this->fetch('title'); ?>
		</title>
		<?php
			echo $this->Html->meta('icon');

			echo $this->Html->css('normalize.min.css');
			echo $this->Html->css('font-awesome.min.css');
			echo $this->Html->css('main-style.css');
			echo $this->Html->css('main-style_preview2.css');
			echo $this->Html->css('responsive.css');
			echo $this->Html->css('pages.css');

			echo $this->fetch('meta');
			echo $this->fetch('css');
			echo $this->fetch('script');
		?>		

        <!-- IE Script Code -->
        <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
        <![endif]-->
    </head>
    
    <body>
        <!-- START OUTER CONTAINER -->
        <div class="outer-container js_plugins">
            <!-- START HEADER -->
				<?php echo $this->element('header'); ?>
            <!-- END HEADER -->
            <!-- START SECTION -->
            <div class="section">
                <div class="wrapper">
                    <!-- START MAIN CONTENT -->
                    <div class="main-content">
                        <div class="main-content-wrap theiaStickySidebar">	
							<?php echo $this->Session->flash(); ?>
							<?php echo $this->fetch('content'); ?>
                        </div>
                    </div>
                    <!-- END MAIN CONTENT -->
                    <!-- START SIDEBAR CONTENT -->
					<?php echo $this->element('sidebar'); ?>
                    <!-- END SIDEBAR CONTENT -->
                </div>
            </div>
            <!-- END SECTION -->
            <!-- START FOOTER -->
            <footer>
                <div class="wrapper backg-colr">
                    <!-- START TICKER -->          
                    <!-- START BOTTOM FOOTER -->
                    <div class="bottom-footer">
                        <!-- Start Temp Copyrights -->
                        <div class="temp-copyrights up-case">
                            <!-- Copyright -->
                            <div class="copyright">
                                Copyright © 2019 <a href="/">MTG Blog </a> All Rights Reserved.
                            </div>
                            <!-- Designed By -->
                            <div class="designed-by">
                                Develope by <a href="#" target="_blank">Maged Ibrahem</a>.
                            </div>
                        </div>
                        <!-- End Temp Copyrights -->
                    </div>
                    <!-- END BOTTOM FOOTER -->
                </div>
            </footer>
            <!-- END FOOTER -->
        </div>
        <!-- END OUTER CONTAINER -->							
    </body>
    
</html>
