<?php include_once dirname(__FILE__)."/../admin/inc/config.php"; ?>
<?php include dirname(__FILE__)."/../inc/header.php"?>
<?php 
    
	$pathInPieces = explode('/', $_SERVER[REQUEST_URI]);
	$pagelink = end($pathInPieces);

    $sql = "SELECT * from posts WHERE status = 0 AND pstatus = 0 AND postSlug = '$pagelink'";
    $query = $dbh -> prepare($sql);
    $query->execute();
    $results=$query->fetch(PDO::FETCH_OBJ);

    if($query->rowCount() > 0)
    {
        $titles = $results->title;
        $contents = base64_decode(htmlentities($results->contents));
        $img = "/admin/uploads/blog_images/".$results->post_image;
        $date = date("d M Y", strtotime($results->date_posted));
        $urlshare = $_SERVER['SERVER_NAME'].'/blog/post/'.$pagelink;
        if($results->tags != null || $results->tags != "")
            $tags = explode(',',$results->tags);
        else
            $tags = [];
    }   
?>
<!-- Content
================================================== -->
<div id="titlebar" class="white margin-bottom-30">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2><?php echo $titles; ?></h2>
				<!--<span>Featured Posts</span>-->

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="<?php echo $root; ?>">Home</a></li>
						<li><a href="<?php echo $root; ?>/blog/blog.php">Blog</a></li>
						<li>Blog Details</li>
					</ul>
				</nav>
			</div>
		</div>
	</div>
</div>

<!-- Post Content -->
<div class="container">
	<div class="row">
		
		<!-- Inner Content -->
		<div class="col-xl-8 col-lg-8">
			<!-- Blog Post -->
			<div class="blog-post single-post">

				<!-- Blog Post Thumbnail -->
				<div class="blog-post-thumbnail">
					<div class="blog-post-thumbnail-inner">
						<!--<span class="blog-item-tag">Tips</span>-->
						<img src="<?php echo $root.$img; ?>" alt="">
					</div>
				</div>

				<!-- Blog Post Content -->
				<div class="blog-post-content">
				
					<div class="blog-post-info-list margin-bottom-20">
						<a href="#" class="blog-post-info"><?php echo $date; ?></a>
					</div>

					<p><?php echo $contents; ?> </p>

					<!-- Share Buttons -->
					<div class="share-buttons margin-top-25">
						<div class="share-buttons-trigger"><i class="icon-feather-share-2"></i></div>
						<div class="share-buttons-content">
							<span>Interesting? <strong>Share It!</strong></span>
							<ul class="share-buttons-icons">
								<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $urlshare; ?>" target="_blank" data-button-color="#3b5998" title="Share on Facebook" data-tippy-placement="top"><i class="icon-brand-facebook-f"></i></a></li>
								<li><a href="http://twitter.com/share?text=<?php echo $title; ?>&url=<?php echo $urlshare; ?>" target="_blank" data-button-color="#1da1f2" title="Share on Twitter" data-tippy-placement="top"><i class="icon-brand-twitter"></i></a></li>
								<li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $urlshare; ?>&title=<?php echo $title; ?>" target="_blank" data-button-color="#0077b5" title="Share on LinkedIn" data-tippy-placement="top"><i class="icon-brand-linkedin-in"></i></a></li>
							</ul>
						</div>
					</div>
				</div>

			</div>
			<!-- Blog Post Content / End -->
			<?php 
                $sqlww = "SELECT * from posts WHERE postSlug <> '$pagelink' AND status = 0 AND pstatus = 0 ORDER BY RAND() LIMIT 2";
                $queryww = $dbh -> prepare($sqlww);
                $queryww->execute();
                $resultsww=$queryww->fetchAll(PDO::FETCH_OBJ);
                if($queryww->rowCount() > 0)
                {
            ?>
                <ul id="posts-nav" class="margin-top-0 margin-bottom-40">
				<li class="next-post">
					<a href="<?php echo $root; ?>/blog/post/<?php echo $resultsww[0]->postSlug; ?>">
						<span>Next Post</span>
						<strong><?php echo $resultsww[0]->title; ?></strong>
					</a>
				</li>
				<li class="prev-post">
					<a href="<?php echo $root; ?>/blog/post/<?php echo $resultsww[1]->postSlug; ?>">
						<span>Previous Post</span>
						<strong><?php echo $resultsww[1]->title; ?></strong>
					</a>
				</li>
			</ul>
           <?php  }?>       
	    </div>

<?php include_once dirname(__FILE__)."/../inc/footer.php"; ?>