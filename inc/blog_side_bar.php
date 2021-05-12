        <?php 
            if($filename == 'blog-details.php' || $filename == 'blog-details')
            {
                $sqlw = "SELECT * from posts WHERE postSlug <> '$pagelink' AND status = 0 AND pstatus = 0 ORDER BY RAND() LIMIT 3";
            }
            else
            {
                $sqlw = "SELECT * from posts WHERE status = 0 AND pstatus = 0 ORDER BY RAND() LIMIT 3";
            }
            $queryw = $dbh -> prepare($sqlw);
            $queryw->execute();
            $resultsw=$queryw->fetchAll(PDO::FETCH_OBJ);
        ?>        
        <div class="col-xl-4 col-lg-4 content-left-offset">
			<div class="sidebar-container">
			    <!-- Widget -->
			    <?php if(isset($tags) && count($tags) > 0) { ?>
				<div class="sidebar-widget">
					<h3>Tags</h3>
					<div class="task-tags">
					    <?php
					        foreach($tags as $tag)
                            {
                                echo '<a href="#"><span>'.$tag.'</span></a>';
                            }
					    ?>
					</div>
				</div>
				<?php } 
    				if($queryw->rowCount() > 0)
                { ?>
				<!-- Widget -->
				<div class="sidebar-widget">
    				<h3>Trending Posts</h3>
					<ul class="widget-tabs">
                        <?php 
                            foreach($resultsw as $resultw)
                            { 
                        ?>
                       		<li>
    							<a href="<?php echo $root; ?>/blog/post/<?php echo $resultw->postSlug; ?>" class="widget-content active">
    								<img src="<?php echo $root."/admin/uploads/blog_images/".$resultw->post_image; ?>" alt="">
    								<div class="widget-text">
    									<h5><?php echo $resultw->title; ?></h5>
    									<span><?php echo date("d M Y", strtotime($resultw->date_posted)); ?></span>
    								</div>
    							</a>
    						</li>
                        <?php } ?>
						
					</ul>

				</div>
				<?php } ?>
				<!-- Widget / End-->
			</div>
		</div>
    </div>
</div>