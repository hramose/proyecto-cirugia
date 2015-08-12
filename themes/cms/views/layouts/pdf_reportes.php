<!DOCTYPE html> <!-- The new doctype -->
<html>
    <head>
    
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        
		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
		
		<script type="text/javascript">
			Cufon.replace('ul.oe_menu div a',{hover: true});
			Cufon.replace('h1,h2,.oe_heading');
		</script>
        <!-- Internet Explorer HTML5 enabling code: -->
        
        <!--[if IE]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        
        <style type="text/css">
        .clear {
          zoom: 1;
          display: block;
        }
        </style>

        
        <![endif]-->
        
    </head>
    
    <body>
    	
    	<section id="page"> <!-- Defining the #page section with the section tag -->
    
            <header> <!-- Defining the header section of the page with the appropriate tag -->
            </header>
           
				<!-- Article 1 start -->
                <div class="line"></div>  <!-- Dividing line -->
                <article id="article"> <!-- The new article tag. The id is supplied so it can be scrolled into view. -->
					
						<div class="articleBody clear">
							<?php echo $content; ?>
						</div>
						
					
                </article>
				<!-- Article end -->
          

        <footer> <!-- Marking the footer section -->
           </footer>
		</section> <!-- Closing the #page section -->

    </body>
</html>
