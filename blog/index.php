<?php include_once dirname(__FILE__)."/../admin/inc/config.php"; ?>
<?php include dirname(__FILE__)."/../inc/header.php"?>

<!-- Content
================================================== -->
<div id="titlebar" class="white margin-bottom-30">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>Blog</h2>
				<span>Featured Posts</span>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="./">Home</a></li>
						<li>Blog</li>
					</ul>
				</nav>
			</div>
		</div>
	</div>
</div>

<!-- Section -->
<div class="section white">
	<div class="container">
		<div class="row">
			<div class="col-xl-8 col-lg-8">
			    <!-- Blog Post -->
	            <?php 
	                try 
	                {
	                    if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                        } else {
                            $page = 1;
                        }
	                    
	                    $sql1 = "SELECT COUNT(*) as ids from posts WHERE status = 0 AND pstatus = 0 ORDER BY date_posted DESC";
                        $query1 = $dbh -> prepare($sql1);
                        $query1->execute();
                        $results=$query1->fetchAll(PDO::FETCH_OBJ);
                        $total = $results[0]->ids;
    	                $limit = 5;
    	                
    	                $pages = ceil($total / $limit);
    	                
                        // Calculate the offset for the query
                        $offset = ($page - 1)  * $limit;
                    
                        // Some information to display to the user
                        $start = $offset + 1;
                        $end = min(($offset + $limit), $total);
    	                
    	                // The "back" link
                        $prevlink = ($page > 1) ? '<li><a href="?page=1" class="ripple-effect" title="First page"><i class="icon-line-awesome-fast-backward"></i></a></li><li> <a href="?page=' . ($page - 1) . '" class="ripple-effect" title="Previous page"><i class="icon-material-outline-keyboard-arrow-left"></i></a></li>' : '';
                    
                        // The "forward" link
                        $nextlink = ($page < $pages) ? '<li><a href="?page=' . ($page + 1) . '" class="ripple-effect" title="Next page"><i class="icon-line-awesome-fast-forward"></i></a></li><li> <a href="?page=' . $pages . '" class="ripple-effect" title="Last page"><i class="icon-material-outline-keyboard-arrow-right"></i></a></li>' : '';
                    
                        // Display the paging information
                        $paginate = '<div class="pagination-container margin-top-40 margin-bottom-10"><nav class="pagination"><ul>'.$prevlink.$nextlink.' </ul></nav></div>';
                        
                        // Prepare the paged query
                        $sql = "SELECT * from posts WHERE status = 0 AND pstatus = 0 ORDER BY date_posted DESC LIMIT $limit OFFSET $offset ";
                        $query = $dbh -> prepare($sql);
                        $query->execute();
                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                    
                        if($query->rowCount() > 0)
                        {
                            foreach($results as $result)
                            {      
	            ?>
				<a href="<?php echo $root; ?>/blog/post/<?php echo $result->postSlug; ?>" class="blog-post">
					<!-- Blog Post Thumbnail -->
					<div class="blog-post-thumbnail">
						<div class="blog-post-thumbnail-inner">
							<!--<span class="blog-item-tag">Tips</span>-->
							<img src="<?php echo $root; ?>/admin/uploads/blog_images/<?php echo $result->post_image; ?>" alt="">
						</div>
					</div>
					<!-- Blog Post Content -->
					<div class="blog-post-content">
						<span class="blog-post-date"><?php echo date("d M Y", strtotime($result->date_posted)); ?></span>
						<h3><?php echo $result->title; ?></h3>
						<p><?php echo substr(base64_decode(htmlentities($result->contents)), 0, 140).'...'; ?> </p>
					</div>
					<!-- Icon -->
					<div class="entry-icon"></div>
				</a>
			  <?php } 
			  echo $paginate;
                        
                    }else   
			        { echo "No blog available"; }
	                } catch (Exception $e) {
                        echo '<p>', $e->getMessage(), '</p>';
                    } ?>
			</div>
<?php include_once dirname(__FILE__)."/../inc/footer.php"; ?>